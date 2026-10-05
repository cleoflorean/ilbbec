<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\PendaftaranRefleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    public function CreatePendaftaran(Request $request)
    {
        $userId = Auth::id() ?? $request->UserId;

        // Cegah spam/duplikasi pendaftaran jika user sudah pernah submit
        if ($userId && Pendaftaran::where('UserId', $userId)->exists()) {
            return redirect()->back()->with('error', 'Anda sudah melakukan pendaftaran sebelumnya.');
        }

        $request->validate([
            'Divisi'             => 'required|string|max:255',
            'Divisi2'            => 'required|string|max:255',
            'Foto'               => 'required|file|image|mimes:jpeg,png|max:2048',
            'BerkasCV'           => 'required|file|mimes:pdf|max:2048',
            'Portofolio'         => 'nullable|file|mimes:pdf|max:5120',
            'Pertanyaan1_Emosi'  => 'nullable|string|in:Joy,Anger,Sadness,Disgust,Fear',
            'Pertanyaan1_Alasan' => 'nullable|string|max:2000',
            'Pertanyaan2_Emosi'  => 'nullable|string|in:Joy,Anger,Sadness,Disgust,Fear',
            'Pertanyaan2_Alasan' => 'nullable|string|max:2000',
            'Pertanyaan3_Emosi'  => 'nullable|string|in:Joy,Anger,Sadness,Disgust,Fear',
            'Pertanyaan3_Alasan' => 'nullable|string|max:2000',
        ]);
        $fotoPath = null;
        $BerkasCVPath = null;
        $portofolioPath = null;

        $refleksi = [
            'Pertanyaan1_Emosi'  => $request->Pertanyaan1_Emosi,
            'Pertanyaan1_Alasan' => $request->Pertanyaan1_Alasan,
            'Pertanyaan2_Emosi'  => $request->Pertanyaan2_Emosi,
            'Pertanyaan2_Alasan' => $request->Pertanyaan2_Alasan,
            'Pertanyaan3_Emosi'  => $request->Pertanyaan3_Emosi,
            'Pertanyaan3_Alasan' => $request->Pertanyaan3_Alasan,
        ];

        try {
            $foto = $request->file('Foto');
            $fotoFileName = 'Foto_' . $userId . '_' . time() . '.' . $foto->extension();
            $fotoPath = $foto->storeAs('Foto', $fotoFileName, 'public');
            if (! $fotoPath) {
                throw new \RuntimeException('Foto gagal disimpan ke storage public.');
            }

            $cvFileName = 'CV_' . $userId . '_' . time() . '.pdf';
            $BerkasCVPath = $request->file('BerkasCV')->storeAs('BerkasCV', $cvFileName, 'public');
            if (! $BerkasCVPath) {
                throw new \RuntimeException('CV gagal disimpan ke storage public.');
            }

            if ($request->hasFile('Portofolio')) {
                $portfolioFileName = 'Portofolio_' . $userId . '_' . time() . '.pdf';
                $portofolioPath = $request->file('Portofolio')->storeAs('Portofolio', $portfolioFileName, 'public');
                if (! $portofolioPath) {
                    throw new \RuntimeException('Portofolio gagal disimpan ke storage public.');
                }
            }

            DB::transaction(function () use ($userId, $request, $fotoPath, $BerkasCVPath, $portofolioPath, $refleksi) {
                // Cek sekali lagi di dalam transaksi untuk menghindari race condition
                if (Pendaftaran::where('UserId', $userId)->exists()) {
                    return;
                }

                $pendaftaran = Pendaftaran::create([
                    'UserId'       => $userId,
                    'Divisi'       => $request->Divisi,
                    'Divisi2'      => $request->Divisi2,
                    'Foto'         => $fotoPath,
                    'BerkasCV'     => $BerkasCVPath,
                    'Portofolio'   => $portofolioPath,
                    'StatusBerkas' => 'Menunggu',
                    'StatusAkhir'  => 'Menunggu',
                ]);

                // Simpan data kuesioner refleksi jika tersedia
                if (!empty($refleksi['Pertanyaan1_Emosi'])) {
                    PendaftaranRefleksi::create([
                        'PendaftaranId'      => $pendaftaran->PendaftaranId,
                        'Pertanyaan1_Emosi'  => $refleksi['Pertanyaan1_Emosi'],
                        'Pertanyaan1_Alasan' => $refleksi['Pertanyaan1_Alasan'] ?? '',
                        'Pertanyaan2_Emosi'  => $refleksi['Pertanyaan2_Emosi'],
                        'Pertanyaan2_Alasan' => $refleksi['Pertanyaan2_Alasan'] ?? '',
                        'Pertanyaan3_Emosi'  => $refleksi['Pertanyaan3_Emosi'],
                        'Pertanyaan3_Alasan' => $refleksi['Pertanyaan3_Alasan'] ?? '',
                    ]);
                }
            });
        } catch (\Throwable $e) {
            // Rollback file upload jika DB gagal
            if ($BerkasCVPath) {
                Storage::disk('public')->delete($BerkasCVPath);
            }
            if ($portofolioPath) {
                Storage::disk('public')->delete($portofolioPath);
            }
            if ($fotoPath) {
                Storage::disk('public')->delete($fotoPath);
            }

            Log::error('Pendaftaran gagal untuk UserId ' . $userId . ': ' . $e->getMessage());

            return redirect()->back()->with('error', 'Pendaftaran gagal diproses. Silakan coba kembali.');
        }

        return redirect()->back()->with('success', 'Pendaftaran Anda berhasil diterima!');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ProcessPendaftaranJob;

use Illuminate\Support\Facades\Auth;

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
            'Divisi'     => 'required|string|max:255',
            'Divisi2'    => 'required|string|max:255',
            'BerkasCV'   => 'required|file|mimes:pdf|max:2048',
            'Portofolio' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $cvFileName = 'CV_' . $userId . '_' . time() . '.pdf';
        $BerkasCVPath = $request->file('BerkasCV')->storeAs('BerkasCV', $cvFileName, 'public');

        $portofolioPath = null;
        if ($request->hasFile('Portofolio')) {
            $portfolioFileName = 'Portofolio_' . $userId . '_' . time() . '.pdf';
            $portofolioPath = $request->file('Portofolio')->storeAs('Portofolio', $portfolioFileName, 'public');
        }

        $payload = [
            'UserId'     => $userId,
            'Divisi'     => $request->Divisi,
            'Divisi2'    => $request->Divisi2,
            'BerkasCV'   => $BerkasCVPath,
            'Portofolio' => $portofolioPath,
        ];

        ProcessPendaftaranJob::dispatch($payload);

        return redirect()->back()->with('success', 'Pendaftaran Anda berhasil diterima dan sedang diproses!');
    }
}
<?php

namespace App\Jobs;

use App\Models\Pendaftaran;
use App\Models\PendaftaranRefleksi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProcessPendaftaranJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Jumlah percobaan maksimal jika terjadi kegagalan (misal database lock/busy).
     */
    public int $tries = 3;

    /**
     * Waktu tunda (dalam detik) sebelum mencoba kembali job yang gagal.
     */
    public int $backoff = 5;

    /**
     * Batas waktu eksekusi job (dalam detik).
     */
    public int $timeout = 60;

    protected array $data;

    /**
     * Data pendaftaran dikirim saat Job di-dispatch
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Eksekusi penyimpanan ke database satu per satu di background
     */
    public function handle(): void
    {
        // Cegah duplikasi pendaftaran jika user sudah pernah terdaftar
        if (Pendaftaran::where('UserId', $this->data['UserId'])->exists()) {
            return;
        }

        DB::transaction(function () {
            $pendaftaran = Pendaftaran::create([
                'UserId'       => $this->data['UserId'],
                'Divisi'       => $this->data['Divisi'],
                'Divisi2'      => $this->data['Divisi2'],
                'BerkasCV'     => $this->data['BerkasCV'],
                'Portofolio'   => $this->data['Portofolio'] ?? null,
                'StatusBerkas' => 'Menunggu',
                'StatusAkhir'  => 'Menunggu',
            ]);

            // Simpan data kuesioner refleksi jika tersedia
            if (!empty($this->data['Refleksi']) && !empty($this->data['Refleksi']['Pertanyaan1_Emosi'])) {
                try {
                    PendaftaranRefleksi::create([
                        'PendaftaranId'      => $pendaftaran->PendaftaranId,
                        'Pertanyaan1_Emosi'  => $this->data['Refleksi']['Pertanyaan1_Emosi'],
                        'Pertanyaan1_Alasan' => $this->data['Refleksi']['Pertanyaan1_Alasan'] ?? '',
                        'Pertanyaan2_Emosi'  => $this->data['Refleksi']['Pertanyaan2_Emosi'],
                        'Pertanyaan2_Alasan' => $this->data['Refleksi']['Pertanyaan2_Alasan'] ?? '',
                        'Pertanyaan3_Emosi'  => $this->data['Refleksi']['Pertanyaan3_Emosi'],
                        'Pertanyaan3_Alasan' => $this->data['Refleksi']['Pertanyaan3_Alasan'] ?? '',
                    ]);
                } catch (\Throwable $e) {
                    Log::warning("PendaftaranRefleksi belum dapat disimpan (tabel mungkin belum di-migrate): " . $e->getMessage());
                }
            }
        });
    }

    /**
     * Log kegagalan jika seluruh percobaan gagal
     */
    public function failed(\Throwable $exception): void
    {
        Log::error("ProcessPendaftaranJob gagal untuk UserId {$this->data['UserId']}: " . $exception->getMessage());
    }
}
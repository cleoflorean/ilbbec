<?php

namespace App\Jobs;

use App\Models\Pendaftaran;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessPendaftaranJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        if (Pendaftaran::where('UserId', $this->data['UserId'])->exists()) {
            return;
        }

        Pendaftaran::create([
            'UserId'     => $this->data['UserId'],
            'Divisi'     => $this->data['Divisi'],
            'Divisi2'    => $this->data['Divisi2'],
            'BerkasCV'   => $this->data['BerkasCV'],
            'Portofolio' => $this->data['Portofolio'],
        ]);
    }
}
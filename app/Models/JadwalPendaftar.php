<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPendaftar extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pendaftar';

    protected $fillable = [
        'PendaftaranId',
        'SesiId',
        'status',
        'selected_at',
        'confirmed_at',
    ];

    protected $casts = [
        'selected_at' => 'datetime',
        'confirmed_at' => 'datetime',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'PendaftaranId', 'PendaftaranId');
    }

    public function jadwal_sesi()
    {
        return $this->belongsTo(JadwalSesi::class, 'SesiId', 'SesiId');
    }
}

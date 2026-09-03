<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wawancara extends Model
{
    protected $table = 'wawancara';
    protected $primaryKey = 'WawancaraId';
    protected $fillable = [
        'PendaftaranId', 'SesiId', 'Lokasi', 'NilaiWawancara', 'Catatan', 'StatusWawancara'
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

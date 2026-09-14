<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalSesi extends Model
{
    protected $table = 'jadwal_sesi';
    protected $primaryKey = 'SesiId';
    protected $fillable = [
        'NamaSesi', 'TanggalMulai', 'TanggalSelesai', 'Jam', 'Lokasi', 'IsActive'
    ];

    public function study_case()
    {
        return $this->hasMany(StudyCase::class, 'SesiId', 'SesiId');
    }

    public function wawancara()
    {
        return $this->hasMany(Wawancara::class, 'SesiId', 'SesiId');
    }  
}

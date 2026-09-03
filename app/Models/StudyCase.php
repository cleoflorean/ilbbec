<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyCase extends Model
{
    protected $table = 'study_case';
    protected $primaryKey = 'CaseId';
    protected $fillable = [
        'PendaftaranId', 'SesiId', 'Kelompok', 'NilaiKasus', 'Catatan', 'StatusKasus'
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

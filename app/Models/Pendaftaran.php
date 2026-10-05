<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';
    protected $primaryKey = 'PendaftaranId';
    protected $fillable = [
        'UserId', 'Divisi', 'Divisi2','Foto', 'BerkasCV', 'Portofolio', 'StatusBerkas', 'StatusAkhir'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserId', 'UserId');
    }
    
    public function refleksi()
    {
        return $this->hasOne(PendaftaranRefleksi::class, 'PendaftaranId', 'PendaftaranId');
    }

    public function study_case()
    {
        return $this->hasOne(StudyCase::class, 'PendaftaranId', 'PendaftaranId');
    }

    public function wawancara()
    {
        return $this->hasOne(Wawancara::class, 'PendaftaranId', 'PendaftaranId');
    }

    public function jadwal_pendaftar()
    {
        return $this->hasMany(JadwalPendaftar::class, 'PendaftaranId', 'PendaftaranId');
    }

    /**
     * Mengambil jadwal pendaftar khusus tahap Study Case
     */
    public function getJadwalStudyCaseAttribute()
    {
        return $this->jadwal_pendaftar
            ->first(function ($jp) {
                return $jp->jadwal_sesi && str_contains(strtolower($jp->jadwal_sesi->NamaSesi), 'study');
            });
    }

    /**
     * Mengambil jadwal pendaftar khusus tahap Wawancara
     */
    public function getJadwalWawancaraAttribute()
    {
        return $this->jadwal_pendaftar
            ->first(function ($jp) {
                return $jp->jadwal_sesi && str_contains(strtolower($jp->jadwal_sesi->NamaSesi), 'wawancara');
            });
    }
}

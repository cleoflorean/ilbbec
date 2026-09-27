<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalSesi extends Model
{
    protected $table = 'jadwal_sesi';
    protected $primaryKey = 'SesiId';

    protected $fillable = [
        'NamaSesi',
        'TanggalMulai',
        'TanggalSelesai',
        'Jam',
        'Lokasi',
        'keterangan',
        'status',
        'IsActive',
    ];

    protected $casts = [
        'TanggalMulai' => 'date',
        'TanggalSelesai' => 'date',
        'IsActive' => 'boolean',
    ];

    public function jadwal_pendaftar()
    {
        return $this->hasMany(JadwalPendaftar::class, 'SesiId', 'SesiId');
    }

    public function pendaftaran()
    {
        return $this->hasManyThrough(
            Pendaftaran::class,
            JadwalPendaftar::class,
            'SesiId',
            'PendaftaranId',
            'SesiId',
            'PendaftaranId'
        );
    }

    public function study_case()
    {
        return $this->hasMany(StudyCase::class, 'SesiId', 'SesiId');
    }

    public function wawancara()
    {
        return $this->hasMany(Wawancara::class, 'SesiId', 'SesiId');
    }

    public function scopeAvailable($query)
    {
        return $query->where(function ($q) {
            $q->where('status', 'available')
              ->orWhereNull('status');
        })->where(function ($q) {
            $q->where('IsActive', true)
              ->orWhereNull('IsActive');
        });
    }

    public function scopeForTahap($query, string $tahap)
    {
        return $query->where('NamaSesi', 'LIKE', '%' . $tahap . '%');
    }
}

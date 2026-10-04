<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranRefleksi extends Model
{
    protected $table = 'pendaftaran_refleksi';
    protected $primaryKey = 'RefleksiId';
    protected $fillable = [
        'PendaftaranId',
        'Pertanyaan1_Emosi',
        'Pertanyaan1_Alasan',
        'Pertanyaan2_Emosi',
        'Pertanyaan2_Alasan',
        'Pertanyaan3_Emosi',
        'Pertanyaan3_Alasan',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'PendaftaranId', 'PendaftaranId');
    }
}

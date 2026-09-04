<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';
    protected $primaryKey = 'PendaftaranId';
    protected $fillable = [
        'UserId', 'Divisi', 'BerkasCV', 'Portofolio', 'StatusBerkas', 'StatusAkhir'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserId', 'UserId');
    }
    
    public function study_case()
    {
        return $this->hasOne(StudyCase::class, 'PendaftaranId', 'PendaftaranId');
    }

    public function wawancara()
    {
        return $this->hasOne(Wawancara::class, 'PendaftaranId', 'PendaftaranId');
    }
}

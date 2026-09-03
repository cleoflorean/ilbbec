<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $tabel = 'pendaftaran';
    protected $primarykey = 'PendaftaranId';
    protected $fillable = [
        'UserId', 'Divisi', 'BerkasCV', 'Portofolio', 'StatusBerkas', ' StatusAkhir'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'UsersId', 'UsersId');
    }
    
    public function study_case()
    {
        return $this->hasOne(StudyCase::class. 'PendaftaranId', 'PendaftaranId');
    }

    public function wawancara()
    {
        return $this->hasOne(Wawancara::class, 'PendaftaranId', 'PendaftaranId');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table  = 'prodi';
    protected $primaryKey = 'ProdiId';
    protected $fillable = [
        'NamaProdi'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'ProdiId', 'ProdiId');
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'FakultadId', 'FakultasId');
    }
}

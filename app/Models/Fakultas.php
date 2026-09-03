<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    protected $table = 'fakultas';
    protected $primarykey = 'FakultasId';
    protected $fillable = [
        'NamaFakultas'
    ];

    public function prodi()
    {
        return $this->hasMany(Fakultas::class, 'FakultasId', 'FakultasId');
    }
}

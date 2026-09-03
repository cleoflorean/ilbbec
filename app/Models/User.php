<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'UserId';

    protected $fillable = [
        'ProdiId', 'Nama', 'Npm', 'TempatLahir', 'TanggalLahir',
        'NoTlp', 'Email', 'Password', 'Angkatan', 'Role',
    ];

    protected $hidden = [
        'Password', 'remember_token',
    ];

    protected $casts = [
        'TanggalLahir' => 'date',
        'Password'     => 'hashed',
    ];

    // ── Override: kolom email & password untuk Laravel Auth ───────────────────
    public function getAuthPassword(): string
    {
        return $this->Password;
    }

    public function getEmailForPasswordReset(): string
    {
        return $this->Email;
    }

    // ── Relasi ────────────────────────────────────────────────────────────────
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'ProdiId', 'ProdiId');
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'UserId', 'UserId');
    }
}

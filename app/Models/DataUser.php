<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class DataUser extends Authenticatable
{
    protected $table = 'data_user';
    protected $primaryKey = 'id_user';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_user',
        'nama',
        'NIK',
        'username',
        'password',
        'email',
        'no_telepon',
        'jenis_kelamin',
        'role',
        'foto'
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Override default Auth identifier (email → username)
     */
    public function getAuthIdentifierName()
    {
        return 'username';
    }
}

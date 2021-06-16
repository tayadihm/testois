<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'no_kartu',
        'nim',
        'nama_mhs',
        'tempat_lahir',
        'tgl_lahir',
        'kelas',
        'jurusan',
        'alamat',
        'no_telfon',
        'email',
        'password',
        'saldo',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function saldo()
    {
        return $this->hasOne('App\Saldo','mhs_id')->withDefault();
    }

    public function dataparkir()
    {
        return $this->hasOne('App\Dataparkir','mhs_id')->withDefault();
    }

    public function kantin()
    {
        return $this->hasOne('App\Kantin','mhs_id')->withDefault();
    }


}

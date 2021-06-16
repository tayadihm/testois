<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Dataparkir extends Model
{
    use HasApiTokens, Notifiable;

    protected $table = 'dataparkirs';

    public function mahasiswa()
    {
        return $this->hasOne('App\Mahasiswa','id')->withDefault();
    }
}

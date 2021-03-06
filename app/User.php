<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function perusahaans()
    {
        return $this->belongsToMany('App\Models\Perusahaan','perusahaan_user','user_id','perusahaan_id');
    }

    public function perusahaanUser()
    {
        return $this->hasMany('App\Models\PerusahaanUser');
    }

    public function hasPerusahaan($id)
    {
        foreach ($this->perusahaanUser as $unit)
        {
            if ($unit->perusahaan_id == $id) return true;
        }
        return false;
    }
}

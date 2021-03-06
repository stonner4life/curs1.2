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
        'name', 'email', 'password','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function rooms(){
        return $this->hasMany('App\RoomTask');
    }

    public function roles(){
        return $this->hasMany('App\Role','id','role');
    }

    public function isAdmin()
    {
//        return $this->admin; // this looks for an admin column in your users table

        return Role::find($this->attributes['role'])->name == 'admin';
    }

//    protected $appends = ['isAdmin'];
//    public function getIsAdminAttribute()
//    {
//        return Role::find($this->attributes['role'])->name == 'admin';
//    }
}

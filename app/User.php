<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Hashids;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'first_name', 'last_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('message')->encode($this->attributes['id']);
    }

    public function getFirstNameAttribute($value)
    {
        return ucwords($value);
    }

    public function messages()
    {
        return $this->hasMany('App\Message','to','id');
    }

    public function sent()
    {
        return $this->hasMany('App\Message','sender','id');
    }

    public function student()
    {
        return $this->hasOne('App\Student', 'email', 'email');
    }

    public function role()
    {
        return $this->hasOne('App\Role');
    }

}

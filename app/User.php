<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function InfoInitLog(){
      return $this->hasOne('App\InfoInitLog');
      // 一对一 关系
    }
    public  function SocialConnect()
    {
      return $this->hasMany('App\SocialConnect');
    }
    public function Donates(){
      return $this->hasMany('App\Donate');
    }
    public function SocialConnects(){
      return $this->hasMany('App\SocialConnect');
    }

}

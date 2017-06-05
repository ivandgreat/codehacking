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
    protected $fillable = [
        'name', 'email', 'password','role_id','is_active','photo_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
      return $this->belongsTo('App\Role');
    }


    public function photo(){

      return $this->belongsTo('App\Photo');

    }

    // it was not yet explained
    // public function setPasswordAttribute($password){
    //   if(!empty($password)){
    //     $this->attributes['password'] = bcrypt($password);
    //   }
    // }


    public function isAdmin(){

      if($this->role->name == 'administrator' && $this->is_active == 1){
        return true;
      }

      return false;
    }

    // this is mutators added from devlob youtube, always start with set
    //-----------------------------------------------------------------------
    public function setNameAttribute($value){
      $this->attributes['name'] = ucfirst($value);
    }

    public function setPasswordAttribute($value){
      $this->attributes['password'] = bcrypt($value);
    }
    //-----------------------------------------------------------------------

    public function posts(){

      return $this->hasMany('App\Post');

    }

}

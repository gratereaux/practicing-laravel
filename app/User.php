<?php

namespace App;

use App\Http\Requests;
use App\Practicante;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'type',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articles(){
        return $this->hasMany('\App\Article');
    }

    public function scopeSearch($query, $name){

        return $query->where('name', 'LIKE', '%'.$name.'%');

    }

    public function isAdministrator(){

        if(\Auth::user()->type == "admin"){
            $response = true;
        }else{
            $response = false;
        }

        return $response;
    }
}

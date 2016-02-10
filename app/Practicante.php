<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Practicante extends Model
{
    
	protected $table = "practicantes";

	protected $fillable = ['name', 'dojo', 'typemember','actual_rank', 'bbnumber', 'email', 'yearbegin', 'policecourse', 'comments'];


	public function pagos(){
    	return $this->hasMany('\App\Pago');
    }


	public function scopeSearch($query, $name){

        return $query->where('name', 'LIKE' ,'%'.$name.'%');
    }

}

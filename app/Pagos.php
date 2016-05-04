<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = "pagos";

    protected $fillable = ['practicante_id', 'ammount', 'fecha_pago', 'concepto', 'is_paid', 'comments'];


    public function practicante(){
    	return $this->belongsTo('\App\Practicante');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Practicante;
use App\Http\Requests\PracticanteRequest;

class ApiController extends Controller
{
    public function practicantes(){
		$practicantes = Practicante::all();
		return response()->json($practicantes);    	
    }
}

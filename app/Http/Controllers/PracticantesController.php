<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Practicante;
use Laracasts\Flash\Flash;
use App\Tag;
use App\Http\Requests\PracticanteRequest;
use Config;


class PracticantesController extends Controller
{
    public function index(Request $request){

    	$practicantes = Practicante::search($request->name)
    							->orderBy('yearbegin', 'DESC')
    							->paginate(10);

    	return view('admin.practicantes.index')->with('practicantes', $practicantes);
    }

    public function create(){
    	
    	return view('admin.practicantes.create')
    					->with('ranks', Config::get('constants.ranks'))
    					->with('type', Config::get('constants.type'))
    					->with('dojos', Config::get('constants.dojos'))
    					->with('cursos', Config::get('constants.cursos'));
    }



    public function store(PracticanteRequest $request){

    	dd($request->all());
	
	}
}

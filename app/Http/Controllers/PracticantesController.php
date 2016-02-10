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
use DB;

class PracticantesController extends Controller
{
    public function index(Request $request){


    	$practicantes = Practicante::search($request->name)
    							->orderBy('yearbegin')
    							->paginate(10);

    	return view('admin.practicantes.index')
                        ->with('practicantes', $practicantes)
                        ->with('dojos', Config::get('constants.dojos'))
                        ->with('ranks', Config::get('constants.ranks'))
                        ->with('type', Config::get('constants.type'));
    }

    public function create(){
    	
    	return view('admin.practicantes.create')
    					->with('ranks', Config::get('constants.ranks'))
    					->with('type', Config::get('constants.type'))
    					->with('dojos', Config::get('constants.dojos'))
    					->with('cursos', Config::get('constants.cursos'));
    }



    public function store(PracticanteRequest $request){

        $practicante = new Practicante($request->all());
        if ($practicante->policecourse){
            $practicante->policecourse = implode(',', $practicante->policecourse);
        }
        $practicante->save();

        Flash::success('Se ha agregado el practicante '. $practicante->name);
        return redirect()->route('admin.practicantes.index');
	
	}

    public function destroy($id){

        $practicante = Practicante::find($id);
        $titulo = $practicante->name;


        $practicante->delete();

        Flash::error("El practicante ".$titulo." ha sido eliminada de manera exitosa!");
        
        return redirect()->route('admin.practicantes.index');

    }

    public function edit($id){

        $practicante = Practicante::find($id);

        return view('admin.practicantes.edit')
                    ->with('practicante', $practicante)
                    ->with('ranks', Config::get('constants.ranks'))
                    ->with('type', Config::get('constants.type'))
                    ->with('dojos', Config::get('constants.dojos'))
                    ->with('cursos', Config::get('constants.cursos'));

    }

    public function update(Request $request, $id){

        if($request->policecourse){
            $policecourse = implode(',',$request->policecourse);
        }else{
            $policecourse = null;
        }

        DB::table('practicantes')->where('id', $id)->update([
                    'name' => $request->name,
                    'dojo' => $request->dojo,
                    'typemember' => $request->typemember,
                    'actual_rank' => $request->actual_rank,
                    'bbnumber' => $request->bbnumber,
                    'email' => $request->email,
                    'yearbegin' => $request->yearbegin,
                    'policecourse' => $policecourse,
                    'comments' => $request->comments
            ]);

        Flash::warning('Se ha editado la cuenta de '. $request->name .' de manera exitosa.');
        
        return redirect()->route('admin.practicantes.index');

    }
}

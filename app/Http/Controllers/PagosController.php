<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Pago;
use App\Practicante;
use Config;

class PagosController extends Controller
{
    public function index(Request $request){

    	return "Listado de pendientes a pago";
    	
    }

    public function show(Request $request, $id){

    	$practicante = Practicante::find($id);
    	$pagos = Pago::where('practicante_id', $id)->orderBy('fecha_pago', 'desc')->paginate(10);

    	return view('admin.pagos.detail')
                        ->with('practicante', $practicante)
                        ->with('pagos', $pagos)
                        ->with('dojos', Config::get('constants.dojos'))
                        ->with('ranks', Config::get('constants.ranks'))
                        ->with('type', Config::get('constants.type'))
                        ->with('conceptos', Config::get('constants.conceptos'));
    }



    public function destroy($id){
    	
    	$pago = Pago::find($id);
        
        $practicante_id = $pago->practicante_id;

        $pago->delete();

        Flash::error("El pago ha sido eliminada de manera exitosa!");
        
        return redirect()->route('admin.pagos.show', [$practicante_id]);

    }

    public function edit($id){
    	$pago = Pago::find($id);
        $practicante = Practicante::find($pago->practicante_id);
        
        return view('admin.pagos.edit')
                        ->with('pago', $pago)
                        ->with('practicante', $practicante)
                        ->with('dojos', Config::get('constants.dojos'))
                        ->with('ranks', Config::get('constants.ranks'))
                        ->with('type', Config::get('constants.type'))
                        ->with('conceptos', Config::get('constants.conceptos'));

    }

    public function update(Request $request, $id){


        $pago = Pago::find($id);

        $pago->concepto = $request->concepto;
        $pago->fecha_pago = $request->fecha_pago;
        $pago->is_paid = $request->is_paid;
        $pago->ammount = $request->ammount;
        $pago->comments = $request->comments;  
        
        $pago->save();

        Flash::success('Se ha modificado el pago de forma satisfactoria.');
        return redirect()->route('admin.pagos.show', [$pago->practicante_id]);


    }

    public function store(Request $request, $id){

        $pago = new Pago($request->all());

        $pago->practicante_id = $id;

        $pago->save();

        Flash::success('Se ha registrado el pago de forma satisfactoria.');
        return redirect()->route('admin.pagos.show', [$id]);
    }


    public function create(Request $request, $id){

    	$practicante = Practicante::find($id);
    	
    	return view('admin.pagos.pay')
                        ->with('practicante', $practicante)
                        ->with('dojos', Config::get('constants.dojos'))
                        ->with('ranks', Config::get('constants.ranks'))
                        ->with('type', Config::get('constants.type'))
                        ->with('conceptos', Config::get('constants.conceptos'));

	}
}

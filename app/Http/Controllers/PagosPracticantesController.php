<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pago;
use App\Practicante;
use Laracasts\Flash\Flash;
use Config;

class PagosPracticantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $practicante_id = Practicante::where('email', $request->user()->email)->get()[0]->id;
        $pagos = Pago::where('practicante_id', $practicante_id)
                                    ->orderBy('fecha_pago', 'desc')
                                    ->paginate(10);

        return view('practicante.pagos.index')->with('pagos', $pagos)
                                              ->with('conceptos', Config::get('constants.conceptos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pago_detail = Pago::find($id);
        return view("practicante.pagos.detail")->with('pago', $pago_detail);
    }
}

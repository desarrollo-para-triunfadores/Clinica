<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Provincia;
use App\Localidad;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
Use Session;

class LocalidadesController extends Controller {

    public function __construct() {
        Carbon::setlocale('es'); // Instancio en Español el manejador de fechas de Laravel    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $localidades = Localidad::all();
        $provincias = Provincia::all();
        return view('localidades.main')->with('localidades', $localidades)->with('provincias', $provincias); // se devuelven los registros
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $localidad = new Localidad($request->all());
        $localidad->save();
        Session::flash('message', 'Se ha registrado a una nueva localidad.');
        return redirect()->route('localidades.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $localidad = Localidad::find($id);
        $provincias = Provincia::all()->lists('nombre', 'id');
        return view('localidades.show')
                        ->with('localidad', $localidad)
                        ->with('provincias', $provincias);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $localidad = Localidad::find($id);
        $localidad->fill($request->all());
        $localidad->save();
        Session::flash('message', 'Se ha actualizado la información');
        return redirect()->route('localidades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $localidad = Localidad::find($id);
        $localidad->delete();
        Session::flash('message', 'La localidad ha sido eliminada');
        return redirect()->route('localidades.index');
    }

}

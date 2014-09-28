<?php

class ToursController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /tours
	 *
	 * @return Response
	 */
	public function index()
	{
			$papeleta= Papeleta::find(1);
			$noPapeleta= $papeleta->papeleta;
			$papeleta->papeleta = $noPapeleta+1;
			$papeleta->save();
			$reservacion = new Reservation;
			$reservacion->papeleta= $noPapeleta;
			$reservacion->tipo = 'Tour';
			$reservacion->estado = 'Activa';
			if ($reservacion->save()) {
				$tours = new Tour;
				$tours->papeleta = $noPapeleta;
				$tours->save();
				return Redirect::to('tours/edit/'.$noPapeleta);
			}else {
				Session::flash('message','Ha ocurrido un error!');
				Session::flash('class','danger');
				return Redirect::to('consultas');
			}
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /tours/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /tours
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /tours/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($papeleta)
	{
		     $tours =   DB::table('tours')->where('papeleta', $papeleta)->first();
             $reservacion = DB::table('reservations')->where('papeleta', $papeleta)->first();
		     return View::make('tours.show')->with('tours',$tours)->with('reservacion',$reservacion); 
		
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /tours/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($papeleta)
	{
			 $tours =  DB::table('tours')->where('papeleta', $papeleta)->first();
             $reservacion = DB::table('reservations')->where('papeleta', $papeleta)->first();
		     Session::put('papeleta', $papeleta);
		     return View::make('tours.edit')->with('tours',$tours)->with('reservacion',$reservacion); 
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /tours/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
			$tours = Tour::find($id);
			$tours->operador = Input::get('ope');
			$tours->tour = Input::get('tour');
			$tours->fecha = Input::get('fecha');
			$tours->claveOperador = Input::get('claveOperador');
			$tours->claveTour = Input::get('claveTour');
			$noPapeleta=$tours->papeleta;
            $reservacion = Reservation::where('papeleta', $noPapeleta)->first();
            $reservacion->destino = Input::get('des');
		    $reservacion->operador = Input::get('ope');
		    $reservacion->tipo = 'Tour';
			$reservacion->estado = 'Activa';
			$reservacion->costoPax = Input::get('costoP');
			$reservacion->costoNeto = Input::get('costoN');
			$reservacion->observacionesPax = Input::get('obPax');
			$reservacion->observacionesAgencia = Input::get('obAg');
			$reservacion->tiempoLimite= Input::get('tmLim');

 	        if ($tours->save()) {
	    	$reservacion->save();
				Session::flash('message','Actualizado correctamente!');
				Session::flash('class','success');
	    	} else {
				Session::flash('message','Ha ocurrido un error!');
				Session::flash('class','danger');
	    	}

             return Redirect::to('tours/edit/'.$noPapeleta);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /tours/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
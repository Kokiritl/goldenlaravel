<?php

class HotelplanesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /hotelplanes
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('hotelAvion.edit');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /hotelplanes/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /hotelplanes
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /hotelplanes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	
		
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /hotelplanes/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($papeleta)
	{
		 $hotelplane =  DB::table('hotelplanes')->where('papeleta', $papeleta)->first();

             $reservacion = DB::table('reservations')->where('papeleta', $papeleta)->first();   		 
        return View::make('hotelplanes.edit')->with('hotelplane',$hotelplane)->with('reservacion',$reservacion);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /hotelplanes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	  	    $hotelplane = Hotelplanes::find($id);
			$hotelplane->papeleta = Input::get('numP');
			$hotelplane->destino = Input::get('des');
			$hotelplane->operador = Input::get('ope');
			$hotelplane->aerolinea = Input::get('aero');
			$hotelplane->clave = Input::get('clave');
			$hotelplane->equipaje = Input::get('equipaje');
			$hotelplane->tarifa = Input::get('tarifa');
			$hotelplane->itinerario = Input::get('itinerario');
			$hotelplane->FechaSalida = Input::get('fechaS');
			$hotelplane->FechaRegreso = Input::get('fechaR');
			$hotelplane->nombreHotel = Input::get('nameH');
			$hotelplane->fechaDeEntrada = Input::get('fechaE');
			$hotelplane->fechaDeSalida = Input::get('fechaS');
			$hotelplane->sgl = Input::get('habS');
			$hotelplane->dbl = Input::get('habD');
			$hotelplane->tpl = Input::get('habT');
			$hotelplane->cpl = Input::get('habC');
			$hotelplane->otros = Input::get('habO');
			 $noPapeleta=$hotelplane->papeleta;	
            $reservacion = Reservation::where('papeleta', $noPapeleta)->first();
            $reservacion->destino = Input::get('des');
		    $reservacion->operador = Input::get('ope'); 
		    $reservacion->tipo = 'Avion';
			$reservacion->estado = 'Activa';
			$reservacion->costoPax = Input::get('costoP');
			$reservacion->costoNeto = Input::get('costoN');
			$reservacion->observacionesPax = Input::get('obPax');
			$reservacion->observacionesAgencia = Input::get('obAg');
			$reservacion->tiempoLimite= Input::get('tmLim');
       
 	   if ($plane->save()) {  
		$reservacion->save();
			Session::flash('message','Actualizado correctamente!');
			Session::flash('class','success');
		} else {
			Session::flash('message','Ha ocurrido un error!');
			Session::flash('class','danger');
		}
   
   return Redirect::to('hotelAvion/edit/'.$noPapeleta);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /hotelplanes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
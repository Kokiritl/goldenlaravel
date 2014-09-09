<?php

class PagosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /pagos
	 *
	 * @return Response
	 */
	public function index()
	{

		
		return View::make('pagos.index');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /pagos/create
	 *
	 * @return Response
	 */
	public function create($papeleta=null)
	{
		$id=0;
		$reservacion= Reservation::where('papeleta', '=', $papeleta)->get();
		foreach ($reservacion as $key => $value) {
			$id=$value->idCliente;
		}
		$clientes = Cliente::find($id);
		$pagos = Pago::where('papeleta', '=', $papeleta)->get();

        //return View::make('clientes.index')->with('clientes',$clientes);
		return View::make('pagos.create')->with('clientes',$clientes)->with('reservacion',$reservacion)->with('pagos',$pagos);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /pagos
	 *
	 * @return Response
	 */
	public function store()
	{
		$pagos = new Pago;

		$pagos->cantidad = Input::get('cantidad');
		$pagos->formaDePago = Input::get('formaDePago');
		$pagos->tarjeta = Input::get('tarjeta');
		$pagos->pagoDe = Input::get('tipoDePago');
		

		if ($pagos->save()) {
			Session::flash('message','Pago Guardado correctamente!');
			Session::flash('class','success');
		} else {
			Session::flash('message','Ha ocurrido un error!');
			Session::flash('class','danger');
		}

		return Redirect::to('pagos/create');
	}

	/**
	 * Display the specified resource.
	 * GET /pagos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /pagos/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /pagos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /pagos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
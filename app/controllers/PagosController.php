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
		$pagos = Pago::where('papeleta', '=', $papeleta)->get();

        //return View::make('clientes.index')->with('clientes',$clientes);
		return View::make('pagos.create')->with('reservacion',$reservacion)->with('pagos',$pagos);
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
		$pagos->papeleta = Input::get('papeleta');
		$pagos->formaDePago = Input::get('formaDePago');
		$pagos->tarjeta = Input::get('tarjeta');
		$pagos->cupon = Input::get('cupon');
		$pagos->pagoDe = Input::get('tipoDePago');
		$pagos->usuario = Auth::user()->name;

		if ($pagos->save()) {
			Session::flash('message','Pago Guardado correctamente!');
			Session::flash('class','success');
			$reservacion= Reservation::where('papeleta', '=', Input::get('papeleta'))->first();
			$totalAgencia= $reservacion->costoNeto;
			$totalPax= $reservacion->costoPax;
			$idReservacion= $reservacion->id;
			$papeleta = Input::get('papeleta');
			$sumas= DB::select('SELECT pagoDe,sum(cantidad) as suma FROM pagos where papeleta='.$papeleta.' group by pagoDe');
			$sumaAgencia=0;
			$sumaPax=0;
			foreach($sumas as $valor){
				if($valor->pagoDe == 'Agencia'){
					$sumaAgencia=$valor->suma;
				}
				if($valor->pagoDe == 'Pax'){
					$sumaPax=$valor->suma;
				}
			}
			$restoAgencia = $totalAgencia-$sumaAgencia;
			$restoPax = $totalPax-$sumaPax;

			$reservacion = Reservation::find($idReservacion);
			if($restoAgencia <= 0 && $restoPax <= 0){
				$reservacion->estado = 'Completo';
			}elseif($restoAgencia <= 0){
				$reservacion->estado = 'Falta pax';
			}elseif($restoPax <= 0){
				$reservacion->estado = 'Falta Agencia';
			}
			$reservacion->save();
			return Redirect::to('pagos/nuevo/'.Input::get('papeleta'));
		} else {
			Session::flash('message','Ha ocurrido un error!');
			Session::flash('class','danger');
		}

		return Redirect::to('pagos/nuevo/'.Input::get('papeleta'));
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
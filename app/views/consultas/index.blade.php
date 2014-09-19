@extends('layouts.default')
@section('content')
@include ('includes.menu')

	<h1>Consultas</h1>

	<div class="panel panel-success">
  		<div class="panel-heading">
  			<h4>Todas las Papeletas</h4>
  		</div>

  		<div class="panel-body">
    		<table class="table">
				<thead>
					<tr>
						<th>Id</th>
						<th>papeleta</th>
						<th>Nombre Pax</th>
						<th>Creado el</th>
						<th>Tiempo Limite</th>
						<th>Tipo</th>
						<th>Estado</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
				@if (!empty($consultas))
					@foreach($consultas as $consulta)
					{{$miTipo='';}}
						<tr>
							@if($consulta->tipo == 'Hotel')
								<?php $miTipo='hoteles'; ?>
							@elseif($consulta->tipo =='Avion')
								<?php $miTipo ='aviones'; ?>
							@endif
							<td>{{ $consulta->id }}</td>
							<td><a href="/{{$miTipo}}/show/{{ $consulta->papeleta }}"><span class="label label-info">{{ $consulta->papeleta }}</span></a></td>
							<td>{{ $consulta->nombre }}</td>
							<td>{{ $consulta->created_at}}</td>
							<td>{{ $consulta->tiempolimite }}</td>
							<td>{{ $consulta->tipo }}</td>
							<td>{{ $consulta->estado }}</td>
							<td>
							@if($consulta->estado =='Activa')
								<a href="/{{$miTipo}}/edit/{{ $consulta->papeleta }}"><span class="label label-success">Editar</span></a>
								<a href="{{ url('/reservation/destroy',$consulta->papeleta) }}"><span class="label label-danger">Cancelar</span></a>
							@endif
								<a href="/pagos/nuevo/{{ $consulta->papeleta }}"><span class="label label-info">Pago</span></a>
							</td>
						</tr>
					@endforeach
			@else
	          	<tr><th colspan="5">
	            	No existe información en esta consulta.
	          	</th></tr>
          	@endif
				</tbody>
			</table>
  		</div>
  	</div>
	@if(Session::has('message'))
	    <div class="alert alert-{{ Session::get('class') }}">{{ Session::get('message')}}</div>
	@endif
@stop

@extends('layouts.default')
@section('content')
@include ('includes.menu')

<script type="text/javascript" src="/js/bootstrap.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#tablaClientes').html('<img src="/img/preloader-01.gif">');

		$.get("/clientes/lista/{{Session::get('papeleta')}}", function (data) {
			$('#tablaClientes').html(data);
		});

	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		var modo=1;
		$('#nuevoCliente').click(function(e){
			e.preventDefault();
			$('#modal1 .modal-title').html('Buscar Pax');
			$('#modal1 .modal-body').html('<img src="/img/preloader-01.gif" height="20">');
			$('#modal1 .btn-primary').show();
			$('#modal1 .btn-primary').html('Nuevo Pax');
			$('#modal1 .btn-default').html('Cerrar');
			$('#modal1').modal();
			$.get("/clientes/buscar/{{Session::get('papeleta')}}", function (data) {
				$('#modal1 .modal-body').html(data);
			});
		});

		$("#modal1").on('hidden.bs.modal', function (e) {
			$('#modal1 .modal-body').html("");
			$('#tablaClientes').html('<img src="/img/preloader-01.gif">');
	    	$.get("/clientes/lista/{{Session::get('papeleta')}}", function (data) {
				$('#tablaClientes').html(data);
			});
	    });

	    $('#modal1 .btn-primary').click(function(e){
	    	//$('#modal1').modal('toggle');
	    	if(modo==1){
	    		modo=2;
	    		$('#modal1 .modal-title').html('Nuevo Pax');
				$('#modal1 .modal-body').html('<img src="/img/preloader-01.gif" height="20">');
				//$('#modal1 .btn-primary').hide();
				$('#modal1 .btn-primary').html('Regresar');
				$('#modal1 .btn-default').html('Cerrar');
				//$('#modal1').modal();
				$.get("/clientes/nuevopax/create", function (data) {
					$('#modal1 .modal-body').html(data);
				});
	    	}else{
	    		modo=1;
	    		$('#modal1 .modal-title').html('Buscar Pax');
				$('#modal1 .modal-body').html('<img src="/img/preloader-01.gif" height="20">');
				//$('#modal1 .btn-primary').show();
				$('#modal1 .btn-primary').html('Nuevo Pax');
				$('#modal1 .btn-default').html('Cerrar');
				$('#modal1').modal();
				$.get("/clientes/buscar/{{Session::get('papeleta')}}", function (data) {
					$('#modal1 .modal-body').html(data);
				});
	    	}
	    });

	});
</script>
	<h1>Vuelos</h1>

	<div class="panel panel-success">
  		<div class="panel-heading">
  			<h4>Actualizar Vuelo</h4>
  		</div>
                 
  		<div class="panel-body">
  			@if (!empty($plane))
    			<form method="post" action="/aviones/update/{{ $plane->id }}">
		        <p>
						<h3>Papeleta</h3><hr>
					</p>
		          	<p>
		            	Numero de Papeleta: <b>{{Session::get('papeleta')}}</b>
		          	</p>
		          	<hr>
	  			     <p>
					<h4>Datos del Pax</h4>
				    </p>
					    <button class="btn btn-primary btn-lg" id="nuevoCliente" >
						  <img src="/img/iconos/buscar.png" height="20"> Buscar Pax
						</button>
			    		<div class="modal fade" id="modal1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog modal-lg">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title text-primary"></h4>
						      </div>
						      <div class="modal-body">
						      </div>
						      <div class="modal-footer">
						        <button type="button" id="modal-button1" class="btn btn-default" data-dismiss="modal"></button>
						        <button type="button" id="modal-button2" class="btn btn-primary"></button>
						      </div>
						    </div><!-- /.modal-content -->
						  </div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
						<div id='tablaClientes' align="center"><img src="/img/preloader-01.gif"></div>
		            
		          	<hr>
	  			<p>
					<h4>Datos del Vuelo</h4>
				</p>
                     <p>
		            	Destino:<input  value="{{ $plane->destino  }}" type="text" name="des"  class="form-control" required>
		          	</p>
		          	<p>
		            	Operador:<input value="{{ $plane->operador}}" type="text" name="ope"  class="form-control" required>
		          	</p>

		          	<p>
		            	Aerolinea: <input value="{{ $plane->aerolinea  }}" type="text" name="aero"  class="form-control" required>
		          	</p>
		          	<p>
		            	Clave: <input value="{{ $plane->clave }}" type="text" name="clave"  class="form-control" required>
		          	</p>
		          	<p>
		            	Equipaje: <input value="{{ $plane->tarifa }}" type="text" name="equipaje"  class="form-control" required>
		          	</p>
		          	<p>
		            	Tarifa: <input value="{{ $plane->tarifa }}" type="text" name="tarifa" class="form-control" >
		          	</p>
		          	
		          	<p>Itinerario:

				   <textarea  name="itinerario" placeholder="Itinerario" class="form-control" >{{ $plane->itinerario }}</textarea>
		            	 
		          	</p>
		          	<p>
		            	Fecha de Salida: <input value="{{ $plane->FechaSalida }}" type="date" name="fechaS"  class="form-control" >
		          	</p>
		          	<p>
		            	Fecha de Regreso: <input value="{{ $plane->FechaRegreso}}" type="date" name="fechaR"  class="form-control" >
		          	</p>
		          		<hr>
	  			<p>
					<h4>Datos del Costo</h4>
				</p>
				 <p>
		           Costo Pax:<input value="{{ $reservacion->costoPax }}" type="text" name="costoP"  class="form-control" required>
		         </p>
	  			<p>
	  			Costo Neto:<input value="{{ $reservacion->costoNeto}}" type="text" name="costoN"  class="form-control" required>
	  			</p>
	  			<p>
	  			Tiempo Limite:<input value="{{ $reservacion->tiempoLimite }}" type="date" name="tmLim"  class="form-control" required>
	  			</p>
	  			<p>
	  			Observaciones Pax:
				   <textarea  name="obPax" placeholder="Observaciones Pax" class="form-control" >{{$reservacion->observacionesPax }}</textarea>
	  			</p>
	  			<p>
	  			Observaciones Agencia:
	  			<textarea name="obAg" placeholder="Observaciones Agencia" class="form-control" >{{ $reservacion->observacionesAgencia }}</textarea>
	  			</p>
	  			


		          	<input type="submit" value="Actualizar" class="btn btn-success">
          	@else
	          	<p>
	            	No existe información para este Hotel.
	          	</p>
          	@endif
        		<a href="/consultas" class="btn btn-default">Regresar</a>
      			</form>
		</div>
	</div>



	@if(Session::has('message'))
	    <div class="alert alert-{{ Session::get('class') }}">{{ Session::get('message')}}</div>
	@endif
@stop
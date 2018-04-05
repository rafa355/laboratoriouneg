@if(empty($type) || $type == 'main')
<div class="row">
	<div class="col-lg-12 col-md-12 col-xs-12">
		<h1 class="page-header">
			 Listado de Computadoras 
			<button type="button" class="btn btn-primary btn-circle pull-right add" data-toggle="tooltip" data-placement="top" title="Agregar Computadora">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</button>
			<div class="clearfix"></div>

		</h1>
	</div>
</div>
<div class="panel panel-warning">
    <div class="panel-heading text-center">
		<span class="label label-danger" alt="Pendientes por Activar" style="size: 50px;">En Uso</span>
		<span class="label label-success" alt="Activas">Disponible</span>
    </div>
    <div class="panel-body" role="tabpanel" id="myTabs">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#user" data-toggle="tab">Usuarios</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade active in" id="user">
            	<br>
                <table id="users" class="table table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center">Numero</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Fecha de Registro</th>
                            <th class="text-center">Operacion</th>
				    	</tr>
				    </thead>
			  	</table>
            </div>
        </div>
    </div>
</div>
@endif

@if($type == 'create')
<div class="panel panel-warning">

	<form method="POST" action="#"  class="form-add">
		{{ csrf_field() }}
		{{ method_field('POST') }}

		<div>
			<div class="row">
				<div class="col-lg-6 col-md-6">
			        <h1 class="h3 title-form">Agregar usuario</h1>
				</div>
			</div>
		</div>
		<div class="alert alert-danger print-error-msg" style="display: none;">
            <ul></ul>
        </div>
		<div class="container-fluid">
		  	<div class="row">
		    	<div class="col-md-12">
					<div class="col-md-3 form-group">
					    <label>Estado de Recepcion</label>
					    <select name="status" class="form-control">
					    	<option value="1">Lista de usar</option>
					    	<option value="3">Para Reparar</option>					    	
					    </select>
					</div>
					<div class="col-md-3 form-group">
					    <label>Numero</label>
		              	<input type="text" name="numero" maxlength="30" placeholder="Numero de computadora" class="form-control" required>
					</div>
				</div>
		  		<div class="clearfix"></div>
		      	<div class="col-lg-12">
		      		<div class="form-group text-center"> 
	  					<input type="submit" value="Guardar" class="btn btn-primary">
	  					<input type="button" name="cancel" id="cancel" value="Cancelar" class="btn btn-secondary cancel">
					</div>
		      	</div>
		      	<div class="col-lg-12">
		      		<div class="message-sucess alert alert-success" style="display: none;"> Los datos han sido guardados exitosamente!</div>
		      		<div class="message-error alert alert-danger" style="display: none;"> Ha ocurrido un error en el guardado de los datos!</div>
			  	</div>
		    </div>
		</div>
	</form>
</div>

@endif



<script>
	$(document).ready(function(){
		$('#users').DataTable({
			"language" : {url: "{{ asset('/plugins/datatables/spanish.json') }}"},
			"processing": true,
			"serverSide": true,
			"ajax": "{{ route('admin.computadoras.datatables') }}",
			"columns": [
				{data: 'numero', name: 'numero'},
				{data: 'status', name: 'status', class: 'text-center', orderable: false, searchable: false},
				{data: 'created_at', name: 'created_at', class: 'text-center'},
				{data: 'actions', name: 'actions', class: 'text-center', orderable: false, searchable: false},
			]
		});
	})
</script>

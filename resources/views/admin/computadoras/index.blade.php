@extends('admin.template.main')
<script type="text/javascript" src="{{ asset('js/jquery-2.2.4.min.js') }}"></script>


@section('content')
<div class="container-fluid">
  	<ul class="breadcrumb">
    	<li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
    	<li class="breadcrumb-item active">Computadoras</li>
	</ul>

	<div class="col-lg-12 col-md-12 col-xs-12" id="content-load-data"></div>
</div>
@endsection

     <!-- TABLE STYLES-->
    <link href="{{ asset('plugins/datatables/datatables.css') }}" rel="stylesheet" />

     <!-- DATA TABLE SCRIPTS -->

	<script>

		$(document).ready(function(){
			$('#content-load-data').load("{{ route('admin.computadoras.async', 'main') }}", function(){
			});

			$('body').on('click', '.add', function(event){
				event.preventDefault();
				$('#content-load-data').load("{{ route('admin.computadoras.async', 'create') }}", function(){
				});
			});

			$('body').on('click', '.cancel', function(event){
				event.preventDefault();
				$('#content-load-data').load("{{ route('admin.computadoras.async', 'main') }}", function(){
				});
			});

			$('body').on('click', '.desocupar', function(event){
				event.preventDefault();
				href = $(this).attr("href");
				$('#content-load-data').load(href, function(){
					$.alert({
                                      title: 'Exito!',
                                 content: 'computadora desocupada',
                                });	
					location.reload();

				});
			});

			$('body').on('click', '.delete', function(event){
				event.preventDefault();
				href = $(this).attr("href");
				$.confirm({
				    title: 'Por favor confirme!',
				    content: 'Una vez realizada la accion los cambios son irreversibles!',
				    buttons: {
				        Confirmar: function () {
				        	showLoading(1);
				        	$.get(href,
        	                function(datos)
        	                {
        	                    $('#content-load-data').load("{{ route('admin.computadoras.async', 'main') }}", function(){
        	                    	showLoading(2);
        	                    	$.alert('Datos borrados exitosamente!');
        	                    });
        	                });
				        },
				        Cancelar: function () {
				            
				        }
				    }
				});
			});

			$('body').on('submit', '.form-add', function(event){
				$(".print-error-msg").css('display','none');
				event.preventDefault();
				$.ajax({
                    type:"POST",
                    url:"{{ route('admin.computadoras.async', 'store') }}",
                    dataType:"json",
                    data:$(this).serialize(),
				    success:function(response){
                    	if($.isEmptyObject(response.error)){
	                    	$('.message-sucess').show();
	                    	setTimeout(function() {
	                    		$('.message-sucess').hide();
	                            $('#content-load-data').load("{{ route('admin.computadoras.async', 'main') }}");
	                        }, 3000);
						} else {
							printErrorMsg(response.error);
						}
                    },
                    error:function(response){
                    	console.log(response);
                    }
                });
			});

			$('body').on('submit', '.form-edit', function(event){
				$(".print-error-msg").css('display','none');
				event.preventDefault();
				href = $(this).attr("action");
				showLoading(1);
				$.ajax({
                    type:"POST",
                    url:href,
 					dataType:"json",
                    data:$(this).serialize(),
                    success:function(response){
                    	if($.isEmptyObject(response.error)){
	                    	$('.message-sucess').show();
	                    	showLoading(2);
	                    	setTimeout(function() {
	                    		$('.message-sucess').hide();
	                            $('#content-load-data').load("{{ route('admin.computadoras.async', 'main') }}");
	                        }, 3000);
						} else {
	                    	showLoading(2);
							printErrorMsg(response.error);
						}
                    },
                    error:function(response){
                    	console.log(response);
                    }
                });
			});

		    function printErrorMsg (msg, type) {
				$(".print-error-msg").find("ul").html('');
				$(".print-error-msg").css('display','block');
				$.each( msg, function( key, value ) {
					$(".print-error-msg").find("ul").append('<li>'+value+'</li>');
				});
			}

			$('body').on('click', '.change-status-user', function(event){
				event.preventDefault();
				href = $(this).attr('data-href');
				status = $(this).attr("data-status");
				if (status == 0) { var mensaje = 'Activar'; }
				else if (status == 1) { var mensaje = 'Desactivar'; }
				console.log(href);

				$.confirm({
				    title: 'Por favor confirme!',
				    content: 'Desea '+mensaje+' las Funciones Premium a este Usuario?',
				    buttons: {
				        Confirmar: function () {
				        	showLoading(1);
				        	$.get(href,
        	                function(datos)
        	                {
        	                    $('#content-load-data').load("{{ route('admin.computadoras.async', 'main') }}", function(){
        	                    	showLoading(2);
        	                    	$.alert('Registro Actualizado Exitosamente!');
        	                    });
        	                });
				        },
				        Cancelar: function () {
				            
				        }
				    }
				});
			});
		});
	</script>

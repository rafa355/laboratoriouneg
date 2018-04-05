@extends('layouts.mainhome')
<script type="text/javascript" src="{{ asset('js/jquery-2.2.4.min.js') }}"></script>

<nav id="app-navbar" class="navbar navbar-inverse navbar-fixed-top primary">
  
    <!-- navbar header -->
    <div class="navbar-header">
      <button type="button" id="menubar-toggle-btn" class="navbar-toggle visible-xs-inline-block navbar-toggle-left hamburger hamburger--collapse js-hamburger">
        <span class="sr-only">Toggle navigation</span>
        <span class="hamburger-box"><span class="hamburger-inner"></span></span>
      </button>
  
      <button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="zmdi zmdi-hc-lg zmdi-more"></span>
      </button>
  
      <button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="zmdi zmdi-hc-lg zmdi-search"></span>
      </button>
  
      <a href="../index.html" class="navbar-brand">
        <span class="brand-icon"><i class="fa fa-gg"></i></span>
        <span class="brand-name">UNEG</span>
      </a>
    </div><!-- .navbar-header -->
    
    <div class="navbar-container container-fluid">
      <div class="collapse navbar-collapse" >
        <ul class="nav navbar-toolbar navbar-toolbar-right navbar-right">
          <li class="nav-item  hidden-float">
            <a href="{{route('login')}}">
Iniciar sesion            </a>
          </li>
        </ul>
      </div>
    </div><!-- navbar-container -->
  </nav>
@section('content')

<div class="col-md-10 col-md-offset-1" style="margin-top:40px">

@foreach($computadoras as $computadora)
@if($computadora->status == 1)
<a class="pc" id="{{$computadora->numero}}" href="{{route('admin.computadoras.async', ['ocupar', 'id'=> $computadora->idlibre])}}" >
@else
<a class="" id="{{$computadora->numero}}"  >
@endif

    <div class="col-md-3 col-sm-6 ">
        <div class="widget stats-widget">
            <div class="widget-body clearfix">
                <div class="pull-left">
                    <h3 class="widget-title text-primary"><span class="counter" data-plugin="counterUp">Computadora </span>{{$computadora->numero}}</h3>
                    <small class="text-color">@if($computadora->estudiante) {{$computadora->estudiante}} @else <br> @endif</small>
                </div>
                <span class="pull-right big-icon watermark"><i class="fa fa-desktop"></i></span>
            </div>
            <footer @if($computadora->status == 1) class="widget-footer bg-primary" @else class="widget-footer bg-danger" @endif>
                <small> @if($computadora->status == 1)Disponible @else Ocupada @endif </small>
                <span class="small-chart pull-right" data-plugin="sparkline" data-options="[4,3,5,2,1], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
            </footer>
        </div><!-- .widget -->
    </div>
</a>
@endforeach
</div>

@endsection




<script>
		$("body").on('click', '.pc',function(){
            event.preventDefault();
            href = $(this).attr("href");
            idc = $(this).attr("id");
            href = $(this).attr("href");
            $.confirm({
    title: 'Ocupar Computadora',
    content: '' +
    '<form action="" class="formName">' +
    '<div class="form-group">' +
    '<label>Cedula</label>' +
    '<input type="number" placeholder="Cedula" class="name form-control" required />' +
    '</div>' +
    '</form>',
    buttons: {
        formSubmit: {
            text: 'Ocupar',
            btnClass: 'btn-blue',
            action: function () {
                var name = this.$content.find('.name').val();
                if(!name){
                    $.alert('Debe ingresar una cedula');
                    return false;
                }

                            $.ajax({
							headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
							type: 'POST',
							url: "{{route('admin.computadoras.async', ['ocupar'])}}",
							data: {
                                computadora:idc,
	            	            cedula: name,
                            },
							success: function (response) {
                                location.reload();
							},
							error: function(msg) {
                                $.alert({
                                      title: 'No se puede ocupar',
                                 content: 'Por favor contacte con el administrador para registrarse en sistema o verifique que no  se encuentre ocupando otra maquina',
                                });							}
						});


            }
        },
        cancel: function () {
            //close
        },
    },
    onContentReady: function () {
        // bind to events
        var jc = this;
        this.$content.find('form').on('submit', function (e) {
            // if the user submits the form by pressing enter in the field.
            e.preventDefault();
            jc.$$formSubmit.trigger('click'); // reference the button and click it
        });
    }
});

});




</script>

   

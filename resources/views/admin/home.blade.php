@extends('admin.template.main')

	
@section('content')

@foreach($computadoras as $computadora)
    <div class="col-md-3 col-sm-6">
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
@endforeach

@endsection
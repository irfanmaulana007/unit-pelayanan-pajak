@extends('layout.template')

@section('custom-css')
	<link rel="stylesheet" type="text/css" href="{{ asset('node_modules/morris.js/morris.css') }}">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@stop

@section('content')
	<div class="row">
		<div class="col-8 offset-2 m-t-20">
			<div class="box">
				<h4 class="text-center">Statistik</h4>
				<br><br>
				<div class="row">
					<div class="col-10 offset-1">
						<div id="line"></div>
						<br><br>
						<hr>
						<br><br>
						<div id="bar"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('custom-js')
	<script src="{{ asset('node_modules/morris.js/morris.min.js') }}"></script>
	<script src="{{ asset('node_modules/raphael/raphael.min.js') }}"></script>
	<script>
		selectedNav("statistik");

		Morris.Line({
			element: 'line',
			data: [
				@for($i = 0; $i < count($doc); $i++)
					{ y: '{{ $i+1 }}' , a: {{ $doc[$i] }} },
				@endfor
			],
			parseTime: false,
			ymin: 0,
			xkey: 'y',
			ykeys: ['a'],
			labels: ['Total Document'],
			xLabels: 'month',
			hideHover: 'true',
		});
	</script>

	<script>
		Morris.Bar({
			element: 'bar',
			data: [
				@foreach($user as $key => $value)
					{ y: '{{ $value->role }}' , a: {{ $value->pending }} },
				@endforeach
			],
			parseTime: false,
			ymin: 0,
			xkey: 'y',
			ykeys: ['a'],
			labels: ['Total Pending'],
			hideHover: 'true',
		});
	</script>
@stop
@extends('layout.template')

@section('content')

	<!-- ALLERT -->
	@if(session()->has('data'))
		@section('alert-class', 'alert-'.session('data')[1])
		@section('alert-info', session('data')[0])
	@endif

	<div class="row m-t-20">
		<div class="col-6 offset-3">
			<div class="box">
	         	<div class="alert @yield('alert-class') alert-dismissable fade small hidden">
	            	<button type="button" class="close" data-dismiss="alert">&times;</button>
	            	<strong>@yield('alert-info')</strong> @yield('alert-message')
	        	</div>

				@yield('auth-content')
			</div>
		</div>
	</div>

	<!-- ALLERT -->
	@if(session()->has('data'))
		<script>alerts()</script>
	@endif

@stop

@section('custom-js')
	<script src="{{ asset('node_modules/parsleyjs/dist/parsley.min.js') }}"></script>
@stop
@extends('layout.auth')

@section('auth-content')
	<h4 class="text-center">Login</h4>
	<br>
	<form action="{{ action('AuthController@doLogin') }}" method="POST">
		{{ csrf_field() }}
	    <div class="form-group">
	    	<label class="small">NIP</label>
	    	<input type="text" class="form-control" placeholder="Enter NIP" name="nip" autofocus>
	    </div>
	    <div class="form-group">
	    	<label class="small">Password:</label>
	    	<input type="password" class="form-control" placeholder="Enter password" name="password">
	    </div>
	    <p class="text-center text-danger small">{{ (isset($error)) ? $error : '' }}</p>
	    <center><a class="small" href="{{ URL::to('register') }}">Don't have account yet? Click here to register</a></center>
	    <br>
	    <center><button type="submit" class="btn btn-primary">Submit</button></center>
	</form>
@stop
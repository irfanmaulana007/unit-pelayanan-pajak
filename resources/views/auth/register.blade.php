@extends('layout.auth')

@section('auth-content')
	<h4 class="text-center">Register</h4>
	<br>
	<form action="{{ action('AuthController@doRegister') }}" method="POST"  data-parsley-validate="true">
		{{ csrf_field() }}
	    <div class="form-group">
	    	<label class="small">Nama</label>
	    	<input type="text" class="form-control" placeholder="Enter Name" name="nama" autofocus required>
	    </div>
	    <div class="form-group">
	    	<label class="small">NIP</label>
	    	<input type="text" class="form-control" placeholder="Enter NIP" name="nip" required>
	    </div>
	    <div class="form-group">
	    	<label class="small">Email</label>
	    	<input type="email" class="form-control" placeholder="Enter email" name="email" required>
	    </div>
	    <div class="form-group">
	    	<label class="small">Password:</label>
	    	<input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
	    </div>
	    <div class="form-group">
	    	<label class="small">Confirm Password:</label>
	    	<input type="password" class="form-control" placeholder="Re-type password" name="confpassword" data-parsley-equalto="#password">
	    </div>
	    <br>
	    <center><a class="small" href="{{ URL::to('/') }}">Already have account? Click here to login</a></center>
	    <br>
	    <center><button type="submit" class="btn btn-primary">Submit</button></center>
	</form>
@stop
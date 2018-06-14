@extends('layout.template')

@section('content')
	<div class="row">
		<div class="col-8 offset-2 m-t-20">
			<div class="box">
				<h4 class="text-center">Create User</h4>
				<br>
				@if(isset($id))
				<form action="{{ URL::to('user/' . $id) }}" method="POST"  data-parsley-validate="true">
				    {{ method_field('PUT') }}
				@else
				<form action="{{ action('UserController@store') }}" method="POST"  data-parsley-validate="true">
				@endif
					{{ csrf_field() }}
				    <div class="form-group">
				    	<label class="small">Nama Lengkap</label>
				    	<input type="text" class="form-control" placeholder="Enter Name" name="nama" value="{{ (isset($id) ? $user->nama : '') }}" autofocus required autocomplete="off">
				    </div>
				    <div class="form-group">
				    	<label class="small">NIP</label>
				    	<input type="text" class="form-control" placeholder="Enter NIP" name="nip" value="{{ (isset($id) ? $user->nip : '') }}" required autocomplete="off">
				    </div>
				    <div class="form-group">
				    	<label class="small">Email</label>
				    	<input type="email" class="form-control" placeholder="Enter email" name="email" value="{{ (isset($id) ? $user->email : '') }}" required autocomplete="off">
				    </div>
				    <div class="form-group">
				    	<label class="small">Password:</label>
				    	<input type="password" class="form-control" id="password" placeholder="Enter password" name="password" value="{{ (isset($id) ? $user->password : '') }}" required>
				    </div>
				    <div class="form-group">
				    	<label class="small">Confirm Password:</label>
				    	<input type="password" class="form-control" placeholder="Re-type password" name="confpassword" value="{{ (isset($id) ? $user->password : '') }}" data-parsley-equalto="#password">
				    </div>
				    <div class="form-group">
				    	<label class="small">Position:</label>
				    	<select name="position" class="form-control" required>
				    		<option value="0" disabled selected>- Select Position -</option>
				    		@foreach($role as $key => $value)
								<option value="{{ $value->id }}" {{ (isset($id) && $value->id == $user->id_role) ? 'selected' : '' }}>{{ $value->nama }}</option>
				    		@endforeach
				    	</select>
				    </div>
				    <br>
				    <center>
				    	<button type="submit" class="btn btn-primary">Submit</button>
				    	<a href="{{ URL::to('user') }}"><button type="button" class="btn btn-default">Cancel</button></a>
				    </center>
				</form>
			</div>
		</div>
	</div>
@stop

@section('custom-js')
	<script src="{{ asset('node_modules/parsleyjs/dist/parsley.min.js') }}"></script>
	<script>
		selectedNav("master");
	</script>
@stop
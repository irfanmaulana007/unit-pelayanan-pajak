@extends('layout.template')

@section('content')
	<div class="row">
		<div class="col-8 offset-2 m-t-20">
			<div class="box">
				<h4 class="text-center">Create Role</h4>
				<br>
				@if(isset($id))
				<form action="{{ URL::to('role/' . $id) }}" method="POST"  data-parsley-validate="true">
				    {{ method_field('PUT') }}
				@else
				<form action="{{ action('RoleController@store') }}" method="POST"  data-parsley-validate="true">
				@endif
					{{ csrf_field() }}
				    <div class="form-group">
				    	<label class="small">Role</label>
				    	<input type="text" class="form-control" placeholder="Enter Role" name="nama" value="{{ (isset($id) ? $role->nama : '') }}" autofocus required autocomplete="off">
				    </div>
				    <br>
				    <center>
				    	<button type="submit" class="btn btn-primary">Submit</button>
				    	<a href="{{ URL::to('role') }}"><button type="button" class="btn btn-default">Cancel</button></a>
				    </center>
				</form>
			</div>
		</div>
	</div>
@stop

@section('custom-js')
	<script>
	<script src="{{ asset('node_modules/parsleyjs/dist/parsley.min.js') }}"></script>
		selectedNav("master");
	</script>
@stop
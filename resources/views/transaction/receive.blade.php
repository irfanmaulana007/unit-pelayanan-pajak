@extends('layout.template')

@section('custom-css')
	<link rel="stylesheet" href="{{ asset('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
@stop

@section('content')
	<div class="row">
		<div class="col-8 offset-2 m-t-20">
			<div class="box">
				<h4 class="text-center">Receive Document</h4>
				<br>
				<form action="{{ action('TransactionController@createInput') }}" method="POST"  data-parsley-validate="true">
					{{ csrf_field() }}
				    <div class="form-group">
				    	<label class="small">Role</label>
				    	<input type="text" class="form-control" placeholder="Enter Role" name="nama" autofocus required autocomplete="off">
				    </div>
				    <br>
				    <center>
				    	<button type="submit" class="btn btn-primary">Submit</button>
				    	<a href="{{ URL::to('transaction/receive') }}"><button type="button" class="btn btn-default">Cancel</button></a>
				    </center>
				</form>
			</div>
		</div>
	</div>
@stop

@section('custom-js')
	<script src="{{ asset('node_modules/datatables.net/js/jquery.dataTables.js') }}"></script>
	<script src="{{ asset('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js') }}"></script>
	<script>
		selectedNav("receive");
	</script>
@stop
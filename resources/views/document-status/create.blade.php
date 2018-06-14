@extends('layout.template')

@section('content')
	<div class="row">
		<div class="col-8 offset-2 m-t-20">
			<div class="box">
				<h4 class="text-center">Create Document Status</h4>
				<br>
				@if(isset($id))
				<form action="{{ URL::to('document-status/' . $id) }}" method="POST"  data-parsley-validate="true">
				    {{ method_field('PUT') }}
				@else
				<form action="{{ action('DocumentStatusController@store') }}" method="POST"  data-parsley-validate="true">
				@endif
					{{ csrf_field() }}
				    <div class="form-group">
				    	<label class="small">Document Status</label>
				    	<input type="text" class="form-control" placeholder="Enter Document Status" name="nama" value="{{ (isset($id) ? $documentStatus->nama : '') }}" autofocus required autocomplete="off">
				    </div>
				    <br>
				    <center>
				    	<button type="submit" class="btn btn-primary">Submit</button>
				    	<a href="{{ URL::to('document-status') }}"><button type="button" class="btn btn-default">Cancel</button></a>
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
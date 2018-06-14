@extends('layout.template')

@section('custom-css')
	<link rel="stylesheet" href="{{ asset('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
@stop

@section('content')
	<!-- ALLERT -->
	@if(session()->has('data'))
		@section('alert-class', 'alert-'.session('data')[1])
		@section('alert-info', session('data')[0])
	@endif

	<div class="row">
		<div class="col-12 m-t-20">
			<div class="box">
	         	<div class="alert @yield('alert-class') alert-dismissable fade small hidden">
	            	<button type="button" class="close" data-dismiss="alert">&times;</button>
	            	<strong>@yield('alert-info')</strong> @yield('alert-message')
	        	</div>
				<h4 class="text-center">Master Role</h4>
				<div class="row">
					<div class="col-12">
						<a href="{{ URL::to('role/create') }}"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Role</button></a>
					</div>
				</div>
				<br>
				<table class="table table-striped data-table">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama</th>
							<th style="text-align: center;">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($role as $key => $value)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $value->nama }}</td>
								<td>
									<center>
										<a href="{{ URL::to('role/' . $value->id . '/edit') }}"><i class="fa fa-edit"></i></a>
	        							<form action="{{ URL::to('role/' . $value->id) }}" method="POST">
										    {{ method_field('DELETE') }}
										    {{ csrf_field() }}
											<a><i class="fa fa-trash" data-id="{{ $value->id }}" data-toggle="modal" data-target="#modalDelete"></i></a>
											<div class="modal fade" id="modalDelete">
												<div class="modal-dialog">
											    	<div class="modal-content">
												    	<div class="modal-header">
												        	<h4 class="modal-title">Delete Confirmation</h4>
												        	<button type="button" class="close" data-dismiss="modal">&times;</button>
												    	</div>
											      		<div class="modal-body text-center">
											        		Are you sure to delete this role?
										        			<br><br>
										        			<center>
																<button class="btn btn-primary">Yes</button>
																<button type="button" data-dismiss="modal" class="btn btn-default">No</button>
										        			</center>
											      		</div>
											      		<div class="modal-footer">
											        		<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
											      		</div>
										    		</div>
										  		</div>
											</div>
	        							</form>
									</center>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- ALLERT -->
	@if(session()->has('data'))
		<script>alerts()</script>
	@endif
@stop

@section('custom-js')
	<script src="{{ asset('node_modules/datatables.net/js/jquery.dataTables.js') }}"></script>
	<script src="{{ asset('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js') }}"></script>
	<script>
		selectedNav("master");

		$(document).ready( function () {
		    $('.data-table').DataTable();

		    $(".fa-trash").click(function(){
		    	id = $(this).data('id');
		    	$("form").attr("action","/role/" + id)
		    });
		});
	</script>
@stop
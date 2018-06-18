@extends('layout.template')

@section('custom-css')
	<link rel="stylesheet" href="{{ asset('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
	<link rel="stylesheet" href="{{ asset('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <meta name="csrf-token" id="meta" content="{{ csrf_token() }}">
@stop

@section('content')
	<!-- ALLERT -->
	@if(session()->has('data'))
		@section('alert-class', 'alert-'.session('data')[1])
		@section('alert-info', session('data')[0])
	@endif

	<div class="row m-t-20">
		<div class="col-12">
			<div class="box">
	         	<div class="alert @yield('alert-class') alert-dismissable fade small hidden">
	            	<button type="button" class="close" data-dismiss="alert">&times;</button>
	            	<strong>@yield('alert-info')</strong> @yield('alert-message')
	        	</div>
				<h4 class="text-center">Monitoring</h4>
				<br>
				<table class="table table-striped data-table">
					<thead>
						<tr>
							<th>No.</th>
							<th>Kode</th>
							<th>Nama Surat</th>
							<th>Tanggal Terima Surat</th>
							<th>Asal Surat</th>
							<th>Perihal</th>
							<th>Posisi</th>
							<th>Send To</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($document as $key => $value)
							<?php
								$transaction = DB::table('transactions')
													->select('transactions.id','a.nama as nama_asal','b.nama as nama_tujuan')
													->join('documents','documents.id','=','transactions.id_document')
													->join('users as a','a.id','=','transactions.id_user')
													->join('users as b','b.id','=','transactions.send_to')
													->where('id_document', $value->id)
													->orderby('transactions.id', 'desc')
													->first();
							?>

							<tr class="@if($value->id_document_status == 1)bg-success text-white @elseif($value->id_document_status == 5) bg-danger text-white @endif">
								<td>{{ $loop->iteration }}</td>
								<td>{{ $value->kode }}</td>
								<td>{{ $value->nama }}</td>
								<td>{{ $value->tanggal_terima }}</td>
								<td>{{ $value->asal }}</td>
								<td>{{ $value->perihal }}</td>
								<td>{{ $transaction->nama_asal }}</td>
								<td>{{ ($transaction->nama_tujuan == $transaction->nama_asal) ? '-' : $transaction->nama_tujuan }}</td>
								<td>{{ $value->status }}</td>
								<td>
									<center>
										<a><i class="fa fa-eye" data-id="{{ $value->id }}"></i></a>
										<a><i class="fa fa-edit" data-id="{{ $value->id }}"></i></a>
	        							<form action="{{ URL::to('document/' . $value->id) }}" id="delete-document" method="POST">
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
											        		Are you sure to delete this document?
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

	<div class="modal fade" id="modalShow">
		<div class="modal-dialog modal-lg">
	    	<div class="modal-content">
		    	<div class="modal-header">
		        	<h4 class="modal-title">Detail Surat</h4>
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		    	</div>
	      		<div class="modal-body">

	      		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	      		</div>
    		</div>
  		</div>
	</div>

	<div class="modal fade" id="modalEdit">
		<div class="modal-dialog modal-lg">
	    	<div class="modal-content">
		    	<div class="modal-header">
		        	<h4 class="modal-title">Edit Document</h4>
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		    	</div>
	      		<div class="modal-body">
	      			<div class="row">
	      				<div class="col-10 offset-1">
			      			<form action="" method="POST" id="edit-document" class="form-horizontal"  data-parsley-validate="true">
							{{ csrf_field() }}
							    <div class="form-group row">
							    	<label class="col-form-label col-4 small">Kode Surat</label>
							    	<div class="col-8">
								    	<input type="text" id="kode" class="form-control" placeholder="Kode Surat" name="kode" required autocomplete="off" readonly>
							    	</div>
							    </div>
							    <div class="form-group row">
							    	<label class="col-form-label col-4 small">Nama Surat</label>
							    	<div class="col-8">
								    	<input type="text" id="nama" class="form-control" placeholder="Nama Surat" name="nama" required autocomplete="off">
							    	</div>
							    </div>
							    <div class="form-group row">
							    	<label class="col-form-label col-4 small">Asal Surat</label>
							    	<div class="col-8">
								    	<input type="text" id="asal" class="form-control" placeholder="Asal Surat" name="asal" required autocomplete="off">
							    	</div>
							    </div>
							    <div class="form-group row">
							    	<label class="col-form-label col-4 small">Perihal Surat</label>
							    	<div class="col-8">
								    	<input type="text" id="perihal" class="form-control" placeholder="Perihal Surat" name="perihal" required autocomplete="off">
							    	</div>
							    </div>
							    <div class="form-group row">
							    	<label class="col-form-label col-4 small">Tanggal Surat Masuk</label>
							    	<div class="col-8">
						    			<input type="text" id="tanggal" class="form-control datepicker" placeholder="yyyy-mm-dd" name="tanggal" required autocomplete="off">
							    	</div>
							    </div>
			        			<br><br>
			        			<center>
									<button class="btn btn-primary">Submit</button>
			        			</center>
			      			</form>
	      				</div>
	      			</div>
	      		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	      		</div>
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
	<script src="{{ asset('node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
	<script>
		selectedNav("monitoring");
        var meta = $("#meta").attr("content");

		$('.datepicker').datepicker({
		    format: 'yyyy-mm-dd',
		});

		$(document).ready( function () {
		    $('.data-table').DataTable();

		    $(".fa-eye").click(function(){
		    	id = $(this).data('id');
				url = "{{ URL::to('detail-transaction/') }}" + '/' + id;

		    	$.ajax({
					url: url,
					type: 'POST',
					data:{
	                    _token: meta,
						id: id,
					},
	                beforeSend: function () {

	                },
	                success: function (message) {
                        $("#modalShow .modal-body").html(message);
		    			$("#modalShow").modal('show');
	                }
				});
		    });

		    $(".fa-edit").click(function(){
		    	id = $(this).data('id');
				url = "{{ URL::to('find-document/') }}" + '/' + id;
		    	$("#edit-document").attr("action","/document/update/" + id)

		    	$.ajax({
					url: url,
					type: 'POST',
					data:{
	                    _token: meta,
						id: id,
					},
	                beforeSend: function () {

	                },
	                success: function (message) {
	                    $("#kode").val(message.kode);
	                    $("#nama").val(message.nama);
	                    $("#asal").val(message.asal);
	                    $("#perihal").val(message.perihal);
	                    $("#tanggal").val(message.tanggal);

		    			$("#modalEdit").modal('show');
	                }
				});

		    	$("#modalEdit").modal('show');
		    });

		    $(".fa-trash").click(function(){
		    	id = $(this).data('id');
		    	$("#delete-document").attr("action","/document/" + id)
		    });
		});
	</script>
@stop
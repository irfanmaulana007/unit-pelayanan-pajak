@extends('layout.template')

@section('custom-css')
	<link rel="stylesheet" href="{{ asset('node_modules/datatables.net-dt/css/jquery.dataTables.css') }}">
@stop

@section('content')
	<div class="row m-t-20">
		<div class="col-12">
			<div class="box">
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
						@foreach($document as $key => $values)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $values->kode }}</td>
								<td>{{ $values->nama }}</td>
								<td>{{ $values->tanggal_terima }}</td>
								<td>{{ $values->asal }}</td>
								<td>{{ $values->perihal }}</td>
								<td>-</td>
								<td>-</td>
								<td>{{ $values->id_document_status }}</td>
								<td><a href><i class="fa fa-trash"></i></a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop

@section('custom-js')
	<script src="{{ asset('node_modules/datatables.net/js/jquery.dataTables.js') }}"></script>
	<script>
		$(document).ready( function () {
		    $('.data-table').DataTable();
		});
	</script>
@stop
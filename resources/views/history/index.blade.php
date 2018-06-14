@extends('layout.template')

@section('custom-css')
	<link rel="stylesheet" href="{{ asset('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
@stop

@section('content')
	<div class="row">
		<div class="col-8 offset-2 m-t-20">
			<div class="box">
				<h4 class="text-center">View History</h4>
				<br><br>
				<table class="table table-striped data-table">
					<thead>
						<tr>
							<th>No.</th>
							<th>Kode Surat</th>
							<th>Nama Surat</th>
							<th>Tanggal Kirim Surat</th>
							<th>Kirim Ke</th>
						</tr>
					</thead>
					<tbody>
						@foreach($transaction as $key => $value)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $value->kode }}</td>
								<td>{{ $value->nama }}</td>
								<td>{{ $value->created_at }}</td>
								<td>{{ $value->user }}</td>
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
	<script src="{{ asset('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js') }}"></script>
	<script>
		selectedNav("history");

		$(document).ready( function () {
		    $('.data-table').DataTable();
		});
	</script>
@stop
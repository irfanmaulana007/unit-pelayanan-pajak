@extends('layout.template')

@section('custom-css')
	{{-- <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}"> --}}
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.17/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
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
							<th>Tanggal Terima Surat</th>
							<th>Asal Surat</th>
							<th>Perihal</th>
						</tr>
					</thead>
					<tbody>
						@foreach($document as $key => $value)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $value->kode }}</td>
								<td>{{ $value->nama }}</td>
								<td>{{ $value->tanggal_terima }}</td>
								<td>{{ $value->asal }}</td>
								<td>{{ $value->perihal }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop

@section('custom-js')
	{{-- <script src="{{ asset('node_modules/datatables.net/js/jquery.dataTables.js') }}"></script> --}}
	{{-- <script src="{{ asset('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js') }}"></script> --}}
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.17/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
	<script>
		selectedNav("laporan");

		$(document).ready( function () {
		    $('.data-table').DataTable({
			    dom: 'Bfrtip',
			    buttons: [
			    {
			      extend: 'excel',
			      text: 'Export excel',
			      className: 'exportExcel',
			      filename: 'Export excel',
			      exportOptions: {
			        modifier: {
			          page: 'all'
			        }
			      }
			    }], 
			});
		});
	</script>
@stop
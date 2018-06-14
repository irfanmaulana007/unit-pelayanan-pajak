<div class="row">
	<div class="col-6">
		<div class="row">
			<div class="col-5">Kode Surat</div>
			<div class="col-1">:</div>
			<div class="col-5"><b>{{ $transaction->kode }}</b></div>
		</div>
		<div class="row">
			<div class="col-5">Nama Surat</div>
			<div class="col-1">:</div>
			<div class="col-5"><b>{{ $transaction->nama }}</b></div>
		</div>
		<div class="row">
			<div class="col-5">Asal Surat</div>
			<div class="col-1">:</div>
			<div class="col-5"><b>{{ $transaction->asal }}</b></div>
		</div>
		<div class="row">
			<div class="col-5">Nama Pemeriksa</div>
			<div class="col-1">:</div>
			<div class="col-5"><b>{{ $transaction->user }}</b></div>
		</div>
	</div>
	<div class="col-6">
		<div class="row">
			<div class="col-5">Tanggal Terima Surat</div>
			<div class="col-1">:</div>
			<div class="col-5"><b>{{ $transaction->tanggal_terima }}</b></div>
		</div>
		<div class="row">
			<div class="col-5">Perihal Surat</div>
			<div class="col-1">:</div>
			<div class="col-5"><b>{{ $transaction->perihal }}</b></div>
		</div>
		<div class="row">
			<div class="col-5">Status Surat</div>
			<div class="col-1">:</div>
			<div class="col-5"><b>{{ $transaction->status }}</b></div>
		</div>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-10 offset-1">
		<div class="timeline">
			@foreach($detail as $key => $value)
				<div class="container right">
			    	<div class="content">
			    		<div class="row">
			    			<div class="col-6">
					    		<h6><b>{{ $value->nama_asal }}</b> Kirim Ke <b>{{ $value->nama_tujuan }}</b></h6>
					    		{{-- <p class="text-muted">{{ date_format($value->created_at, 'D, d/M/Y') }}</p> --}}
					    		<p class="text-muted">{{ $value->created_at }}</p>
			    			</div>
			    			<div class="col-6">
			    				<h6>Uraian : asdf</h6>
			    			</div>
			    		</div>
			    	</div>
				</div>
			@endforeach
		</div>
	</div>
</div>
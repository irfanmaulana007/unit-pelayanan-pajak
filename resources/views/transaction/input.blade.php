@extends('layout.template')

@section('custom-css')
	<link rel="stylesheet" href="{{ asset('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <meta name="csrf-token" id="meta" content="{{ csrf_token() }}">
@stop

@section('content')
	<!-- ALLERT -->
	@if(session()->has('data'))
		@section('alert-class', 'alert-'.session('data')[1])
		@section('alert-info', session('data')[0])
	@endif
	
	<div class="row">
		<div class="col-8 offset-2 m-t-20">
			<div class="box">
	         	<div class="alert @yield('alert-class') alert-dismissable fade small hidden">
	            	<button type="button" class="close" data-dismiss="alert">&times;</button>
	            	<strong>@yield('alert-info')</strong> @yield('alert-message')
	        	</div>
				<h4 class="text-center">Input Document</h4>
				<br>
				<form action="{{ action('DocumentController@createInput') }}" method="POST"  id="form" data-parsley-validate="true">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-6">
						    <div class="form-group">
					    		<label class="small">Kode Surat</label>
								<div class="input-group">
						    		<input type="text" id="kode" class="form-control" placeholder="Kode Surat" name="kode" autofocus required autocomplete="off">
									<span class="input-group-btn">
										<button id="btn-search" class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
									</span>
								</div>
								<p id="err" class="text-danger"></p>
						    </div>
						    <div class="form-group">
						    	<label class="small">Nama Surat</label>
						    	<input type="text" id="nama" class="form-control" placeholder="Nama Surat" name="nama" required autocomplete="off">
						    </div>
						    <div class="form-group">
						    	<label class="small">Asal Surat</label>
						    	<input type="text" id="asal" class="form-control" placeholder="Asal Surat" name="asal" required autocomplete="off">
						    </div>
						    <div class="form-group">
						    	<label class="small">Perihal Surat</label>
						    	<input type="text" id="perihal" class="form-control" placeholder="Perihal Surat" name="perihal" required autocomplete="off">
						    </div>
						</div>
						<div class="col-6">
						    <div class="form-group">
						    	<label class="small">Tanggal Surat Masuk</label>
						    	<input type="text" id="tanggal" class="form-control datepicker" placeholder="yyyy-mm-dd" name="tanggal" required autocomplete="off">
						    </div>
						    <div class="form-group">
						    	<label class="small">Status Surat</label>
						    	<select name="status" id="status" class="form-control" required>
						    		<option value="0" selected disabled>- Select Status -</option>
						    		@foreach($documentStatus as $key => $value)
										<option value="{{ $value->id }}">{{ $value->nama }}</option>
						    		@endforeach
						    	</select>
						    </div>
						    <div class="form-group">
						    	<label class="small">Kirim Ke</label>
						    	<select name="kirim" id="kirim" class="form-control" required>
						    		<option value="0" selected disabled>- Select Position -</option>
						    		@foreach($user as $key => $value)
										<option value="{{ $value->id }}">{{ $value->nama }}</option>
						    		@endforeach
						    	</select>
						    </div>
						    <div class="form-group">
						    	<label class="small">Uraian Hasil</label>
						    	<textarea name="uraian" rows="3" id="uraian" class="form-control" required></textarea>
						    </div>
						</div>
					</div>
				    <br>
				    <h6 id="errDoc" class="text-center text-danger"></h6>
				    <br>
				    <center>
				    	<button type="button" id="btnSubmit" class="btn btn-primary" onclick="checkKode()">Submit</button>
				    	<button type="submit" id="btnReceive" class="btn btn-success" style="display: none;">Receive</button>
				    </center>
				</form>
			</div>
		</div>
	</div>

	<!-- ALLERT -->
	@if(session()->has('data'))
		<script>alerts()</script>
	@endif
@stop

@section('custom-js')
	<script src="{{ asset('/js/autocomplete.js') }}"></script>
	<script src="{{ asset('/js/form.js') }}"></script>
	<script src="{{ asset('node_modules/parsleyjs/dist/parsley.min.js') }}"></script>
	<script src="{{ asset('node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
	<script>
		selectedNav("input");

		var companies = [
			@foreach($company as $key => $value)
				"{{ $value->nama }}",
			@endforeach
		];
		autocomplete(document.getElementById("asal"), companies);

		$('.datepicker').datepicker({
		    format: 'yyyy-mm-dd',
		});
        
        var meta = $("#meta").attr("content");

        $("#status").change(function(){
        	if($(this).val() == 1){
        		$("#kirim").prop("required", false);
        		$("#kirim").prop("disabled", true);
        	}else{
        		$("#kirim").prop("required", true);
        		$("#kirim").prop("disabled", false);
        	}
        });

		$("#btn-search").click(function(){
			kode = $("#kode").val();
			if(kode != ""){
				url = "{{ URL::to('find-kode/') }}" + '/' + kode;
				$.ajax({
					url: url,
					type: 'POST',
					data:{
	                    _token: meta,
						kode: kode,
					},
	                beforeSend: function () {
	                    $("#btn-search i").removeClass('fa-search');
	                    $("#btn-search i").addClass('fa-spin');
	                    $("#btn-search i").addClass('fa-spinner');
	                },
	                success: function (message) {
	                    $("#btn-search i").addClass('fa-search');
	                    $("#btn-search i").removeClass('fa-spin');
	                    $("#btn-search i").removeClass('fa-spinner');

	                    if(message.document == "true"){
						    $("#err").html('');
						    $("#nama").val(message.nama);
						    $("#asal").val(message.asal);
						    $("#perihal").val(message.perihal);
						    $("#tanggal").val(message.tanggal);
						    $("#uraian").val(message.uraian);

	                    	if(message.receiveAble == "true" && message.input == "false"){
	                    		// Receive document
		                    	readable(true);
							    $("#kirim").html('');
							    $("#status").html('');
							    $("#kirim").removeAttr('required');
							    $("#status").removeAttr('required');
							    $("#uraian").removeAttr('required');
	                    		receiveAble(message.id);
	                    	}else if(message.receiveAble == "false" && message.input == "true"){
	                    		// Passing Document
							    $("#errDoc").html('');
    							$("form").attr("action","/transaction/passing/" + message.id);
		                    	readable(true);
							    $("#uraian").prop('readonly', false);
	                    	}else if(message.receiveAble == "false" && message.input == "false"){
	                    		// Document on ohter position
	                    		onOtherPosition();
		                    	readable(true);
	                    	}else if(message.status == "Finish"){
	                    		finished();
	                    	}
	                    }else{
						    $("#errDoc").html('');
		                    $("#err").html('*Kode tidak ditemukan');
		                    init();
	                    }
	                }
				});
			}
			
		});
	</script>
@stop
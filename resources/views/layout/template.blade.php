<!DOCTYPE html>
<html>
<head>
	<title>UPPRD Gambir @yield('title')</title>

	<!-- CSS - Plugin -->
	<link rel="stylesheet" type="text/css" href="{{ asset('node_modules/bootstrap/dist/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('node_modules/font-awesome/css/font-awesome.min.css') }}">
	@yield('custom-css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <meta name="csrf-token" id="meta" content="{{ csrf_token() }}">

	<!-- JS - Plugin -->
	<script src="{{ asset('node_modules/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/alert.js') }}"></script>
	<script src="{{ asset('js/nav.js') }}"></script>

	<!-- Google Fonts - Raleway -->
	<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
</head> 
<body>
	<header>
		
	</header>
	
	@if(Auth::user())
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
			<span class="navbar-text m-r-20 text-uppercase text-white">
			    {{ Auth::user()->nama }}
			</span>

			<ul class="navbar-nav mr-auto">
				@if(Auth::user()->id_role == 1)
			    	<li class="nav-item">
			    		<a id="nav-monitoring" class="nav-link" href="{{ URL::to('monitoring') }}">Monitoring</a>
			    	</li>
		    	@endif
		    	<li class="nav-item">
		    		<a id="nav-input" class="nav-link" href="{{ URL::to('document/input') }}">Input / Receive</a>
		    	</li>
				@if(Auth::user()->id_role == 1)
			    	<li class="nav-item">
			    		<a id="nav-statistik" class="nav-link" href="{{ URL::to('statistik') }}">Statisik</a>
			    	</li>
			    	<li class="nav-item">
			    		<a id="nav-laporan" class="nav-link" href="{{ URL::to('document/laporan') }}">Laporan</a>
			    	</li>
				    <li id="nav-master" class="nav-item dropdown ">
				    	<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
				        	Master
				    	</a>
				    	<div class="dropdown-menu">
				        	<a class="dropdown-item" href="{{ URL::to('company') }}">Master Company</a>
				        	<a class="dropdown-item" href="{{ URL::to('user') }}">Master User</a>
				        	<a class="dropdown-item" href="{{ URL::to('role') }}">Master Role</a>
				        	<a class="dropdown-item" href="{{ URL::to('document-status') }}">Master Document Status</a>
				    	</div>
				    </li>
		    	@endif
		    	<li class="nav-item">
		    		<a id="nav-history" class="nav-link" href="{{ URL::to('view-history') }}">View History</a>
		    	</li>
			</ul>
			<ul class="navbar-nav ml-auto">
		    	<span class="nav-item">
		    		<a class="nav-link" href="{{ URL::to('logout') }}">Logout</a>
		    	</span>
		    </ul>
		</nav>
	@endif

	<div id="content">
		@yield('content')
		
	</div>

	<footer>
		Copyright &copy; 2018. All right reserved. Unit Pelayanan Pajak & Retribusi Daerah Gambir
	</footer>

	<!-- Custom JS - Plugin -->
	@yield('custom-js')

	<script>
        var meta = $("#meta").attr("content");

		setInterval(function() {
			check();
		}, 600000); // check every 30 minutes

		function check(){
			url = "{{ URL::to('transaction/check-pending-document') }}";
	    	$.ajax({
				url: url,
				type: 'POST',
				data:{
                    _token: meta,
				},
                beforeSend: function () {

                },
                success: function (message) {
                    console.log("checked");
                }
			});
		}
	</script>
</body>
</html>
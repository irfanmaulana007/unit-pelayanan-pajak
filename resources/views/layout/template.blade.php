<!DOCTYPE html>
<html>
<head>
	<title>UPPRD Gambir @yield('title')</title>

	<!-- CSS - Plugin -->
	<link rel="stylesheet" type="text/css" href="{{ asset('node_modules/bootstrap/dist/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('node_modules/font-awesome/css/font-awesome.min.css') }}">
	@yield('custom-css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">

	<!-- JS - Plugin -->
	<script src="{{ asset('node_modules/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/alert.js') }}"></script>

	<!-- Google Fonts - Raleway -->
	<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
</head> 
<body>
	<header>
		
	</header>
	
	@if(Auth::user())
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
			<ul class="navbar-nav mr-auto">
		    	<li class="nav-item">
		    		<a class="nav-link" href="{{ URL::to('') }}">TU</a>
		    	</li>
		    	<li class="nav-item">
		    		<a class="nav-link active" href="{{ URL::to('monitoring') }}">Monitoring</a>
		    	</li>
		    	<li class="nav-item">
		    		<a class="nav-link" href="{{ URL::to('') }}">Input</a>
		    	</li>
		    	<li class="nav-item">
		    		<a class="nav-link" href="{{ URL::to('') }}">Statisik</a>
		    	</li>
		    	<li class="nav-item">
		    		<a class="nav-link" href="{{ URL::to('') }}">Laporan</a>
		    	</li>
		    	<li class="nav-item">
		    		<a class="nav-link" href="{{ URL::to('') }}">Master User</a>
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
</body>
</html>
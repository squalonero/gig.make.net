<!doctype html>
<html>
<head>
    @include('include.header')
</head>
<body class="user-page @yield('title') {{ Session::get('italia') }}">
	
<div id="wrap" >
	
	
		<header class="">
			@include('include.head')
			@include('include.menu')
		</header>

		<div class="@yield('container')">
			<div id="main" class="@yield('container')">

					@yield('content')
			
			</div>
		</div>
	
		
		
	
	<div id="push" class=""></div>
</div>
	<div id="prefooter">
			</div>
	<footer id="footer" class="">
			@include('include.footer')
		    @yield('scripts')
		</footer>

</body>
</html>
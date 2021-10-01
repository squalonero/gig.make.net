<!doctype html>
<html>
<head>
    @include('include.header')
</head>
<body class="user-page  @yield('title') ">
	
<div id="wrap" >
	
	
		<header class="">
			@include('include.head')
		</header>

		<div class="container-fluid">
			<div id="main" class="">

					@yield('content')
			
			</div>
		</div>
	
		
		
	
	<div id="push" class=""></div>
</div>
	<div id="prefooter">
			</div>
	<footer id="footer" class="footerlogin">
			@include('include.footer')
		</footer>
</body>
</html>
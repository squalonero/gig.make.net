@extends( 'layouts.user' )
@section('title', 'Nazioni')
@section('container', 'container')
@section('content')

<div class="d-flex justify-content-center align-items-center flex-direction">
	<div class="boxes">
		<a class="mbox leftbox d-flex justify-content-center align-items-center p-5 mr-5" href="italia">ITALIA</a>
	</div>
	<div class="boxes">
		<a class="mbox rightbox d-flex justify-content-center align-items-center p-5" href="world">WORLD</a>
	</div>
</div>

@endsection
@extends( 'layouts.user' )

@section('content')

    {{ Session::get('nazione') }}
	

@endsection
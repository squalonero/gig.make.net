@if( Session::get("admin_privileges") == 2)
    @extends( 'layouts.user' )
@else
    @extends("crudbooster::admin_template")
@endif
@section("content")
    gestione firme


@endsection
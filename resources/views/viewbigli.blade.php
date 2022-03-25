<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />-->
    <meta charset="UTF-8">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
    <title>Biglietto</title>
</head>
<body>
	<style>
		.mdivisione{
			color: red;
		}
	</style>
<p>
	@if($request[0]->divisione)

		<span class="mdivisione">Nome Divisione:<br />
		{!! $request[0]->divisione !!}</span><br>

	@endif

	@if($request[0]->nome != '' && $request[0]->cognome != '')

    	<br/>{!! ucfirst($request[0]->nome) !!} {!! ucfirst($request[0]->cognome) !!}<br />

	@endif

    @if( $request[0]->professione != '')
        {!! ucwords(strtolower($request[0]->professione)) !!}<br />
    @endif
    <br />{!! $request[0]->societa !!}
    <br />{!! $request[0]->indirizzo !!}<br/>

    @if($request[0]->telefono != '')
        Tel. {!!$request[0]->prefnaz !!} {!! $request[0]->preftel !!} {!! $request[0]->telefono !!}
    @endif
    @php $trattino = '' @endphp
    @if($request[0]->fax != '')
        @if($request[0]->telefono != '' )
            @php $trattino = ' - ' @endphp
        @endif
        {!! $trattino !!}Fax {!!$request[0]->prefnaz1 !!} {!! $request[0]->prefax !!} {!! $request[0]->fax!!}
    @endif
    @php $trattino = '' @endphp
    @if($request[0]->cell != '' )
        @if($request[0]->telefono != '' || $request[0]->fax != '')
            @php $trattino = ' - ' @endphp
        @endif
        {!!$trattino !!}Cell. {!! $request[0]->cellnaz !!} {!! $request[0]->prefcell !!} {!! $request[0]->cell!!}
    @endif
    @php $trattino = '' @endphp

    @if($request[0]->emailBF != '' || $request[0]->email)
        @php $trattino = ' - ' @endphp
    @endif
    @php  $mail = ($request[0]->emailBF !='')? $request[0]->emailBF : $request[0]->email @endphp
    <br /> {!! $mail !!}{!!$request[0]->at !!}{!! $request[0]->emaildomain !!}{!! $trattino !!} www.{!! $request[0]->cdominio!!}
    <br /></p>

</body>
</html>


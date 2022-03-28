@extends('22signatures.index')
@section('content')
	<div style="text-align:left;">

		@yield('signature-specific')

		{{-- Outputs: Ufficio|Filiale di SarcazzoDove --}}
		@if ($viewData['type'] && $viewData['place'])
			<i>
				<span style="font-weight:normal; font-size:10pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;" class="tipologia">
					{{ $viewData['type'] }} {{ $viewData['place'] }}
				</span>
				<span style="font-weight:normal; font-size:10pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;" class="comune"></span>
			</i>
			<br /><br />
		@endif

		{{-- Intoo Only --}}
		@if ($viewData['ID_societa'] === 13)
			<span style="font-weight:bold; font-size:9pt; color:#015379; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;">
				<img src="http://{{ $_SERVER['HTTP_HOST'] }}/{{ $viewData['logoSC'] }}" alt="" title="" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<img src="http://{{ $_SERVER['HTTP_HOST'] }}/img/star-logo.gif" alt="Career Star Group" />
			</span>
		@else
			{{-- Not Intoo --}}
			<span style="font-weight:bold; font-size:9pt; color:#015379; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;">
				<img src="http://{{ $_SERVER['HTTP_HOST'] }}/{{ $viewData['logoSC'] }}" alt="" title="">
			</span>
		@endif

	</div>

	<div style="text-align:left; font-weight:normal; font-size:13pt; color:#65656A; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;">
		<img src="http://{{ $_SERVER['HTTP_HOST'] }}/img/Linea_273_8px.gif" width="305px" height="16px" />
	</div>

	<div style="text-align:left;">

		@if ($viewData['address'])
			<span style="font-weight:normal; font-size:10pt; color:#65656A; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;" class="address">
				{{ $viewData['address'] }}
			</span>

		@elseif($viewData['address_it'])

			<span style="font-weight:normal; font-size:9pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;" class="indirizzo">
				{{ $viewData['address_it'] }}
			</span><br />
		@endif

		@if ($viewData['tel'])
			<span style="font-weight:normal; font-size:9pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;" class="telefono">
				{{ trans('campi.tel') }}: {{ $viewData['tel'] }}
			</span><br />
		@endif

		@if ($viewData['cell'])
			<span style="font-weight:normal; font-size:9pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;" class="cell">
				{{ trans('campi.cell') }}: {{ $viewData['cell'] }}
			</span><br />
		@endif

		@if ($viewData['fax'])
			<span style="font-weight:normal; font-size:9pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;" class="fax">
				{{ trans('campi.fax') }}: {{ $viewData['fax'] }}
			</span><br />
		@endif

		@if ($viewData['email'])
			<span style="font-weight:normal; font-size:9pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;" class="mail">
				E-mail: {{ $viewData['email'] }}
			</span><br />
		@elseif($viewData['email_company'])
			<span style="font-weight:normal; font-size:9pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;" class="mail">
				E-mail: {{ $viewData['email_company'] }}
			</span><br />
		@endif

		<span style="font-weight:bold; font-size:9pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;" class="domain">www.{{ $viewData['domain'] }}</span>

	</div>

	<div style="text-align:left; font-weight:normal; font-size:13pt; color:#65656A; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;">
		<img src="http://{{ $_SERVER['HTTP_HOST'] }}/img/Linea_273_8px.gif" width="305px" height="16px" />
	</div>

	@if ($viewData['endorsement'])
		<span style="font-weight:bold; font-size:9pt; color:#015379; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;">
			<img src="http://{{ $_SERVER['HTTP_HOST'] }}/{{ $viewData['endorsement'] }}" alt="Gi Group" title="$ragsoc_prova">
		</span>
	@endif

	<div style="text-align:left;">
		<span style="text-align:left; font-size:7pt; color:#65656A; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;" class='privacy'><br />{{ $viewData['privacyC'] }}</span>
	</div>
@endsection

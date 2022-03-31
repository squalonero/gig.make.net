@extends('22signatures.index')

@php
$style_default = '
	display:block;
	font-weight:normal;
	line-height: 1.1;
	color:rgba(100, 100, 100, 1);
	color:#646464;
	font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;
	';
$logo_width = $viewData['logo_width'] ? 'width="' . $viewData['logo_width'] . '" style=max-width:' . $viewData['logo_width'] . 'px' : '';
$endorsement_width = $viewData['endorsement_width'] ? 'width="' . $viewData['endorsement_width'] . '" style=max-width:' . $viewData['endorsement_width'] . 'px' : '';
$sponsor_width = $viewData['sponsor_width'] ? 'width="' . $viewData['sponsor_width'] . '" style=max-width:' . $viewData['sponsor_width'] . 'px' : '';
@endphp
@section('content')
	<div style="text-align:left;">

		@yield('signature-specific')

		<span
			style="font-weight:bold; font-size:13pt; color:#015379; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;">
			<div style='display:inline-block'>
				<img class="logoS" src="http://{{ $_SERVER['HTTP_HOST'] }}/{{ $viewData['logoSC'] }}" {{ $logo_width }} >
			</div>
		</span>

		<div style="text-align:left;">

			{{-- Estero @notverified --}}
			@if ($viewData['address'])
				<div style="font-size:10pt">
					<br />
				</div>

				<div style="{{ $style_default }} font-size:9pt;">
					{{ $viewData['address'] }}
				</div>

				<br style="line-height:0;content:'';" />
				@if ($viewData['address_2'])
					<div style="{{ $style_default }} font-size:9pt;">
						{{ $viewData['address_2'] }}
					</div>

				<br style="line-height:0;content:'';" />
				@endif

				@if ($viewData['address_3'])
					<div style="{{ $style_default }} font-size:9pt;">
						{{ $viewData['address_3'] }}
					</div>
				@endif
			@endif
			{{-- End Estero @notverified --}}

			@if ($viewData['address_it'])
				<div style="font-size:10pt">
					<br />
				</div>

				<div style="{{ $style_default }} font-size:9pt;">
					{{ $viewData['address_it'] }}
				</div>

				<br style="line-height:0;content:'';" />
				@if ($viewData['address_it_2'])
					<div style="{{ $style_default }} font-size:9pt;">
						{{ $viewData['address_it_2'] }}
					</div>

				<br style="line-height:0;content:'';" />
				@endif

				@if ($viewData['address_it_3'])
					<div style="{{ $style_default }} font-size:9pt;">
						{{ $viewData['address_it_3'] }}
					</div>
				@endif
			@endif

			@if ($viewData['cell'])
				<br style="line-height:0;content:'';" />
				<div style="{{ $style_default }} font-size:9pt;">
					<span style="display:inline-block;width:16px">
						<strong style="{{ $style_default }} letter-spacing:7px; font-size:9pt; font-weight:700;">M </strong>
					</span>
					{{ $viewData['cell'] }}
				</div>
			@endif

			@if ($viewData['tel'])
				<br style="line-height:0;content:'';" />
				<div style="{{ $style_default }} font-size:9pt;">
					<span style="display:inline-block;width:16px">
						<strong style="{{ $style_default }} letter-spacing:7px; font-size:9pt; font-weight:700;">T </strong>
					</span>
					{{ $viewData['tel'] }}
				</div>
			@endif

			@if ($viewData['skype'])
				<br style="line-height:0;content:'';" />
				<div style="{{ $style_default }} font-size:9pt;">
					<strong style="font-weight:700;">Skype </strong>{{ $viewData['skype'] }}
				</div>
			@endif

			@if ($viewData['email'])
				<br style="line-height:0;content:'';" />
				<div style="{{ $style_default }} font-size:9pt;">
					<strong style="font-weight:700;">E-mail </strong>{{ $viewData['email'] }}
				</div>
			@elseif($viewData['email_company'])
				<br style="line-height:0;content:'';" />
				<div style="{{ $style_default }} font-size:9pt;">
					<strong style="font-weight:700;">E-mail </strong>{{ $viewData['email_company'] }}
				</div>
			@endif

			<div style="font-size:8pt;"><br /></div>
			<div style="{{ $style_default }} font-weight:bold; font-size:10pt;">
				<a href="http://www.{{ $viewData['domain'] }}"
					style="{{ $style_default }} font-weight:bold; font-size:10pt; text-decoration:none;"
					target="_blank">
					www.{{ $viewData['domain'] }}
				</a>
			</div>

			{{-- Social --}}
			@if ($viewData['social_count'] > 0)
				{!! $viewData['social_output'] !!}
			@endif
			{{-- End Social --}}

			{{-- Endorsement image --}}
			@if ($viewData['endorsement'])
				<div style="font-size:10pt">
					<br />
				</div>
				<div style="text-align:left;">
					@if ($viewData['endorsementLink'])
						<a href="{{ $viewData['endorsementLink'] }}">
					@endif

					<img src="https://{{ $_SERVER['HTTP_HOST'] }}/{{ $viewData['endorsement'] }} " alt="endorsement" {{ $endorsement_width }} />

					@if ($viewData['endorsementLink'])
						</a>
					@endif
				</div>
			@endif
			{{-- End Endorsement image --}}

			{{-- Logo More Than Work --}}
			<div style="text-align:left; margin:10px 0px">
				@if ($viewData['mdw_replace_link'])
					<a href="{{ $viewData['mdw_replace_link'] }}">
					@else
						<a href="https://www.gigroupholding.{{ $viewData['isItalia'] ? 'it' : 'com' }}/">
				@endif
				<img src="{{ $viewData['mdw_replace_image'] ? $viewData['mdw_replace_image'] : asset('img/Morethanwork.png') }} " alt="Logo More than work" width="145" />
				</a>
			</div>
			{{-- End logo More Than Work --}}

			@if ($viewData['sponsor_image'])
				<div style="text-align:left; margin:10px 0px">
					@if ($viewData['sponsorLink'])
						<a href="{{ $viewData['sponsorLink'] }}">
					@endif

					<img src="http://{{ $_SERVER['HTTP_HOST'] }}/{{ $viewData['sponsor_image'] }} " {{ $sponsor_width }} />

					@if ($viewData['sponsorLink'])
						</a>
					@endif
				</div>
			@endif

		</div>

		@if ($viewData['privacyC'])
			<div style="text-align:left;">
				<div style="font-size:10pt">
					<br />
				</div>
				<span style="text-align:left; font-size:7pt; color:#65656A; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;">
					{{ $viewData['privacyC'] }}<br />
				</span>
			</div>
		@endif
	</div>

@endsection

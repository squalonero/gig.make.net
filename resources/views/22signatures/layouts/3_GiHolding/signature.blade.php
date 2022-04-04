@extends('22signatures.index')
@php
$style_default = "
	display:block;
	font:700 8pt/10pt 'Lato', sans-serif;
	color:rgb(0, 20, 90);
	";
// $logo_width = $viewData['logo_width'] ? 'width="' . $viewData['logo_width'] . '" style=max-width:' . $viewData['logo_width'] . 'px' : '';
// $endorsement_width = $viewData['endorsement_width'] ? 'width="' . $viewData['endorsement_width'] . '" style=max-width:' . $viewData['endorsement_width'] . 'px' : '';
// $sponsor_width = $viewData['sponsor_width'] ? 'width="' . $viewData['sponsor_width'] . '" style=max-width:' . $viewData['sponsor_width'] . 'px' : '';
// $logo_width = $endorsement_width = $sponsor_width = 'style=width:auto;height:auto;display:block;border:0;';
@endphp

{{-- SIGNATURE INFO

Name Surname:
- lato bold 11pt
- line height 13pt

Job Title:
	- lato regular 11pt
	- line height 13pt

Logo:
	- width 80px

Domain:
	- lato bold 8pt
	- line height 10pt

Phone, address, social:
	- lato regular 8pt
	- line height 10pt

Logo #ChangeLives
	- width 112px

	END INFO --}}


@section('content')
	<div style="font-family: 'Lato', sans-serif;">

		@yield('signature-specific')

		{{-- Company Logo --}}

		{!! MyFuncs::spaceHTML('15px') !!}

		<span style="display:block; height: auto;">
			<!--[if gte mso 9]>
					<v:image
						src="http://{{ $_SERVER['HTTP_HOST'] }}/{{ $viewData['logoSC'] }}"
						style="position:relative;top:1;left:1;width:50;height:50">
						</v:image>
					<![endif]-->
			<img src="http://{{ $_SERVER['HTTP_HOST'] }}/{{ $viewData['logoSC'] }}" {{ $logo_width }}>
		</span>
		{{-- End Company Logo --}}
		<br style="line-height:0;content:'';" />

		{!! MyFuncs::spaceHTML('10px') !!}

		<span style="{{ $style_default }}" class="domain">www.{{ $viewData['domain'] }}</span>

		@if ($viewData['tel'])
			<br style="line-height:0;content:'';" />
			<span style="{{ $style_default }}">
				T {{ $viewData['tel'] }}
			</span>
		@endif

		@if ($viewData['cell'])
			<br style="line-height:0;content:'';" />
			<span style="{{ $style_default }}">
				M {{ $viewData['cell'] }}
			</span>
		@endif

		@if ($viewData['fax'])
			<br style="line-height:0;content:'';" />
			<span style="{{ $style_default }}">
				F {{ $viewData['fax'] }}
			</span>
		@endif

		@if ($viewData['email'])
			<br style="line-height:0;content:'';" />
			<span style="{{ $style_default }}">
				E-mail {{ $viewData['email'] }}
			</span>
		@endif

		{{-- Estero @notverified --}}
		@if ($viewData['address'])
			<br style="line-height:0;content:'';" />
			<span style="{{ $style_default }}">
				{{ $viewData['address'] }}
			</span>

			@if ($viewData['address_2'])
				<br style="line-height:0;content:'';" />
				<span style="{{ $style_default }}">
					{{ $viewData['address_2'] }}
				</span>
			@endif

			@if ($viewData['address_3'])
				<br style="line-height:0;content:'';" />
				<span style="{{ $style_default }}">
					{{ $viewData['address_3'] }}
				</span>
			@endif
		@endif
		{{-- End Estero @notverified --}}

		@if ($viewData['address_it_via_civico'])
			<br style="line-height:0;content:'';" />
			<span style="{{ $style_default }}">
				{{ $viewData['address_it_via_civico'] }}
			</span>
		@endif

		@if ($viewData['address_it_cap_citta'])
			<br style="line-height:0;content:'';" />
			<span style="{{ $style_default }}">
				{{ $viewData['address_it_cap_citta'] }}
			</span>
		@endif

		{{-- @if ($viewData['address_it_full'])
			<br style="line-height:0;content:'';" />
			<span style="{{ $style_default }}">
				{{ $viewData['address_it_full'] }}
			</span>
		@endif --}}


		{{-- Social --}}
		@if ($viewData['social_exist'])
			<br style="line-height:0;content:'';" />
			{!! MyFuncs::spaceHTML('10px') !!}
			<table style="border-spacing:0">
				<tr>
					<td valign="middle" style="vertical-align:middle;font:700 8pt/10pt 'Lato', sans-serif;
						color:rgb(0, 20, 90);">
						Follow us
					</td>
					{!! $viewData['social_output'] !!}
				</tr>

			</table>
		@endif
		{{-- End Social --}}

		{{-- Human Resources in place of Endorsement image (if checked) --}}
		@if ($viewData['is_human_resources'])
			{!! MyFuncs::spaceHTML('10px') !!}

			<div>
				@if ($viewData['endorsementLink'])
					<a href="{{ $viewData['endorsementLink'] }}">
				@endif

				<img src="{{ asset('img/Changelives.png') }}"
					width="122" style="max-width:122px" />

				@if ($viewData['endorsementLink'])
					</a>
				@endif
			</div>
			{{-- Endorsement image (in this layout is Logo More Than Work) --}}
		@elseif ($viewData['endorsement'])
			{!! MyFuncs::spaceHTML('10px') !!}
			<div>
				@if ($viewData['endorsementLink'])
					<a href="{{ $viewData['endorsementLink'] }}">
				@endif

				<img src="https://{{ $_SERVER['HTTP_HOST'] }}/{{ $viewData['endorsement'] }} "
					{{ $endorsement_width }} />

				@if ($viewData['endorsementLink'])
					</a>
				@endif
			</div>
		@endif
		{{-- End Endorsement image --}}

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

@endsection

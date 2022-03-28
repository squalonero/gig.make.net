@extends('22signatures.index')

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
		<span style="display:block; margin-top:15px; width:80px; max-width:80px; height: auto;">
			<img src="http://{{ $_SERVER['HTTP_HOST'] }}/{{ $viewData['logoSC'] }}" alt="" title="" width="80">
		</span>
		{{-- End Company Logo --}}

		<span style="display:block; font:700 8pt/10pt 'Lato', sans-serif; color:rgb(0, 20, 90); margin-top:10px;" class="domain">www.{{ $viewData['domain'] }}</span>

		@if ($viewData['tel'])
			<span style="display:block;font:400 8pt/10pt 'Lato', sans-serif; color:rgb(0, 20, 90);" class="telefono">
				T. {{ $viewData['tel'] }}
			</span>
		@endif

		{{-- Estero @notverified --}}
		@if ($viewData['address'])

			<span
				style="display:block;font:400 8pt/10pt 'Lato', sans-serif; color:rgb(0, 20, 90);"
				class="address">
				{{ $viewData['address'] }}
			</span>

			@if ($viewData['address_2'])
				<span
					style="display:block;font:400 8pt/10pt 'Lato', sans-serif; color:rgb(0, 20, 90);"
					class="address">
					{{ $viewData['address_2'] }}
				</span>
			@endif

			@if ($viewData['address_3'])
				<span
					style="display:block;font:400 8pt/10pt 'Lato', sans-serif; color:rgb(0, 20, 90);"
					class="address">
					{{ $viewData['address_3'] }}
				</span>
			@endif
		@endif
		{{-- End Estero @notverified --}}

		{{-- Social --}}
		@if ($viewData['social_count'] > 0)
                {!! $viewData['social_output'] !!}
        @endif
		{{-- End Social --}}

		{{-- Endorsement image --}}
		@if ($viewData['sponsorFilePath'] || $viewData['endorsement'])
			<div style="margin-top:10px;">
				@if ($viewData['endorsementLink'])
					<a href="{{ $viewData['endorsementLink'] }}">
				@endif

				<img src="http://{{ $_SERVER['HTTP_HOST'] }}/{{ $viewData['sponsorFilePath'] ? $viewData['sponsorFilePath'] : $viewData['endorsement'] }} "
					style="max-width:112px;" alt="sponsorImage" width="112"/>

				@if ($viewData['endorsementLink'])
					</a>
				@endif
			</div>
		@endif
		{{-- End Endorsement image --}}

		{{-- Logo More Than Work --}}
		<div style="text-align:left; margin:10px 0px">
			<a href="https://www.gigroupholding.it/">
				<img src="{{ asset('img/morethanwork.svg') }} " alt="Logo More than work" width="145"/>
			</a>
		</div>
		{{-- End Logo More Than Work --}}

	</div>

	@if($viewData['privacyC'])
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

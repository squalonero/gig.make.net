@extends('22signatures.index')

@php
    $style_default = 'font-weight:normal; line-height: 1.1; color:rgba(100, 100, 100, 1); color:#646464; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;';
    $style_bold = '';
@endphp
@section('content')
	<div style="text-align:left;">

		@yield('signature-specific')

		<span
			style="font-weight:bold; font-size:13pt; color:#015379; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;">
			<div style='display:inline-block'>
				<img class="logoS" src="http://{{ $_SERVER['HTTP_HOST'] }}/{{ $viewData['logoSC'] }}" alt=''
					title="">
			</div>
		</span>

		<div style="text-align:left;">

			{{-- Estero @notverified --}}
			@if($viewData['address'])
				<div style="font-size:10pt">
					<br />
				</div>

				<div style="{{ $style_default }} font-size:9pt;">
					{{ $viewData['address'] }}
				</div>
				<br />
				@if ($viewData['address_2'])
					<div style="{{ $style_default }} font-size:9pt;">
						{{ $viewData['address_2'] }}
					</div>
					<br />
				@endif

				@if ($viewData['address_3'])
					<div style="{{ $style_default }} font-size:9pt;">
						{{ $viewData['address_3'] }}
					</div>
					<br />
				@endif
			@endif
			{{-- End Estero @notverified --}}

			@if($viewData['address_it_1'] && $viewData['address_it_2'])
				<br />
				<div style="{{ $style_default }} font-size:9pt;">
					{{ $viewData['address_it_1'] }}
				</div>
				<div style="{{ $style_default }} font-size:9pt;">
					{{ $viewData['address_it_2'] }}
				</div>
			@else
				<div style="{{ $style_default }} font-size:9pt;">
					{{ $viewData['address_it'] }}
				</div>
				<br />
			@endif

			@if($viewData['cell'])
				<div style="{{ $style_default }} font-size:9pt;">
					<span style="display:inline-block;width:16px">
						<strong style="{{ $style_default }} letter-spacing:7px; font-size:9pt;">M </strong>
					</span>
					{{ $viewData['cell'] }}
				</div>
			@endif

			@if($viewData['tel'])
				<div style="{{ $style_default }} font-size:9pt;">
					<span style="display:inline-block;width:16px">
						<strong style="{{ $style_default }} letter-spacing:7px; font-size:9pt;">T </strong>
					</span>
					{{ $viewData['tel'] }}
				</div>
			@endif

			@if($viewData['skype'])
				<div style="{{ $style_default }} font-size:9pt;">
					<strong>Skype </strong>{{ $viewData['skype'] }}
				</div>
			@endif

			@if($viewData['email'])
				<div style="{{ $style_default }} font-size:9pt;">
					<strong>E-mail </strong>{{ $viewData['email'] }}
				</div>
			@elseif($viewData['email_company'])
				<div style="{{ $style_default }} font-size:9pt;">
					<strong>E-mail </strong>{{ $viewData['email_company'] }}
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
			@if($viewData['social_count'] > 0)
				{!! $viewData['social_output'] !!}
			@endif
			{{-- End Social --}}

			{{-- Sponsor image --}}
			@if($viewData['sponsorFilePath'] || $viewData['endorsement'])
				<div style="font-size:10pt">
					<br />
				</div>
				<div style="text-align:left;">
					@if ($viewData['endorsementLink'])
						<a href="{{ $viewData['endorsementLink'] }}" alt="Sponsor Url">
					@endif

					    <img src="http://{{ $_SERVER['HTTP_HOST'] }}/{{ $viewData['sponsorFilePath'] ? $viewData['sponsorFilePath'] : $viewData['endorsement'] }} " alt="sponsorImage" />

					@if ($viewData['endorsementLink'])
						</a>
					@endif
				</div>
			@endif
			{{-- End Sponsor image --}}

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
	</div>

@endsection

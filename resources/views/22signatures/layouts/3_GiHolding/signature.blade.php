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

		{{-- Social @toimprove --}}
		@if ($viewData['socialCount'] > 0)
			<?php
			$totalSocial = $viewData['socialCount'];
			$social_output = '';
			// check if at least a social has been compiled
			$oneSocialCompiled = false;
			for ($socialIndex = 0; $socialIndex < $totalSocial; $socialIndex++) {
			    $socialHrefVarNameCheck = 'social_' . $socialIndex;
			    if (trim($viewData['request']->$socialHrefVarNameCheck) != '') {
			        $oneSocialCompiled = true;
			        break;
			    }
			}

			if ($oneSocialCompiled) {
			    $social_output .= '<div style="margin-top:10px;"><span style="display:inline-block;font:400 8pt/10pt \'Lato\', sans-serif; color:rgb(0, 20, 90);">Follow us </span>';
			    for ($socialIndex = 0; $socialIndex < $totalSocial; $socialIndex++) {
			        $socialHrefVarName = 'social_' . $socialIndex;
			        $socialImgVarName = 'socialImage_' . $socialIndex;
			        $socialLabelVarName = 'socialLabel_' . $socialIndex;
			        if (trim($viewData['request']->$socialHrefVarName) != '') {
			            $social_output .= '<a href="' . $viewData['request']->$socialHrefVarName . '" target="_blank" style="display:inline-block;vertical-align:middle;">
							<img src="http://' . $_SERVER['HTTP_HOST'] . '/' . $viewData['request']->$socialImgVarName . '" style="height:10pt;margin-left:3pt" alt="" /></a>
							<span style="">&nbsp;</span>';
			        }
			    }
			    $social_output .= '</div>';
			}
			echo $social_output;
			?>
		@endif
		{{-- End Social --}}

		{{-- Sponsor image --}}
		@if ($viewData['sponsorFilePath'] || $viewData['firmaImg'])
			<div style="margin-top:10px;">
				@if ($viewData['firmaImgLink'])
					<a href="{{ $viewData['firmaImgLink'] }}" alt="Sponsor Url">
				@endif

				<img src="http://{{ $_SERVER['HTTP_HOST'] }}/{{ $viewData['sponsorFilePath'] ? $viewData['sponsorFilePath'] : $viewData['firmaImg'] }} "
					style="max-width:112px;" alt="sponsorImage" width="112"/>

				@if ($viewData['firmaImgLink'])
					</a>
				@endif
			</div>
		@endif
		{{-- End Sponsor image --}}

	</div>

@endsection

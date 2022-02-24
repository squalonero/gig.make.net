@extends('22signatures.layouts.3_GiHolding.signature')
@section('signature-specific')
	@if ($viewData['name'] && $viewData['lastname'])
		<span style="font:700 11pt/13pt 'Lato', sans-serif; color:rgb(0, 20, 90);" class="nome">
			{{ $viewData['name'] }} {{ $viewData['lastname'] }}
		</span>
		<br />
	@endif

	{{-- Estero --}}
	@if ($viewData['job'])
		<span style="font:400 11pt/13pt 'Lato', sans-serif; color:rgb(29, 87, 251)" class="job">
			{{ $viewData['job'] }}
		</span>
		<br />
	@endif
	{{-- End Estero --}}

    @if ($viewData['job_it'])
		<span style="font:400 11pt/13pt 'Lato', sans-serif; color:rgb(29, 87, 251)" class="professione">
			{{ $viewData['job_it'] }}
		</span>
		<br />
	@endif

@endsection

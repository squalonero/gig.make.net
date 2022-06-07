@extends('22signatures.layouts.2_OtherCompany.signature')

@section('signature-specific')

	<span style="font-weight:bold; font-size:10pt; color:#65656A; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;" class="nome">

		{{ ucwords(strtolower($viewData['name'])) . ' ' . ucwords(strtolower($viewData['lastname'])) }}

	</span>

	<br />



	{{-- Estero --}}

	@if ($viewData['job'])

		<span style="font-weight:normal; font-size:10pt; color:#65656A; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;" class="job">

			{{ $viewData['job'] }}

		</span>

		<br />

	@endif

	{{-- End Estero --}}



	@if ($viewData['job_it'])

		<span style="font-weight:normal; font-size:10pt; color:#65656A; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;" class="professione">

			{{ $viewData['job_it'] }}

		</span>

		<br />

	@endif



	@if (!$viewData['job_it'] || $viewData['type'])

		<br />

	@endif

@endsection


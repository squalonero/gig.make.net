@extends('22signatures.layouts.1_Gigroup.signature')
@section('signature-specific')
	<span style="font-weight:bold; line-height: 1.1; font-size:10pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;" class="nome">
		{{ $viewData['name'] }} {{ $viewData['lastname'] }}
	</span>

	@if ($viewData['job'])
		<div style="font-weight:normal; line-height: 1.1; font-size:10pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;" class="job">
			{{ $viewData['job'] }}
		</div>
	@endif

	@if ($viewData['job_it'])
		<div style="font-weight:normal; line-height: 1.1; font-size:10pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;" class="professione">
			{{ $viewData['job_it'] }}
		</div>
	@endif

	@if (!$viewData['type'] || !$viewData['place'])
		<div style="font-size:10pt"><br /></div>
	@endif

	@if ($viewData['type'] && $viewData['place'])
		<i><span style="font-weight:normal;font-size:10pt;color:#65656A;font-family:Helvetica,FuturaTahoma,Arial,sans-serif;" class="tipologia">
				{{ $viewData['office_type'] }} {{ $viewData['place'] }}
			</span>
			<span style="font-weight:normal; font-size:10pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;" class="comune"></span></i><br />
	@endif
@endsection

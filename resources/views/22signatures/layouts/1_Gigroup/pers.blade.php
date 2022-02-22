@extends('22signatures.layouts.1_Gigroup.signature')
@section('signature-specific')
	<span style="font-weight:bold; font-size:10pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;" class="nome">
		{{ $viewData['name'] }} {{ $viewData['lastname'] }}
	</span>

	@if ($viewData['job'])
		<span style="font-weight:normal; font-size:10pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;" class="job">
			{{ $viewData['job'] }}
		</span>
	@endif

	@if ($viewData['job_it'])
		<span style="font-weight:normal; font-size:10pt; color:rgba(100, 100, 100, 1);color:#646464; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;" class="professione">
			{{ $viewData['job_it))'] }}
		</span>
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

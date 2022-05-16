@extends('22signatures.layouts.1_Gigroup.signature')
@section('signature-specific')

    {{-- Outputs: Ufficio|Filiale di SarcazzoDove --}}
    @if($viewData["type"] && $viewData["place"])
    <span style="font-weight:bold; font-size:10pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;" class="tipologia">
        {{$viewData['office_type']}} {{$viewData['place']}}
    </span>
    <span style="font-weight:bold; font-size:10pt; color:#65656A; font-family:Helvetica,FuturaTahoma,Arial,sans-serif;" class="comune"></span><br />
    @endif

@endsection
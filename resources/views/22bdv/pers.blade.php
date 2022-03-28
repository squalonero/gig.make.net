@extends('22bdv.index')
@section('content')
@php
    $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
@endphp
<p>
    <span style="font-weight:bold; font-size:9pt; color:#015379; font-family:Helvetica,Futura,Tahoma,Arial,sans-serif;">
        <img src="{{ $protocol. $_SERVER['HTTP_HOST'] .'/' .$viewData['logoSC'] }}" alt="" title=""  />
    </span><br/><br/>
    {{ ucfirst($viewData['name']) . ' ' . ucfirst($viewData['lastname']) }}

    @if($viewData['job_it'] != '')
        <br />  {{ $viewData['job_it'] }}
    @endif

    <br /><br />
    {{ $viewData['nome_societa'] }}

    <br />
    {{ $viewData['address_it'] }}
    <br/>

    @if($viewData['tel'] != '')
        Tel. {{ $viewData['tel'] }}
    @endif

    @if($viewData['tel'] != '' && $viewData['fax'] != '')
    -
    @endif

    @if($viewData['fax'] != '')
        Fax {{ $viewData['fax'] }}
    @endif

    @if($viewData['tel'] != '' || $viewData['fax'] != '')
    -
    @endif

    @if($viewData['cell'] != '')
        Cell. {{ $viewData['cell'] }}
    @endif

    @if($viewData['email_filiale'])
        <br />
        {{ $viewData['email_filiale'] }}{{ '@'.$viewData['email_domain'] }} - {{ 'www.'.$viewData['domain'] }}
        <br /></p>
    @endif

@endsection
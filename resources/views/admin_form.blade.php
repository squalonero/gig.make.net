@extends("crudbooster::default.form")
@section('content')
<div class="alert alert-warning" role="alert">
    Attenzione! Per ottenere la migliore qualità dalle immagini è consigliabile caricarle in formato VETTORIALE (SVG) mantenendo la massima risoluzione,<br/>
    la dimensione dell'immagine può essere specificata nell'apposito campo.<br/>
    Alcuni strumenti utili:
    <ul>
        <li><a href="https://png2svg.com/it/" target="_blank" class="alert-link">Convertitore PNG 2 SVG</a></li>
        <li><a href="https://convertio.co/it/" target="_blank" class="alert-link">Convertio.co</a></li>
    </ul>

</div>
@parent
@endsection
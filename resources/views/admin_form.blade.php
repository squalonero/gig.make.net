@extends("crudbooster::default.form")
@section('content')
<div class="alert alert-warning" role="alert">
    Attenzione! Per ottenere la migliore qualità dalle immagini nelle firme e la compatibilità tra client di posta è obbligatorio:
    <ul>
        <li>Che l'immgine sia in formato jpg o png</li>
        <li>Che l'immgine sia in scala 1:1</li>
        <li>Che l'immagine abbia il metodo colore RGB</li>
        <li>Che l'immagine sia a 72 dpi</li>
    </ul>

</div>
@parent
@endsection
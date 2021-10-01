
@extends(($permission == 2) ? "layouts.user" : "crudbooster::admin_template")
@section('title', 'Importa Triplette')


@section('container', 'container')
@section("content")

    <div class="row">
        <div class="col-md-12">
            <h2 class="title text-center">@yield('title')</h2>
            <hr/>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            @if($inserimento == 'ko')
           <form action="importcsv" method="post" id="importfile" name="importfile" enctype="multipart/form-data">
               @csrf
                <div class="form-group">
                    <label for="societa_id">Upload File Triplette</label>
                    <div class="dropSelect mDropSel">
                        <input type="file" id="filecsv" name="filecsv">
                       <input type="submit" value="Carica">

                    </div>
                </div>
           </form>
        @else
            <h2>Triplette inserite correttamente.</h2>
            @endif
        </div>

    </div>

    <hr>
   <script src="vendor/crudbooster/assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="js/custom.js"></script>

@endsection
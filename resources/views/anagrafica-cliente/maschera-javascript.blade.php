@extends('layouts.main-layout')

@push('head-script')
    <!-- foglio di stile custom -->
    <style>
        .row {
            margin-bottom: 10px;
        }
    </style>
@endpush
@push('footer-script')

    <script type="text/javascript">

        //==== Variuabile globali

        var arDati = [];

        function drawTable(tblContainer) {
            // --- Svuoto il contenuto del container
            $(tblContainer).empty();
            // -- per ogni elemento di ardati creo una row (tr)
            //indice array il promo

            //TODO: provare a fare la stessa cosa con un x-template
            $.each(arDati, function (idx, item) {
                console.log('idx='.concat(idx).concat(JSON.stringify(item)));
                var tr = $('<tr/>');

                var colNome = $('<td/>').html(item.nome);
                var colCognome = $('<td/>').html(item.cognome);

                tr.append(colNome);
                tr.append(colCognome);

                $(tblContainer).append(tr);
            });
        }

        $('#btnInviaDati').on('click', function (e) {
            //---fermo i comportamento di default e così ti sei permsso di non dichiare il form
            e.preventDefault();
            //---scatena un evento in cascata ne verificano degli altri
            //così gestisce solo il mio evento e nennsun altro
            e.stopPropagation();


            // === 1: recuper il valroe dei campi

            var nome = $("#fldNome").val();
            var cognome = $("#fldCognome").val();

            //=== 1.1 verifica che i campi siano popolati

            // === 2: aggiungo i campi alla struttura dati
            arDati.push({
                    'nome': nome,
                    'cognome': cognome
                }
            );

            // === 3: disegno la tabella
            drawTable('#tblContent');

            // === 4 richiamo api e meorizzo su db
            //se non metto il dominio ma la / significa la root della pagine
            // e non mettevo la / lo accodava alla url della pagina

            //le api scambiano solo oggetti json quindi devo creare un oggeto soopra
            //sono quelli che ci aspettiamo dentro la request nel controllare
            var jsonData = {
                'fldNome' : nome,
                'fldCognome': cognome
            };

            $.post("/api/ws/create-anagrafica", jsonData)
                .done(function (data) {
                    alert ("Data loaded" + data);
                });

            //così gestisce solo il mio evento e nennsun altro
            return false;
        });


    </script>

@endpush

@section('pageContent')
    <h1> Inserisci qui la tua anagrafica</h1>
    <!--Nome -->
    <div class="row">
        <div class="col-md-4"> {!! Form::label('nome','Nome',['class' => 'col-md-2 control-label']) !!}</div>
        <div class="col-md-8"> {!! Form::text('nome','',['class' => 'col-md-6' , 'id' => 'fldNome'])!!}</div>
    </div>

    <!--Nome -->
    <div class="row">
        <div class="col-md-4"> {!! Form::label('cognome','Cognome',['class' => 'col-md-2 control-label']) !!}</div>
        <div class="col-md-8"> {!! Form::text('cognome','',['class' => 'col-md-6' , 'id' => 'fldCognome'])!!}</div>
    </div>

    <div class="row">
        <div class="col-md-4"> &nbsp;</div>
        <div class="col-md-8"> {!! Form::submit('Invia Dati',['class' => 'btn btn-primary', 'id' => 'btnInviaDati'])!!}</div>
    </div>

    <hr>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Cognome</th>
        </tr>
        </thead>
        <tbody id="tblContent">
        </tbody>
    </table>

@endsection

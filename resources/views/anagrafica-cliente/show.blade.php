@extends('layouts.main-layout')

{{-- andiamo ad riepilre lo stack definito nel layput madre con i comandi puysh che ci permottono di iniettare codice quante volte si vuole a mo di pila--}}
@push('head-script')
    <!-- dentro gli stack solo coidce html anche per i commenti no blade -->
    <!--handlebars -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.10/handlebars.min.js"></script>
    <!--bootbox -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>


@endpush

@push('footer-script')
    <script type="application/javascript">
        $(document).ready(function () {
            // === faccio chiamata AJAX alla nostra API
            /*
            io prendo i dati dall'api scritta in laravel tramita chiamata ajax
            li passo in gestione a handlebars andando a caricare e compilare il relativo template
            in questo modo posso nel template handlebars accedere ai nomi delle varibiabili come nel modello

             */

            //-- definisco la modale di bootbox che la visualizza immediatamente
            var dialog = bootbox.dialog({
                title: 'Finestra di esempio',
                message: 'Loading'
            });

            var apiEndPoint = '{{ route('api.anagrafica-clienti.detail',['id' => $id]) }}';

            $.getJSON(apiEndPoint, function (response) {
                //--- Visualizzo solo per riepiligo i dati in console
                console.log(response);
                //--- Recuperio il contaneri di destinazione
                var container = $('#detailContent');
                //--- Recupero il template di handlebars
                var source = $('#anagrafica-dettaglio').html();

                //--- Compilo il xtemplate
                var template = Handlebars.compile(source);
                //--- Infilo i dati dentro il template
                var rendered = template(response);
                //--- Lo inserisco nel contaneir
                container.html(rendered);

                //--- qui è già tutto calcolato e definito a runtime quindi possiamo modificare
                //--- il codice con jquery
                //a partire da # prendimi solo li e l'enventuale contenuto di li
                $('#riepilogoOrdini > li').each(function (idx, item) {
                    $(item).on('click', function () {
                        alert($(this).attr('importo'));
                    });
                });

                //-- nascono la modale al termine del caricamento
                dialog.modal('hide');
            });

        });
    </script>
@endpush


@section('pageContent')
    <h1>Dettaglio anagrafica cliente</h1>

    <div id="detailContent">
        @include('x-template.x-anagrafica-dettaglio')
    </div>


@endsection
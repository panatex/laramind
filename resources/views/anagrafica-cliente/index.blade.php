@extends('layouts.main-layout')

@push('head-script')
    <!-- foglio di stile custom -->
    <style>
        .btnRosso::before {
            /* le glipicon sono in realtà un carattere*/
            font-family: "Glyphicons Halflings";
            content: '\e021';
            margin-right: 5px;
        }
    </style>

@endpush

@section('pageContent')
    <h1>Elenco anagrafiche clienti</h1>
    {{link_to_route('anagrafica-clienti.create','Crea anagrafica','',['class' => 'btn btn-primary'])}}

    @if (session('flash'))
        <div class="alert alert-success">
            {{ session('flash') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($dataC as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->nome}}</td>
                <td>{{$row->cognome}}</td>
                <td>
                    {{--aggiungere i pulsantei con delle include--}}
                    @include('includes.anagrafica-link-visualizza',['id' => $row->id ])
                    @include('includes.anagrafica-link-modifica',['id' => $row->id ])
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
@extends('layouts.main-layout')

@section('pageContent')
    <h1>Elenco anagrafiche clienti</h1>
    {{link_to_route('anagrafica-clienti.create','Crea anagrafica','',['class' => 'btn btn-primary'])}}
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
                <td></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
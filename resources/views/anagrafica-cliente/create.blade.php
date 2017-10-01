@extends('layouts.main-layout')
@section('pageContent')
    {{--s:Creiamo il form solo a livello di intestazione con laravel collective --}}
    {{-- conni punti escamitivi fa interpretare il codice html al bwroser e lo inserisce nella facendo correttamente il rendering
    altrimenti mi farebbe con le {{lo escape delle angolate e non eleborebbe il codice html}}--}}

    {!! Form::open([
    'url' => route('anagrafica-clienti.store').'?data=123',
     'method' => 'POST',
     'class' => 'form-horizontal',
     'id' => 'frmAnagrafica',
     'files' => 'true']) //se non ci si mette questo non puoi caricare il file nemmeno se ci metti il campo file nel form perchè manca l'enctype a livello di testata del form
     !!}

    {{-- includo il form--}}

    @include('includes.form-anagrafica')

    {!! Form::close() !!}

    {{--e:Creiamo il form solo a livello di intestazione con laravel collective --}}

@endsection

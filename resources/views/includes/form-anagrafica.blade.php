@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ ucfirst($error) }}</li>
            @endforeach
        </ul>
    </div>
@endif



<div class="form-group row">

    {{-- primo campo attributo for che aggancia al relativo input
     poi il contenuto della label--}}
    {!! Form::label( 'nome','Nome', [
    'class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {{-- primo è il name--}}
        {!! Form::text('nome', //name
        isset($anagrafica['nome']) ? $anagrafica['nome'] : '', //valore del campo di input
        [
            'class'     =>  'col-md-6',
            'required'  =>  'required',
            'id'        =>  'fldNome' ]
        ) !!}
    </div>
    <div class="col-md-4"></div>

</div>
<div class="form-group row">
    {{-- primo campo attributo for che aggancia al relativo input
   poi il contenuto della label--}}
    {!! Form::label( 'cognome','Cognome', [
    'class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {{-- primo è il name--}}
        {!! Form::text('cognome', //name
        isset($anagrafica['cognome']) ? $anagrafica['cognome'] : '', //valore del campo di input
        [
            'class'     =>  'col-md-6',
            'required'  =>  'required',
            'id'        =>  'fldCognome' ]
        ) !!}
    </div>
    <div class="col-md-4"></div>
</div>

<div class="form-group row">

    {{-- primo campo attributo for che aggancia al relativo input
   poi il contenuto della label--}}
    {!! Form::label( 'email','Email', [
    'class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {{-- primo è il name--}}
        {!! Form::email('email', //name
        isset($anagrafica['email']) ? $anagrafica['email'] : '', //valore del campo di input
        [
            'class'     =>  'col-md-6',
            'required'  =>  'required',
            'id'        =>  'fldEmail' ]
        ) !!}
    </div>
    <div class="col-md-4"></div>

</div>

<div class="form-group row">
    {{-- primo campo attributo for che aggancia al relativo input
   poi il contenuto della label--}}
    {!! Form::label( 'telefono','Telefono', [
    'class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {{-- primo è il name--}}
        {!! Form::text('telefono', //name
        isset($anagrafica['telefono']) ? $anagrafica['telefono'] : '', //valore del campo di input
        [
            'class'     =>  'col-md-6',
            'required'  =>  'required',
            'id'        =>  'fldTelefono' ]
        ) !!}
    </div>
    <div class="col-md-4"></div>

</div>

<div class="form-group row">
    {{-- primo campo attributo for che aggancia al relativo input
   poi il contenuto della label--}}
    {!! Form::label( 'data_contatto','Data contatto', [
    'class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {{-- primo è il name--}}
        {!! Form::date('data_contatto', //name
        isset($anagrafica['data_contatto']) ? $anagrafica['data_contatto'] : '', //valore del campo di input
        [
            'class'     =>  'col-md-6',
            'required'  =>  'required',
            'id'        =>  'fldDataContatto' ]
        ) !!}
    </div>
    <div class="col-md-4"></div>

</div>

<div class="form-group row">
    {{-- primo campo attributo for che aggancia al relativo input
   poi il contenuto della label--}}
    {!! Form::label( 'logo','Logo', [
    'class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {{-- primo è il name--}}
        {!! Form::file('logo', //name
        [
            'class'     =>  'btn btn-primary',
            'id'        =>  'fldLogo' ]
        ) !!}
    </div>
    <div class="col-md-4"></div>

</div>

<div class="form-group row">
   <div class="col-md-2 control-label">&nbsp;</div>
    <div class="col-md-6">
        {!! Form::submit('Invia Dati',['class' => 'btn btn-primary']) !!}
    </div>
    <div class="col-md-4"></div>
</div>
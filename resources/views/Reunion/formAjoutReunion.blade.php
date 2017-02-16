@extends('layouts.masterAdmin')
@section('content')

<div class="box">

    {!! Form::open(['url' => 'postReunion']) !!}

    <h3>Type de rendez-vous</h3>
    <div class="col-lg-6">
        <select class="form-control" name="select_type">
            <option class="" value="1"> Réunion </option>
            <option class="" value="2"> Assemblée générale </option>
        </select>
    </div>
    <br><br>
    <h3>Adresse du rendez-vous</h3>
    <div class="col-lg-6">
        <input type="text" class="form-control" name="adresseReunion" placeholder="Adresse du rendez-vous">
    </div>
    <br><br>
    <h3>Code Postal réunion</h3>
    <div class="col-lg-6">
        <input type="number" class="form-control" name="cpReunion" placeholder="Code Postal de la réunion">
    </div>
    {!! Form::close() !!}

</div>

@stop

@extends('layouts.master')
@section('content')
@php
    $place = (($mesConferences->placeDispoConf)-($mesConferences->placeReserConf));
    $i = 0;
@endphp
{!! Form::open(['url' => 'postFormReserveConf']) !!}
<div class='box'>
    <input type="hidden" name='idConf' value="{{$mesConferences->idConf}}">
    <center><h3> Conférence: {{$mesConferences->libConf}} </h3>
    <P> {{$mesConferences->contenuConf}} </p>
    <h6>Il ne reste que {{$place}} ! Dépéchez vous de reserver la/les votre(s) !</h6>
    <div class='col-lg-offset-4'>
        <div class='col-lg-6'>
            <center> <select class='form-control col-md-4' name='placeSouhaite'>
        @for($i=1;$i<= $place; $i++)
        <option value='{{$i}}'>{{$i}}</option>
        @endfor
                </select></center>
        </div><br><br></center>
    <center><button type='submit' class='btn btn-info'>Réserver</button></center>
    </div>
</div>
{{ Form::close() }}
@stop


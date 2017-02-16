@extends('layouts.master')
@section('content')
@php
$placeDispo = (($mesConferences->placeDispoConf)-($mesConferences->placeReserConf));
$place = (($mesConferences->placeDispoConf)-($mesConferences->placeReserConf));
$i = 0;  
@endphp

{!! Form::open(['url' => 'postFormReserveConf']) !!}
<div class='box'>
    <input type="hidden" name='idConf' value="{{$mesConferences->idConf}}">
    <div>
        <center>
            <h3> Conférence: {{$mesConferences->libConf}} </h3>
            <P> {{$mesConferences->contenuConf}} </p>
            <h6>Il ne reste que {{$placeDispo}} places ! Dépéchez vous de réserver la/les votre(s) !</h6>
        </center>
    </div>
    <div class="col-md-4 col-md-offset-4">
        <center>
            <select class='form-control col-md-4' name='placeSouhaite'>
                @if($placeDispo >= 6)
                @php
                $place = 6;
                @endphp
                @endif
                @for($i=1;$i <= $place; $i++)
                <option value='{{$i}}'>{{$i}}</option>
                @endfor
            </select>
        </center>
    </div>
    <div class="col-md-12">
        <br>
        <center>
        <button type='submit' class='btn btn-info'>Réserver</button>
        </center>
    </div>
</div>

{{ Form::close() }}
@stop
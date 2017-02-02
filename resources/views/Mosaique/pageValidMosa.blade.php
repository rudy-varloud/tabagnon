@extends('layouts.master')
@section('content')
<div class="box">
    <center>
        {!! Form::open(['url' => 'valideImage', 'files' => true]) !!}
        <img class='article-image' src="{{ URL::asset('assets/image/mosaique/'.$mesMosaiques->nomImage) }}" alt=""><BR><br>
        <h4>{{$mesMosaiques->descriptionImage}}</h4>
        <input type="hidden" name="id" value="{{$mesMosaiques->idImage}}">
        <button type="submit" class="btn btn-info" value="Valider">Valider</button>
        {{ Form::close() }}
        {!! Form::open(['url' => 'refuseImage', 'files' => true]) !!}
        <input type="hidden" name="idImage" value="{{$mesMosaiques->idImage}}">
        <br>
        <button type="submit" class="btn btn-danger" value="Valider">Refuser</button>
        {{ Form::close() }}
        
    </center>
</div>
@stop
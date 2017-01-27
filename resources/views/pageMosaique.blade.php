@extends('layouts.master')
@section('content')
<div class="box">
    @php
        $date = date("Y-m-d");
    @endphp
    <button type='button' class='btn btn-info' onclick='ajoutImage();'>Ajouter une image</button>
    {!! Form::open(['url' => 'postFormMosaique', 'files' => true]) !!}
    <div class="form-group formAjoutImage" id='formAjoutImage' style='display : none;'>
        {{$error or ""}}
        <br>
        <label class='col-md-3 control-label'>Image que vous souhaitez ajouter à la mosaïque</label>
        <div class='col-md-4'>
            <input type='hidden' name="imageMosaique" value=""/>
            <input type='hidden' name="MAX_FILE_SIZE" value="204800"/>
            <input type='file' name="imageMosaique" class="btn btn-default pull-left" accept="image/*" required/>
        </div>
        <div class="col-md-4">
        <input type="text" class="form-control" name="descriptionImage" value="" placeholder="Courte description de l'image" required>
        <input type='hidden' value='{{$date}}' name='date'>
        </div>
        <button type="submit" class="btn btn-info btn_mosaique" value="Envoyer">Envoyer</button>
    </div>
    {{ Form::close() }}
    <br>
    @foreach($mesMosaiques as $maMosaique)
    <img class='article-image' src="{{ URL::asset('assets/image/mosaique/'.$maMosaique->nomImage) }}" alt="">
    @endforeach
    <center>{{ $mesMosaiques->render() }}</center>
</div>
@stop


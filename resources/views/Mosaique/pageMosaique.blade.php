@if (Session::get('ncpt') != 0) 
@extends('layouts.master')
@section('content')
<div class="box">
    @if($message != null)
    <div class="alert alert-info alert-dismissable fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p>{{$message}}</p>
    </div>
    @endif
    @php
    $date = date("Y-m-d");
    @endphp
    @if (Session::get('ncpt') >= 2)
    <button type='button' class='btn btn-info' onclick='ajoutImage();'>Ajouter une image</button>
    {!! Form::open(['url' => 'postFormMosaique', 'files' => true]) !!}
    <div class="form-group formAjoutImage" id='formAjoutImage' style='display : none;'>
        <br>
        <label class='col-md-3 control-label'>Image que vous souhaitez partager</label>
        <div class='col-md-4'>
            <input type='hidden' name="imageMosaique" value=""/>
            <input type='hidden' name="MAX_FILE_SIZE" value="15000000"/>
            <input type='file' name="imageMosaique" class="btn btn-default" accept="image/*" required/>
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" name="descriptionImage" value="" placeholder="Courte description de l'image" required>
            <input type='hidden' value='{{$date}}' name='date'>
        </div>
        <button type="submit" class="btn btn-info btn_mosaique" value="Envoyer">Envoyer</button>
    </div>
    {{ Form::close() }}
    @endif
    <br>
    @if ($mesMosaiques == null)
    Aucun utilisateur n'a publié d'image
    @endif
    @foreach($mesMosaiques as $maMosaique)
    <a href="{{ url('/getImage/'.$maMosaique->idImage)}}"><img class='article-image' src="{{ URL::asset('assets/image/mosaique/'.$maMosaique->nomImage) }}" alt=""></a>
    @endforeach
    <center>{{ $mesMosaiques->render() }}</center>
</div>
@stop
@endif
@if (Session::get('ncpt') == 0)
<script>
    window.location.href = "{{url('/getLogin')}}";
</script>
@endif


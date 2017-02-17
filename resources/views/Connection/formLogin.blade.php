@extends('layouts.master')
@section('content')
<br>
{!! Form::open(['url' => 'login']) !!}
<div class="form-subscribe col-md-offset-3 col-md-6">
    <br>
    <div class="form-horizontal">    
        <h1 class='titreLogin'>Authentification</h1>
        <p>{{$erreur}}</p>
        <div class="form-group">
            <label class="col-lg-5 col-md-3 control-label">Identifiant : </label>
            <div class="col-md-5">
                <input type="text" name="login" class="form-control" placeholder="Votre identifiant" required autofocus>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-5 col-md-3 control-label">Mot de passe : </label>
            <div class="col-md-5">
                <input type="password" name="pwd" class="form-control" placeholder="Votre mot de passe" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
                <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> Valider</button>
                {{ Form::close() }}
            </div>
        </div>
        <br>
        <center>
            <a href='{{url('/getSubscribe')}}'> S'inscrire</a>
            <br>
            <a href='{{url('/mdpoublie')}}'> Mot de passe oublié</a>
        </center>
    </div>
    <br>
</div>


@stop


@extends('layouts.master')
@section('content')
<div class="form-subscribe">
    <br>
    <center><h1>Inscription</h1></center>
    <br><br>
    {!! Form::open(['url' => 'subscribe']) !!}
    <div class="form-horizontal">   
        <div class="form-group">
            <label class="col-md-3 control-label"><i class="glyphicon glyphicon-tag"> </i> Nom : </label>   
            <div class="col-md-6 col-md-3">
                <input type="text" name="nom" class="form-control" pattern=".{2,25}" value = "{{$nom or ''}}"  placeholder="Votre Nom" required autofocus>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label"><i class="glyphicon glyphicon-tag" > </i> Prénom : </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="prenom" class="form-control"  pattern=".{2,25}" value = "{{$prenom or ''}}" placeholder="Votre Prénom" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label"><i class="glyphicon glyphicon-home"> </i> Adresse : </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="adr" class="form-control" pattern=".{0,50}" value = "{{$adr or ''}}" placeholder="Votre adresse" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label"><i class="glyphicon glyphicon-home"> </i> Ville : </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="ville" class="form-control" pattern=".{0,40}" value = "{{$ville or ''}}" placeholder="Votre ville" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label"><i class="glyphicon glyphicon-home"> </i> Code Postal : </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="cp" class="form-control" pattern="[0-9]{5}" value = "{{$cp or ''}}" placeholder="Votre code postal" required>
            </div>
        </div>
        <div class="form-group ">

            <label class="item item-input col-md-3 control-label "> <i class="glyphicon glyphicon-earphone"> </i> Téléphone :</label>
            <div class="col-md-6 col-md-3 ">
                <input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" name="tel" class="form-control" value = "{{$tel or ''}}" placeholder="Votre téléphone">
            </div>
        </div>
        <div class="form-group">
            {{$erreur}}
            <label class="col-md-3 control-label"><i class= "glyphicon glyphicon-user"> </i> Identifiant : </label>
            <div class="col-md-6  col-md-3">
                <input type="text" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" name="login" class="form-control" value = "{{$login or ''}}" placeholder="Votre identifiant" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label"><i class= "glyphicon glyphicon-eye-close"> </i> Mot de passe : </label>
            <div class="col-md-6 col-md-3">
                <input type="password" name="pwd" class="form-control" placeholder="Votre mot de passe" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label"><i class="glyphicon glyphicon-envelope"> </i> Adresse e-mail : </label>
            <div class="col-md-6 col-md-3">
                <input type="email" name="mail" class="form-control" pattern=".{5,65}" value = "{{$mail or ''}}" placeholder="Votre adresse e-mail" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
                <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> Valider</button>
            </div>
        </div>

    </div>
    {!! Form::close() !!}
</div>
@stop



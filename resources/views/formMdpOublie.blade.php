@extends('layouts.master')
@section('content')
<!doctype html>
<div class='box col-md-12'>
    <center><h1>Envoyez-moi mon mot de passe</h1></center>
    <br><br>
    {!! Form::open(['url' => 'mdp']) !!}
    <div class="col-md-offset-2 col-md-12">
        @if ( $erreur != null)
        <p>{{ $erreur }}</p>
        @endif
        <div class="col-md-3 col-md-offset-2">
            <input name="login" class="form-control" type="text" placeholder="Votre identifiant" required>
            <input name="email" class="form-control" type="text" placeholder="Votre adresse email" required>
        </div>    
    </div>
    
    <div class="bouton-connexion col-md-3 col-md-offset-4">
        <br>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Envoyer</button>
    </div>
</div>


{!! Form::close() !!}
@stop




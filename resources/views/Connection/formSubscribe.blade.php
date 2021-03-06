@if (Session::get('id') != 0)
<script>
    window.location.href = "{{url('/accueil')}}";
</script>
@endif
@extends('layouts.master')
@section('content')
<script>
    function pass() {
        $('.verifMdp').mouseup(function () {
            $('.pwd').attr('type', 'password');
        });
        $('.verifMdp').mousedown(function () {
            $('.pwd').removeAttr('type', 'password');
        });
    }
</script>
<body onLoad="pass();">
    <div class="form-subscribe">
        <br>
        <center><h1>Inscription</h1></center>
        <br><br>
        {!! Form::open(['url' => 'subscribe']) !!}
        <div class="form-horizontal">   
            <div class="form-group">
                <label class="col-md-3 control-label"><i class="glyphicon glyphicon-tag"> </i> Nom : </label>   
                <div class="col-md-6 col-md-3">
                    <input type="text" name="nom" class="form-control" value = "{{$nom or ''}}"  placeholder="Votre Nom" required autofocus pattern="[a-zA-Z]*.{2,50}" title="Votre nom ne doit pas contenir de chiffres et doit faire moins de 50 caractères.">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label"><i class="glyphicon glyphicon-tag" > </i> Prénom : </label>
                <div class="col-md-6 col-md-3">
                    <input type="text" name="prenom" class="form-control" value = "{{$prenom or ''}}" placeholder="Votre Prénom" required pattern="[a-zA-Z]*.{2,50}" title="Votre prénom ne doit pas contenir de chiffres et doit faire moins de 50 caractères.">
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

                <label class="item item-input col-md-3 control-label "> <i class="glyphicon glyphicon-earphone"> </i> Téléphone fixe :</label>
                <div class="col-md-6 col-md-3 ">
                    <input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" name="tel" class="form-control" value = "{{$tel or ''}}" placeholder="Votre numéro de téléphone fixe" required>
                </div>
            </div>
            <div class="form-group ">

                <label class="item item-input col-md-3 control-label "> <i class="glyphicon glyphicon-earphone"> </i> Téléphone mobile :</label>
                <div class="col-md-6 col-md-3 ">
                    <input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" name="mobile" class="form-control" value = "{{$mobile or ''}}" placeholder="Votre numéro de téléphone portable" required>
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
                    <input type="password" name="pwd" class="form-control pwd" placeholder="Votre mot de passe" required>
                </div>
                <div class="verifMdp">
                    <span class='glyphicon glyphicon-eye-open'/>
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
            <br>
        </div>
        {!! Form::close() !!}
    </div>
</body>
@stop



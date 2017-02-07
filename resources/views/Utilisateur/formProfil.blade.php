@extends('layouts.master')
@section('content')
<!doctype html>
<script>
    function pass() {
        $('.verifMdp').mouseup(function () {
            $('.mdp').attr('type', 'password');
        });
        $('.verifMdp').mousedown(function () {
            $('.mdp').removeAttr('type', 'password');
        });
    }
</script>
<html lang="fr">
    <body onLoad="pass();"class="body">
        <div class="col-md-12 well well-md">

            <center><h1>Modification du profil</h1>
                <p style="color:red">@if($message != null)<span class="glyphicon glyphicon-warning-sign" ></span> {{$message}}@endif</p></center>
            <br><br>

            {!! Form::open(['url' => 'postmodificationProfil']) !!}
            <div class="form-horizontal">   
                <div class="form-group">
                    <div class="form-group">
                        <label class="col-md-3 control-label"><i class="glyphicon glyphicon-list-alt"> </i> Nom : </label>
                        <div class="col-md-6 col-md-3">
                            <input type='text' name='nom' value='{{$unV->nomVis or ''}}'
                                   class='form-control' required pattern="[a-zA-Z]*.{2,50}" title="Votre nom ne doit pas contenir de chiffres et doit faire moins de 50 caractères.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><i class="glyphicon glyphicon-list-alt"> </i> Prénom : </label>
                        <div class="col-md-6 col-md-3">
                            <input type='text' name='prenom' value='{{$unV->prenomVis or ''}}'
                                   class='form-control' required pattern="[a-zA-Z]*.{2,50}" title="Votre prénom ne doit pas contenir de chiffres et doit faire moins de 50 caractères.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><i class="glyphicon glyphicon-envelope"> </i> Adresse e-mail : </label>
                        <div class="col-md-6 col-md-3">
                            <input type='text' name='mail' pattern=".{5,65}" value='{{$unV->mailVis or ''}}'
                                   class='form-control' required >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><i class="glyphicon glyphicon-home"> </i> Adresse : </label>
                        <div class="col-md-6 col-md-3">
                            <input type='text' name='adressecli' value='{{$unV->adresseVis or ''}}'
                                   class='form-control' required>
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
                    <div class="form-group">
                        <label class="col-md-3 control-label"><i class="glyphicon glyphicon-earphone"> </i> Téléphone fixe : </label>
                        <div class="col-md-6 col-md-3">
                            <input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" name="telcli" class="form-control" value='{{$unV->telFixeVis or ''}}' placeholder="Votre numéro de téléphone portable" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><i class="glyphicon glyphicon-earphone"> </i> Téléphone portable : </label>
                        <div class="col-md-6 col-md-3">
                            <input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" name="mobile" class="form-control" value = "{{$unV->mobileVis or ''}}" placeholder="Votre numéro de téléphone portable" required>
                        </div>
                    </div>
                    @if(Session::get('ncpt') == 5)
                    <div class="form-group">
                        <label class="col-md-3 control-label"><i class="glyphicon glyphicon-list-alt"> </i> Login : </label>
                        <div class="col-md-6 col-md-3">
                            <input type='text' name='login' value='{{$unV->login or ''}}'
                                   class='form-control' required>
                        </div>
                    </div>
                    @endif
                    @php
                    $mdp_decrypt = decrypt($unV->mdpVis);
                    @endphp
                    <div class="form-group">
                        <label class="col-md-3 control-label"><i class= "glyphicon glyphicon-eye-close"> </i> Mot de passe : </label>
                        <div class="col-md-6 col-md-3">
                            <input type='password' name='mdp' value='{{$mdp_decrypt}}'
                                   class='form-control mdp' id="0" required >
                        </div>
                        <div class="verifMdp">
                            <span class='glyphicon glyphicon-eye-open'/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> Valider</button>
                        </div>
                    </div>


                </div>
            </div>
            {!! Form::close() !!}
        </div>
        @stop
    </body>  
</html>

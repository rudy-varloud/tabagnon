@extends('layouts.master')
@section('content')
<!doctype html>
<script>
    function pass(){
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
                <p style="color:red">@if($message != null)<span class="glyphicon glyphicon-warning-sign" ></span>{{$message}}@endif</p></center>
            <br><br>

            {!! Form::open(['url' => 'postmodificationProfil']) !!}
            <div class="form-horizontal">   
                <div class="form-group">
                    <div class="form-group">
                        <label class="col-md-3 control-label"><i class="glyphicon glyphicon-list-alt"> </i> Nom : </label>
                        <div class="col-md-6 col-md-3">
                            <input type='text' name='nom' value='{{$unV->nomVis or ''}}'
                                   class='form-control' required >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><i class="glyphicon glyphicon-list-alt"> </i> Prénom : </label>
                        <div class="col-md-6 col-md-3">
                            <input type='text' name='prenom' value='{{$unV->prenomVis or ''}}'
                                   class='form-control' required >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><i class="glyphicon glyphicon-envelope"> </i> Adresse e-mail : </label>
                        <div class="col-md-6 col-md-3">
                            <input type='text' name='mail' value='{{$unV->mailVis or ''}}'
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
                        <label class="col-md-3 control-label"><i class="glyphicon glyphicon-earphone"> </i> Téléphone : </label>
                        <div class="col-md-6 col-md-3">
                            <input type='tel' name='telcli' value='{{$unV->telVis or ''}}'
                                   class='form-control' required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><i class= "glyphicon glyphicon-eye-close"> </i> Mot de passe : </label>
                        <div class="col-md-6 col-md-3">
                            <input type='password' name='mdp' value='{{$unV->mdpVis or ''}}'
                                   class='form-control mdp' id="0" required>
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
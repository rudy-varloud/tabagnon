@extends('layouts.master')
@section('content')
<!doctype html>
<html lang="fr">
    <body class="body">
        <div class="col-md-12 well well-md">

            <center><h1>Modification du profil</h1></center>
            <br><br>

            {!! Form::open(['url' => 'postmodificationProfil']) !!}
            <div class="form-horizontal">   
                <div class="form-group">

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
                            <input type='tel' name='telcli' value='0{{$unV->telVis or ''}}'
                                   class='form-control' required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><i class= "glyphicon glyphicon-eye-close"> </i> Mot de passe : </label>
                        <div class="col-md-6 col-md-3">
                            <input type='password' name='mdp' value='{{$unV->mdpVis or ''}}'
                                   class='form-control' required>
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
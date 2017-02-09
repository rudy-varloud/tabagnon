@extends('layouts.masterAdmin')
@section('content')
<body>
<div>
    <br><br>
    <br><br>
    <div class="box">
    <div class="container">
        <div class="blanc">
            <center> <h1>Modification du niveau du compte</h1> </center>
        </div>
    </div>
    <div class=''>
        {!! Form::open(['url' => 'postModifUser', 'files' => true]) !!} 
        <div class='form-group'>
            <BR> <BR>
            <div class="col-md-12  col-sm-12 well well-md">
                <div class='form-group'>
                    <input type="hidden" name="idVis" class="" value="{{ $mesVisiteurs->idVis }}">
                    <div class='col-lg-offset-4 col-lg-4'>
                        <center><select name="id_type" class="form-control">
                            <option value="1"> Utilisateur non confirmé</option>
                            <option value="2" > Utilisateur confirmé </option>
                            <option value="3" > Guide </option>
                            <option value="4" > Administrateur </option>
                            </select></center>
                    </div>
                </div>
                <BR> <BR>

                <center> <div class="form-group">
                    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                        <button type="submit" class="btn btn-default btn-primary">
                            <span class="glyphicon glyphicon-ok"></span> Valider
                        </button>
                        &nbsp;
                        <button type="button" class="btn btn-default btn-primary" 
                                onclick="javascript: window.location = '{{url('/listeUser')}}';">
                            <span class="glyphicon glyphicon-remove" ></span> Annuler</button>
                    </div>           
                    </div> </center>
            </div>
        </div>
    </div>
</div>
</body>
@stop

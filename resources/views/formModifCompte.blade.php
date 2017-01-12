@extends('layouts.masterAdmin')
@section('content')
<body>
<div>
    <br><br>
    <br><br>
    <div class="container">
        <div class="blanc">
            <h1>Modification du niveau du compte</h1>
        </div>
    </div>
    <div class=''>
        {!! Form::open(['url' => 'postModifUser', 'files' => true]) !!} 
        <div class='form-group'>
            <BR> <BR>
            <div class="col-md-12  col-sm-12 well well-md">
                <div class='form-group'>
                    <input type="hidden" name="idVis" class="" value="{{ $mesVisiteurs->idVis }}">
                    <div class='col-md-3'>
                        <select name="id_type" class="form-control">
                            <option value="1"> Utilisateur non confirmé</option>
                            <option value="2" > Utilisateur confirmé </option>
                            <option value="3" > Guide </option>
                            <option value="4" > Administrateur </option>
                        </select>
                    </div>
                </div>
                <BR> <BR>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                        <button type="submit" class="btn btn-default btn-primary">
                            <span class="glyphicon glyphicon-ok"></span> Valider
                        </button>
                        &nbsp;
                        <button type="button" class="btn btn-default btn-primary" 
                                onclick="javascript: window.location = '{{url('/')}}';">
                            <span class="glyphicon glyphicon-remove" ></span> Annuler</button>
                    </div>           
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@stop

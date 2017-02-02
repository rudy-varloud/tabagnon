@extends('layouts.master')
@section('content')
{!! Html::script('assets/jquery-rating/jquery.barrating.js') !!}
{!! Html::style('assets/jquery-rating/dist/themes/fontawesome-stars.css') !!}

@php
$cptConf = 0;
$cptVisite = 0;
@endphp
<script type="text/javascript">
    tinyMCE.init({
        mode: "textareas",
        language: "fr_FR",
        language_url: '../assets/tinymce/langs/fr_FR.js',
        forced_root_block: "",
        force_br_newlines: true,
        force_p_newlines: false,
        height: 300,
        plugins: "autoresize"
    });
</script>
<div class='box'>
    <h3>Liste de vos conférences</h3>
    <table class="table table-striped listeFiltree">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Date</th>
                <th>Adresse</th>
                <th>Nombre de place</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $mesConferences as $uneConference )
            @php
            $dateConf = date_create($uneConference->dateConf);
            @endphp
            <tr>
                <td>{{$uneConference -> libConf}}</td>
                <td>{{$dateConf->format('d/m/Y')}}</td>               
                <td>{{$uneConference -> adresseConf}} </td>
                <td>{{$uneConference -> qteBillet}} places</td>
                <td><i class="fa fa-commenting" aria-hidden="true"></i> Avis</td>
            </tr>
            @endforeach
        </tbody>        
    </table>
    <br><br>
    <h3>Liste de vos visites</h3>
    <table class="table table-striped listeFiltree">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Date</th>
                <th>Adresse</th>
                <th>Nombre de place</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $mesVisites as $uneVisite )
            @php
            $dateVis = date_create($uneVisite->dateVisite);
            @endphp
            <tr>
                <td>{{$uneVisite -> libelleVisite}}</td>
                <td>{{$dateVis->format('d/m/Y')}}</td>
                <td>{{$uneVisite -> lieuxVisite}} </td>
                <td>{{$uneVisite -> qteBillet}} places</td>
                <td><a data-toggle="modal" data-target="#avisVisite{{$cptVisite}}">Avis <i class="fa fa-commenting" aria-hidden="true"></i></a></td>
            </tr>
            <!--MODAL CONF-->
        <div id="avisVisite{{$cptVisite}}" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Votre avis</h4>                      
                    </div>
                    {!! Form::open(['url' => '/avisVisite', 'files' => true]) !!}
                    <input  name="idVisite" type="hidden" value="{{$uneVisite->idVisite}}">
                    <input  name="cptVisite" type="hidden" value="{{$cptVisite}}">
                    <input  name="dateVisite" type="hidden" value="{{$uneVisite->dateVisite}}">
                    <br>
                    <div>
                        <p>Votre note globale pour cette visite :</p>
                        <select id="select" name="note">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>     
                    </div>
                    <br>
                    <div>
                        <p>Une remarque :</p>
                        <textarea name='avis' class="form-control" type="text" >{{$remarque or ''}}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> Modifier</button>                      
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        @php($cptVisite += 1)
        @endforeach
        </tbody>
    </table>

</div>
@stop


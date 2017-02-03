@extends('layouts.masterAdmin')
@section('content')
<script type="text/javascript">
    tinyMCE.init({
        mode: "textareas",
        language: "fr_FR",
        language_url: 'assets/tinymce/langs/fr_FR.js',
        forced_root_block: "",
        force_br_newlines: true,
        force_p_newlines: false,
        height: 100,
        plugins: "autoresize"
    });
</script>
<div class="box">
    @php
    $date = date("Y-m-d");
    $cpt = 0;
    @endphp
    <h3> Images en attentes de validation </h3>
    @foreach($mesMosaiques as $maMosaique)
    <a data-toggle="modal" data-target="#modalMosaique{{$cpt}}"><img class='article-image' src="{{ URL::asset('assets/image/mosaique/'.$maMosaique->nomImage) }}" alt=""></a>
    <div id="modalMosaique{{$cpt}}" class="modal fade" >
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center><h4 class="modal-title">Validation de l'image</h4></center>
                </div>
                <div class='modal-body'>
                    <center>
                        <img class='article-image' src="{{ URL::asset('assets/image/mosaique/'.$maMosaique->nomImage) }}" alt="">                   
                        <p>{{$maMosaique->descriptionImage}}</p>               
                    </center>
                </div>

                <div class="modal-footer">
                    <center>
                        <a href = "{{url('/validerImage/'.$maMosaique->idImage)}}"><button class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> Valider</button></a>
                        <a href = "{{url('/refuserImage/'.$maMosaique->idImage)}}"><button class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> Supprimer</button></a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    </center>
                </div>
            </div>

        </div>
    </div>
    @php($cpt+=1)
    @endforeach
    <center>{{ $mesMosaiques->render() }}</center>
</div>
@stop




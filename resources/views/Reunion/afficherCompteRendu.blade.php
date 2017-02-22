@extends('layouts.masterAdmin')
@section('content')

<div class='box'>
    @php
    $date = date_create($mesReunions->dateReunion);
    @endphp
    <center><h3>Compte rendu de la réunion {{$mesReunions->idReunion}} du {{$date->format('d-m-Y')}} à {{$date->format('H:i')}}</h3></center>
    <br>
    <center><p>{{$mesReunions->contenuReunion}}</p></center>
    <hr>
    <center><h3><a class='article-image' href="{{ URL::asset('assets/documents/CompteRendu/'.$mesReunions->dlCompteRendu) }}" alt=""><i class="fa fa-download" aria-hidden="true"></i>Télécharger la version digitale du compte rendu !<i class="fa fa-download" aria-hidden="true"></i></h3></center>
    <br><br>
        <a href='{{url('/monHistorique')}}'><button type='button' class='btn btn-info' value='Retour'>Retour</button></a>
</div>

@stop


@extends('layouts.masterAdmin')
@section('content')

<div class='box'>
    <h2> Liste de tous les articles disponibles </h2>
    @foreach($lesArticles as $unArticle)
    @php
        $date = date_create($unArticle->dateCreation);
        $date_edi = date_create($unArticle->dateEdition);
    @endphp
    <h4> Article numéro: {{$unArticle->idArticle}}</h4>
    <table class="table table-bordered listeFiltree">
        <thead>
            <tr>
                <td>Numéro de l'article</td>
                <td>Titre de l'article</td>
                <td>Date de publication de l'article</td>
                <td>Dernière date d'édition de l'article</td>
                <td>Modifier l'article</td>
                <td>Supprimer l'article</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$unArticle->idArticle}}</td>
                <td>{{$unArticle->titreArticle}}</td>
                <td>{{$date->format('d/m/Y')}}</td>
                <td>{{$date_edi->format('d/m/Y')}}</td>
                <td><center><a href="{{url('modifierArticle')}}/{{ $unArticle->idArticle }}"><span class="glyphicon glyphicon-pencil" title="Modifier le status de ce compte"></span></a></center></td>
                <td><center><a href="#" onclick="javascript:if (confirm('Voulez vous vraiment supprimer ce produit ?'))
                           { window.location ='{{ url('/deleteArticle') }}/{{ $unArticle->idArticle }}'; }"><span class="glyphicon glyphicon-remove" title="Modifier le status de ce compte"></span></a></center></td>
            </tr>
        </tbody>
    </table>
    <br>
    @endforeach
</div>

@stop

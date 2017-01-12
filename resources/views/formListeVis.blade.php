@extends('layouts.masterAdmin')
@section('content')
<div class="container">
    <h4> Rechercher un utilisateur </h4>
    <div class="col-md-3">
    <input type="text" name="filtreNom" class="form-control" placeholder="Nom de l'utilisateur recherché">
    </div>
    <br><br>
    <h2>Liste de tout les utilisateurs existant: ({{$mesVisiteurs2}})</h2>        
    <table class="table table-striped listeFiltree">
        <thead>
            <tr>
                <th>Pseudo</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>Adresse mail</th>
                <th>Adresse</th>
                <th>Niveau du compte</th>
                <th>Modifier le niveau du compte</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $mesVisiteurs as $unVisiteur )
            <tr>
                <td>{{$unVisiteur -> login}}</td>
                <td>{{$unVisiteur -> nomVis}}</td>
                <td>{{$unVisiteur -> prenomVis}}</td>
                <td>{{$unVisiteur -> telVis}}</td>
                <td>{{$unVisiteur -> mailVis}}</td>
                <td>{{$unVisiteur -> adresseVis}}</td>
                @if(($unVisiteur -> ncptVis) == 4)
                <td>Administrateur</td>
                @endif
                @if(($unVisiteur -> ncptVis) == 3)
                <td>Guide</td>
                @endif
                @if(($unVisiteur -> ncptVis) == 2)
                <td>Utilisateur confirmé</td>
                @endif
                @if(($unVisiteur -> ncptVis) == 1)
                <td>Utilisateur non confirmé</td>
                @endif
                <td><center><a href=" {{ url('/modifUser') }}/{{ $unVisiteur -> idVis }} "><span class="glyphicon glyphicon-sort" title="Modifier le status de ce compte"></span></a></center></td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop


@extends('layouts.masterAdmin')
@section('content')
@php($cpt = 0)
@foreach( $mesVisiteurs as $unVisiteur )
@php($cpt += 1)
@endforeach
<div class="container box">
    {!! Form::open(['url' => 'listeUserSpe']) !!}
    <h4> Rechercher un utilisateur </h4>
    <div class="col-md-3">
        <input type="text" name="filtre" class="form-control" placeholder="Nom ou prénom de l'utilisateur" >
        <a href='{{url('listeUserSpe')}}'><button type='submit' class='btn btn-info'> Rechercher </button></a>
    </div>
    {!! Form::close() !!}
    <br><br><br><br>
    <h2>Liste de tous les utilisateurs existants répondant aux critères choisis: ({{$user}})({{$cpt}} résultats)</h2>      
    @if($mesVisiteurs != null)
    <div class="table-responsive">
        <table class="table table-striped listeFiltree">
            <thead>
                <tr>
                    <th>Pseudo</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone fixe</th>
                    <th>Téléphone portable</th>
                    <th>Adresse mail</th>
                    <th>Adresse</th>
                    <th>Niveau du compte</th>
                    <th>Modifier le niveau du compte</th>
                    <th>Supression du compte</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $mesVisiteurs as $unVisiteur )
                <tr>
                    <td>{{$unVisiteur -> login}}</td>
                    <td>{{$unVisiteur -> nomVis}}</td>
                    <td>{{$unVisiteur -> prenomVis}}</td>
                    <td>{{$unVisiteur -> telFixeVis}}</td>
                    <td>{{$unVisiteur -> mobileVis}}</td>
                    <td>{{$unVisiteur -> mailVis}}</td>
                    <td>{{$unVisiteur -> adresseVis}} {{$unVisiteur -> villeVis}} {{$unVisiteur -> codePostVis}}</td>
                    @if(Session::get('id') != $unVisiteur -> idVis)
                    @if(($unVisiteur -> ncptVis) == 5)
                    <td>Guide temporaire</td>
                    @endif
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
            @endif
            @if(Session::get('id') == $unVisiteur -> idVis)
            <td>Administrateur</td>
            <td class="bold red">Votre compte</td>
            @endif 
            <td><a class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"
                   onclick="javascript:if (confirm('Voulez vous vraiment supprimer ce compte ?'))
                       { window.location ='{{ url('/supprimerCompte') }}/{{ $unVisiteur -> idVis }}'; }"></td>

            </tr>

            @endforeach
            </tbody>
        </table>
    </div> 
    @endif
    @if($mesVisiteurs == null)
    <p>Aucun n'utilisateur ne correspond au critère spécifié.</p>
    @endif
</div>
@stop


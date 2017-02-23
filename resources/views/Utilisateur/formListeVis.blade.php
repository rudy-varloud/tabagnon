@extends('layouts.masterAdmin')
@section('content')
{!! Form::open(['url' => 'listeUserSpe']) !!}
<div class="container box">
    <h4> Rechercher un utilisateur </h4>
    <div class='col-md-12 inputRecherche'>
        <div class="col-md-3">
            <input type="text" name="filtre" class="form-control" placeholder="Nom ou prénom de l'utilisateur" >
        </div>
        <a href='{{url('listeUserSpe')}}'><button type='submit' class='btn btn-info'> Rechercher </button></a>
    </div>
    <br><br><br>
    <h2>Liste de tous les utilisateurs existants : ({{$mesVisiteurs2}})</h2>      
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
                    <th>Suppression du compte</th>
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
                    <td>Membre de l'association</td>
                    @endif
                    @if(($unVisiteur -> ncptVis) == 1)
                    <td>Utilisateur non confirmé</td>
                    @endif
                    <td><center><a href=" {{ url('/modifUser') }}/{{ $unVisiteur -> idVis }} "><span class="glyphicon glyphicon-sort" title="Modifier le status de ce compte"></span></a></center></td>
                    <td><a class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"
                       onclick="javascript:if (confirm('Voulez vous vraiment supprimer ce compte ?'))
                           { window.location ='{{ url('/supprimerCompte') }}/{{ $unVisiteur -> idVis }}'; }"></td>
            @endif
            @if(Session::get('id') == $unVisiteur -> idVis)
            <td>Administrateur</td>
            <td class="bold red">Votre compte</td>
            @endif     
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <center> {{ $mesVisiteurs->render() }} </center>
</div>
@stop


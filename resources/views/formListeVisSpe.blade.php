@extends('layouts.masterAdmin')
@section('content')
<div class="container box">
    {!! Form::open(['url' => 'listeUserSpe']) !!}
    <h4> Rechercher un utilisateur </h4>
    <div class="col-md-3">
        <input type="text" name="filtre" class="form-control" placeholder="Nom ou prénom de l'utilisateur" >
        <a href='{{url('listeUserSpe')}}'><button type='submit' class='btn btn-info'> Rechercher </button></a>
    </div>
    {!! Form::close() !!}
    <br><br><br><br>
    <h2>Liste de tous les utilisateurs existants répondant aux critères choisis: ({{$user}})({{$mesVisiteurs2}})</h2>      
    @if($mesVisiteurs != null)
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
    @endif
    @if($mesVisiteurs == null)
    <p>Aucun n'utilisateur ne correspond au critère spécifié.</p>
    @endif
</div>
@stop


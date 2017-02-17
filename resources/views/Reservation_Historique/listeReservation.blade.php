@if (Session::get('id') == 0)
<script>
    window.location.href = "{{url('/accueil')}}";
</script>
@endif
@extends('layouts.master')
@section('content')
@php
$cptConf = 0;
$cptVisite = 0;
@endphp
<div class='box'>
    <h3>Liste de vos conférences</h3>
    @if ($mesConferences == null)
    Vous n'avez pas de conférence réservée, vous pouvez en réserver en <a href='{{ url('getPageConference')}}'>cliquant ici</a>
    @endif
    @if ($mesConferences != null)
    <div class="table-responsive">
        <table class="table table-striped listeFiltree">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Adresse</th>
                    <th>Code Postal</th>
                    <th>Prix</th>
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
                    <td>{{$dateConf->format('H:i')}}</td>
                    <td>{{$uneConference -> adresseConf}} </td>
                    <td>{{$uneConference -> cpConf}}</td>
                    <td>{{$uneConference -> prixConf * $uneConference -> qteBillet}} € pour {{$uneConference -> qteBillet}} places</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <div>
        <br><br>
        <h3>Liste de vos visites</h3>
        @if ($mesVisites == null)
        Vous n'avez pas de visite réservée, vous pouvez en réserver en <a href='{{ url('getPageVisite')}}'>cliquant ici</a>
        @endif
        @if ($mesVisites != null)
        <div class="table-responsive">
            <table class="table table-striped listeFiltree">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Adresse</th>
                        <th>Prix</th>
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
                        <td>{{$dateVis->format('H:i')}}</td>
                        <td>{{$uneVisite -> lieuxVisite}} </td>
                        <td>{{$uneVisite -> prixVisite * $uneVisite -> qteBillet}} € pour {{$uneVisite -> qteBillet}} places</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
    @if ((Session::get('ncpt') == 4) || (Session::get('ncpt') == 3) || (Session::get('ncpt') == 2))
    <div>
        <br><br>
        <h3>Liste des rendez-vous</h3>
        @if ($mesReunions == null)
        Vous n'avez pas de rendez-vous actuellement
        @endif
        @if($mesReunions != null)
            @foreach ($mesReunions as $uneReunion)
            @php
            $date = date_create($uneReunion->dateReunion);
            @endphp
            Vous avez une <span class='deco_reu'>{{$uneReunion->typeReunion}}</span> à l'adresse <span class='deco_reu'>{{$uneReunion->adresseReunion}} {{$uneReunion->cpReunion}}</span> le <span class='deco_reu'>{{$date->format('d-m-Y')}} {{$date->format('H:i')}}</span>.<br><br>
            @endforeach
        @endif
    </div>
    @endif
</div>

@stop


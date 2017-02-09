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
    <div>
        <br><br>
        <h3>Liste de vos visites</h3>
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
    </div>
</div>

@stop


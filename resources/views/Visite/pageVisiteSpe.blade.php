@if (Session::get('ncpt') > 0)
@extends('layouts.master')
@section('content')
@php
$uneVisite = $mesVisites[0];
@endphp
{!! Form::open(['url' => 'reservationPlace']) !!}
<div class="box">
    <input type="hidden" value="{{ $uneVisite->idVisite }}" name="idVisite">
    <h3> Bienvenue sur la balade: {{$uneVisite->libelleVisite}}</h3>
    <p> {{$uneVisite->descriptionVisite}} </p>
    <h5> Le prix par personne de cette visite est de : {{$uneVisite->prixVisite}} €</h5>
    <div class="reserverPlace">
        <div class="col-lg-4 reservation"> 
            <select id="date_selected" name='dateVisite' onclick="checkSelected()" class="form-control">
                <option value="Selectionnez la date souhaitée" disabled selected required>Selectionnez une date</option>
                @foreach($mesVisites as $uneVisite)
                @php
                $date = date_create($uneVisite->dateVisite);
                @endphp
                <option value="{{$uneVisite->dateVisite}}">Le {{$date->format("d/m/Y")}} à {{$date->format("H:i")}}</option>
                @endforeach
            </select>
            <br>       
            <div class="testReser">
                <button type="submit" class="btn btn-info sub" value="Réserver"> Réserver </button>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop
@endif
@if (Session::get('ncpt') == 0)
<script>
    window.location.href = "{{url('/getLogin')}}";
</script>
@endif

@if (Session::get('ncpt') > 0)
@extends('layouts.master')
@section('content')
@if($alerte != "")
<div class="box">
<center><p><i class="fa fa-exclamation-triangle fa-2x red" aria-hidden="true"></i> {{ $alerte }}</p>
    <a href="{{url('/getPageVisite')}}"><button class="btn btn-info sub" >Cliquez ici pour retournez sur la liste des visites</button></a>
</center>
</div>
@endif
@if($alerte == "")
              @if($nbPlaceDispo != 0)
              {!! Form::open(['url' => 'postReservationPlace', 'files' => true]) !!}
              <div class="box">
                  <div class="reserverPlace">
                      <d              iv class="testReser">
            <div class="col-lg-4 reservation"> 
                      <input type="hidden" value="{{ $idVisite }}" name="idVisite">
                  <input type="hidden" value="{{ $dateVisite }}" name="dateVisite">
                  <select name='nbPlaceVoulu' class="form-control">
                      <option value="Selectionnez le nombre de place souhaité" disabled selected required>Selectionnez le nombre de place(s) souhaité(s)</option>
                      @for($i = 1; $i<= $nbPlaceDispo; $i++)
                      <option value="{{$i}}">{{$i}}</option>
                      @endfor
                  </select>
              </div>
              <button type="submit" class="btn btn-info sub" value="Réserver"> Valider </button>
        </div>
    </div>
</div>
{{ Form::close() }}
@endif
@if ($nbPlaceDispo == 0)
<div class='box'>
    <p>Désolé, mais il n'y a plus de place disponible pour cette date.
        <br>
        <a href='{{url('/getVisiteSpe')}}/{{$idVisite}}'>Cliquez ici pour sélectionnez une autre date</a>
        <br>
        <a href='{{url('/accueil')}}'>Cliquez là pour revenir sur la page d'acceuil</a>
</div>
@endif
@endif
@if (Session::get('ncpt') == 0)
<script>
    window.location.href = "{{url('/getLogin')}}";
</script>
@endif
@endif
@stop
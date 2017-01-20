@if (Session::get('ncpt') > 0)
@extends('layouts.master')
@section('content')
{!! Form::open(['url' => 'postReservationPlace', 'files' => true]) !!}
<div class="box">
    <div class="reserverPlace">
        <div class="testReser">
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
@stop
@endif
@if (Session::get('ncpt') == 0)
<script>
    window.location.href = "{{url('/getLogin')}}";
</script>
@endif
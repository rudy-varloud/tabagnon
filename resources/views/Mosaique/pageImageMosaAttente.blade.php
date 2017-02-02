@extends('layouts.master')
@section('content')
<div class="box">
    @php
        $date = date("Y-m-d");
    @endphp
    <h3> Images en attentes de validation </h3>
    @foreach($mesMosaiques as $maMosaique)
    <a href="{{ url('/getImageValid/'.$maMosaique->idImage)}}"><img class='article-image' src="{{ URL::asset('assets/image/mosaique/'.$maMosaique->nomImage) }}" alt=""></a>
    @endforeach
    <center>{{ $mesMosaiques->render() }}</center>
</div>
@stop




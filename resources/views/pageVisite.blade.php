@extends('layouts.master')
@section('content')
@foreach ($mesVisites as $uneVisite)
<p>{{$uneVisite->libelleVisite}}</p>
@endforeach


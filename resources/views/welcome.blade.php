@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
<!--<br><br><br><br>-->
<div class="logo" style="margin-top: 10%">
<center> <H2 style="font-family: 'Open Sans'"> Bienvenue sur le site du Tabagnon <b>{{ Session::get('prenom') }}</b> ! </h2> </center>
</div>
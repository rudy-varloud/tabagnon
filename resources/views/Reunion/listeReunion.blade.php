@extends('layouts.masterAdmin')
@section('content')

<div class='box'>
    <table class="table table-striped listeFiltree">
            <thead>
                <tr>
                    <td> Numéro </td>
                    <td> Type </td>
                    <td> Adresse </td>
                    <td> Date de la réunion </td>
                    <td><centre> Supprimer cette réunion </centre></td>
                </tr>
            </thead>
            <tbody>
                @foreach($mesReunions as $uneReunion)
                @php
                $date = date_create($uneReunion->dateReunion);
                @endphp
                <tr>
                    <td>{{$uneReunion -> idReunion}}</td>
                    <td>{{$uneReunion -> typeReunion}} </td>               
                    <td>{{$uneReunion -> adresseReunion}} {{$uneReunion->cpReunion}}</td>
                    <td>{{$date->format('d-m-Y')}} {{$date->format('H:i')}}</td>
                    <td><center><a class="fa fa-trash fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"
                           onclick="javascript:if (confirm('Voulez vous vraiment supprimer cette réunion ?'))
                               { window.location ='{{ url('/supprimerReunion') }}/{{ $uneReunion -> idReunion }}'; }"></center></td>
                </tr>
                @endforeach
            </tbody>
    </table>
</div>

@stop

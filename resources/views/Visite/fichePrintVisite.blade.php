{!! Html::style('assets/css/bootstrap.css') !!}
{!! Html::style('assets/css/mdb.min.css') !!} 
{!! Html::style('assets/font-awesome/css/font-awesome.min.css') !!}
@php($totalBillet = 0)
<div class='printPage'>
    <center>
        <h3 class="listeResa">Liste des réservations pour la visite : {{$uneVisite->libelleVisite}} </h3><br>
        <button id='impression'  class='btn btn-info' onClick="document.getElementById('impression').style.display = 'none';window.print();document.getElementById('impression').style.display = 'block';"><i class="fa fa-print" aria-hidden="true"></i> Imprimer</button>
    </center>
    <br>
    <div class="table-responsive">
        <center>
            <table class="table table-striped listeFiltree">
                <thead>
                    <tr>
                        <th><center>Nom</center></th>
                        <th><center>Prénom</center></th>
                        <th><center>Téléphone fixe</center></th>
                        <th><center>Téléphone portable</center></th>
                        <th><center>Adresse mail</center></th>
                        <th><center>Nombre de place réservées</center></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $lesReservations as $uneReservation )
                    @php
                    $totalBillet += $uneReservation -> qteBillet
                    @endphp
                    @if($uneReservation->nbPlaceRes != 0)
                    <tr>
                        <td><center>{{$uneReservation -> nomVis}}</center></td>
                <td><center>{{$uneReservation -> prenomVis}}</center></td>
                <td><center>{{$uneReservation -> telFixeVis}}</center></td>
                <td><center>{{$uneReservation -> mobileVis}}</center></td>
                <td><center>{{$uneReservation -> mailVis}}</center></td>
                <td><center>{{$uneReservation -> qteBillet}}</center></td>
                </tr>
                @endif
                <br>
                @endforeach
                </tbody>
            </table>
            <br> 
            <center><h5>Nombre de place(s) réservée(s) au total : {{$totalBillet}} </h5></center>        
        </center>
    </div>
</div>


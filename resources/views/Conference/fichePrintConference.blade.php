{!! Html::style('assets/css/bootstrap.css') !!}
{!! Html::style('assets/css/mdb.min.css') !!} 
{!! Html::style('assets/font-awesome/css/font-awesome.min.css') !!}
<div class='printPage'>
    <center>
        <h3 class="listeResa">Liste des réservations pour la conférence : {{$uneConference->libConf}} </h3><br>
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
                <th><center>Mobile</center></th>
                <th><center>Fixe</center></th>
                <th><center>Adresse mail</center></th>
                <th><center>Nombre de place(s) réservée(s)</center></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($mesConferences as $uneConference)
                    <tr>
                <td><center>{{$uneConference -> nomVis}}</center></td>
                <td><center>{{$uneConference -> prenomVis}}</center></td>
                <td><center>{{$uneConference -> telFixeVis}}</center></td>
                <td><center>{{$uneConference -> mobileVis}}</center></td>
                <td><center>{{$uneConference -> mailVis}}</center></td>
                <td><center>{{$uneConference -> qteBillet}}</center></td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <center><h5>Nombre de place(s) actuellement réservée(s): {{$uneConference->placeReserConf}}</h5></center>
            <br>              
        </center>
    </div>
</div>


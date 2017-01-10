<!--View utilisée pour l'envoi du mail récapitulatif de la commande.-->
<p>Bonjour, suite à votre commande effectuée le {{ $date }} , voici un mail de confirmation de celle-ci.</p>
<p>Numero de commande : {{$numCommande}}</p>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nom du modèle</th>
            <th>Marque</th>
            <th>Type de modèle</th>
            <th>Pointure</th>
            <th>Pour qui ?</th>
            <th>Pour quand ?</th>
            <th>Prix unitaire</th>
            <th>Quantité</th>
            <th>Prix</th>


        </tr>


    </thead>




    @foreach($lesChaussures as $uneChaussure)
    <tr>   
        <td>{{ $uneChaussure->LIBELLECH }}</td> 

        <td>{{ $uneChaussure->NOMMARQUE }}</td>


        <td>  
            {{ $uneChaussure->LIBELLETYPE }}

        </td>
        <td>
            {{$uneChaussure->IDTAILLE}}

        </td>

        <td>  
            {{$uneChaussure->LIBELLECAT}}

        </td>
        <td> {{$uneChaussure->LIBELLESAISON }} </td>


        <td> {{ $uneChaussure->PRIXCH }}€</td>

        <td>{{$uneChaussure->QTECOMMANDE }}</td>
        <td> {{ $uneChaussure->PRIXCH * $uneChaussure->QTECOMMANDE}}€</td>



        @endforeach


    </tr>




    <BR> <BR>
</table>

<p>Pour un total de {{ $total }} euros</p>

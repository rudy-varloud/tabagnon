<!--View utilisée pour l'envoi du mail récapitulatif de la commande.-->
@php
$dateConf = date_create($uneConference->dateConf);
@endphp
<div class="brand">
    <a href="{{url('/accueil')}}"><img src="<?php echo $message->embed(URL::asset('assets/image/logoTabagnon.png')); ?>" alt="Logo Tabagnon" height="30" width="25"></a>
    Le Tabagnon | <small>Saint-Genis-les-Ollières</small>
</div>
<br>
<p>Bonjour, votre réservation a bien été prise en compte ! Voici un récapitulatif des informations : </p>

<body>
    <ul>
        <li>Nom de la conférence : {{$uneConference -> libConf}}</li>
        <li>Date et heure de la conférence : Le {{$dateConf->format('d/m/Y')}} à {{$dateConf->format('H:i')}}</li>
        <li>Lieu de la conférence : {{$uneConference -> adresseConf}} {{$uneConference -> cpConf}}</li>
        <li>Prix total de la réservation : {{$uneConference -> prixConf * $qteBillet}} € pour {{$qteBillet}} places</li>          
    </ul>
    <p>Pour le paiement, merci d'adresser un chèque à l'ordre de la trésorerie de l'association le Tabagnon</p>         
</body>

<footer>
    <hr />
    <address> Les membres de l'association Le Tabagnon  </address>
</footer>

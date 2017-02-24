@extends('layouts.master')
@section('content')

<div class="container">

    <div class="row">
        <div class="box">
            @if($message != null)
            <div class="alert alert-info alert-dismissable fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p>{{$message}}</p>
            </div>
            @endif
            <div class="col-lg-12 text-center">
                <div id="carousel-example-generic" class="carousel slide">
                    <!-- Indicators -->
                    <ol class="carousel-indicators hidden-xs">
                        @php($cpt = 0)
                        @foreach($lesImages as $uneImage)
                        @if($cpt == 0)
                        <li data-target="#carousel-example-generic" data-slide-to="{{$cpt}}" class="active"></li>
                        @endif
                        @if($cpt>0)
                        <li data-target="#carousel-example-generic" data-slide-to="{{$cpt}}"></li>
                        @endif
                        @php($cpt+=1)
                        @endforeach
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        @php($cpt = 0)
                        @foreach($lesImages as $uneImage)
                        @if($cpt == 0)
                        <div class="item active">
                            <img class="img-responsive img-full img-carousel" src="{{ URL::asset('assets/image/carousel/'.$uneImage->image) }}" alt="">
                        </div>
                        @endif
                        @if($cpt>0)
                        <div class="item">
                            <img class="img-responsive img-full img-carousel" src="{{ URL::asset('assets/image/carousel/'.$uneImage->image) }}" alt="">
                        </div>
                        @endif
                        @php($cpt+=1)
                        @endforeach
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="icon-prev"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="icon-next"></span>
                    </a>
                </div>
                <h2 class="brand-before">
                    <small>Bienvenue sur le site de l'association</small>
                </h2>
                <div class="presentation">
                <h1 class="brand-name titre_accueil">Le Tabagnon</h1>
                <hr class="tagline-divider"><br>
                <p>Le 28 Février 1990, un groupe de passionnés décidait de la création de notre association.

                    Le premier bureau était composé de Philippe GUILLIEN, Président, Jean PARRIER vice- président,

                    Monique HEINIS, secrétaire, Marlène COUTAREL, trésorière et Clément VOORHOEVE, trésorier

                    adjoint.</p>
                <p>

                    On trouvait aussi parmi les membres, Mesdames Marie Françoise ROGER DALBERT, Yvette MIENCE et

                    Andrée CROST. </p>

                <p>Par la suite le groupe s’étoffera et d’anciens st genois, Messieurs SECOND, CHANINEL, MASSON,

                    CALENDRAS et d’autres encore viendront travailler au sein du Tabagnon.</p>

                <p>Le nom du Tabagnon vient de la guinguette qui était située dans le vallon du Ratier, au-delà du

                    restaurant actuel de la Cascade. C’était le Grand Tabagnon dont l’activité prendra fin au début du

                    dernier conflit mondial.</p>

                <p>Nos prédécesseurs ont effectué un formidable travail, nous les en remercions ici. Ils ont fait paraître

                    deux livres que nous tenons à disposition de celles et ceux qui voudraient connaître l’histoire du

                    village.</p>

                <p>Le bureau actuel est composé de :</p>
                <ul>
                    <li> Président : M. RIBERON Gilbert </li>

                    <li> Trésorier : M. BERNARD Jean Claude </li>

                    <li>Secrétaire : Mme REBOULLET Brigitte</li></ul>

                <p>Vous trouverez nos numéros de téléphone sur tout bon annuaire…

                Si l’histoire du village vous intéresse, n’hésitez pas à prendre contact avec nous.

                Nous vous attendons.</p></div>
            </div><br>
            <div class='dlManuel'>
                @if ((Session::get('ncpt') == 2) || (Session::get('ncpt') == 4))
                <center> <a href="{{url::asset('assets/documents/MANUELUTILISATEUR.pdf')}}" alt="">Télécharger le manuel utilisateur</a> </center>
                @endif
                @if (Session::get('ncpt') == 4)
                <center><a href="{{url::asset('assets/documents/ManuelAdministrateur.pdf')}}" alt="">Télécharger le manuel administrateur</a></center>
                @endif
            </div>
        </div>        
    </div>
    <br>
    <div class="box col-md-12">
        <div class="col-md-6">
            <hr>
            <h3 class="intro-text text-center">Nos dernières visites !
            </h3>
            <hr>   
            <div class="col-md-offset-4 col-md-12">
                <ul class="presVisite">
                    @if ($lesVisites == null)
                    <h3>Aucune visite n'est disponible actuellement</h3>
                    @endif
                    @if ($lesVisites != null)
                    @foreach($lesVisites as $uneVisite)
                    <li><a href="{{url('/getVisiteSpe/'.$uneVisite->idVisite)}}" data-toggle="collapse" data-target=".navbar-collapse.in" style="font-size:1.3em;">{{$uneVisite->libelleVisite}}</a></li>
                    @endforeach
                    @endif
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <hr>
            <h3 class="intro-text text-center">Nos dernières conférences  !
            </h3>
            <hr>
            <div class="col-md-offset-4 col-md-12">
                <ul>
                    @if ($lesConferences == null)
                    <h3>Aucune conférence n'est actuellement disponible</h3>
                    @endif
                    @if ($lesConferences != null)
                    @foreach($lesConferences as $uneConference)
                    <li><a href="{{url('/getConfSpe/'.$uneConference->idConf)}}" data-toggle="collapse" data-target=".navbar-collapse.in" style="font-size:1.3em;">{{$uneConference->libConf}}</a></li>
                    @endforeach
                    @endif
                </ul>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <br>
            <hr>
            <h2 class="intro-text text-center">Nos derniers articles !
            </h2>
            <hr>
            <br>
            @foreach($lesArticles as $unArticle)
            <a href="{{url('/article/'.$unArticle->idArticle)}}">
                <div class="col-lg-3 col-sm-6 col-md-3">   
                    <center>
                        <img class="img-news" src="{{ URL::asset('assets/image/article/'.$unArticle->imageArticle) }}" alt="{{$unArticle->titreArticle}}">
                        <div class="col-md-12">        
                            <div class="news-title">
                                <h4>{{$unArticle->titreArticle}}</h4>
                            </div>
                        </div>
                        <br><br>
                    </center>
                </div>
            </a>
            @endforeach
        </div>
        <br><br><br>
    </div>



</div>
<!-- /.container -->

<!-- Script to Activate the Carousel -->
<script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
</script>
@stop



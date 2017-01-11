@extends('layouts.master')
@section('content')


<div class="container">

    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <div id="carousel-example-generic" class="carousel slide">
                    <!-- Indicators -->
                    <ol class="carousel-indicators hidden-xs">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img class="img-responsive img-full" src="{{ URL::asset('assets/image/slide-1.jpg') }}" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive img-full" src="{{ URL::asset('assets/image/slide-2.jpg') }}" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive img-full" src="{{ URL::asset('assets/image/slide-3.jpg') }}" alt="">
                        </div>
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
                <h1 class="brand-name">Tabagnon</h1>
                <hr class="tagline-divider">
            </div>
        </div>
    </div>


    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center">Nos derniers articles !
                </h2>
                <hr>
                <br>
                @foreach($lesArticles as $unArticle)
                <a href="{{url('/article/'.$unArticle->idArticle)}}">
                    <div class="col-md-4">    
                        <img class="img-news" src="{{ URL::asset('assets/image/'.$unArticle->imageArticle) }}" alt="{{$unArticle->titreArticle}}">
                        <div class="col-md-12">        
                            <div class="news-title">
                                <h4>{{$unArticle->titreArticle}}</h4>
                            </div>
                        </div>
                        <br>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
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



@extends('layouts.master')
@section('content')


<div class="container">

    <div class="row">
        <div class="box">
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
                        <img class="img-news" src="{{ URL::asset('assets/image/article/'.$unArticle->imageArticle) }}" alt="{{$unArticle->titreArticle}}">
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



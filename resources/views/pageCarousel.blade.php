@extends('layouts.masterAdmin')
@section('content')

<div class="box">
    <h1 class="carousel-title">Les images du carousel non affichées</h1>
    @foreach($lesImagesFalse as $uneImage)
    <div class='col-md-2'>
        <img class="img-news" src="{{ URL::asset('assets/image/'.$uneImage->image) }}" alt="">
    </div>
    @endforeach
</div>

<div class="box">

    <h1 class="carousel-title">Les images qui seront affichées sur la page d'acceuil</h1>
    @foreach($lesImagesTrue as $uneImage)
    <div class='col-md-4'>
        <img class="img-news" src="{{ URL::asset('assets/image/'.$uneImage->image) }}" alt="">
        <div class="col-md-12">                    
            <div class="flecheCarouselUp">
                <a><span class="glyphicon glyphicon-arrow-up"></span></a>
            </div>
        </div>

    </div>
    @endforeach
</div>

@stop
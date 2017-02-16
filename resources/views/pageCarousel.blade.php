@extends('layouts.masterAdmin')
@section('content')

<div class="box col-md-12" style="padding-bottom: 10%;" >


    <div class="form-group col-md-12">
        {!! Form::open(['url' => 'ajoutImageCarousel', 'files' => true]) !!}
        <h1 class="carousel-title">Ajouter une image à la liste des images</h1>
        <br> 
        {{$message or ""}}
        <div class='col-md-4 col-md-offset-4'>
            <input type='hidden' name="imageCarousel" value=""/>
            <input type='hidden' name="MAX_FILE_SIZE" value="15000000"/>
            <input type='file' name="imageCarousel" class="btn btn-default" accept="image/*"/> 
        </div>

        <div class='col-md-offset-5 col-md-4'><button type="submit" class="btn btn-default btn-primary">
                <span class="glyphicon glyphicon-ok"></span> Ajouter
            </button>
        </div>
        {!! Form::close() !!} 
    </div>   

    <div class="col-md-12">
        <h1 class="carousel-title">Les images du carrousel non affichées sur la page d'accueil</h1>
        <br>
        @foreach($lesImagesFalse as $uneImage)
        <div class='col-md-4 carousel-admin'>       
            <img class="img-news" src="{{ URL::asset('assets/image/carousel/'.$uneImage->image) }}" alt="">
            <a href='{{url('/ajouterCarousel/'.$uneImage->image)}}'><span class="glyphicon glyphicon-circle-arrow-down"></span> Ajouter l'image dans le carrousel</a>
            <br>
            <a aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"
               onclick="javascript:if (confirm('Voulez vous vraiment supprimer cette image de la base de données ?'))
                   { window.location ='{{ url('/supprimerCarousel') }}/{{ $uneImage->image }}'; }"><span class="glyphicon glyphicon-remove"></span>Supprimer l'image du carrousel</a>
        </div>
        @endforeach
    </div>
    <div class="col-md-12">
        <h1 class="carousel-title">Les images qui seront affichées sur la page d'accueil</h1>
        <br>
        @foreach($lesImagesTrue as $uneImage)   
        <div class='col-md-4 carousel-admin'>       
            <img class="img-news" src="{{ URL::asset('assets/image/carousel/'.$uneImage->image) }}" alt="">
            <a href='{{url('/retirerCarousel/'.$uneImage->image)}}'><span class="glyphicon glyphicon-circle-arrow-up"></span> Retirer l'image du carrousel</a>
            <br>
            <a aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"
               onclick="javascript:if (confirm('Voulez vous vraiment supprimer cette image de la base de données ?'))
                   { window.location ='{{ url('/supprimerCarousel') }}/{{ $uneImage->image }}'; }"><span class="glyphicon glyphicon-remove"></span>Supprimer l'image du carrousel</a>      
        </div>
        @endforeach
        <br>
    </div>
</div>

@stop

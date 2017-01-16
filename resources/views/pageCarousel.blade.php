@extends('layouts.masterAdmin')
@section('content')

<div class="box">
    {!! Form::open(['url' => 'ajoutImageCarousel', 'files' => true]) !!} 
    
    <div class="form-group">
        <h1 class="carousel-title">Ajouter une image à la liste des images</h1>
        <br> 
        {{$message or ""}}
        <div class='col-md-4 col-md-offset-4'>
            <input type='hidden' name="imageCarousel" value=""/>
            <input type='hidden' name="MAX_FILE_SIZE" value="2048000"/>
            <input type='file' name="imageCarousel" class="btn btn-default pull-left" accept="image/*"/> 
        </div>
        
        <div class='col-md-offset-5 col-md-4'><button type="submit" class="btn btn-default btn-primary">
                <span class="glyphicon glyphicon-ok"></span> Ajouter
            </button></div>
    </div>
    {!! Form::close() !!}
</div>

<div class="box">
    <h1 class="carousel-title">Les images du carousel non affichées</h1>
    <br>
    @foreach($lesImagesFalse as $uneImage)
    <div class='col-md-4 carousel-admin'>       
        <img class="img-news" src="{{ URL::asset('assets/image/carousel/'.$uneImage->image) }}" alt=""></a>
        <a href='{{url('/ajouterCarousel/'.$uneImage->image)}}'><span class="glyphicon glyphicon-circle-arrow-down"></span> Ajouter l'image dans le carousel</a>
        <br>
        <a href='{{url('/supprimerCarousel/'.$uneImage->image)}}'><span class="glyphicon glyphicon-remove"></span> Supprimer l'image du carousel</a>
    </div>
    @endforeach
</div>

<div class="box">

    <h1 class="carousel-title">Les images qui seront affichées sur la page d'acceuil</h1>
    <br>
    @foreach($lesImagesTrue as $uneImage)   
    <div class='col-md-4 carousel-admin'>       
        <img class="img-news" src="{{ URL::asset('assets/image/carousel/'.$uneImage->image) }}" alt=""></a>
        <a href='{{url('/retirerCarousel/'.$uneImage->image)}}'><span class="glyphicon glyphicon-circle-arrow-up"></span> Retirer l'image du carousel</a>
        <br>
        <a href='{{url('/supprimerCarousel/'.$uneImage->image)}}'><span class="glyphicon glyphicon-remove"></span> Supprimer l'image du carousel</a>       
    </div>
    
    @endforeach
</div>


@stop
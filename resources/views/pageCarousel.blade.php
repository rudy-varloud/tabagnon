@extends('layouts.masterAdmin')
@section('content')

<!-- Modal -->
<div id="yourModalID" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Options</h4>
            </div>
            <div class="modal-body">

                <a href='' class='lien-popup'><span class="glyphicon glyphicon-export"></span> Enlever l'image du carousel</a>
                <br><br>
                <a href='' class='lien-popup'><span class="glyphicon glyphicon-remove"></span> Supprimer l'image</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>

    </div>
</div>

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
        <a class="myModal1" data-toggle="modal" data-target="#yourModalID" data-yourparameter="{{$uneImage->image}}">
            <img class="img-news" src="{{ URL::asset('assets/image/'.$uneImage->image) }}" alt=""></a>
    </div>
    @endforeach
</div>


<script>
$('#yourModalID').on('show.bs.modal', function(e) {
  var yourparameter = e.relatedTarget.dataset.yourparameter;  
});
</script>

@stop
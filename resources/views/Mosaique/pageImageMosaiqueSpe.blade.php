@extends('layouts.master')
@section('content')
<script type="text/javascript">
    tinyMCE.init({
    mode: "textareas",
            language: "fr_FR",
            language_url: '../assets/tinymce/langs/fr_FR.js',
            forced_root_block: "",
            force_br_newlines: true,
            force_p_newlines: false,
            height: 150,
            plugins: "autoresize"
    });</script>
<center><div class="box">
        @if($message != null)
        <div class="alert alert-info alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p>{{$message}}</p>
        </div>
        @endif
        @if ($mesMosaiques != null)
        @php
        $date = date_create($mesMosaiques->dateCrea);
        $date_jour = date("Y-m-d H:i");
        @endphp
        <img class='article-image' src="{{ URL::asset('assets/image/mosaique/'.$mesMosaiques->nomImage) }}" alt="">  <br><br>
        @if($statut == true)
        <a href="{{url('/likeImage/'.Session::get('id')."/".$idImage)}}"><i class="fa fa-thumbs-o-down fa-2x red" aria-hidden="true"></i></a>
        @endif
        @if($statut == false)
        <a href="{{url('/likeImage/'.Session::get('id')."/".$idImage)}}"><i class="fa fa-thumbs-o-up fa-2x green" aria-hidden="true"></i></a>
        @endif
        <h3> {{ $mesMosaiques->descriptionImage}} </h3>
        @if ($compteur != null)
        <p>Déjà {{$compteur}} personnes ont aimé cette photo !</p>
        @endif
        <h6> Publié le: {{ $date->format('d-m-Y') }} par {{$mesMosaiques->prenomVis}} {{ $mesMosaiques->nomVis }} </h6>
        @if ((Session::get('ncpt') == 4) || (Session::get('id') == $mesMosaiques->idVisiteur))
        <a href='#' onclick="javascript:if (confirm('Voulez vous vraiment supprimer cette image ?'))
            { window.location ='{{url ('/deleteImage/' . $mesMosaiques->idImage)}}'; }"><i class="fa fa-trash" aria-hidden="true" /> Supprimer cette image </i></a>
        @endif

    </div> </center>
<br>
{!! Form::open(['url' => 'postAjoutCommentaire']) !!}
<center
    <div class='box commentaire'>
        <input type='hidden' name='idImg' value='{{$mesMosaiques->idImage}}'>
        <input type='hidden' name="date" value='{{$date_jour}}'>
        <input type='hidden' name="idVis" value='{{Session::get('id')}}'>
        @if (Session::get('ncpt') >= 2)
        <h2>Poster un commentaire</h2>
        <textarea name='commentaire' class="form-control" type="text" ></textarea>
        <br>
        <center> <button type='submit' class='btn btn-info' value='Envoyer'> Envoyer </button>
            <br><BR>
            @endif
            {{ Form::close() }}
            <h3 class='titre'> Commentaires </h3>
            @foreach ($mesMosaiques2 as $uneMosaique)
            @php
            $date_com = date_create($uneMosaique->dateCommentaire);
            @endphp
            <p> {{$uneMosaique->commentaire}} </p>
            <h6 class='nomCom'>De {{$uneMosaique->login}} le {{$date_com->format('d-m-Y H:i')}}</h6>
            @if ((Session::get('ncpt') == 4)||(Session::get('id') == $uneMosaique->idVisi))
            <a href="{{url('/deleteCom/'.$uneMosaique->idCommentaire.'/'.$uneMosaique->idImg)}}"><i class="fa fa-eraser" aria-hidden="true" title="Supprimer ce commentaire"></i></a>
            @endif
            @endforeach
            <center>{{ $mesMosaiques2->render() }}</center>
            @endif
    </div>
</center>
@stop

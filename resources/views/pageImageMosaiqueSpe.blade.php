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
    });

</script>
<center><div class="box">
        @if ($mesMosaiques != null)
        @php
        $date = date_create($mesMosaiques->dateCrea);
        $date_jour = date("Y-m-d H:i");
        @endphp
        <img class='article-image' src="{{ URL::asset('assets/image/mosaique/'.$mesMosaiques->nomImage) }}" alt="">
        <h3> {{ $mesMosaiques->descriptionImage}} </h3>
        <h6> Publié le: {{ $date->format('d-m-Y') }} par {{$mesMosaiques->prenomVis}} {{ $mesMosaiques->nomVis }} </h6>
        @if (Session::get('ncpt') == 4)
        <a href='{{url ('/deleteImage/'. $mesMosaiques->idImage)}}'><i class="fa fa-trash" aria-hidden="true"> Supprimer cette image </i></a>
        @endif

    </div> </center>
<br>
{!! Form::open(['url' => 'postAjoutCommentaire']) !!}
<center
<div class='box commentaire'>
    <input type='hidden' name='idImg' value='{{$mesMosaiques->idImage}}'>
    <input type='hidden' name="date" value='{{$date_jour}}'>
    <input type='hidden' name="idVis" value='{{Session::get('id')}}'>
    <h2>Poster un commentaire:</h2>
    <textarea name='commentaire' class="form-control" type="text" ></textarea>
    <br>
    <center> <button type='submit' class='btn btn-info' value='Envoyer'> Envoyer </button>
        <br><BR>
        {{ Form::close() }}
        <h3 class='titre'> Commentaires: </h3>
        @foreach ($mesMosaiques2 as $uneMosaique)
        @php
        $date_com = date_create($uneMosaique->dateCommentaire);
        @endphp
        <p> {{$uneMosaique->commentaire}} </p>
        <h6 class='nomCom'>De {{$uneMosaique->login}} le {{$date_com->format('d-m-Y H:i')}}</h6>
        @endforeach
        <center>{{ $mesMosaiques2->render() }}</center>
        @endif
</div>
</center>
@stop

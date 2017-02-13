<!DOCTYPE html>
<html lang="en">

    <head>
        <link rel="icon" type="image/png" href="{{URL::asset('assets/image/logoTabagnon.png')}}" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Tabagnon</title>

        <!-- Bootstrap Core CSS -->
        {!! Html::style('assets/css/bootstrap.css') !!}
        {!! Html::style('assets/css/mdb.min.css') !!}
        <!-- javascript-->
        {!! Html::script('assets/js/bootstrap.min.js') !!}
        {!! Html::script('assets/js/jquery.js') !!}
        {!! Html::script('assets/js/bootstrap.min.js') !!}
        {!! Html::script('assets/js/tabagnon.js') !!}
        {!! Html::script('assets/js/tinymce/tinymce.min.js') !!}
        <script type="text/javascript">
            tinyMCE.init({
                mode: "textareas",
                language: "fr_FR",
                language_url: 'assets/js/tinymce/langs/fr_FR.js',
                forced_root_block: "",
                force_br_newlines: true,
                force_p_newlines: false,
                height: 300
            });
        </script>

        <!-- Custom CSS -->
        {!! Html::style('assets/css/tabagnon.css') !!}

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">


    </head>

    <body>
        <br>
        <div class="col-md-12">
            <center>
                <a href="{{url('/accueil')}}"><img class="img-presentation" src="{{ URL::asset('assets/image/livre-tabagnon1.png') }}" alt=""></a>
            </center>
        </div>
    </body>

</html>




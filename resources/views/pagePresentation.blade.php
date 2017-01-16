<!DOCTYPE html>
<html lang="en">

    <head>

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

        <div>
            <img class="img-presentation" src="{{ URL::asset('assets/image/livre-tabagnon1.png') }}" alt=""></a>
        </div>
        <div class="brand">
            <a style="text-decoration:none;display: inherit;margin: 0;padding: 30px 0 10px;text-align: center;text-shadow: 1px 1px 2px rgba(0,0,0,0.5);font-size: 1em;font-weight: 700;line-height: normal;color: #fff;margin-top: 25%;" href="{{url('/accueil')}}"><img src="{{URL::asset('assets/image/logoTabagnon.png')}}" alt="Logo Tabagnon" height="123" width="100">Tabagnon<br><small>Cliquez pour ici entrer</small></a>
        </div>
    </body>



</html>


<body>

</body>



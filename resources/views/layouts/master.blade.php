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

            function pass() {
                $('.verifMdp').mouseup(function () {
                    $('.pwd').attr('type', 'password');
                });
                $('.verifMdp').mousedown(function () {
                    $('.pwd').removeAttr('type', 'password');
                });
            }
        </script>

        <!-- Custom CSS -->
        {!! Html::style('assets/css/tabagnon.css') !!}

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">


    </head>

    <body onLoad="pass();">
        <div class="brand">
            <a href="{{url('/accueil')}}"><img src="{{URL::asset('assets/image/logoTabagnon.png')}}" alt="Logo Tabagnon" height="123" width="100"></a>
            Tabagnon | <small>Saint-Genis-les-Ollières</small></div>
        <!-- Navigation -->
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                    <a class="navbar-brand" href="{{url('/accueil')}}">
                        <img src="{{URL::asset('assets/image/logoTabagnon.png')}}" alt="Logo Tabagnon" height="30" width="24">
                        Association Tabagnon</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="{{url('/getArticles')}}" data-toggle="collapse" data-target=".navbar-collapse.in" class="">Les Articles</a></li>
                        <li><a href="{{url('/getPageConference')}}" data-toggle="collapse" data-target=".navbar-collapse.in" class="">Conférence</a></li>
                    </ul>
                    @if(Session::get('id') == 0)
                    <ul class="nav navbar-nav">
                        <li><a href="{{url('/getSubscribe')}}">Inscription</a></li>
                        <li><a data-target="#loginModal" data-toggle="modal" data-target=".navbar-collapse.in" class="connec">Se connecter</a></li>
                    </ul>
                    @else
                    <ul class="nav navbar-nav">
                        @if(Session::get('ncpt') == 4)
                        <li><a href='{{ url('/getPageAdmin')}}' data-toggle='collapse' data-target='.navbar-collapse.in' class=''>Pannel Administration</a></li>
                        @endif
                        <li><a href="{{url('/getProfil')}}" data-toggle="collapse" data-target=".navbar-collapse.in" class="">Compte</a></li>
                        <li><a href="{{url('/getPageVisite')}}" data-toggle="collapse" data-target=".navbar-collapse.in" class="">Visite Disponible</a></li>
                        <li><a href="{{url('/getLogout')}}" data-toggle="collapse" data-target=".navbar-collapse.in" class="">Se deconnecter</a></li>
                    </ul>
                    @endif
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <div class="container">
            @yield('content')
        </div>
    </body>
    <br>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; Tabagnon 2017</p>
                </div>
            </div>
        </div>
    </footer>






    <!-- Modal -->
    <div id="loginModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center> <h3 class="modal-title">Authentification</h3> </center>
                </div>
                {!! Form::open(['url' => 'login']) !!}
                <div class="modal-body">                   

                    <h5 class="control-label">Identifiant : </h5>
                    <input type="text" name="login" class="form-control" placeholder="Votre identifiant" required autofocus>
                    <h5 class="control-label">Mot de passe : </h5>
                    <input type="password" name="pwd" class="form-control pwd" placeholder="Votre mot de passe" required>
                    <div class="verifMdp">
                        <span class='glyphicon glyphicon-eye-open'/>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> Valider</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                </div>
                {{ Form::close() }}
            </div>

        </div>
    </div>
</html>

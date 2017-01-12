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

        <!-- Custom CSS -->
        {!! Html::style('assets/css/tabagnon.css') !!}

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">


    </head>

    <body>
        <div class="brand">
            <a href="{{url('/')}}"><img src="{{URL::asset('assets/image/logoTabagnon.png')}}" alt="Logo Tabagnon" height="123" width="100"></a>
            Tabagnon | <small>Saint genis les ollières</small></div>
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
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img src="{{URL::asset('assets/image/logoTabagnon.png')}}" alt="Logo Tabagnon" height="30" width="24">
                        Association Tabagnon</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    @if(Session::get('id') == 0)
                    <ul class="nav navbar-nav">
                        <li><a href="{{url('/getSubscribe')}}">Inscription</a></li>
                        <li><a href="{{url('/getLogin')}}" data-toggle="collapse" data-target=".navbar-collapse.in" class="">Se connecter</a></li>
                    </ul>
                    @else
                    <ul class="nav navbar-nav">
                        @if(Session::get('ncpt') == 4)
                        <li><a href='{{ url('/getPageAdmin')}}' data-toggle='collapse' data-target='.navbar-collapse.in' class=''>Pannel Administration</a></li>
                        @endif
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

    <!-- javascript-->
    {!! Html::script('assets/js/bootstrap.min.js') !!}
    {!! Html::script('assets/js/jquery.js') !!}
    {!! Html::script('assets/js/bootstrap.min.js') !!}
    {!! Html::script('assets/js/tabagnon.js') !!}

</html>

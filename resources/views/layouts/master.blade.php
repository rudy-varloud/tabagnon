<!doctype html>
<html lang="fr">
    <head>
        <title>Le Tabagnon</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width-device-width, intial-scale=1.0">
        {!! Html::style('assets/css/bootstrap.css') !!}
        {!! Html::style('assets/css/mdb.min.css') !!}
        {!! Html::style('assets/css/tabagnon.css') !!}
        <link href="https://fonts.googleapis.com/css?family=Frank+Ruhl+Libre" rel="stylesheet">
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="mdb.min.js"></script>
    </head>
    <body>
        <div class='container'>
            <nav class='navbar navbar-fixed-top navbar-default' role='navigation'>
                <div class='container-field'>
                    <div class='container-header'>
                        <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#navbar-collapse-target'>
                            <span class='sr-only'>Toggle navigation</span>
                            <span class='icon-bar'></span>
                            <span class='icon-bar'></span>
                            <span class='icon-bar+ bvn'></span>
                        </button>
                        <a class='navbar-brand' href='{{ url('/') }}'>Tabagnon</a>
                    </div>
                    @if(Session::get('id') == 0)
                    <ul class="nav navbar-nav navbar-right connect">
                        <li><a href="{{url('/getSubscribe')}}">Inscription</a></li>
                        <li><a href="{{url('/getLogin')}}" data-toggle="collapse" data-target=".navbar-collapse.in" class="">Se connecter</a></li>
                    </ul>
                    @else
                    <ul class="nav navbar-nav navbar-right connect">
                        @if(Session::get('ncpt') == 4)
                        <li><a href='{{ url('/getPageAdmin')}}' data-toggle='collapse' data-target='.navbar-collapse.in' class=''>Pannel Administration</a></li>
                        @endif
                        <li><a href="{{url('/getLogout')}}" data-toggle="collapse" data-target=".navbar-collapse.in" class="">Se deconnecter</a></li>
                    </ul>
                    @endif
                    
                    
                    
        </div>
    </nav>
</div>

<div class="container">
    @yield('content')
</div>
{!! Html::script('assets/js/bootstrap.min.js') !!}
{!! Html::script('assets/js/jquery-2-1-3.min.js') !!}
{!! Html::script('assets/js/ui-bootstrap-tpls.min.js') !!}
{!! Html::script('assets/js/bootstrap.min.js') !!}
</body>
</html>

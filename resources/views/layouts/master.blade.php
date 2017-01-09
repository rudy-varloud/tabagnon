<!doctype html>
<html lang="fr">
    <head>
        <title>Le Tabagnon</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width-device-width, intial-scale=1.0">
        {!! Html::style('assets/css/bootstrap.css') !!}
        {!! Html::style('assets/css/mdb.min.css') !!}
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="mdb.min.js"></script>
    </head>
    <body>
        <div class='container'>
            <nav class='navbar navbar-fixed-top' role='navigation'>
                <div class='container-field'>
                    <div class='container-header'>
                        @if(Session::get('id') > 0)
                        <a class='navbar-brand' href='{{ url('/welcome') }}'>Le Tabagnon</a>
                        @else
                        <a class='navbar-brand' href='{{ url('/') }}'>Le Tabagnon</a>
                        @endif

                    </div>
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

<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Instacons Resolver</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    @endif

    <div class="content">
        {{--WELCOME--}}
        <div class="title m-b-md">
            Instagram Resolve InstaCons
        </div>
        {{--BUTTONS--}}
        <div class="links">
            @if(!$hash)
                <p>To Proceed you need to authorize this app ..</p>
                <a class="btn btn-secondary btn-lg"
                   href="https://www.instagram.com/oauth/authorize/?client_id={{ env('INSTAGRAM_CLIENT_ID')}}&redirect_uri=http://instacons.localhost/user-media&response_type=token&scope=public_content">Authorise</a>
            @endif
            @if($hash)
                <p>App Authorised Browse our Media Gallery</p>
                <a id="media-list-button" class="btn btn-secondary btn-lg"
                   href=''>Browse
                    Media</a>
            @endif
        </div>
        {{--DATA--}}
    </div>
</div>
<script>
    /**
     * This could be simplified to Typescript or rather server side
     * We are perfoming a get request from Instagram and Cosnuming the #hash response value of the access Token
     * for Security we could make this a curl call or compile in webpack
     */
    $(document).ready(function () {
        @if($hash)
        let access_token = window.location.hash,
            param       = access_token.replace('#access_token=',''),
            route   =  '{{ env('APP_URL') }}';

        $('#media-list-button').attr('href', route + '/user-media-list/' + param );
        @endif
    });
</script>
</body>
</html>

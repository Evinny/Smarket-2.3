<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>S.Market</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

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
            .top-left {
                position: absolute;
                left: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 50px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            {{----}}
            <div class="top-left">
                <a href="{{ route('site.markets.list') }}">Go Back</a>
            </div>
            {{----}}
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                
                <div class="title m-b-md">
                    Editing... {{$current_data->name}}.
                </div>

                <b><hr>
                <div class="links">
                    
                    <form action='{{ route('site.markets.edit', ['id' => $current_data->id]) }}' method='post'>
                        @csrf
                        @method('put')
                        {{----}}
                        <input type='text' name='name' placeholder='{{$current_data->name}}'>
                        {{----}}
                        <input type='text' name='address' placeholder='{{$current_data->address}}'>
                        {{----}}
                        <input type='text' name='type' placeholder='{{$current_data->type}}'>
                        {{----}}
                        <input type='text' name='cnpj' placeholder='{{$current_data->cnpj}}'>
                        {{----}}
                        <br>
                        <button type='sumbmit'> Save </button><br>
                        {{----}}
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                        {{----}}
                        <h3>{{ isset($status) ? $status : ''}}</h3>

                </div>
            </div>
        </div>
    </body>
</html>

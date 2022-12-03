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

            li { 
            font-size:16px; 
            color:#790000; 
            font-weight:bold; 
            
            }
            
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
                <a href="{{ route('site.products') }}">Go Back</a>
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
                
                <div class="title">
                    Record Item
                    <hr>
                </div>

                <div class="links">
                    
                    <form action='{{ route('site.products.record') }}' method='post'>
                        @csrf
                        {{----}}
                        <input type='text' name='name' placeholder='Item Name' value={{old('name')}}>
                        {{----}}
                        <input type='text' name='details' placeholder='Item Details' value={{old('details')}}>
                        {{----}}
                        <input type='number' name='amount_stocked' placeholder='Amount in Stock' value={{old('amount_stocked')}}>
                        {{----}}
                        <input type='number' name='amount_in_markets' placeholder='Amount in markets' value={{old('amount_in_markets')}}>
                        {{----}}
                        <input type='number' name='price' placeholder='Item Price' value={{old('price')}}><br>
                        {{----}}
                        <input list='Providers_name' name='provider_name' placeholder='Provider' autocomplete="off">
                        {{----}}
                        <datalist id='Providers_name'>
                            
                            @foreach ($provider_names as $id => $name)
                                {{----}}
                                <option value='{{$name}}'  >
                                {{----}}
                            @endforeach
                        
                        </datalist>
                        {{----}}    
                        <button type='sumbmit'> Record </button><br>
                        {{----}}
                        
                        
                        
                    </form>
                   
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    
                    <h3>{{session('status')}}</h3>

                </div>
            </div>
        </div>
    </body>
</html>

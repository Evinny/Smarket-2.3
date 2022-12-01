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
            <div class="top-left">
                <a href="{{ route('site.home') }}">Go Back</a>
            </div>
            
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
                    Make Order
                    <hr>
                </div>

                <div class="links">
                    <form action='{{ route('order.store') }}' method='post'>
                        @csrf
                        
                        <input list="market_name" placeholder='Market Name' name='market_name' autocomplete="off">
                        
                        <datalist id="market_name">
                            
                            @foreach ($market_names as $id => $name)    
                                <option value='{{$name}}'  >
                            @endforeach

                        </datalist>

                        <input type='text' name='market_cnpj' placeholder='Market CNPJ'>
        

                        



                        <input list='product_names' name='product_names' placeholder='Product' autocomplete="off">
                        <datalist id='product_names'>
                        @foreach ($product_names as $id => $name)
                            <option value='{{$name}}'  >
                        @endforeach
                                <option value='teste'>
                        
                        </datalist>

                        <input type='number' name='product_amount' placeholder='amount'>
                        
                        <br><br>
                        
                        <button type='sumbmit'> Insert </button>

                        <br>

                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                        <h3>{{ isset($status) ? $status : ''}}</h3>
                        {{session('status')}}
                        
                        
                        
                        
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

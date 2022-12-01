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

            .pagination li{
                display: inline;
                margin-left: 5px;
                margin-right: 5px;
            }
            .pagination ul{
                list-style-type: none;
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
                right: 9%;
                top: 10%;
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
                font-size: 84px;
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

            .a {
                color: #636b6f;

            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            
            <div class="top-left">
                <a href="{{ route('site.markets') }}">Go Back</a>
            </div>
            <div class="top-right">
            
                <form action={{route('site.markets.list')}} method='post'>
                    @csrf
                    <b>Search for specifics<br>
                    <input type='text' placeholder='Search' name='search'>
                </form>
            </div>
                
                <div class="content">
                    <div class="title m-b-md">
                    </b>Markets list</b>
                    </div>
                <b>
                    <div class="links">
                        <a href="{{ route('site.products') }}">Products</a>
                        <a href="{{ route('site.markets.mass.remove') }}">Mass Remove</a>
                        <a href="{{ route('site.products') }}">Filters</a>
                        <hr>
                    </div>
                    
                    <table border='1' width='100%'>
                        <thead>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Type</th>
                            <th>CNPJ</th>
                            
                             

                        </thead>
                        <tbody>
                            
                            @foreach ($Ldata->all() as $data)
                                <tr> 
                                    <td><a href= '{{route('site.markets.show', $data->id)}}'>{{$data->name}}</td>
                                    <td>{{$data->address}}</td>
                                    <td>{{$data->type}}</td>
                                    <td>{{$data->cnpj}}</td>
                                    <td><a href ='{{route('site.markets.edit.form', $data->id)}}'>Edit</td>
                                    <td><a href ='{{route('site.markets.remove.form', $data->id)}}'>Del</td>
                                </tr>
                    
                            @endforeach
                        </tbody>
                    </table>
                    {{$Ldata->appends($request)->links()}}
                    <center>{{ request()->msg ? 'Deletion successful' : ''}}</center>
            </div>
        </div>
    </body>
</html>

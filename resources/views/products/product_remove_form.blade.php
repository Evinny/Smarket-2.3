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
                <a href="{{ route('site.products.list') }}">Go Back</a>
            </div>
            <div class="top-right">
            
                
            </div>
                
                <div class="content">
                    <div class="title m-b-md">
                    </b>Delete Product: {{$Ldata->pluck('name')}}?</b>
                    </div>
                <b>
                    <div class="links">
                        
                        <hr>
                    </div>
                    
                    <table border='1' width='100%'>
                        <thead>
                            <th>Name</th>
                            <th>Details</th>
                            <th>Amount in Stock </th>
                            <th>Amount in market(s)</th>
                            <th>Price</th>
                            

                        </thead>
                        <tbody>
                            @foreach ($Ldata->all() as $data)
                                <tr> 
                                    
                                    <td><center>{{$data->name}}</center></td>
                                    <td><center>{{$data->details}}</center></td>
                                    <td><center>{{$data->amount_stocked}}</center></td>
                                    <td><center><center>{{$data->amount_in_markets}}</center></td>
                                    <td><center>{{$data->price}}</center></td>
                                    
                                </tr>
                    
                            @endforeach
                        </tbody>
                    </table>
                    <form action={{route('site.products.remove')}} method='post'>
                        @csrf
                        <br>
                        <input  type='hidden'  name='product_id' value='{{$id}}'>
                        <button style=height:30px;width:80px;font-size:16pt; type='sumbmit'> Yes </button><br>
                    </form>
                    
            </div>
        </div>
    </body>
</html>

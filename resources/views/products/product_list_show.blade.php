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
                <a href="{{ route('site.markets.list') }}">Go Back</a>
            </div>
            <div class="top-right">
            
                
            </div>
                
                <div class="content">
                    <div class="title m-b-md">
                    </b>{{$product[0]->name}}</b>
                    </div>
                <b>
                    <div class="links">
                        
                        <a>cachorro quente nazista</a>

                    </div>
                    
                    <hr>
                    <br>
                    Details of Product
                    <br><br>
                    <table border='1' width='100%'>
                        <thead>
                            <th>Description</th>
                            <th>Amount Requested</address></th>
                            <th>Amount_left</th>
                            <th>price</th>
                            
                            

                        </thead>
                        <tbody>
                            
                            <tr> 
                                <td><center>{{$product[0]->details}}</center></td>
                                <td><center>{{$product[0]->amount_left}}</center></td>
                                <td><center>{{$product[0]->amount_in_stock}}</center></td>
                                <td><center>{{$product[0]->price}}</center></td>
                                
                                
                            </tr>
                    
                            
                        </tbody>
                        
                    
                
                        </tbody>
                    </table>
                    <br>
                    <hr>
                    <br>
                    Provider
                    <br><br>
                    <table border='1' width='100%'>
                        <thead>
                            <th>Name</th>
                            <th>Provider Address</address></th>
                            <th>Provider Size</th>
                            <th>Type of Provider</th>
                            <th>Products delivered</th>
                            <th>Products Available</th>
                            
                            

                        </thead>
                        <tbody>
                        
                            <tr> 
                                <td><center>{{$provider->name}} </a></center></td>
                                <td><center>{{$provider->address}}</center></td>
                                <td><center>{{$provider->size}}</center></td>
                                <td><center>{{$provider->type}}</center></td>
                                <td><center>{{$provider->products_delivered}}</center></td>
                                <td><center>{{$provider->products_available}}</center></td>
                                
                            </tr>
                    </form>
                    
            </div>
        </div>
    </body>
</html>

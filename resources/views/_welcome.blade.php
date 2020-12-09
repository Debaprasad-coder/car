<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                /*background-color: #fff;
                /*color: #636b6f;*/*/
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 180vh;
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

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
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
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                         @php
                            $cartTotal = !empty(Session::get('cart'))?count(Session::get('cart')):null;
                        @endphp
                        <a href="{{url('cart/viewCart')}}" >
                            <button type="button" class="btn btn-sm btn-default">
                                Cart
                                @if($cartTotal > 0)
                                    <span class="badge">{{$cartTotal}}</span>
                                @endif
                            </button>
                        </a>
                    @else                        
                         @php
                            $cartTotal = !empty(Session::get('cart'))?count(Session::get('cart')):null;
                        @endphp
                        <a href="{{route('cart.viewCart')}}" >
                            <button type="button" class="btn btn-sm btn-default">
                                Cart
                                @if($cartTotal > 0)
                                    <span class="badge">{{$cartTotal}}</span>
                                @endif
                            </button>
                        </a>
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif
            <div class="container">
                <h2>Car Model</h2> 
                <div class="row">
                    
                    <form class="form-inline" action="" method="get">
                      <div class="form-group">
                        <label for="car-model">Brand : </label>
                        <select class="form-control" name="car-model">
                            
                            <!-- <option value="MARUTI" >Maruti</option>
                            <option value="BMW">BMW</option>
                            <option value="MAHINDRA" >Mahindra</option> -->
                            @if(isset($_GET['car-model']))
                                 @foreach(['all'=>'ALL','MARUTI'=>'MARUTI','BMW'=>'BMW','MAHINDRA'=>'MAHINDRA'] as $key=>$brand)
                                    <option value="{{$key}}" {{($key==$_GET['car-model'])?'selected="selected"':''}}>{{$brand}}</option>
                                @endforeach                            
                            @else
                                 @foreach(['all'=>'ALL','MARUTI'=>'MARUTI','BMW'=>'BMW','MAHINDRA'=>'MAHINDRA'] as $key=>$brand)
                                    <option value="{{$key}}">{{$brand}}</option>
                                @endforeach
                            
                               
                            @endif
                        </select>
                      </div>                  
                      <button type="submit" class="btn btn-default">search</button>
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (isset($cart_msg_success))
                        <div class="alert alert-success">
                            <strong>Success!</strong>  {{$cart_msg_success}}   
                        </div>
                    @endif
                    <!--@if (isset($cart_msg_error))
                        <div class="alert alert-danger">
                            <strong>Error !</strong>  {{$cart_msg_error}}   
                        </div>
                    @endif -->                   
                </div>
                <div class="row">
                     @foreach($cars as $car)
                    <div class="col-md-3">                        
                        <div class="panel panel-primary">
                            <div class="panel-heading">{{$car->car_name}}</div>
                            <div class="panel-body">
                                <form action="{{url('cart/add')}}" method="post">
                                    {{csrf_field()}}
                                  <div class="form-group">
                                    <img class="img-rounded" style="height:100px;width:100px;" src="{{URL('assets/car')}}/{{$car->car_image}}" alt="">
                                  </div>
                                  <div class="form-group">
                                    <label for="Price">Price : </label>
                                    &#8377; {{$car->car_price}}
                                  </div>
                                  <div class="form-group">
                                    <label for="qty">Qty : </label>
                                    <input type="hidden" name="carId" value="{{$car->id}}">
                                    <?php
                                        $i='';
                                        if(!empty(Session::get('cart'))){

                                            foreach(Session::get('cart') as $key => $value){

                                                if($value['car_id'] == $car->id){                                
                                                    $i = $value['quantity'];
                                                    $addClass = '';
                                                    break;                               
                                                }else{
                                                    continue;
                                                }
                                            }                            
                                        }
                                    ?>
                                    <input type="number" name="quantity" min="0" value="{{$i}}" required="required">
                                  </div>
                                  <input type="submit" name="submit" class="btn btn-success" value="Add to Cart">                                  
                                  
                                </form>
                            </div>
                        </div>
                    </div>                                      
                    @endforeach
                </div>
            </div>
        </div>
    </body>
   
</html>

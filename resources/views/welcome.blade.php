@extends('layouts.app')

@section('content')
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
                                 @foreach(['all'=>'ALL','MARUTI'=>'MARUTI','BMW'=>'BMW','MAHINDRA'=>'MAHINDRA','TATA'=>'TATA','TOYOTA'=>'TOYOTA'] as $key=>$brand)
                                    <option value="{{$key}}" {{($key==$_GET['car-model'])?'selected="selected"':''}}>{{$brand}}</option>
                                @endforeach                            
                            @else
                                 @foreach(['all'=>'ALL','MARUTI'=>'MARUTI','BMW'=>'BMW','MAHINDRA'=>'MAHINDRA','TATA'=>'TATA','TOYOTA'=>'TOYOTA'] as $key=>$brand)
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
@push('PAGE_CSS')
<style type="text/css">
  .order-table thead{
    background-color: #009688;
    color: #f5efef;
  }
  
</style>
@endpush
@endsection

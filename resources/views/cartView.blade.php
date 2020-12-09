@extends('layouts.app')

@section('content')
<div class="container">
   
    <!--{{ json_encode(Session::get('cart'))}}-->   
    <h2>My Cart</h2> 
    <div class="row">  
      @if (Session::has('cart_msg_success'))
            <div class="alert alert-success">
                <strong>Success!</strong>  {{Session::get('cart_msg_success')}}   
            </div>
        @endif
         @if (Session::has('cart_msg_error'))
            <div class="alert alert-danger">
                <strong>Error !</strong>  {{Session::get('cart_msg_error')}}   
            </div>
        @endif                  
        <table class="table table-bordered cart-table">
            <thead>
              <tr>
                <th>SL.</th>
                <th>Brand </th>
                <th>Title</th>
                <th>Qty</th>
                <th>unit Price</th>
                <th>Total Price</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @if(!empty(Session::get('cart')))
                
                    @php
                        $i=1;
                        $cartTotal = 0;
                        $carTotal = 0;
                    @endphp
                    @foreach(Session::get('cart') as $key => $val)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$val['car_brand']}}</td>
                            <td>{{$val['car_name']}}</td>
                            <td>{{$val['quantity']}}</td>
                            <td>{{$val['unit_price']}}</td>
                            <td>{{$val['car_price']}}</td>
                            <td>
                                <a href="{{url('cart/delete',$val['car_id'])}}" onclick="return confirm('Are you sure to delete this car from cart ??')">
                                    <button type="button" class="btn btn-xs btn-warning">
                                        Remove <span class="glyphicon glyphicon-trash "></span>
                                    </button>                            
                                </a>
                            </td>
                        </tr>
                        @php
                            $i++;
                            $cartTotal += $val['car_price'];
                            $carTotal += $val['quantity'];
                        @endphp
                    @endforeach
                        <tr>
                            <td colspan="3" align="center">Total Car</td>
                            <td>{{$carTotal}}</td>
                            <td>Sub Total</td>
                            <td colspan="2">{{$cartTotal}}</td>
                            
                        </tr>            
                @else
                <tr class="danger">
                    <td colspan="8" align="center">
                        No Item in Cart
                    </td>
                </tr>
                @endif  
            </tbody>
        </table>
    </div>
    <div class="row">
        @if(!empty(Session::get('cart')))
        <div class="col-md-6">
            @if(Auth::user())
           <a href="{{url('home')}}">
               <button type="button" class="btn btn-primary btn-block" onclick="return confirm('Are you sure to Update ??')"><span class="glyphicon glyphicon-edit"></span> Edit Cart</button>
           </a>
           @else
           <a href="{{url('')}}">
               <button type="button" class="btn btn-primary btn-block" onclick="return confirm('Are you sure to Update ??')"><span class="glyphicon glyphicon-edit"></span> Edit Cart</button>
           </a>
           @endif
       </div>
       <div class="col-md-6">
           <a href="{{url('checkout')}}">
               <button type="button" class="btn btn-success btn-block" onclick="return confirm('Are you sure to checkout ??')"> <span class="glyphicon glyphicon-check"></span> Checkout</button>
           </a>
       </div>       
       @endif
    </div>
    <?php
        //echo "<pre>";print_r(Session::get('cart'));
    ?>    
</div>
@push('PAGE_CSS')
<style type="text/css">
  .cart-table thead{
    background-color: #009688;
    color: #f5efef;
  }
  .cart-table tbody tr:last-child{
    background-color: #009688;
    color: #f5efef;
  }
</style>
@endpush
@endsection

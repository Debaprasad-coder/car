@extends('layouts.app')

@section('content')
<div class="container">
   
    <!--{{ json_encode(Session::get('cart'))}}-->   
    <h2>My Order</h2> 
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
      <table class="table table-bordered order-table">
          <thead>
            <tr>
              <th>SL.</th>
              <th>Brand </th>
              <th>Title</th>
              <th>Car Image</th>
              <th>unit Price</th>
              <th>Qty</th>
              <th>Total Price</th>
              <th>Order Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @if(count($orders)>0)
              @php
                $i=1;
              @endphp
              @foreach($orders as $order)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$order->carBrand}}</td>
                  <td>{{$order->carName}}</td>
                  <td>
                    <img class="img-rounded" style="height:50px;width:50px;" src="{{URL('assets/car')}}/{{$order->carImg}}" alt="">
                  </td>
                  <td>{{$order->unitPrice}}</td>
                  <td>{{$order->qty}}</td>
                  <td>{{$order->totalPrice}}</td>
                  <td>{{$order->oredrAt}}</td>
                  <td>{{$order->status}}</td>
                </tr>
                @php
                  $i++;
                @endphp
              @endforeach
            @else
              <tr class="danger">
                <td colspan="9" align="center">
                  No Order found
                </td>
              </tr>
            @endif
              
          </tbody>
      </table>
    </div>
    <div class="row">
       
    </div>
    <?php
        //echo "<pre>";print_r($orders);
       // echo "<pre>";print_r(Auth::user());
    ?>    
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

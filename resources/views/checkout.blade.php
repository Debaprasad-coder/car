@extends('layouts.app')

@section('content')
<div class="container">
   @if (Session::has('cart_msg_success'))
            <div class="alert alert-success">
                <strong>Success!</strong>  {{Session::get('cart_msg_success')}}   
            </div>
        @endif
         @if (Session::has('cart_msg_error'))
            <div class="alert alert-danger">
                <strong>Success!</strong>  {{Session::get('cart_msg_error')}}   
            </div>
        @endif
    <!--{{ json_encode(Session::get('cart'))}}--> 
    <h2>Order details</h2>
    <div class="row">
      <div class="row">                    
        <table class="table table-bordered order-table">
            <thead>
              <tr>
                <th>SL.</th>
                <th>Brand </th>
                <th>Title</th>
                <th>Qty</th>
                <th>unit Price</th>
                <th>Total Price</th>                
              </tr>
            </thead>
            <tbody>
                @if(count(Session::get('cart'))>0)                
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
                @endif  
            </tbody>
        </table>
    </div>
    </div>  
    <h2>Chekout Form</h2> 
    <div class="row checkout">
      @if (count($errors)>0)
          <div class="alert alert-danger">
              <p class="text-danger"><strong>Errors !</strong> Check out Form has some errors,Please correct ! </p>  
          </div>
      @endif
      <form class="form-horizontal" action="{{url('cartSave')}}" method="post" id="billingForm">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-sm-4" for="">Billing Address</label>
            
          </div> 
          {{csrf_field()}}
          <div class="form-group {{($errors->first('bill_name'))?'has-error':''}}">
              <label class="control-label col-sm-2" for="name">Name:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" value="{{old('bill_name')}}" id="bill_name" placeholder="Enter name" name="bill_name">
                <span class="text-danger">{{$errors->first('bill_name')}}</span>
              </div>
            </div>
            <div class="form-group {{($errors->first('bill_email'))?'has-error':''}}">
              <label class="control-label col-sm-2" for="email">Email:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="bill_email" placeholder="Enter email" name="bill_email" value="{{old('bill_email')}}">
                <span class="text-danger">{{$errors->first('bill_email')}}</span>
              </div>
            </div>
            <div class="form-group {{($errors->first('bill_mobile'))?'has-error':''}}">
              <label class="control-label col-sm-2" for="mobile">Mobile:</label>
              <div class="col-sm-10">          
                <input type="text" class="form-control" id="bill_mobile" placeholder="Enter mobile" name="bill_mobile" value="{{old('bill_mobile')}}">
                <span class="text-danger">{{$errors->first('bill_mobile')}}</span>
              </div>
            </div>
            <div class="form-group {{($errors->first('bill_address'))?'has-error':''}}">
              <label class="control-label col-sm-2" for="address">Address:</label>
              <div class="col-sm-10">          
                <input type="text" class="form-control" id="bill_address" placeholder="Enter addess" name="bill_address" value="{{old('bill_address')}}">
                <span class="text-danger">{{$errors->first('bill_address')}}</span>
              </div>
            </div>
        </div>
        <div class="col-md-6">            
            <div class="form-group">
              <label class="control-label col-sm-6" for="">
                <input class="form-check-input" type="checkbox" id="bill_gridCheck" name="bill_gridCheck">
                Same as Billing Address
              </label>              
              <label class="control-label col-sm-6" for="">Shipping Address</label>
            </div>     
            <div class="form-group {{($errors->first('inv_name'))?'has-error':''}}">
              <label class="control-label col-sm-2" for="name">Name:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inv_name" placeholder="Enter name" name="inv_name" value="{{old('inv_name')}}">
                <span class="text-danger">{{$errors->first('inv_name')}}</span>
              </div>
            </div>
            <div class="form-group {{($errors->first('inv_email'))?'has-error':''}}">
              <label class="control-label col-sm-2" for="email">Email:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inv_email" placeholder="Enter email" name="inv_email" value="{{old('inv_email')}}">
                <span class="text-danger">{{$errors->first('inv_email')}}</span>
              </div>
            </div>
            <div class="form-group {{($errors->first('inv_mobile'))?'has-error':''}}">
              <label class="control-label col-sm-2" for="mobile">Mobile:</label>
              <div class="col-sm-10">          
                <input type="text" class="form-control" id="inv_mobile" placeholder="Enter mobile" name="inv_mobile" value="{{old('inv_mobile')}}">
                <span class="text-danger">{{$errors->first('inv_mobile')}}</span>
              </div>
            </div>
            <div class="form-group {{($errors->first('inv_address'))?'has-error':''}}">
              <label class="control-label col-sm-2" for="address">Address:</label>
              <div class="col-sm-10">          
                <input type="text" class="form-control" id="inv_address" placeholder="Enter address" name="inv_address"  value="{{old('inv_address')}}">
                <span class="text-danger">{{$errors->first('inv_address')}}</span>
              </div>
            </div>           
            <div class="form-group">        
              <div class="col-sm-8">
                <input type="submit" class="btn btn-success" value="Save & pay" name="submit">
              </div>
            </div>
        </div>
      </form>
      
    </div>
   
    <?php
        //echo "<pre>";print_r(Session::get('cart'));
    ?>    
</div>
@push('PAGE_CSS')
<style type="text/css">
  .checkout{
    border:1px solid #333;
    margin: -5px 0px 20px 0px;
  }
  .order-table thead{
    background-color: #009688;
    color: #f5efef;
  }
  .order-table tbody tr:last-child{
    background-color: #009688;
    color: #f5efef;
  }
</style>
@endpush
@push('PAGE_JS')
<script type="text/javascript">
/**
*FILL Inv. form BY BILLING form
*/
var arr_ex = [];
var name,value,FORM = "";
var arr_inv = []; 
var arr_length = null;
var up_bound = "";
$("input:checkbox#bill_gridCheck").click(function(){
  
  if( $(this).is(':checked') ){
    /*fill Inv. dtls by billing dtls*/
    FORM = $("#billingForm").serializeArray();   
    arr_length = Math.ceil( (FORM.length)/2 );
    up_bound = Math.floor( (FORM.length)/2 );
    
    for(var i =1;i<up_bound; i++){

      name = FORM[i].name;
      arr_inv = name.split("_"); 
      value = FORM[i].value;
      
      $("#inv_"+arr_inv[1]).val(value);
      /*push id to array_1*/
      arr_ex.push("inv_"+arr_inv[1]);
      arr_length = arr_length +1;
    }   
  }else{
    /*reset the inv. dtls field*/    
    for(var i = 0;i<=arr_ex.length;i++){
      $("#"+arr_ex[i]).val('');     
    }
  }
});
</script>
@endpush
@endsection




<?php

namespace Car\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Validator;
use Session;
use Car\model\CarModel;


class CartController extends Controller
{
  
  public function index()
  {
    echo "hi";
  }
  /**
    add car to cart
  */
  public function add(Request $request)
  { 
    
    //dd($request->post()); 
    if($request->submit){
      //dd($request->post());      
      $validator = Validator::make($request->all(), [                
        'carId'=>'required|numeric',            
        'quantity'=>'required|numeric|min:1', 
      ],
      [
       'carId.required' => 'The Car id is required.',
       'carId.numeric' => 'The Car id is invalid.',
       'quantity.required' => 'The Quantity is required.',
       'quantity.numeric' => 'The Quantity error.',
      ]);
      if($validator->fails()) 
      {
        //echo "sdfgh";exit;
          return redirect()
                  ->back()
                  ->withErrors($validator)
                  ->withInput();
      }else{ 
        
        $car = CarModel::find($request->carId)  ;
        // dd(sizeof($car)); 
        // dd($car->count()); 
        if($car){
          $cart = Session::get('cart');
          if(is_array($cart)){            
            $key = $this->findArrayKey($cart,$request->carId);
            if(is_int($key)){
              
              $cart[$key]['quantity'] = $request->quantity;  
              $cart[$key]['car_price'] = $car->car_price*$request->quantity;

            }else{
              
              $cart[] = array(
                'car_id'=> $car->id,
                'quantity' => $request->quantity,
                'car_brand' => $car->car_brand,
                'car_name' => $car->car_name,
                'unit_price' => $car->car_price,
                'car_price' => $car->car_price*$request->quantity,
              );
            }            
          }else{
            $cart[] = array(
              'car_id'=> $car->id,
              'quantity' => $request->quantity,
              'car_brand' => $car->car_brand,
              'car_name' => $car->car_name,
              'unit_price' => $car->car_price,
              'car_price' => $car->car_price*$request->quantity,
            );
          }
          Session::put('cart',$cart);  
          //echo "<pre>";print_r(Session::get('cart'));die();
          if(Auth::user()){
            return redirect()
                    ->route('home')
                    ->with('cart_msg_success',"Car / ( $request->quantity )$car->car_name  has been added successfuly");
          }else{
            $cars = DB::table('Car_model')->get();
            return view('welcome',['cars'=>$cars,'cart_msg_success'=>"Car / ( $request->quantity ) $car->car_name  has been added successfuly"]);
           /* return redirect()
                    ->route()
                    ->with('cart_msg_success',"Car / $car->car_name  has been added successfuly");*/
          }           
        }else{
          //error
          if(Auth::user()){
            return redirect()
                    ->route('home')
                    ->with('cart_msg_error','Something went wrong,Please try again!');
          }else{
            $cars = DB::table('Car_model')->get();
            return view('welcome',['cars'=>$cars,'cart_msg_error'=>"Something went wrong,Please try again!"]);
          }           
        }
      }
    }else{
      /*do nothing*/
      //dd($request->post()); 
      if(Auth::user()){
        return redirect()
                ->route('home')
                ->with('cart_msg_error','Something went wrong,Please try again!');
      }else{
        $cars = DB::table('Car_model')->get();
        return view('welcome',['cars'=>$cars,'cart_msg_error'=>"Something went wrong,Please try again!"]);
        } 
    }    
  }
  /**
    viewCart
  */
  public function viewCart()
  {

    return view('cartView');
  }
  public function edit(Request $request,$id)
  {
      dd($Request);
  }

  public function delete($id)
  {     
    if((int)$id > 0){

      $cart = Session::get('cart');
      //echo "<pre>";print_r($cart);    
      $carId = $this->findArrayKey($cart,(int)$id);
      if(is_int($carId)){
        /**
          car id found
        */
        $carName = $cart[$carId]['car_name'];
        $carQty =  $cart[$carId]['quantity']; 
        unset($cart[$carId]);        
        Session::put('cart',$cart);
        return redirect()->back()->with("cart_msg_success", " $carQty $carName Car has been removed successfuly from Cart");
      }else{
        /**
          car id not found
        */
        return redirect()->back()->with("cart_msg_error", "Car id not found !");       
      }
    }else{

    }
  }

  /**
    custom array search function
    search by value return key else false 
  */
  public function findArrayKey($array="",$value="")
  {
    //echo "here";die();
    foreach($array as $key => $val){        
     if($val['car_id'] == $value){
      return  $key;
     }
    }        
    return false;
  }    
}

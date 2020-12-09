<?php

namespace Car\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Validator;
use Session;
use Car\model\CartModel;
use Car\model\BookingModel;


class CheckoutController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
        checkout function
    */
    public function checkout()
    {
        return view('checkout');
    }   
    /**
        cart cartSave function
    */  
    public function cartSave(Request $request)
    {
        //dd($request->post());
        if($request->submit){
            //dd($request->post());      
            $validator = Validator::make($request->all(), [                
                    'bill_name'=>'required|regex:/(^[a-zA-Z ]+$)+/',            
                    'bill_email'=>'required|email|max:100', 
                    'bill_mobile'=>'required|numeric|digits_between:10,15', 
                    'bill_address'=>'required|regex:/(^[a-zA-Z0-9 ]+$)+/', 
                    'inv_name'=>'required||min:1', 
                    'inv_email'=>'required|email|max:100', 
                    'inv_mobile'=>'required|numeric|digits_between:10,15', 
                    'inv_address'=>'required|regex:/(^[a-zA-Z0-9 ]+$)+/', 
                ],
                [
                    'bill_name.required' => 'The billing name is required.',
                    'bill_name.regex' => 'The billing name accept alphabates only.',
                    'bill_email.required' => 'The billing email is required.',
                    'bill_email.email' => 'The billing email is invalid.',
                    'bill_email.max' => 'The billing email max length 100.',
                    'bill_mobile.required' => 'The billing mobile is required.',
                    'bill_mobile.numeric' => 'The billing mobile accept number only.',
                    'bill_mobile.digits_between' => 'The billing mobile must be between 10 and 15 digits.',
                    'bill_address.required' => 'The billing address is required.',
                    'bill_address.regex' => 'The billing address accept alphnumeric char,space only.',
                    'inv_name.required' => 'The shipping name is required.',
                    'inv_name.regex' => 'The shipping name accept alphabates only.',
                    'inv_email.required' => 'The shipping email is required.',
                    'inv_email.email' => 'The shipping email is invalid.',
                    'inv_email.max' => 'The shipping email max length 100.',
                    'inv_mobile.required' => 'The shipping mobile is required.',
                    'inv_mobile.numeric' => 'The shipping mobile accept number only.',       
                    'inv_mobile.digits_between' => 'The shipping mobile must be between 10 and 15 digits.',          
                    'inv_address.required' => 'The shipping address is required.',
                    'inv_address.regex' => 'The shipping address accept alphnumeric char,space only.',
                ]);
            if($validator->fails()) 
            {
                //echo "sdfgh";exit;
                return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
            }else{
                //procedd to save the data
                //echo "<pre>";print_r($request->post());
                //echo "<pre>";print_r(Session::get('cart'));exit;
                DB::beginTransaction();
                try{
                    foreach(Session::get('cart') as $key=>$value){
                        $tblCart = [
                            'user_id' => Auth::user()->id,
                            'car_id' => $value['car_id'],
                            'car_qty' => $value['quantity'], 
                            'car_unit_price' => $value['unit_price'],
                            'created_at' => date('Y-m-d H:i:s'),
                            'status' => 'pending'                   
                        ]; 
                        /*insert category and get insert id*/                   
                        $lastInsertid = CartModel::insertGetId($tblCart);
                        $cartId[] = $lastInsertid>0?(bool)true:(bool)false;
                        $tablAddr = [
                            'cart_id' => $lastInsertid,
                            'bill_name' => $request->bill_name,
                            'bill_email' => $request->bill_email,
                            'bil_mobile' => $request->bill_mobile,
                            'bill_address' => $request->bill_address,
                            'ship_name' => $request->inv_name,
                            'ship_email' => $request->inv_email,                            
                            'ship_mobile' => $request->inv_mobile,
                            'ship_address' => $request->inv_address,
                        ];
                        $cartAddr[] = BookingModel::insert($tablAddr);
                    }
                    /*
                    echo "<pre>";print_r($cartId);
                    echo "<pre>";print_r($cartAddr);
                    exit;
                    */
                    if(count(array_keys($cartId, '1')) == count($cartId) && count(array_keys($cartAddr, '1')) == count($cartAddr)){
                        /*all insert done successfully*/
                        DB::commit();
                        /*unset cart session*/
                        Session::forget('cart');    
                        return redirect()
                            ->route('order')
                            ->with('cart_msg_success','Your order has been placed successfuly.');
                    }
                }catch(\Exception $e) {
                    dd($e);
                    DB::rollback(); 
                    return back();
                }
            }
        }   
    }    
    
}

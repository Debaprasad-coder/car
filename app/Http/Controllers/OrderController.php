<?php

namespace Car\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Validator;
use Session;
use Car\model\CartModel;
use Car\model\BookingModel;
use Car\model\OrderModel;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        //echo 'orders';
        $this->data['orders'] = OrderModel::getOrder(Auth::user()->id);
        //echo "<pre>";print_r(   $this->data['orders']);
        return view('orderView',$this->data);
        
    }
    
}

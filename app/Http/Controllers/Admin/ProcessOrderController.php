<?php

namespace Car\Http\Controllers\Admin;

//use Car\model\CartModel;
use Car\model\BookingModel;
use Illuminate\Http\Request;
use Car\Http\Controllers\Controller;

class ProcessOrderController extends Controller
{
    public function __construct()
	{
		//dd($guard);
		$this->middleware('auth:admin');
	}

	//orderDetails
	public function orderDetails($id)
	{
		
		$this->data['orderDetails'] = BookingModel::find((int)$id);
		return view('admin.order.orderdetails',$this->data);
		//echo $id;
	}
}

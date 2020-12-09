<?php

namespace Car\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Validator;
use Session;
use Car\model\CarModel;


class HomeController extends Controller
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
    public function index(Request $request)
    {        
        //dd($_GET);
        $carBrand = isset($_GET["car-model"])?$_GET["car-model"]:'';
        $this->data['cars'] = ($carBrand=='')?CarModel::get():(($carBrand=='all')?CarModel::get():CarModel::where('car_brand',$carBrand)->get());
        return view('home',$this->data);
    }
    
}

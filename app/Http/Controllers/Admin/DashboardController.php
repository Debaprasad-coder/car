<?php

namespace Car\Http\Controllers\Admin;

use Car\Car;
use Car\model\OrderModel;
use Illuminate\Http\Request;
use Car\Http\Controllers\Controller;
use Auth;
use car\User;
use Validator;
class DashboardController extends Controller
{
    
	public function __construct()
	{
		//dd($guard);
		$this->middleware('auth:admin');
	}
    //index function
    public function index()
    {    	
        return view('admin.dashboard.index');
    }
    //display order 
    public function order()
    {
        $this->data['orders'] = OrderModel::getOrder();
    	return view('admin.order.index',$this->data);
    }
    //display profile
    public function profile()
    {
        $this->data['user'] = User::find(Auth::User()->id);      
    	return view('admin.profile.index',$this->data);
    }
    //update profile
    public function updateProfile(Request $request,User $user,$id)
    {
         //echo $user->id;exit;
        // dd($request->post());
        //dd($user);
        if($request->submit){

            //validation
            $validator = Validator::make($request->all(), [                
                'name'=>'required|string',            
                'email'=>'required|string|email|max:255|unique:users,email,'.$id, 
                'phone'=>'required|numeric|digits_between:10,15|unique:users,phone,'.$id, 
              ]
              );
            if($validator->fails()) 
            {
                //echo "sdfgh";exit;
                return redirect()
                          ->back()
                          ->withErrors($validator)
                          ->withInput();
            }else{
                
                /*$user->name = $request->name;
                $user->email  = $request->email;
                $user->phone = $request->phone;
                $user->save();*/
                User::find($id)->update($request->all()); 

                return redirect()
                    ->route('admin.profile')
                    ->with('status','Profile has been updated successfuly.');
            }
        }

    }


}

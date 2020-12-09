<?php

namespace Car\Http\Controllers\Admin;

//use Car\Car;

use DB;
use Auth;
use Validator;
use Session;
use Car\model\carModel as Car;
use Illuminate\Http\Request;
use Car\Http\Controllers\Controller;

class CarController extends Controller
{
    
    public function __construct(){
        //dd($guard);
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $this->data['cars'] = Car::simplePaginate(5);
        //$this->data['cars'] = Car::paginate(5);
        $this->data['count'] = Car::all()->count();
        /*echo "<pre>";
        print_r($this->data['cars']);
        exit;*/
        //return $this->data;
        return view('admin.car.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.car.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->post());
        if($request->submit){
            //dd($request->post());      
            $validator = Validator::make($request->all(),
                [                
                    'car_brand'=>'required|regex:/(^[a-zA-Z ]+$)+/',            
                    'car_name'=>'required|regex:/(^[a-zA-Z ]+$)+/|unique:car_model',            
                    'car_image'=>'required',            
                    'car_price'=>'required|regex:/(^[0-9 ]+$)+/',           
                ],
                [
                    'car_brand.required' => 'The Car-Brand name is required.',
                    'car_name.required' => 'The Car name is required.',
                    'car_image.required' => 'The Car Image is required.',
                    'car_price.required' => 'The Car price is required.',
                    'car_brand.regex' => 'The Car-Brand allowed alphabates only.',
                    'car_name.regex' => 'The Car-name allowed alphabates only.',                    
                    'car_price.regex' => 'The Car-price allowed number only.',
                    
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
                     $tblProduct = [
                        'car_brand' => $request->car_brand,
                        'car_name' => $request->car_name,
                        'car_price' => $request->car_price,
                    ]; 
                    /*insert product and get insert id*/                   
                    $lastinsertid = Car::insertGetId($tblProduct);

                    /*upload car image*/
                    $image = $request->file('car_image');
                    $input['car_image'] = $lastinsertid.'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/assets/car');
                    $image->move($destinationPath, $input['car_image']);   

                    /*update image name*/
                    $updateProductImg = [
                        'car_image'=> $input['car_image'],                       
                    ];
                    $lastupdate = Car::where('id',$lastinsertid)->update($updateProductImg);

                    if($lastinsertid && $lastupdate){
                        /*all insert done successfully*/
                        DB::commit();                                            
                        return redirect()
                            ->route('cars.index')
                            ->with('status','Car has been saved successfuly.');
                    }
                }catch(\Exception $e) {
                    dd($e);
                    DB::rollback(); 
                    return back();
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Car\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        
        /*dd($car);
        echo "show";exit;*/
        return response()->json(['car'=>$car]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Car\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        /*
        echo $car->car_brand;
        dd($car);
        echo "edit";exit;
        */
        //return $car;
        return view('admin.car.edit',['car'=>$car]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Car\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        
        /*echo $car->id;
        dd($request);
        echo "update";exit;*/
        if($request->submit){
            $validator = Validator::make($request->all(),
                [                
                    'car_brand'=>'required|regex:/(^[a-zA-Z ]+$)+/',            
                    'car_name'=>'required|regex:/(^[a-zA-Z0-9 -]+$)+/',
                    'car_price'=>'required|regex:/(^[0-9 ]+$)+/',           
                ],
                [
                    'car_brand.required' => 'The Car-Brand name is required.',
                    'car_name.required' => 'The Car name is required.',
                    'car_price.required' => 'The Car price is required.',
                    'car_brand.regex' => 'The Car-Brand allowed alphabates only.',
                    'car_name.regex' => 'The Car-name allowed alphabates only.',                    
                    'car_price.regex' => 'The Car-price allowed number only.',
                ]
            );            
            if($validator->fails()) 
            {                
                return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
            }else{
                    
                /*$tblProduct = [
                    'car_brand' => $request->car_brand,
                    'car_name' => $request->car_name,
                    'car_price' => $request->car_price,
                ];*/ 
                $car->car_brand = $request->car_brand;
                $car->car_name  = $request->car_name;
                $car->car_price = $request->car_price;
                $car->save();                

                //remove file
                if(\File::exists(public_path('/assets/car'.$car->car_image))){
                  \File::delete(public_path('/assets/car'.$car->car_image));
                }
                //upload file
                if($request->hasFile('car_image')){

                    $image = $request->file('car_image');
                    $input['car_image'] = $car->id.'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/assets/car');
                    $image->move($destinationPath, $input['car_image']); 
                }                                               
                return redirect()
                    ->route('cars.index')
                    ->with('status','Car has been updated successfuly.');
            }
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Car\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        /*echo "destroy";
        echo $car->id;
        dd($car);
        echo "destroy";exit;*/
        $car->delete();
        return redirect()
            ->route('cars.index')
            ->with('status','Car has been deleted successfuly.');
    }
}

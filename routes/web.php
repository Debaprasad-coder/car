<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	
	$model = isset($_GET['car-model'])?$_GET['car-model']:'';
	if($model == 'all'){
		$cars = DB::table('Car_model')->get();/*get all car recoed from database*/
	}elseif($model!=''){
		$cars = DB::table('Car_model')->where('car_brand',$model)->get();/*get selected car recoed from database*/
	}else{
		$cars = DB::table('Car_model')->get();/*get all car recoed from database*/
	}	
	//dd($cars);
    return view('welcome',['cars'=>$cars]);
});


//authentication route
Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');


// Route::get('/cart', 'CartController@index')->name('cart');
// Route::any('/cart/add', 'CartController@add')->name('cart.add');
/*group route*/

Route::prefix('cart')->group(function() {
	Route::any('/add', 'CartController@add')->name('cart.add');
	Route::any('/viewCart', 'CartController@viewCart')->name('cart.viewCart');
	Route::any('/edit', 'CartController@edit')->name('cart.edit');
	Route::any('/delete/{id}', 'CartController@delete')->name('cart.delete');
});

Route::get('/checkout', 'CheckoutController@checkout')->name('checkout');
Route::post('/cartSave', 'CheckoutController@cartSave')->name('cartSave');

/*order*/

Route::get('/order', 'OrderController@index')->name('order');


/*
-----------------------------------------------
 admin routes
-------------------------------------------------
*/
Route::prefix('admin')->namespace('Auth\Admin')->group(function(){
	// Authentication Routes...
	Route::get('/', 'LoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'LoginController@login');
	Route::post('/logout', 'LoginController@logout')->name('admin.logout');
});
Route::prefix('admin')->namespace('Admin')->group(function(){
	//admin authuorization routes
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::get('order', 'DashboardController@order')->name('admin.order');
    Route::get('order/{id}', 'ProcessOrderController@orderDetails');
    Route::get('profile', 'DashboardController@profile')->name('admin.profile');
    Route::post('profile/{id}', 'DashboardController@updateProfile');
    // car resource route
    Route::resource('cars', 'CarController');
    
    
       
});

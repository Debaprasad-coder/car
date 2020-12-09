@include('admin.layouts.common.header')
@include('admin.layouts.common.sidebar')
    <!-- partial -->
    <div class="main-panel">
		<div class="content-wrapper">
			<!-- Page Title Header Starts-->
			<div class="row page-title-header">
				<div class="col-12">
					<div class="page-header">						
						<div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">
							<ul class="quick-links">
								<li>
									<a href="{{route('cars.index')}}">Car</a>
								</li>
								<li>
									<a href="{{route('cars.edit',$car->id)}}">Edit</a>
								</li>
							</ul>
							<!-- <ul class="quick-links ml-auto">
								<li><a href="#">Settings</a>
								</li>
								<li><a href="#">Analytics</a>
								</li>
								<li><a href="#">Watchlist</a>
								</li>
							</ul> -->
						</div>
					</div>
				</div>
			</div>
			<!-- {{$car}} -->
			<div class="col-12 grid-margin">
            <div class="card">
              	<div class="card-body">
                <mark class="bg-warning text-white">Car Edit Form</mark>
                <form class="form-sample" method="POST" action="{{route('cars.update',$car->id)}}" enctype="multipart/form-data">
                	{{csrf_field()}}
                	<input type="hidden" name="_method" value="PATCH">
                  <p class="text-success">Update Car infomation </p>
                  <div class="row">
	                    <div class="col-md-6 ">
	                      <div class="form-group row {{ $errors->has('car_brand') ? ' has-error' : '' }}">
	                        <label class="col-sm-3 col-form-label">Car Brand</label>
	                        <div class="col-sm-9">
	                          <select class="form-control" name="car_brand">
	                          	<option value="">Select Car Brand</option>
	                          	@foreach(['MARUTI'=>'MARUTI','MAHINDRA'=>'MAHINDRA','BMW'=>'BMW','TATA'=>'TATA','TOYOTA'=>'TOYOTA'] as $key=>$val)
	                          		<option value="{{$key}}" {{$car->car_brand == $key? "selected":""}}>{{$val}}</option>
	                          	@endforeach	                           
	                          </select>
	                          <span class="text-danger">{{$errors->first('car_brand')}}</span>
	                        </div>
	                      </div>
	                    </div>
	                    <div class="col-md-6">
	                      <div class="form-group row{{ $errors->has('car_name') ? ' has-error' : '' }}">
	                        <label class="col-sm-3 col-form-label">Car Name</label>
	                        <div class="col-sm-9">
	                          <input class="form-control" placeholder="Car Name" name="car_name" value="{{ $car->car_name }}">
	                          <span class="text-danger">{{$errors->first('car_name')}}</span>
	                        </div>
	                      </div>
	                    </div>
                  	</div>
                  	<div class="row">
	                    <div class="col-md-6 ">
	                      <div class="form-group row {{ $errors->has('car_image') ? ' has-error' : '' }}">
	                        <label class="col-sm-3 col-form-label">Choose Image</label>
	                        <div class="col-sm-9">
	                          <input type="file" name="car_image"class="form-control file-upload-info" placeholder="Upload Image" onchange="readURL(this);">
	                          <span class="text-danger">{{$errors->first('car_image')}}</span>
	                        </div>
	                      </div>
	                    </div>
	                    <div class="col-md-6">
	                      <div class="form-group row {{ $errors->has('car_price') ? ' has-error' : '' }}">
	                        <label class="col-sm-3 col-form-label">Car Price</label>
	                        <div class="col-sm-9">
	                          <input type="text" class="form-control"  name="car_price" placeholder="Car Price" value="{{ $car->car_price }}">
	                          <span class="text-danger">{{$errors->first('car_price')}}</span>
	                        </div>
	                      </div>
	                    </div>
                  	</div>

                  	<div class="row">
                  		<div class="col-md-5 pull-right">
                  			@if(file_exists( public_path().'/assets/car/'.$car->car_image))

		                        <img src="{{asset('assets/car/'.$car->car_image)}}" alt="demo" id="demoCarImg" >

		                    @else

		                        <img src="{{asset('assets/profile/no-image.png')}}" alt="demo" id="demoCarImg" >

		                    @endif
                  		</div>
                  		<div class="col-md-7 pull-right">
                  			<input type="submit" class="btn btn-outline-success btn-lg" name="submit" value="Update Car">
                  		</div>
                  	</div>                  	
                </form>
              	</div>
            </div>
        </div>	
	</div>
	<style type="text/css">
		#demoCarImg{
			height:100px;
			width:100px;
			border:1px solid #123;
			border-radius: 5px;
		}
		
	</style>
	<script type="text/javascript">
		function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#demoCarImg')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
	</script>
    <!-- partial -->       
@include('admin.layouts.common.footer')

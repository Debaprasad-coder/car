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
								<li><a href="{{route('cars.index')}}">Car</a>
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
				<div class="col-md-12">
					
				</div>
			</div>
			<!-- Page Title Header Ends-->
			<div class="row">
				
			</div>
			<!-- {{!!$cars!!}} -->
			@if(Session::get('status'))
                <div class="alert alert-success" role="alert">
                  <b>{{Session::get('status')}}<b>
                </div>
            @endif
			<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title pull-right">Car List</h4> 
                    <a href="{{route('cars.create')}}" class="pull-left">                    	
                    	<button type="button" class="btn btn-sm btn-success">ADD Car</button>
                    </a>  
                    
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> Sl </th>
                          <th> Car Image </th>
                          <th> Car name </th>
                          <th> Car Brand </th>
                          <th> Car Price </th>
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
	                        $i=1;	                       
                   		@endphp
                        @foreach($cars as $car)
                        	<tr>
                        		<td> {{$i}} </td>
	                          	<td class="py-1">
	                            	<img src="{{URL('assets/car')}}/{{$car->car_image}}" alt="image">
	                        	</td>
	                          	<td> {{$car['car_name']}} </td>
	                          	<td>{{$car['car_brand']}}</td>
	                          	<td> {{$car['car_price']}} </td>	                         
	                          	<td> 
	                          		<a href="javascript:void(0);">
			                    		<button type="button" class="btn btn-xs btn-outline-primary veiwCar" data-url="{{route('cars.show',$car->id)}}">View</button>
			                    	</a>
			                    	<a href="{{route('cars.edit',$car->id)}}" onclick="return confirm('Are you sure to Edit ??');">
			                    		<button type="button" class="btn btn-xs btn-outline-success">Edit</button>
			                    	</a>
			                    	<!-- <a href="{{route('cars.create')}}">
			                    		<button type="button" class="btn btn-outline-danger">Delete</button>
			                    	</a> -->
			                    	<a href="javascript:void(0);">
			                    		<form action="{{ route('cars.destroy',$car->id) }}" method="POST"
			                    			onsubmit="return confirm('Are you sure to delete ??');">
										    <input type="hidden" name="_method" value="DELETE">
										    <input type="hidden" name="_token" value="{{ csrf_token() }}">
										    <input type="submit" class="btn btn-xs btn-outline-danger" value="Delete">
									</form>
			                    	</a>
			                    	<!-- <a href="javascript:void(0);" onclick="event.preventDefault();
                                             document.getElementById('destroy-form').submit();">
                                    <button type="button" class="btn btn-outline-danger">Delete</button>
                                	</a> 
                                	<form id="destroy-form" action="{{ route('cars.destroy',$car->id) }}" method="POST" style="display: none;">
                                		<input type="hidden" name="_method" value="DELETE">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                	</form> -->
	                          	</td>	                         
	                        </tr> 
	                        @php
		                        $i++;
		                    @endphp 
                        @endforeach
                      </tbody>
                    </table>
                	</br>
                    <div class="row">
                    	<div class="col-md-4">
                    		<mark class="bg-info text-white">Total Records : {{$count}} </mark>
                    	</div>
                    	<div class="col-md-4">
                    		{{ $cars->links() }}
                    	</div>
                    	<div class="col-md-4">
                    		<mark class="bg-warning text-white">Current Page : {{$cars->currentPage()}} </mark>
                    	</div>

                    </div>                    
                    <!-- {!! $cars->render() !!} -->
                   <!--  <div class="row">
                    	<div class="col-md-4 col-md-offset-4">
                    		{{ $cars->links() }}
                    	</div>
                    	
                    </div> -->
                  </div>
                </div>
            </div>
		</div>
	
    <!-- partial -->       
@include('admin.layouts.common.footer')
<style type="text/css">
	.pagination li {
		height:20%;
		width:30%;
		border:1px solid #123;
		background-color: #19d895 ;
		color: #ffffff;
		text-align: center;
		font-size: 15px;
		margin: 0 3px 0 0;
		cursor: not-allowed;
	}	
</style>
<script type="text/javascript">
	$('.veiwCar').click(function(){
		var url = $(this).data('url');
		$.ajax({
				type:'GET',
				url:url,
				//data:{"_token": "{{ csrf_token() }}"},
				success:function(data){           
				console.log(data);
				var html = `<table class="table">                      
                      <tbody>
                      	<tr>
                      		<td>Brand</td>
                      		<td>`+data.car.car_brand+`</td>
                      	</tr>
                      	<tr>
                      		<td>Name</td>
                      		<td>`+data.car.car_name+`</td>
                      	</tr>
                      	<tr>
                      		<td>Image</td>
                      		<td class=""><img src="{{URL('assets/car')}}/{{"`+data.car.car_image+`"}}" alt="image">
                      		</td>
                      	</tr>
                      	<tr>
                      		<td>Price</td>
                      		<td>`+data.car.car_price+`</td>
                      	</tr>
                      	<tr>
                      		<td>Created At</td>
                      		<td>`+data.car.created_at+`</td>
                      	</tr>
                      	<tr>
                      		<td>Updated At</td>
                      		<td>`+data.car.updated_at+`</td>
                      	</tr>                        
                      </tbody>
                    </table>`;
				$(".modal-title").html('Car Information');
				$(".modal-body").html(html);
				$(".modal").modal('show');
				
			}
		});
	});
</script>
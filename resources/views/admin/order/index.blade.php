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
								<li><a href="{{route('admin.order')}}">Order</a>
								</li>
							</ul>
							
						</div>
					</div>
				</div>
				<div class="col-md-12">
					
				</div>
			</div>
			<!-- Page Title Header Ends-->
			<div class="row">
				<?php 
					// echo "<pre>";
					// print_r($orders);
				?>
			</div>
			<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title pull-right">Order List</h4> 
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> Sl </th>
                          <!-- <th> Car Image </th> -->
                          <th> Car name </th>
                          <th> Car Brand </th>
                          <th> Car Price </th>
                          <th> Car Qty </th>
                          <th> Order Price </th>
                          <!-- <th> Order At </th> -->
                          <th> Order Status </th>
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
	                        $i=1;	                       
                   		@endphp
                        @foreach($orders as $order)
                        	<tr>
                        		<td> {{$i}} </td>
	                          	<!-- <td class="py-1">
	                            	<img src="{{URL('assets/car')}}/{{$order->carImg}}" alt="image">
	                        	</td> -->
	                          	<td>{{$order->carName}}</td>
	                          	<td>{{$order->carBrand}}</td>
	                          	<td>{{$order->unitPrice}}</td>
	                          	<td>{{$order->qty}}</td>	                         
	                          	<td>{{$order->totalPrice}}</td>
	                          	<!-- <td>{{$order->oredrAt}}</td> -->
	                          	<td>{{$order->status}}</td>
	                          	<td> 
	                          		<a href="{{route('admin.order')}}/{{$order->id}}">
			                    		<button type="button" class="btn btn-xs btn-outline-success veiwCar" >View</button>
			                    	</a>			                    	
	                          	</td>	                         
	                        </tr> 
	                        @php
		                        $i++;
		                    @endphp 
                        @endforeach
                      </tbody>
                    </table>
                	</br>
                                        
                    
                  </div>
                </div>
            </div>
		</div>
	
    <!-- partial -->       
@include('admin.layouts.common.footer')

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
								<li><a href="{{route('admin.order')}}/{{$orderDetails->id}}">Order Details</a>
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
				<div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"><mark class="bg-success text-white">Shipping Address</mark></h4>                  
                    <table class="table">
                      
                      <tbody> 
	                      <tr>
	                      	<td>Name</td>
	                      	<td>{{$orderDetails->ship_name}}</td>
	                      </tr> 
	                      <tr>
	                      	<td>Email</td>
	                      	<td>{{$orderDetails->ship_email}}</td>
	                      </tr>
	                      <tr>
	                      	<td>Phone</td>
	                      	<td>{{$orderDetails->ship_mobile}}</td>
	                      </tr>
	                      <tr>
	                      	<td>Address</td>
	                      	<td>{{$orderDetails->ship_address}}</td>
	                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"><mark class="bg-primary text-white">Billing Address</mark></h4>
                    <table class="table">                      
                      <tbody>
                      	<tr>
                      		<td>Name</td>
                      		<td>{{$orderDetails->bill_name}}</td>
                      	</tr>
                      	<tr>
                      		<td>Email</td>
                      		<td>{{$orderDetails->bill_email}}</td>
                      	</tr>
                      	<tr>
                      		<td>Phone</td>
                      		<td>{{$orderDetails->bil_mobile}}</td>
                      	</tr>
                      	<tr>
                      		<td>Address</td>
                      		<td>{{$orderDetails->bill_address}}</td>
                      	</tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
			</div>
			<div class="row">
				<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"><mark class="bg-success text-white">Shipping Address</mark></h4>                  
                    <table class="table">
                      
                      <tbody> 
	                      <tr>
	                      	<td>Name</td>
	                      	<td>{{$orderDetails->ship_name}}</td>
	                      </tr> 
	                      <tr>
	                      	<td>Email</td>
	                      	<td>{{$orderDetails->ship_email}}</td>
	                      </tr>
	                      <tr>
	                      	<td>Phone</td>
	                      	<td>{{$orderDetails->ship_mobile}}</td>
	                      </tr>
	                      <tr>
	                      	<td>Address</td>
	                      	<td>{{$orderDetails->ship_address}}</td>
	                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>             
			</div>

		</div>
	
    <!-- partial -->       
@include('admin.layouts.common.footer')

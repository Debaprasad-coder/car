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
								<li><a href="profile">Profile</a>
								</li>								
							</ul>
							
						</div>
					</div>
				</div>
				<div class="col-md-12">
					@if(Session::get('status'))
		                <div class="alert alert-primary" role="alert">
		                  <b>{{Session::get('status')}}<b>
		                </div>
		            @endif
					<div class="card">
		              	<div class="card-body">
		                	<mark class="bg-success text-white">Profile Edit Form</mark>
			                <form class="form-sample" method="POST" action="{{ route('admin.profile') }}/{{Auth::user()->id}}" onsubmit="return confirm('Are you sure to update this information ??');">
			                	{{csrf_field()}}			                	
			                  	<p class="text-primary">Update User Profile </p>
			                  	<div class="row">	                    
				                    <div class="col-md-6">
				                      <div class="form-group row{{ $errors->has('name') ? ' has-error' : '' }}">
				                        <label class="col-sm-3 col-form-label"> Name</label>
				                        <div class="col-sm-9">
				                          <input class="form-control" placeholder="Car Name" name="name" value="{{ $user->name }}">
				                          <span class="text-danger">{{$errors->first('name')}}</span>
				                        </div>
				                      </div>
				                    </div>
				                    <div class="col-md-6">
				                      <div class="form-group row">
				                        <label class="col-sm-3 col-form-label"> Code</label>
				                        <div class="col-sm-9">
				                          <input class="form-control" placeholder="Car Name" name="" value="{{ $user->code }}" disabled="disabled">
				                          
				                        </div>
				                      </div>
				                    </div>
			                  	</div>
			                  	<div class="row">
				                    <div class="col-md-6">
				                      <div class="form-group row{{ $errors->has('email') ? ' has-error' : '' }}">
				                        <label class="col-sm-3 col-form-label"> Email</label>
				                        <div class="col-sm-9">
				                          <input class="form-control" placeholder="Car Name" name="email" value="{{ $user->email }}">
				                          <span class="text-danger">{{$errors->first('email')}}</span>
				                        </div>
				                      </div>
				                    </div>
				                    <div class="col-md-6">
				                      <div class="form-group row{{ $errors->has('phone') ? ' has-error' : '' }}">
				                        <label class="col-sm-3 col-form-label"> Phone</label>
				                        <div class="col-sm-9">
				                          <input class="form-control" placeholder="Car Name" name="phone" value="{{ $user->phone }}">	
				                          <span class="text-danger">{{$errors->first('phone')}}</span>                         
				                        </div>
				                      </div>
				                    </div>
			                  	</div> 
			                  	<div class="row">
			                  		<div class="col-md-6 pull-right">
			                  			
			                  		</div>
			                  		<div class="col-md-6 pull-right">
			                  			<input type="submit" class="btn btn-outline-primary btn-md" name="submit" value="Update">
			                  		</div>
			                  	</div>                     	                  	
			                </form>
		              	</div>
            		</div>
				</div>
			</div>
			<!-- Page Title Header Ends-->
			<div class="row">
				
			</div>
			
		</div>
	
    <!-- partial -->       
@include('admin.layouts.common.footer')

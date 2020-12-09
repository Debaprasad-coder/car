@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">Admin Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('admin/login') }}">
                        {{ csrf_field() }}
                            @if(Session::get('status'))
                                <div class="alert alert-danger" role="alert">
                                  <b>{{Session::get('status')}}<b>
                                </div>
                            @endif
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>                         
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"  autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" >

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
                            <label for="captcha" class="col-md-4 control-label">Solve This Math</label>
                            
                            <div class="col-md-3">
                                <input id="captcha" type="captcha" class="form-control" name="captcha" >

                                @if ($errors->has('captcha'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-5 showCaptcha">
                                <span>{!!captcha_img('math')!!} </span>

                                   <img id="refreshCaptcha" src="{{URL('assets/captcha/captcha.jpg')}}" title="Refresh captcha" alt="Captcha"> 
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('PAGE_JS')

<script type="text/javascript">
    $("#refreshCaptcha").click(function(){
       $.ajax({
         type:'POST',
         url: "{{url("refreshcaptcha")}}",
         data:{"_token": "{{ csrf_token() }}"},
         success:function(data){           
            console.log(data.captcha);
            $('.showCaptcha span').html(data.captcha);
         }
      });
    });
   
</script>
@endpush
@push('PAGE_CSS')
<style type="text/css">
    #refreshCaptcha{
        height:40px;
        width:40px;
    }
</style>
@endpush

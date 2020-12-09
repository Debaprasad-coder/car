<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Car') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <style>
.footer {
  position: relative;
  left: 0;
  bottom: -5px;
  width: 100%;
  padding: 10px;
  background-color: #e7e7e7;
  color: #123;
  text-align: center;
}
</style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Car') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                            <li>
                                @php
                                    $cartTotal = !empty(Session::get('cart'))?count(Session::get('cart')):null;
                                @endphp
                                <a href="{{route('cart.viewCart')}}" >
                                    <button type="button" class="btn btn-sm btn-default">
                                        Cart
                                        @if($cartTotal > 0)
                                            <span class="badge">{{$cartTotal}}</span>
                                        @endif
                                    </button>
                                </a>
                            </li>
                        @else
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }}[{{Auth::user()->role}}]
                                </a>                                
                            </li>
                            <li class="dropdown">                                
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>                                    
                            </li>
                            <li>
                                @php
                                    $cartTotal = !empty(Session::get('cart'))?count(Session::get('cart')):null;
                                @endphp
                                <a href="{{route('cart.viewCart')}}" >
                                    <button type="button" class="btn btn-sm btn-default">
                                        Cart
                                        @if($cartTotal > 0)
                                            <span class="badge">{{$cartTotal}}</span>
                                        @endif
                                    </button>
                                </a>
                            </li>
                            <li>                               
                                <a href="{{route('order')}}" >
                                    <button type="button" class="btn btn-sm btn-info">
                                        Order                                        
                                    </button>
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

</body>
<div class="footer">
    <h4> Car :- {{date('l jS \of F Y H:i:s A')}}</h4>
</div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
   <!--  -->
   @stack('PAGE_JS')
   @stack('PAGE_CSS')
</html>

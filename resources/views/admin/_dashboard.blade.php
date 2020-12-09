@extends('admin.layouts.app')

@section('content')
<div class="container">

   <h1> This is Admin Dashboard </h1>
   
</div>
@push('PAGE_CSS')
<style type="text/css">
  .cart-table thead{
    background-color: #009688;
    color: #f5efef;
  }
  .cart-table tbody tr:last-child{
    background-color: #009688;
    color: #f5efef;
  }
</style>
@endpush
@endsection
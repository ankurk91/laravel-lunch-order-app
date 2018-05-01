@extends('_layouts.app')

@section('pageTitle','Home')

@section('content')

  @include('alert::bootstrap')

  <div class="my-5 text-center">
    <i class="fas fa-8x fa-utensils"></i>
    <h1 class="display-1 mt-2">{{config('app.name')}}</h1>
    <h5 class="text-muted font-weight-light">Lunch orders made easy.</h5>
    <a class="btn btn-primary btn-lg mt-3" href="{{route('shop.index')}}">
      <i class="fa fa-cart-plus"></i>
      Place your order for today
    </a>
  </div>

@endsection

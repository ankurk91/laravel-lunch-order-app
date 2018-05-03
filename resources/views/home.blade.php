@extends('_layouts.app')

@section('pageTitle','Home')

@section('content')

  @include('alert::bootstrap')

  <section class="my-5 text-center">
    <i class="fas fa-8x fa-utensils"></i>
    <h1 class="display-1 mt-2">{{config('app.name')}}</h1>
    <h5 class="text-muted font-weight-light">Lunch orders made easy.</h5>
    <a class="btn btn-primary btn-lg mt-3" href="{{route('shop.index')}}">
      <i class="fa fa-cart-plus"></i>
      Place your order for today
    </a>
  </section>

  <div class="text-center">
    <h3 class="font-weight-light">Covers all features you need.</h3>
  </div>
  <hr>
  <section class="row">
    <div class="col-md-3 text-center">
      <i class="fas fa-6x fa-calendar-check text-muted"></i>
      <h5 class="mt-3 mb-0 font-weight-light">Monthly invoice</h5>
    </div>
    <div class="col-md-3 text-center mt-sm-0 mt-lg-0 mt-4">
      <i class="fas fa-6x fa-rupee-sign text-muted"></i>
      <h5 class="mt-3 mb-0 font-weight-light">Track payments</h5>
    </div>
    <div class="col-md-3 text-center mt-sm-0 mt-lg-0 mt-4">
      <i class="fas fa-6x fa-envelope-open text-muted"></i>
      <h5 class="mt-3 mb-0 font-weight-light">Email notifications</h5>
    </div>
    <div class="col-md-3 text-center mt-sm-0 mt-lg-0 mt-4">
      <i class="fas fa-6x fa-hand-peace text-muted"></i>
      <h5 class="mt-3 mb-0 font-weight-light">Self management</h5>
    </div>
  </section>

@endsection

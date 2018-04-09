@extends('_layouts.app')

@section('pageTitle','Orders')

@section('content')
  <section class="row d-flex">
    <div class="col">
      @component('components.breadcrumb')
        Orders
      @endcomponent
    </div>
    <div class="col pt-1 text-right">
      <ul class="nav justify-content-end">
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.orders.create')}}">
            <i class="fas fa-cart-plus"></i> Add new order
          </a>
        </li>
      </ul>
    </div>
  </section>

  @include('alert::bootstrap')
@endsection()

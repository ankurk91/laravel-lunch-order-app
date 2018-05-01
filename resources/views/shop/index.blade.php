@extends('_layouts.app')

@section('pageTitle','Shop')

@section('content')
  @component('components.breadcrumb')
    Shop
  @endcomponent

  <div class="row">
    <div class="col-md-7 mb-sm-0 mb-lg-0 mb-4">
      @include('alert::bootstrap')

      @isset($order)
        @if($order->status === 'cancelled')
          @include('shop._restore')
        @else
          @include('shop._edit')
          @include('shop._cancel')
        @endif
      @else
        @include('shop._create')
      @endisset

    </div>

    @include('shop._sidebar')
  </div>

@endsection

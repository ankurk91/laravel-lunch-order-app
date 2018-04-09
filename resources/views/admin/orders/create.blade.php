@extends('_layouts.app')

@section('pageTitle','Create order')

@section('content')
  @component('components.breadcrumb',[
    'links' => [
      'orders' => route('admin.orders.index')
    ]
  ])
    Create order
  @endcomponent

  @include('alert::bootstrap')
@endsection()

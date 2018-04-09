@extends('_layouts.app')

@section('pageTitle','Edit order')

@section('content')
  @component('components.breadcrumb',[
    'links' => [
      'orders' => route('admin.orders.index')
    ]
  ])
    Edit order
  @endcomponent

  @include('alert::bootstrap')
@endsection()

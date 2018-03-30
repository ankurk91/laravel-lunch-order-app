@extends('_layouts.app')

@section('pageTitle','503')

@section('content')
  @component('components.error-page',[
  'errorCode' => '503',
  'errorHeading' => config('app.name').' is down for maintenance!',
  'actionUrl' => request()->url(),
  'actionLabel' => 'Retry'
  ])
    We are performing a scheduled maintenance. We should be back online shortly.
  @endComponent
@endsection

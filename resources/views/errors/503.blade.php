@extends('_layouts.app')

@section('pageTitle','503')

@section('content')
  @component('components.errorPage',[
  'errorCode' => '503',
  'errorHeading' => 'Application is down for maintenance.',
  'actionUrl' => request()->url(),
  'actionLabel' => 'Retry'
  ])
    We are performing a scheduled maintenance. We should be back online shortly.
  @endComponent
@endsection

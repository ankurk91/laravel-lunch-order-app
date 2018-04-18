@extends('_layouts.app')

@section('pageTitle','429')

@section('content')
  @component('components.errorPage',[
  'errorCode' => '429',
  'errorHeading' => 'Too many requests',
  'actionUrl' => request()->url(),
  'actionLabel' => 'Retry'
  ])
    You have made too many requests.<br>
    Please wait for sometime and try again.
  @endComponent
@endsection

@extends('_layouts.app')

@section('pageTitle','400')

@section('content')
  @component('components.errorPage',[
  'errorCode' => '400',
  'errorHeading' => 'Bad Request',
  'actionUrl' => url('/'),
  'actionLabel' => 'Back to home page'
  ])
    Your browser did something wrong. Please try again.
  @endComponent
@endsection

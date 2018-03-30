@extends('_layouts.app')

@section('pageTitle','404')

@section('content')
  @component('components.error-page',[
  'errorCode' => '404',
  'errorHeading' => 'Page not found'
  ])
    The page you are looking for can't be found.
  @endComponent
@endsection

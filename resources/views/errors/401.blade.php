@extends('_layouts.app')

@section('pageTitle','401')

@section('content')
  @component('components.errorPage',[
  'errorCode' => '401',
  'errorHeading' => 'Unauthorised',
  'actionUrl' => url()->previous(),
  'actionLabel' => 'Back to previous page'
  ])
    @empty($exception->getMessage())
      Sorry, you are not authorized to access this page.
    @else
      {{$exception->getMessage()}}
    @endempty
  @endComponent
@endsection

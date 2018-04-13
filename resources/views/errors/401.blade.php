@extends('_layouts.app')

@section('pageTitle','401')

@section('content')
  @component('components.errorPage',[
  'errorCode' => '401',
  'errorHeading' => 'Unauthorised',
  'actionUrl' => url()->previous(),
  'actionLabel' => 'Back to previous page'
  ])
    You are not authorised to perform this action.
  @endComponent
@endsection

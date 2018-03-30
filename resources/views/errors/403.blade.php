@extends('_layouts.app')

@section('pageTitle','403')

@section('content')
  @component('components.error-page',[
  'errorCode' => '403',
  'errorHeading' => 'Forbidden',
  'actionUrl' => url()->previous(),
  'actionLabel' => 'Back to previous page'
  ])
    You are not authorised to perform this action.
  @endComponent
@endsection

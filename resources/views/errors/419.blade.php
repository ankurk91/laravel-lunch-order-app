@extends('_layouts.app')

@section('pageTitle','419')

@section('content')
  @component('components.error-page',[
  'errorCode' => '419',
  'errorHeading' => 'Page expired',
  'actionUrl' => url()->previous(),
  'actionLabel' => 'Back to previous page'
  ])
    The page has expired due to inactivity.<br>
    Please refresh and try again.
  @endComponent
@endsection

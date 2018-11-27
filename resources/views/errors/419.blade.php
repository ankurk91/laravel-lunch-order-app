@extends('_layouts.app')

@section('pageTitle','419')

@section('content')
  @component('components.errorPage',[
  'errorCode' => '419',
  'errorHeading' => 'Page expired',
  'actionUrl' => url()->previous(),
  'actionLabel' => 'Back to previous page'
  ])
    Sorry, the page has expired due to inactivity.<br>
    Please refresh and try again.
  @endComponent
@endsection

@extends('_layouts.app')

@section('pageTitle','500')

@section('content')
  @component('components.errorPage',[
  'errorCode' => '500',
  'errorHeading' => 'Looks like something went wrong!',
  'actionUrl' => request()->url(),
  'actionLabel' => 'Retry'
  ])
    We track these errors automatically, but if the problem persists feel free to contact us. In the meantime, try
    refreshing.
  @endComponent
@endsection

@extends('_layouts.app')

@section('pageTitle','503')

@section('content')
  @component('components.errorPage',[
  'errorCode' => '503',
  'errorHeading' => 'Application is down for maintenance.',
  'actionUrl' => request()->url(),
  'actionLabel' => 'Retry'
  ])

    @empty(optional($exception)->getMessage())
      We are performing a scheduled maintenance. <br>We should be back online shortly.
    @else
      {{optional($exception)->getMessage()}}
    @endempty

  @endComponent
@endsection

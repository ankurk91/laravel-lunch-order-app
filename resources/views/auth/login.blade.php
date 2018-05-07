@extends('_layouts.app')
@section('pageTitle','Log in')

@section('content')

  @component('components.breadcrumb')
    Log in
  @endcomponent

  @include('alert::bootstrap')

  <div class="row">
    <section class="col-sm-5 order-sm-first order-lg-last">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Log in to your account</h5>
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
              <label for="email">E-mail address</label>
              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                     name="email" value="{{ old('email') }}" required autofocus placeholder="E-mail">

              @if ($errors->has('email'))
                <div class="invalid-feedback">
                  {{ $errors->first('email') }}
                </div>
              @endif
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <input id="password" type="password"
                     class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                     name="password" required placeholder="Password">

              @if ($errors->has('password'))
                <div class="invalid-feedback">
                  {{ $errors->first('password') }}
                </div>
              @endif
            </div>

            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="remember"
                       {{ old('remember') ? 'checked' : '' }} class="custom-control-input" id="input-remember">
                <label class="custom-control-label" for="input-remember">Remember me</label>
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-sign-in-alt"></i> Log in
              </button>
            </div>
            <div class="form-group mb-0">
              <a href="{{route('oauth.login','google')}}" class="btn btn-light btn-block border-dark">
                <img class="d-inline-block align-text-bottom" src="{{asset('img/google-logo.svg')}}" height="18" width="18" alt="g">
                <span class="label">&ensp;Log in with Google</span>
              </a>
            </div>
          </form>
        </div>
      </div>
      <div class="text-center">
        <a class="btn btn-link" href="{{ route('password.request') }}">
          Forgot your password?
        </a>
      </div>
    </section>

    @include('auth._sidebar')
  </div>

@endsection

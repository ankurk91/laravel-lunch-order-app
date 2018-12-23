@extends('_layouts.app')
@section('pageTitle','Reset password')

@section('content')

  @component('components.breadcrumb')
    Reset password
  @endcomponent

  <div class="row justify-content-center">
    <div class="col-md-5">

      @include('alert::bootstrap')

      <div class="card">

        <div class="card-body">
          <h5 class="card-title">Reset your password</h5>
          <h6 class="card-subtitle text-muted">You need to provide your registered e-mail address.</h6>

          <form class="mt-2" method="POST" action="{{ route('password.request') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
              <label for="email"> E-mail address</label>

              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                     name="email" value="{{ $email or old('email') }}" placeholder="E-mail" required autofocus>

              @if ($errors->has('email'))
                <div class="invalid-feedback">
                  {{ $errors->first('email') }}
                </div>
              @endif

            </div>

            <div class="form-group">
              <label for="password">New password</label>

              <input id="password" type="password"
                     class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                     placeholder="New password" required>

              @if ($errors->has('password'))
                <div class="invalid-feedback">
                  {{ $errors->first('password') }}
                </div>
              @endif

            </div>

            <div class="form-group">
              <label for="password-confirm">Confirm new password</label>

              <input id="password-confirm" type="password"
                     class="form-control"
                     name="password_confirmation" placeholder="Confirm new password" required>
            </div>

            <div class="form-group mb-0">
              <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-check"></i> Reset password
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="text-center">
        <a class="btn btn-link" href="{{ route('login') }}">
          Back to Log in
        </a>
      </div>
    </div>
  </div>

@endsection

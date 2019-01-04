@extends('_layouts.app')
@section('pageTitle','Security')

@section('content')

  @component('components.breadcrumb',[
  'links'=>[
    'profile'=> route('account.edit')
  ]])
    Security
  @endcomponent

  @include('alert::bootstrap')

  <div class="row">

    @include('account._sidebar')

    <div class="col-md-8">
      <form method="POST" action="{{ route('account.password.update') }}">
        @csrf
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Change your password</h5>

            <div class="form-group">
              <label for="current_password">Current password</label>

              <input id="current_password" type="password"
                     class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}"
                     name="current_password"
                     placeholder="Current password" required autofocus>

              @if ($errors->has('current_password'))
                <div class="invalid-feedback">
                  {{ $errors->first('current_password') }}
                </div>
              @else
                <small class="form-text text-muted">You must provide your current password in order to change it.
                </small>
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

            <div class="form-group mb-0">
              <label for="password-confirm">Confirm new password</label>

              <input id="password-confirm" type="password"
                     class="form-control"
                     name="password_confirmation" placeholder="Confirm new password" required>
            </div>

          </div>
          <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-key"></i> Change password
            </button>
          </div>
        </div>
      </form>

      <form onsubmit="return confirm('Are you sure?')" action="{{route('account.actions.passwordResetEmail')}}"
            method="POST">
        @csrf
        <div class="card mt-4">
          <div class="card-body">
            <h5 class="card-title">Send password reset e-mail</h5>
            <p class="card-text font-weight-light">
              An email with password reset instructions will be send to your e-mail address.
            </p>
          </div>
          <div class="card-footer text-right">
            <button type="submit" class="btn btn-outline-primary"><i class="fas fa-envelope"></i> Send password reset
              e-mail
            </button>
          </div>
        </div>
      </form>

      <form onsubmit="return confirm('Are you sure?')" action="{{route('account.actions.logoutOtherDevices')}}"
            method="POST">
        @csrf
        <div class="card mt-4">
          <div class="card-body">
            <h5 class="card-title">Log out from other devices</h5>
            <p class="card-text font-weight-light">
              <i class="fas fa-exclamation-triangle"></i> You will be logged-out from all of
              your active devices except current.
            </p>
            <div class="form-group mb-0 required">
              <label for="current_password-2">Current password</label>
              <input id="current_password-2" type="password"
                     class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}"
                     name="current_password"
                     placeholder="Current password" required>

              @if ($errors->has('current_password'))
                <div class="invalid-feedback">
                  {{ $errors->first('current_password') }}
                </div>
              @endif
            </div>
          </div>
          <div class="card-footer text-right">
            <button type="submit" class="btn btn-outline-danger"><i class="fas fa-sign-out-alt"></i> Log out</button>
          </div>
        </div>
      </form>
    </div>
  </div>

@endsection

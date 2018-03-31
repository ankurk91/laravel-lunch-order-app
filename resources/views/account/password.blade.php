@extends('_layouts.app')
@section('pageTitle','Change Password')

@section('content')

  @component('components.breadcrumb')
    Change Password
  @endcomponent

  @include('alert::bootstrap')

  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">

        <div class="card-body">
          <h5 class="card-title">{{auth()->user()->has_null_password ? 'Set new' : 'Change your'}} password</h5>

          <form method="POST" action="{{ route('account.password.update') }}">
            @csrf
            @if(!auth()->user()->has_null_password)
              <div class="form-group">
                <label for="current_password">Current Password</label>

                <input id="current_password" type="password"
                       class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}"
                       name="current_password"
                       placeholder="Current Password" required>

                @if ($errors->has('current_password'))
                  <div class="invalid-feedback">
                    {{ $errors->first('current_password') }}
                  </div>
                @endif
              </div>
            @endif

            <div class="form-group">
              <label for="password">New Password</label>

              <input id="password" type="password"
                     class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                     placeholder="Password" required>

              @if ($errors->has('password'))
                <div class="invalid-feedback">
                  {{ $errors->first('password') }}
                </div>
              @endif
            </div>

            <div class="form-group">
              <label for="password-confirm">Confirm New Password</label>

              <input id="password-confirm" type="password"
                     class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                     name="password_confirmation" placeholder="Confirm Password" required>

              @if ($errors->has('password_confirmation'))
                <div class="invalid-feedback">
                  {{ $errors->first('password_confirmation') }}
                </div>
              @endif
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-key"></i> {{auth()->user()->has_null_password ? 'Set new' : 'Change'}} Password
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="text-center">
        <a class="btn btn-link" href="{{ route('account.edit') }}">
          Back to profile
        </a>
      </div>
    </div>
  </div>

@endsection

@extends('_layouts.app')
@section('pageTitle','Login')

@section('content')

  @component('components.breadcrumb')
    Login
  @endcomponent

  @include('alert::bootstrap')

  <div class="row">
    <section class="col-sm-5 order-sm-first order-lg-last">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Login to your account</h5>
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
              <label for="email">E-Mail address</label>
              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                     name="email" value="{{ old('email') }}" required autofocus placeholder="Email">

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
                       {{ old('remember') ? 'checked' : '' }} class="custom-control-input" id="check-remember">
                <label class="custom-control-label" for="check-remember">Remember me</label>
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-sign-in-alt"></i> Login
              </button>
            </div>
            <div class="form-group mb-0">
              <a href="{{route('oauth.login','google')}}" class="btn btn-danger btn-block">
                <i class="fab fa-google"></i> Login with Google
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

    <aside class="col-sm-7 order-sm-last order-lg-first mt-sm-0 mt-lg-0 mt-3">
      <div class="jumbotron pt-4">
        <h1 class="display-4">Hello, there!</h1>
        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to
          featured content or information.</p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
      </div>
    </aside>
  </div>

@endsection

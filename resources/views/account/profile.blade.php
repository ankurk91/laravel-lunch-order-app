@extends('_layouts.app')

@section('pageTitle','Profile')

@section('content')

  <section class="row d-flex">
    <div class="col">
      @component('components.breadcrumb')
        Profile
      @endcomponent
    </div>
    <div class="col text-right">
      <div class="mt-2">
        <a class="small text-muted" href="{{route('account.password.edit')}}">Change password</a>
      </div>
    </div>
  </section>

  @include('alert::bootstrap')

  <section class="row">
    <aside class="col-md-4">
      <div class="card">
        <div class="card-body text-center">
          @if(optional($profile)->avatar)
            <img class="rounded-circle" src="{{$profile->avatar}}?sz=200" alt="avatar" height="200">
          @else
            <i class="fas fa-8x fa-user-circle text-muted"></i>
          @endif
          <p class="h6 my-3">{{$user->email}}</p>
          <p class="text-capitalize">{{implode(', ',$roles)}}</p>
        </div>
      </div>
    </aside>

    <section class="col-md-8 mt-sm-0 mt-lg-0 mt-3">
      <form method="POST" action="{{ route('account.update') }}">
        @csrf
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit your profile</h5>
            <div class="form-group">
              <label for="email">E-Mail Address</label>
              <input id="email" type="email" class="form-control"
                     name="email" value="{{ $user->email }}" disabled>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group required">
                  <label for="first_name">First name</label>
                  <input id="first_name" type="text"
                         class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                         name="first_name"
                         placeholder="First name"
                         value="{{old('first_name', optional($profile)->first_name)}}"
                         required autofocus>

                  @if ($errors->has('first_name'))
                    <div class="invalid-feedback">
                      {{ $errors->first('first_name') }}
                    </div>
                  @endif
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="last_name">Last name</label>
                  <input id="last_name" type="text"
                         class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                         name="last_name" placeholder="Last name"
                         value="{{old('last_name', optional($profile)->last_name)}}">

                  @if ($errors->has('last_name'))
                    <div class="invalid-feedback">
                      {{ $errors->first('last_name') }}
                    </div>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="primary_phone">Primary phone</label>
              <input id="primary_phone" type="tel"
                     class="form-control{{ $errors->has('primary_phone') ? ' is-invalid' : '' }}"
                     name="primary_phone" placeholder="Primary phone"
                     value="{{old('primary_phone', optional($profile)->primary_phone)}}">

              @if ($errors->has('primary_phone'))
                <div class="invalid-feedback">
                  {{ $errors->first('primary_phone') }}
                </div>
              @endif
            </div>
          </div>
          <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Update</button>
          </div>
        </div>
      </form>

      <form onsubmit="return confirm('Are you sure?')" action="{{route('account.actions.logout-other-devices')}}"
            method="POST">
        @csrf
        <div class="card mt-4">
          <div class="card-body">
            <h5 class="card-title">Logout from other devices</h5>
            <p class="card-text small font-weight-light">
              <i class="fas fa-exclamation-triangle"></i> You will be logged-out from all of
              your active devices except current.
            </p>
            <div class="form-group required">
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
          </div>
          <div class="card-footer text-right">
            <button type="submit" class="btn btn-outline-danger"><i class="fas fa-sign-out-alt"></i> Sign-out</button>
          </div>
        </div>
      </form>
    </section>
  </section>
@endsection

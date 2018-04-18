@extends('_layouts.app')

@section('pageTitle','Profile')

@section('content')

  @component('components.breadcrumb')
    Profile
  @endcomponent

  @include('alert::bootstrap')

  <section class="row">
    @include('account._sidebar')

    <section class="col-md-8">
      <form method="POST" action="{{ route('account.update') }}">
        @csrf
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit your profile</h5>
            <div class="form-group">
              <label for="email">E-Mail address</label>
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
                         value="{{old('first_name', $user->profile->first_name)}}"
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
                         value="{{old('last_name', $user->profile->last_name)}}">

                  @if ($errors->has('last_name'))
                    <div class="invalid-feedback">
                      {{ $errors->first('last_name') }}
                    </div>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group mb-0">
              <label for="primary_phone">Primary phone</label>
              <input id="primary_phone" type="tel"
                     class="form-control{{ $errors->has('primary_phone') ? ' is-invalid' : '' }}"
                     name="primary_phone" placeholder="Primary phone"
                     value="{{old('primary_phone', $user->profile->primary_phone)}}">

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

    </section>
  </section>
@endsection

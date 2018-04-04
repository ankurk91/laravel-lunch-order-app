@extends('_layouts.app')

@section('pageTitle','Create user')

@section('content')
  @component('components.breadcrumb')
    Create user
  @endcomponent

  @include('alert::bootstrap')

  <div class="row">
    <div class="col-md-12">
      <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Create new user</h5>
            <div class="form-group">
              <label for="email">E-Mail address</label>
              <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                     name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>

              @if ($errors->has('email'))
                <div class="invalid-feedback">
                  {{ $errors->first('email') }}
                </div>
              @endif
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group required">
                  <label for="first_name">First name</label>
                  <input id="first_name" type="text"
                         class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                         name="first_name"
                         placeholder="First name"
                         value="{{old('first_name')}}"
                         required>

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
                         value="{{old('last_name')}}">

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
                     value="{{old('primary_phone')}}">

              @if ($errors->has('primary_phone'))
                <div class="invalid-feedback">
                  {{ $errors->first('primary_phone') }}
                </div>
              @endif
            </div>

            <div class="form-group required">
              <label>Select roles</label>
              @foreach($availableRoles as $role)
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" name="roles[]"
                         id="check-role-{{$role->id}}"
                         value="{{$role->id}}"
                         @if(in_array($role->id,old('roles',[]))) checked @endif>
                  <label class="custom-control-label text-capitalize"
                         for="check-role-{{$role->id}}">{{$role->name}}</label>
                </div>
              @endforeach

              @if ($errors->has('roles'))
                <div class="invalid-feedback d-block">
                  {{ $errors->first('roles') }}
                </div>
              @endif
            </div>
          </div>
          <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Create</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

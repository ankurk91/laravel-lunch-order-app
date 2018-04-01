@extends('_layouts.app')

@section('pageTitle','Edit User')

@section('content')
  @component('components.breadcrumb')
    Edit User
  @endcomponent

  @include('alert::bootstrap')

  <div class="row">
    <aside class="col-md-4">
      <div class="card">
        <div class="card-body text-center">
          @if(optional($user->profile)->avatar)
            <img class="rounded-circle" src="{{$user->profile->avatar}}?sz=200" alt="avatar" height="200">
          @else
            <i class="fas fa-8x fa-user-circle text-muted"></i>
          @endif
          <p class="h6 my-3">{{$user->email}}</p>
          <p class="text-capitalize">{{implode(', ',$user->roles->pluck('name')->toArray())}}</p>
        </div>
      </div>
    </aside>

    <section class="col-md-8 mt-sm-0 mt-lg-0 mt-3">
      <form method="POST" action="{{ route('admin.users.update',$user->id) }}">
        @csrf
        @method('PUT')
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit user profile</h5>
            <div class="form-group">
              <label for="email">E-Mail Address</label>
              <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                     name="email" placeholder="Email" value="{{ old('email',$user->email) }}" disabled>

              @if ($errors->has('email'))
                <div class="invalid-feedback">
                  {{ $errors->first('email') }}
                </div>
              @endif
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="first_name">First name</label>
                  <input id="first_name" type="text"
                         class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                         name="first_name"
                         placeholder="First name"
                         value="{{old('first_name', optional($user->profile)->first_name)}}"
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
                         value="{{old('last_name', optional($user->profile)->last_name)}}">

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
                     value="{{old('primary_phone', optional($user->profile)->primary_phone)}}">

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

      <form method="POST" action="{{route('admin.users.update-roles',$user->id)}}">
        @csrf
        <div class="card mt-4">
          <div class="card-body">
            <h5 class="card-title">Edit user roles</h5>
            <div class="form-group">
              <label>Select roles</label>
              @foreach($availableRoles as $role)
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" name="roles[]"
                         id="check-role-{{$role->id}}"
                         value="{{$role->id}}"
                         @if($user->roles->contains('id',$role->id)) checked @endif>
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
            <button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Update</button>
          </div>
        </div>
      </form>
    </section>
  </div>
@endsection

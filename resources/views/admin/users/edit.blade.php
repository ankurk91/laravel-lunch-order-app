@extends('_layouts.app')

@section('pageTitle','Edit user')

@section('content')
  @component('components.breadcrumb',[
    'links' => [
      'users' => route('admin.users.index')
    ]
  ])
    Edit user
  @endcomponent

  @include('alert::bootstrap')

  <div class="row">
    <aside class="col-md-4">
      <div class="card">
        <div class="card-body text-center">
          @if($user->profile->avatar)
            <a href="{{$user->profile->avatar}}" target="_blank">
              <img class="rounded-circle border" src="{{$user->profile->avatar}}?sz=200" alt="avatar" height="200">
              <span class="sr-only">View large image</span>
            </a>
          @else
            <i class="fas fa-8x fa-user-circle text-muted"></i>
          @endif
          <p class="h5 my-3 text-nowrap">{{$user->email}}</p>
          <p class="text-capitalize">{{implode(', ',$user->getRoleNames()->toArray())}}</p>
          <p class="small text-muted mb-0">
            Member since -
            @datetime($user->created_at)
          </p>
        </div>
      </div>
    </aside>

    <section class="col-md-8 mt-sm-0 mt-lg-0 mt-4">
      <form method="POST" action="{{ route('admin.users.update',$user) }}">
        @csrf
        @method('PUT')
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit user profile</h5>
            <div class="form-group">
              <label for="email">E-Mail address</label>
              <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                     name="email" placeholder="E-Mail" value="{{ old('email',$user->email) }}" disabled>

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
            <button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Update profile</button>
          </div>
        </div>
      </form>

      <form method="POST" action="{{route('admin.users.update-roles',$user)}}">
        @csrf
        @method('patch')
        <div class="card mt-4">
          <div class="card-body">
            <h5 class="card-title">Edit user roles</h5>
            <div class="form-group required">
              <label>Select roles</label>
              @foreach($availableRoles as $role)
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" name="roles[]"
                         id="input-role-{{$role->id}}"
                         value="{{$role->id}}"
                         @if($user->roles->contains('id',$role->id)) checked @endif>
                  <label class="custom-control-label text-capitalize"
                         for="input-role-{{$role->id}}">{{$role->name}}</label>
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
            <button type="submit" class="btn btn-primary"><i class="fas fa-wrench"></i> Update roles</button>
          </div>
        </div>
      </form>

      <form action="{{route('admin.users.password-reset-email',$user)}}"
            method="POST">
        @csrf

        <div class="card mt-4">
          <div class="card-body">
            <h5 class="card-title">Send password reset email</h5>
            <p class="card-text font-weight-light">
              User will receive an email with password reset link.
            </p>
          </div>
          <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary"><i class="fas fa-envelope"></i> Send password reset email
            </button>
          </div>
        </div>
      </form>

      <form onsubmit="return confirm('Are you sure?')"
            action="{{route('admin.users.toggle-block',$user)}}"
            method="POST">
        @csrf
        @method('patch')
        <div class="card mt-4">
          <div class="card-body">
            <h5 class="card-title">Block/unblock user</h5>
            <p class="card-text font-weight-light">
              When blocked; User will be logged out of all active devices and will not be allowed to log in back.
            </p>
          </div>
          <div class="card-footer text-right">
            @if($user->is_blocked)
              <span class="text-muted mr-3">
                Blocked
                @timeago($user->blocked_at)
              </span>
              <button type="submit" class="btn btn-success"><i class="fas fa-lock-open"></i> Unblock</button>
            @else
              <button type="submit" class="btn btn-warning"><i class="fas fa-lock"></i> Block</button>
            @endif
          </div>
        </div>
      </form>

      @include('admin.users._delete')
    </section>
  </div>
@endsection

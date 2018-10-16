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

      @include('admin.users._updateRoles')
      @include('admin.users._resetPasswordEmail')
      @include('admin.users._updateBlockStatus')
      @include('admin.users._delete')
    </section>
  </div>
@endsection

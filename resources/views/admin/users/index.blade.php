@extends('_layouts.app')

@section('pageTitle','Users')

@section('content')

  <section class="row d-flex">
    <div class="col">
      @component('components.breadcrumb')
        Users
      @endcomponent
    </div>
    <div class="col pt-1 text-right">
      <ul class="nav justify-content-end">
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.users.create')}}">
            <i class="fas fa-user-plus"></i> Add new user
          </a>
        </li>
      </ul>
    </div>
  </section>

  @include('alert::bootstrap')

  <section class="card mb-3">
    <div class="card-body">
      <form id="search-form" class="form-inline" method="GET"
            action="{{route('admin.users.index')}}">

        <select class="form-control mb-2 mb-sm-0 mr-sm-2" name="per_page">
          <option disabled>Per page</option>
          @foreach([10,30,50] as $n)
            <option value="{{$n}}" @if(request('per_page') == $n) selected @endif>{{$n}}</option>
          @endforeach
        </select>

        <select class="form-control mb-2 mb-sm-0 mx-sm-2 text-capitalize" name="active_status">
          <option disabled>Status</option>
          @foreach(['active','blocked','all'] as $status)
            <option value="{{$status}}"
                    @if(request('active_status','active') === $status) selected @endif>{{$status}}</option>
          @endforeach
        </select>

        <select class="form-control mb-2 mb-sm-0 mx-sm-2 text-capitalize" name="role_name">
          <option disabled>Role</option>
          <option value="">Any</option>
          @foreach($roles as $role)
            <option value="{{$role->name}}"
                    @if(request('role_name') === $role->name) selected @endif>{{$role->name}}</option>
          @endforeach
        </select>

        <input type="text" class="form-control mb-2 mb-sm-0 mr-sm-2" placeholder="Search" name="search"
               value="{{request('search')}}" autofocus>

        <button type="submit" value="1" class="btn btn-primary mb-0 mb-sm-0 mr-sm-2">
          <i class="fa fa-search fa-fw"></i>Search
        </button>

      </form>
    </div>
  </section>


  <section class="table-responsive">
    <table class="table table-striped table-light table-bordered table-hover" id="list-table">
      <thead>
      <tr>
        <th class="w-25">Email</th>
        <th>Name</th>
        @if(request('active_status') === 'all')
          <th>Status</th>
        @endif
        <th class="w-25">Actions</th>
      </tr>
      </thead>
      <tbody>
      @forelse($users as $user)
        <tr>
          <td class="align-middle">
            {{$user->email}}
          </td>
          <td class="align-middle">{{optional($user->profile)->full_name}}</td>
          @if(request('active_status') === 'all')
            <td class="align-middle h5">
              @if($user->is_blocked)
                <span class="badge badge-danger">Blocked</span>
              @else
                <span class="badge badge-success">Active</span>
              @endif
            </td>
          @endif
          <td class="text-center">
            <a href="{{route('admin.orders.create',$user)}}" class="btn btn-sm btn-primary mb-0"><i
                class="fas fa-cart-plus"></i> Order</a>
            <a href="{{route('admin.orders.index',['search'=>$user->email])}}" class="btn btn-sm btn-info mb-0"><i
                class="fas fa-history"></i> History</a>
            <a href="{{route('admin.users.edit',$user)}}" class="btn btn-sm btn-secondary mb-0"><i
                class="fas fa-edit"></i> Edit</a>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="4" class="text-center">No records found</td>
        </tr>
      @endforelse
      </tbody>
    </table>
  </section>

  @if($users->total() > 1)
    <div class="row">
      <div class="col-md-4 mb-sm-0 mb-3 text-center text-sm-left">
        <h5 class="mt-sm-2 mt-0 mb-0">Found {{$users->total()}} entries</h5>
      </div>
      <div class="col-md-8 d-flex">
        <div class="mx-auto ml-sm-auto mr-sm-0 table-responsive-sm">
          {{$users->appends(request()->all())->links()}}
        </div>
      </div>
    </div>
  @endif

@endsection

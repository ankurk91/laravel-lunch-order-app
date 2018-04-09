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
          <option disabled>Per Page</option>
          <option value="10" @if(request('per_page') === '10') selected @endif>10</option>
          <option value="30" @if(request('per_page') === '30') selected @endif>30</option>
          <option value="50" @if(request('per_page') === '50') selected @endif>50</option>
        </select>

        <select class="form-control mb-2 mb-sm-0 mx-sm-2" name="active_status">
          <option disabled>Status</option>
          <option value="active" @if(request('active_status') === 'active') selected @endif>Active</option>
          <option value="blocked" @if(request('active_status') === 'blocked') selected @endif>Blocked</option>
          <option value="all" @if(request('active_status') === 'all') selected @endif>All</option>
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
    <table class="table table-striped table-light table-bordered table-hover" id="payees-table">
      <thead>
      <tr>
        <th>Email</th>
        <th>Name</th>
        @if(request('active_status') === 'all')
          <th>Status</th>
        @endif
        <th>Actions</th>
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
            <td class="align-middle">
              @if($user->is_blocked)
                <span class="badge badge-secondary">Blocked</span>
              @else
                <span class="badge badge-success">Active</span>
              @endif
            </td>
          @endif
          <td class="text-center">
            <a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-sm btn-secondary mb-0"><i
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

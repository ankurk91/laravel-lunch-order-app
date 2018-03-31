@extends('_layouts.app')

@section('pageTitle','Users')

@section('content')
  @component('components.breadcrumb')
    Users
  @endcomponent

  <section class="card mb-3">
    <div class="card-body">
      <form id="search-form" class="form-inline" method="GET"
            action="{{route('admin.users.index')}}">
        <div class="form-group">
          <select class="form-control" name="per_page">
            <option value="10" @if(request('per_page') === '10') selected @endif>10</option>
            <option value="30" @if(request('per_page') === '30') selected @endif>30</option>
            <option value="50" @if(request('per_page') === '50') selected @endif>50</option>
          </select>
        </div>

        <div class="form-group mx-sm-3">
          <input type="text" class="form-control" placeholder="Search" name="search"
                 value="{{request('search')}}">
        </div>
        <div class="form-group mb-0">
          <button type="submit" value="1" class="btn btn-primary"><i class="fa fa-search fa-fw"></i>Search
          </button>
        </div>
      </form>
    </div>
  </section>


  <section class="table-responsive">
    <table class="table table-striped table-light table-bordered table-hover" id="payees-table">
      <thead>
      <tr>
        <th>Email</th>
        <th>Name</th>
        <th>Registered at</th>
        <th>Actions</th>
      </tr>
      </thead>
      <tbody>
      @forelse($users as $item)
        <tr>
          <td class="align-middle">{{$item->email}}</td>
          <td class="align-middle">{{optional($item->profile)->first_name}}</td>
          <td class="align-middle">{{$item->created_at->format('j M Y, g:i a, T')}}</td>
          <td class="text-center">
            <a href="{{route('admin.users.edit',$item->id)}}" class="btn btn-sm btn-secondary mb-0"><i
                class="fas fa-pencil-alt"></i> Edit</a>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="4" class="text-center">No users found</td>
        </tr>
      @endforelse
      </tbody>
    </table>
  </section>

  @if($users->total() > 0)
    <div class="row">
      <div class="col-md-4 mb-sm-0 mb-3 text-center text-sm-left">
        <h5 class="mt-sm-2 mt-0 mb-0">Found {{$users->total()}} entries</h5>
      </div>
      <div class="col-md-8 d-flex">
        <div class="mx-auto ml-sm-auto mr-sm-0">
          {{$users->appends(request()->all())->links()}}
        </div>
      </div>
    </div>
  @endif

@endsection

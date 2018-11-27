@extends('_layouts.app')

@section('pageTitle','My Orders')

@section('content')
  @component('components.breadcrumb')
    My Orders
  @endcomponent

  @include('alert::bootstrap')

  <section class="card mb-3">
    <div class="card-body">
      <form id="search-form" class="form-inline" method="GET"
            action="{{route('orders.index')}}">

        <select class="form-control mb-2 mb-sm-0 mr-sm-2" name="per_page">
          <option disabled>Per page</option>
          @foreach([10,30,50] as $n)
            <option value="{{$n}}" @if(request('per_page') == $n) selected @endif>{{$n}}</option>
          @endforeach
        </select>

        <select class="form-control mb-2 mb-sm-0 mx-sm-2 text-capitalize" name="order_status">
          <option disabled>Status</option>
          <option value="">Any</option>
          @foreach(config('project.order_status') as $status)
            <option value="{{$status}}"
                    @if(request('order_status') === $status) selected @endif>{{$status}}
            </option>
          @endforeach
        </select>

        <select class="form-control mb-2 mb-sm-0 mx-sm-2" name="order_month">
          <option disabled>Month</option>
          @foreach(months_with_names() as $month=>$name)
            <option value="{{$month}}"
                    @if(request('order_month',today()->month) == $month) selected @endif>{{$name}}</option>
          @endforeach
        </select>

        <select class="form-control mb-2 mb-sm-0 mx-sm-2" name="order_year">
          <option disabled>Year</option>
          @foreach($years as $year)
            <option value="{{$year->year}}"
                    @if(request('order_year',today()->year) == $year->year) selected @endif>{{$year->year}}</option>
          @endforeach
        </select>

        <input type="text" class="form-control mb-2 mb-sm-0 mx-sm-2" placeholder="Search" name="search"
               value="{{request('search')}}" autofocus>

        <button type="submit" class="btn btn-primary mb-0 mb-sm-0 mr-sm-2">
          <i class="fa fa-search fa-fw"></i>Search
        </button>

      </form>
    </div>
  </section>

  <section class="table-responsive">
    <table class="table table-striped table-light table-bordered table-hover" id="list-table">
      <thead>
      <tr>
        <th>ID</th>
        <th>For Date</th>
        <th>Created by</th>
        <th>Total</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
      </thead>
      <tbody>
      @forelse($orders as $order)
        <tr>
          <td class="align-middle">
            {{$order->id}}
          </td>
          <td class="align-middle">
            @date($order->for_date)
          </td>
          <td class="align-middle">
            {{$order->createdByUser->email}}
          </td>
          <td>
            {{money($order->total)}}
          </td>
          <td class="align-middle h5">
            @switch($order->status)
              @case('pending')
              <span class="badge badge-warning">Pending</span>
              @break

              @case('completed')
              <span class="badge badge-success">Completed</span>
              @break

              @case('cancelled')
              <span class="badge badge-danger">Cancelled</span>
              @break

              @default
              <span class="badge badge-secondary">{{$order->status}}</span>
            @endswitch
          </td>
          <td class="text-center">
            <a href="{{route('orders.show',$order)}}" class="btn btn-sm btn-info mb-0"><i
                class="fas fa-folder-open"></i> View</a>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="text-center">No records found</td>
        </tr>
      @endforelse
      </tbody>
    </table>
  </section>

  @if($orders->total() > 1)
    <div class="row">
      <div class="col-md-4 mb-sm-0 mb-3 text-center text-sm-left">
        <h5 class="mt-sm-2 mt-0 mb-0">Found {{$orders->total()}} entries</h5>
      </div>
      <div class="col-md-8 d-flex">
        <div class="mx-auto ml-sm-auto mr-sm-0 table-responsive-sm">
          {{$orders->appends(request()->query())->onEachSide(2)->links()}}
        </div>
      </div>
    </div>
  @endif

@endsection()

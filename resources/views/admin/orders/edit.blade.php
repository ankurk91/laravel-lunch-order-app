@extends('_layouts.app')

@section('pageTitle','Edit order')

@section('content')
  @component('components.breadcrumb',[
    'links' => [
      'orders' => route('admin.orders.index')
    ]
  ])
    Edit order
  @endcomponent

  @include('alert::bootstrap')

  <div class="row">
    <aside class="col-md-4 mb-sm-0 mb-lg-0 mb-4">
      @component('components.user-card', [ 'user' => $order->orderForUser])
      @endcomponent()
    </aside>

    <section class="col-md-8 mt-sm-0 mt-lg-0 mt-4">
      <form method="POST" action="{{ route('admin.orders.update',$order->id) }}">
        @csrf
        @method('PUT')
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Update order</h5>

          </div>
          <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-pencil-alt"></i> Update order
            </button>
          </div>
        </div>
      </form>

      <form onsubmit="return confirm('Are you sure to delete this order?')"
            action="{{route('admin.orders.destroy',$order->id)}}"
            method="POST">
        @csrf
        @method('delete')
        <div class="card mt-4">
          <div class="card-body">
            <h5 class="card-title text-danger">Delete order</h5>
            <p class="card-text font-weight-light">
              You can not delete orders that are marked as completed.<br>
              This operation can't be undone.
            </p>
          </div>
          <div class="card-footer text-right">
            <button type="submit" class="btn btn-danger">
              <i class="fas fa-trash"></i> Delete order
            </button>
          </div>
        </div>
      </form>

    </section>
  </div>
@endsection()

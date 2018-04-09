@extends('_layouts.app')

@section('pageTitle','Create order')

@section('content')
  @component('components.breadcrumb',[
    'links' => [
      'orders' => route('admin.orders.index')
    ]
  ])
    Create order
  @endcomponent

  @include('alert::bootstrap')

  <form method="POST" action="">
    @csrf
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Place your order for today</h5>

        <div class="form-group row">
          <label for="input-product-1" class="col-sm-6 col-form-label">Product - <span class="text-muted">(₹ 50/item)</span></label>
          <div class="col-sm-6">
            <select id="input-product-1" class="form-control">
              <option selected>Choose...</option>
              <option>...</option>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label for="input-product-2" class="col-sm-6 col-form-label">Product - <span class="text-muted">(₹ 15/item)</span></label>
          <div class="col-sm-6">
            <select id="input-product-2" class="form-control">
              <option selected>Choose...</option>
              <option>...</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="input-notes">Add notes</label>
          <textarea rows="1" class="form-control" id="input-notes"
                    placeholder="Optional notes for yourself"></textarea>
        </div>

        <div class="text-right">
          <button type="submit" class="btn btn-success">
            <i class="fas fa-check"></i> Confirm your order
          </button>
        </div>
      </div>
    </div>
  </form>

@endsection()

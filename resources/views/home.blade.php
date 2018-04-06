@extends('_layouts.app')

@section('pageTitle','Home')

@section('content')
  @component('components.breadcrumb')
    Dashboard
  @endcomponent

  @include('alert::bootstrap')

  <div class="row">
    <div class="col-md-7 mb-sm-0 mb-lg-0 mb-4">
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

      <form onsubmit="return confirm('Are you sure to cancel order?')"
            action="#"
            method="POST">
        @csrf
        @method('delete')
        <div class="card mt-4">
          <div class="card-body">
            <h5 class="card-title text-danger">Cancel order</h5>
            <p class="card-text font-weight-light">
              You can always restore your order only before closing time.
            </p>
            <div class="text-right">
              <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash-alt"></i> Cancel order
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>

    <div class="col-md-5">
      <div class="jumbotron pt-4">
        <h1 class="display-4">Hello, there!</h1>
        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to
          featured content or information.</p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
      </div>
    </div>
  </div>

@endsection

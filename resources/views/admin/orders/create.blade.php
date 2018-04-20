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

  <div class="row">
    <aside class="col-md-4 mb-sm-0 mb-lg-0 mb-4">
      @component('components.userCard', [ 'user' => $user])
      @endcomponent()
    </aside>

    <section class="col-md-8 mt-sm-0 mt-lg-0 mt-4">

      <form method="POST" action="{{route('admin.orders.store',$user)}}">
        @csrf
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Place order for today</h5>
            <h6 class="card-subtitle mb-2 text-muted">You need to choose at least on product.</h6>

            @if ($errors->has('products'))
              <div class="alert alert-danger alert-dismissible show" role="alert">
                {{ $errors->first('products') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

            @forelse($products as $product)
              <div class="form-group row">
                <input type="hidden" name="products[{{$product->id}}][id]" value="{{$product->id}}">
                <label for="input-product-{{$loop->index}}" class="col-sm-6 col-form-label">
                  {{$product->name}}
                </label>
                <div class="col-md-2">
                  <input type="number" step=".01" class="form-control" placeholder="Price"
                         value="{{old("products.{$product->id}.unit_price",$product->unit_price)}}"
                         name="products[{{$product->id}}][unit_price]">
                </div>
                <label class="col-md-1 text-center">x</label>
                <div class="col-sm-3">
                  <select id="input-product-{{$loop->index}}" class="form-control"
                          name="products[{{$product->id}}][quantity]">
                    <option disabled>Quantity</option>
                    <option value="">0</option>
                    @foreach(range(1, $product->max_quantity) as $n)
                      <option value="{{$n}}">{{$n}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            @empty
              <div class="row text-center">
                No products found.
              </div>
            @endforelse

            <div class="form-group">
              <label for="input-staff-notes">Staff notes</label>
              <textarea rows="1" class="form-control {{ $errors->has('staff_notes') ? ' is-invalid' : '' }}"
                        id="input-staff-notes" name="staff_notes"
                        placeholder="Optional notes form staff">{{old('staff_notes')}}</textarea>
              @if ($errors->has('staff_notes'))
                <div class="invalid-feedback">
                  {{ $errors->first('staff_notes') }}
                </div>
              @endif
            </div>

            <div class="form-group">
              <label for="input-notes">Customer notes</label>
              <textarea rows="1" class="form-control {{ $errors->has('customer_notes') ? ' is-invalid' : '' }}"
                        id="input-notes" name="customer_notes"
                        placeholder="Optional notes by customer">{{old('customer_notes')}}</textarea>
              @if ($errors->has('customer_notes'))
                <div class="invalid-feedback">
                  {{ $errors->first('customer_notes') }}
                </div>
              @endif
            </div>

            <div class="text-right">
              <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Place order
              </button>
            </div>
          </div>
        </div>
      </form>
    </section>
  </div>
@endsection()

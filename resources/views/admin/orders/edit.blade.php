@extends('_layouts.app')

@section('pageTitle','Edit order')

@section('content')
  <section class="row d-flex">
    <div class="col">
      @component('components.breadcrumb',[
        'links' => [
          'orders' => route('admin.orders.index')
        ]
      ])
        Edit order
      @endcomponent
    </div>
    <div class="col pt-1 text-right">
      <ul class="nav justify-content-end">
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.orders.create',$order->createdForUser)}}">
            <i class="fas fa-cart-plus"></i> Add new order
          </a>
        </li>
      </ul>
    </div>
  </section>


  @include('alert::bootstrap')

  <div class="row">
    <aside class="col-md-4 mb-sm-0 mb-lg-0 mb-4">
      @component('components.userCard', [ 'user' => $order->createdForUser])
      @endcomponent()
    </aside>

    <section class="col-md-8 mt-sm-0 mt-lg-0 mt-4">
      <form method="POST" action="{{ route('admin.orders.update',$order) }}">
        @csrf
        @method('PUT')
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Update order</h5>
            <h6 class="card-subtitle mb-2 text-muted">You need to choose at least one product.</h6>

            @include('admin.orders._validationAlert')

            @foreach($order->orderProducts as $item)
              <input type="hidden" name="products[{{$item->product_id}}][id]" value="{{$item->product_id}}">
              <div class="form-group row">
                <label for="input-product-{{$loop->index}}" class="col-sm-6 col-form-label">
                  {{$item->product->name}}
                </label>
                <div class="col-md-2">
                  <input type="number" step=".01" class="form-control" placeholder="Price"
                         value="{{old("products.{$item->product_id}.unit_price",$item->unit_price)}}"
                         name="products[{{$item->product_id}}][unit_price]">
                </div>
                <label class="col-md-1 text-center">x</label>
                <div class="col-sm-3">
                  <select id="input-product-{{$loop->index}}" class="form-control"
                          name="products[{{$item->product_id}}][quantity]">
                    <option disabled>Quantity</option>
                    <option value="">0</option>
                    @foreach(range(1, $item->product->max_quantity) as $n)
                      <option value="{{$n}}"
                              @if(old("products.{$item->product_id}.quantity",$item->quantity) == $n) selected @endif>{{$n}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            @endforeach
            <hr>
            @foreach($newProducts as $product)
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
                      <option
                        value="{{$n}}" {{old("products.{$product->id}.quantity") == $n ? 'selected' : ''}}>{{$n}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            @endforeach

            <div class="form-group">
              <label for="input-staff-notes">Staff notes</label>
              <textarea rows="1" class="form-control max-height-10 {{ $errors->has('staff_notes') ? ' is-invalid' : '' }}"
                        id="input-staff-notes" name="staff_notes"
                        placeholder="Optional notes form staff">{{old('staff_notes',$order->staff_notes)}}</textarea>
              @if ($errors->has('staff_notes'))
                <div class="invalid-feedback">
                  {{ $errors->first('staff_notes') }}
                </div>
              @endif
            </div>

            <div class="form-group">
              <label for="input-notes">Customer notes</label>
              <textarea rows="1" class="form-control max-height-10 {{ $errors->has('customer_notes') ? ' is-invalid' : '' }}"
                        id="input-notes" name="customer_notes"
                        placeholder="Optional notes by customer">{{old('customer_notes',$order->customer_notes)}}</textarea>
              @if ($errors->has('customer_notes'))
                <div class="invalid-feedback">
                  {{ $errors->first('customer_notes') }}
                </div>
              @endif
            </div>
          </div>
          <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-pencil-alt"></i> Update order
            </button>
          </div>
        </div>
      </form>

      <form onsubmit="return confirm('Are you sure to update status?')"
            action="{{route('admin.orders.update-status',$order)}}"
            method="POST">
        @csrf
        @method('patch')
        <div class="card mt-4">
          <div class="card-body">
            <h5 class="card-title">Change order status</h5>
            <div class="form-group required">
              <label>Select status</label>
              @foreach(config('project.order_status') as $status)
                <div class="custom-control custom-radio">
                  <input type="radio" class="custom-control-input" name="status"
                         id="input-order-status-{{$status}}"
                         value="{{$status}}"
                         @if($order->status === $status) checked @endif>
                  <label class="custom-control-label text-capitalize"
                         for="input-order-status-{{$status}}">{{$status}}</label>
                </div>
              @endforeach

              @if ($errors->has('status'))
                <div class="invalid-feedback d-block">
                  {{ $errors->first('status') }}
                </div>
              @endif
            </div>
          </div>
          <div class="card-footer text-right">
            <button type="submit" class="btn btn-outline-primary">
              <i class="fas fa-check-circle"></i> Update status
            </button>
          </div>
        </div>
      </form>

      <form onsubmit="return confirm('Are you sure to delete this order?')"
            action="{{route('admin.orders.destroy',$order)}}"
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

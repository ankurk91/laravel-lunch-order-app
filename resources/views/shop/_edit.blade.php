<form method="POST" action="{{route('shop.store')}}">
  @csrf
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Update order for today</h5>
      <h6 class="card-subtitle mb-2 text-muted">You need to choose at least one product.</h6>

      @if ($errors->has('products'))
        <div class="alert alert-danger alert-dismissible show" role="alert">
          <i class="fas fa-exclamation-circle"></i> {{ $errors->first('products') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      @foreach($order->orderProducts as $item)
        <input type="hidden" name="products[{{$item->product_id}}][id]" value="{{$item->product_id}}">
        <div class="form-group row">
          <label for="input-product-{{$loop->index}}" class="col-sm-6 col-form-label">
            {{$item->product->name}}
          </label>
          <div class="col-md-3 text-muted">
            {{money($item->unit_price)}}/unit
          </div>
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
          <div class="col-md-3 text-muted">
            {{money($product->unit_price)}}/unit
          </div>
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
      <hr>

      <div class="form-group">
        <label for="input-notes">Add notes</label>
        <textarea rows="1" class="form-control max-height-10 {{ $errors->has('customer_notes') ? ' is-invalid' : '' }}"
                  id="input-notes" name="customer_notes"
                  placeholder="Optional notes">{{old('customer_notes',$order->customer_notes)}}</textarea>
        @if ($errors->has('customer_notes'))
          <div class="invalid-feedback">
            {{ $errors->first('customer_notes') }}
          </div>
        @endif
      </div>

      <div class="text-right">
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-pencil-alt"></i> Update order
        </button>
      </div>
    </div>
  </div>
</form>

<form method="POST" action="{{route('shop.store')}}">
  @csrf
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Place order for today</h5>
      <h6 class="card-subtitle mb-2 text-muted">You need to choose at least one product.</h6>

      @include('admin.orders._validationAlert')

      @forelse($products as $product)
        <div class="form-group row">
          <input type="hidden" name="products[{{$product->id}}][id]" value="{{$product->id}}">
          <label for="input-product-{{$loop->index}}" class="col-sm-6 col-form-label">
            {{$product->name}}
          </label>
          <div class="col-md-3 text-muted">
            {{money($product->unit_price)}}/item
          </div>
          <div class="col-sm-3">
            <select id="input-product-{{$loop->index}}" class="form-control"
                    name="products[{{$product->id}}][quantity]">
              <option disabled>Quantity</option>
              <option value="">0</option>
              @foreach(range(1, $product->max_quantity) as $n)
                <option value="{{$n}}" {{old("products.{$product->id}.quantity") == $n ? 'selected' : ''}}>{{$n}}</option>
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
        <label for="input-notes">Add notes</label>
        <textarea rows="1" class="form-control max-height-10 {{ $errors->has('customer_notes') ? ' is-invalid' : '' }}"
                  id="input-notes" name="customer_notes"
                  placeholder="Optional notes">{{old('customer_notes')}}</textarea>
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

@extends('_layouts.app')

@section('pageTitle','Create Product')

@section('content')

  @component('components.breadcrumb',[
        'links' => [
          'products' => route('admin.products.index')
        ]
      ])
    Create product
  @endcomponent

  @include('alert::bootstrap')

  <form method="POST" action="{{route('admin.products.store')}}">
    @csrf
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Create a new product</h5>

        <div class="form-group required">
          <label for="input-name">Name</label>
          <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                 id="input-name" name="name"
                 placeholder="Name" value="{{old('name')}}" required autofocus>
          @if ($errors->has('name'))
            <div class="invalid-feedback">
              {{ $errors->first('name') }}
            </div>
          @endif
        </div>

        <div class="form-group">
          <label for="input-description">Description</label>
          <textarea rows="2" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}"
                    id="input-description" name="description"
                    placeholder="Description">{{old('description')}}</textarea>
          @if ($errors->has('description'))
            <div class="invalid-feedback">
              {{ $errors->first('description') }}
            </div>
          @endif
        </div>

        <div class="form-row">
          <div class="col-md-6">

            <div class="form-group required">
              <label for="input-max_quantity">Max quantity per order</label>
              <input type="number" class="form-control {{ $errors->has('max_quantity') ? ' is-invalid' : '' }}"
                     id="input-max_quantity" name="max_quantity"
                     placeholder="Max quantity" value="{{old('max_quantity')}}" required>
              @if ($errors->has('max_quantity'))
                <div class="invalid-feedback">
                  {{ $errors->first('max_quantity') }}
                </div>
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group required">
              <label for="input-unit_price">Unit price</label>
              <input type="number" class="form-control {{ $errors->has('unit_price') ? ' is-invalid' : '' }}"
                     id="input-unit_price" name="unit_price"
                     placeholder="Unit price" value="{{old('unit_price')}}" required>
              @if ($errors->has('unit_price'))
                <div class="invalid-feedback">
                  {{ $errors->first('unit_price') }}
                </div>
              @endif
            </div>
          </div>
        </div>

        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="input-active" name="active"
                 @if(old('active',true)) checked @endif value="1"
          >
          <label class="custom-control-label" for="input-active">Available for new orders</label>
        </div>

        <div class="text-right">
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus-square"></i> Create product
          </button>
        </div>
      </div>
    </div>
  </form>


@endsection()

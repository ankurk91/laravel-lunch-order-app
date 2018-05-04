@extends('_layouts.app')

@section('pageTitle','Edit Product')

@section('content')

  <section class="row d-flex">
    <div class="col">
      @component('components.breadcrumb',[
       'links' => [
         'products' => route('admin.products.index')
       ]
     ])
        Edit product
      @endcomponent
    </div>
    <div class="col pt-1 text-right">
      <ul class="nav justify-content-end">
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.products.create')}}">
            <i class="fas fa-plus-circle"></i> Add new product
          </a>
        </li>
      </ul>
    </div>
  </section>

  @include('alert::bootstrap')

  <form method="POST" action="{{route('admin.products.update',$product)}}">
    @csrf
    @method('PUT')
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Update product</h5>

        <div class="form-group required">
          <label for="input-name">Name</label>
          <input type="text" class="form-control max-height-10 {{ $errors->has('name') ? ' is-invalid' : '' }}"
                 id="input-name" name="name"
                 placeholder="Name" value="{{old('name',$product->name)}}" required autofocus>
          @if ($errors->has('name'))
            <div class="invalid-feedback">
              {{ $errors->first('name') }}
            </div>
          @endif
        </div>

        <div class="form-group">
          <label for="input-description">Description</label>
          <textarea rows="2" class="form-control max-height-10 {{ $errors->has('description') ? ' is-invalid' : '' }}"
                    id="input-description" name="description"
                    placeholder="Description">{{old('description',$product->description)}}</textarea>
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
                     placeholder="Max quantity" value="{{old('max_quantity',$product->max_quantity)}}" required>
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
                     placeholder="Unit price" value="{{old('unit_price',$product->unit_price)}}" required>
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
                 @if(old('active', $product->active)) checked @endif value="1"
          >
          <label class="custom-control-label" for="input-active">Available for new orders</label>
        </div>
      </div>
      <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-pencil-alt"></i> Update product
        </button>
      </div>
    </div>
  </form>

  @include('admin.products._delete')

@endsection()

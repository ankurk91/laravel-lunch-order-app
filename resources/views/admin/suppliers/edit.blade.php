@extends('_layouts.app')

@section('pageTitle','Edit Supplier')

@section('content')

  @component('components.breadcrumb',[
        'links' => [
          'suppliers' => route('admin.suppliers.index')
        ]
      ])
    Edit supplier
  @endcomponent

  @include('alert::bootstrap')

  <form method="POST" action="{{route('admin.suppliers.update', $supplier)}}">
    @csrf
    @method('PUT')
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Edit supplier</h5>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group required">
              <label for="first_name">First name</label>
              <input id="first_name" type="text"
                     class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                     name="first_name"
                     placeholder="First name"
                     value="{{old('first_name', $supplier->first_name)}}"
                     required autofocus>

              @if ($errors->has('first_name'))
                <div class="invalid-feedback">
                  {{ $errors->first('first_name') }}
                </div>
              @endif
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="last_name">Last name</label>
              <input id="last_name" type="text"
                     class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                     name="last_name" placeholder="Last name"
                     value="{{old('last_name', $supplier->last_name)}}">

              @if ($errors->has('last_name'))
                <div class="invalid-feedback">
                  {{ $errors->first('last_name') }}
                </div>
              @endif
            </div>
          </div>
        </div>

        <div class="form-group required">
          <label for="input-email">Email</label>
          <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                 id="input-email" name="email"
                 placeholder="Email" value="{{old('email', $supplier->email)}}" required>
          @if ($errors->has('email'))
            <div class="invalid-feedback">
              {{ $errors->first('email') }}
            </div>
          @endif
        </div>

        <div class="form-group">
          <label for="input-address">Address</label>
          <textarea rows="2" class="form-control max-height-10 {{ $errors->has('address') ? ' is-invalid' : '' }}"
                    id="input-address" name="description"
                    placeholder="Address">{{old('address', $supplier->address)}}</textarea>
          @if ($errors->has('address'))
            <div class="invalid-feedback">
              {{ $errors->first('address') }}
            </div>
          @endif
        </div>

        <div class="form-row">
          <div class="col-md-6">
            <div class="form-group required">
              <label for="input-primary_phone">Primary Phone</label>
              <input type="number" class="form-control {{ $errors->has('primary_phone') ? ' is-invalid' : '' }}"
                     id="input-primary_phone" name="primary_phone"
                     placeholder="Primary phone" value="{{old('primary_phone', $supplier->primary_phone)}}" required>
              @if ($errors->has('primary_phone'))
                <div class="invalid-feedback">
                  {{ $errors->first('primary_phone') }}
                </div>
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="input-alternate_phone">Alternate Phone</label>
              <input type="number" class="form-control {{ $errors->has('alternate_phone') ? ' is-invalid' : '' }}"
                     id="input-alternate_phone" name="alternate_phone"
                     placeholder="Alternate phone" value="{{old('alternate_phone', $supplier->alternate_phone)}}">
              @if ($errors->has('alternate_phone'))
                <div class="invalid-feedback">
                  {{ $errors->first('alternate_phone') }}
                </div>
              @endif
            </div>
          </div>
        </div>

        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="input-active" name="active"
                 @if(old('active', $supplier->active)) checked @endif value="1"
          >
          <label class="custom-control-label" for="input-active">Available for new orders</label>
        </div>

        <div class="text-right">
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-pencil-alt"></i> Update supplier
          </button>
        </div>
      </div>
    </div>
  </form>

  @include('admin.suppliers._delete')

@endsection()

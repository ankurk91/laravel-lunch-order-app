@if ($errors->has('products'))
  <div class="alert alert-danger alert-dismissible show" role="alert">
    {{ $errors->first('products') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

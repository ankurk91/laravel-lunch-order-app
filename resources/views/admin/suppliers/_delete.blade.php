<form onsubmit="return confirm('Are you sure to delete this supplier?')"
      action="{{route('admin.suppliers.destroy',$supplier)}}"
      method="POST">
  @csrf
  @method('delete')
  <div class="card mt-4">
    <div class="card-body">
      <h5 class="card-title text-danger">Delete supplier</h5>

      @if($errors->delete->has('supplier'))
        <div class="alert alert-danger alert-dismissible show" role="alert">
          <i class="fas fa-exclamation-circle"></i> {{ $errors->delete->first('supplier') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      <p class="card-text font-weight-light">
        You can only delete unused supplier.<br>
        This operation can't be undone.
      </p>
    </div>
    <div class="card-footer text-right">
      <button type="submit" class="btn btn-danger">
        <i class="fas fa-trash"></i> Delete supplier
      </button>
    </div>
  </div>
</form>

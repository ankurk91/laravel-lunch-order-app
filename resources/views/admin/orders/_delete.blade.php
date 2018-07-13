<form onsubmit="return confirm('Are you sure to delete this order?')"
      action="{{route('admin.orders.destroy',$order)}}"
      method="POST">
  @csrf
  @method('delete')
  <div class="card mt-4">
    <div class="card-body">
      <h5 class="card-title text-danger">Delete order</h5>

      @if($errors->delete->has('order'))
        <div class="alert alert-danger alert-dismissible show" role="alert">
          <i class="fas fa-exclamation-circle"></i> {{ $errors->delete->first('order') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

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

<form onsubmit="return confirm('Are you sure to cancel order?')"
      action="{{route('shop.cancel')}}"
      method="POST">
  @csrf
  <div class="card mt-4">
    <div class="card-body">
      <h5 class="card-title text-danger">Cancel today's order</h5>
      <p class="card-text font-weight-light">
        You can only restore your order before closing time.
      </p>
      <div class="text-right">
        <button type="submit" class="btn btn-danger">
          <i class="fas fa-trash-alt"></i> Cancel order
        </button>
      </div>
    </div>
  </div>
</form>

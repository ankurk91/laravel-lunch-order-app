<form onsubmit="return confirm('Are you sure to restore order?')"
      action="{{route('shop.restore')}}"
      method="POST">
  @csrf
  <div class="card">
    <div class="card-body">
      <h5 class="card-title text-success">Restore today's order</h5>
      <p class="card-text font-weight-light">
        Your order was cancelled.<br>
        You can restore your order. You should be able to update your order after restoring.
      </p>
      <div class="text-right">
        <button type="submit" class="btn btn-outline-success">
          <i class="fas fa-undo"></i> Restore order
        </button>
      </div>
    </div>
  </div>
</form>

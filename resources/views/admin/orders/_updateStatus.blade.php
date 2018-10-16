<form onsubmit="return confirm('Are you sure to update status?')"
      action="{{route('admin.orders.updateStatus',$order)}}"
      method="POST">
  @csrf
  @method('patch')
  <div class="card mt-4">
    <div class="card-body">
      <h5 class="card-title">Change order status</h5>
      <div class="form-group required">
        <label>Select status</label>
        @foreach(config('project.order_status') as $status)
          <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" name="status"
                   id="input-order-status-{{$status}}"
                   value="{{$status}}"
                   @if($order->status === $status) checked @endif>
            <label class="custom-control-label text-capitalize"
                   for="input-order-status-{{$status}}">{{$status}}</label>
          </div>
        @endforeach

        @if ($errors->has('status'))
          <div class="invalid-feedback d-block">
            {{ $errors->first('status') }}
          </div>
        @endif
      </div>
    </div>
    <div class="card-footer text-right">
      <button type="submit" class="btn btn-outline-primary">
        <i class="fas fa-check-circle"></i> Update status
      </button>
    </div>
  </div>
</form>

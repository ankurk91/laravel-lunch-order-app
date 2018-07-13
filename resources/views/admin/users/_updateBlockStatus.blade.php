<form onsubmit="return confirm('Are you sure?')"
      action="{{route('admin.users.toggle-block',$user)}}"
      method="POST">
  @csrf
  @method('patch')
  <div class="card mt-4">
    <div class="card-body">
      <h5 class="card-title">Block/unblock user</h5>
      <p class="card-text font-weight-light">
        When blocked; User will be logged out of all active devices and will not be allowed to log in back.
      </p>
    </div>
    <div class="card-footer text-right">
      @if($user->is_blocked)
        <span class="text-muted mr-3">
                Blocked
                @timeago($user->blocked_at)
              </span>
        <button type="submit" class="btn btn-success"><i class="fas fa-lock-open"></i> Unblock</button>
      @else
        <button type="submit" class="btn btn-warning"><i class="fas fa-lock"></i> Block</button>
      @endif
    </div>
  </div>
</form>

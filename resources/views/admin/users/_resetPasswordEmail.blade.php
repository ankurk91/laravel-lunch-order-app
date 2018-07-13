<form action="{{route('admin.users.password-reset-email',$user)}}"
      method="POST">
  @csrf

  <div class="card mt-4">
    <div class="card-body">
      <h5 class="card-title">Send password reset e-mail</h5>
      <p class="card-text font-weight-light">
        User will receive an e-mail with password reset instructions.
      </p>
    </div>
    <div class="card-footer text-right">
      <button type="submit" class="btn btn-primary"><i class="fas fa-envelope"></i> Send password reset e-mail
      </button>
    </div>
  </div>
</form>

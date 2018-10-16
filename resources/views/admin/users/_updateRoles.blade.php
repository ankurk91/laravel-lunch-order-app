<form method="POST" action="{{route('admin.users.updateRoles',$user)}}">
  @csrf
  @method('patch')
  <div class="card mt-4">
    <div class="card-body">
      <h5 class="card-title">Edit user roles</h5>
      <div class="form-group required">
        <label>Select roles</label>
        @foreach($availableRoles as $role)
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="roles[]"
                   id="input-role-{{$role->id}}"
                   value="{{$role->id}}"
                   @if($user->roles->contains('id',$role->id)) checked @endif>
            <label class="custom-control-label text-capitalize"
                   for="input-role-{{$role->id}}">{{$role->name}}</label>
          </div>
        @endforeach

        @if ($errors->has('roles'))
          <div class="invalid-feedback d-block">
            {{ $errors->first('roles') }}
          </div>
        @endif
      </div>
    </div>
    <div class="card-footer text-right">
      <button type="submit" class="btn btn-primary"><i class="fas fa-wrench"></i> Update roles</button>
    </div>
  </div>
</form>

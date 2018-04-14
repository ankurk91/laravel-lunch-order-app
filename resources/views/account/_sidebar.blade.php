<aside class="col-md-4 mb-sm-0 mb-lg-0 mb-4">

  @component('components.userCard', ['user' => $user])
  @endcomponent()

  <section class="list-group mt-4">
    <a href="{{route('account.edit')}}"
       class="list-group-item list-group-item-action {{isActiveRoute('account.edit')}}">
      <i class="fas fa-user"></i> Profile
    </a>
    <a href="{{route('account.password.edit')}}"
       class="list-group-item list-group-item-action {{isActiveRoute('account.password.edit')}}">
      <i class="fas fa-key"></i> Security
    </a>
    <a href="#" class="list-group-item list-group-item-action disabled">
      <i class="fas fa-bell"></i> Notifications
    </a>
    <a href="#" class="list-group-item list-group-item-action disabled">
      <i class="fas fa-cog"></i> Preferences
    </a>
    <a href="#" class="list-group-item list-group-item-action disabled">
      <i class="fas fa-history"></i> Activity
    </a>
  </section>

</aside>

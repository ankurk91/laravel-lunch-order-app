<header class="app-header">
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm border-bottom" role="navigation">
    <div class="container">
      <a class="navbar-brand" href="{{url('/')}}">
        <i class="fas fa-utensils"></i> {{config('app.name')}}
      </a>
      <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#mobile-nav"
              aria-controls="mobile-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mobile-nav">

        <ul class="navbar-nav mr-auto">
          @hasrole('admin')
          <li class="nav-item {{isActiveRoute('admin.products.index')}}">
            <a class="nav-link" href="{{route('admin.products.index')}}">
              <i class="fas fa-box-open"></i> Products</a>
          </li>
          <li class="nav-item {{isActiveRoute('admin.orders.index')}}">
            <a class="nav-link" href="{{route('admin.orders.index')}}">
              <i class="fas fa-dolly"></i> Orders</a>
          </li>
          <li class="nav-item {{isActiveRoute('admin.users.index')}}">
            <a class="nav-link" href="{{route('admin.users.index')}}">
              <i class="fas fa-users"></i> Users</a>
          </li>
          @endhasrole
          @auth
            <li class="nav-item {{isActiveRoute('shop.index')}}">
              <a class="nav-link" href="{{route('shop.index')}}">
                <i class="fas fa-cart-plus"></i> Shop</a>
            </li>
            <li class="nav-item {{isActiveRoute('orders.index')}}">
              <a class="nav-link" href="{{route('orders.index')}}">
                <i class="fas fa-history"></i> My Orders</a>
            </li>
          @endauth
        </ul>


        <ul class="navbar-nav ml-auto">
          @guest
            <li class="nav-item {{isActiveRoute('login')}}">
              <a href="{{route('login')}}" class="nav-link">
                <i class="fas fa-sign-in-alt"></i>&ensp;Log in</a>
            </li>
          @endguest
          @auth
            <li class="nav-item dropdown {{isActiveRoute('account.edit')}}">
              <a class="nav-link dropdown-toggle" href="{{route('account.edit')}}" id="user-dropdown" role="button"
                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle"></i> {{auth()->user()->email}}
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="user-dropdown">
                <a class="dropdown-item" href="{{route('account.edit')}}">
                  <i class="fas fa-cog"></i> Account
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.querySelector('#logout-form').submit();">
                  <i class="fas fa-sign-out-alt"></i> Log out
                </a>

                <form hidden id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
        </ul>
        @endauth

      </div>
    </div>
  </nav>
</header>

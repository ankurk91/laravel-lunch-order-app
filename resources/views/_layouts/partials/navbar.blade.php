<header class="header">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand mb-0 h1" href="{{url('/')}}">
        {{config('app.name')}}
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile-nav"
              aria-controls="mobile-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mobile-nav">

        <ul class="navbar-nav mr-auto">
          @auth
            <li class="nav-item active">
              <a class="nav-link" href="#"><i class="fas fa-dolly"></i> Orders</a>
            </li>
          @endauth
        </ul>


        <ul class="navbar-nav ml-auto">
          @guest
            <li class="nav-item active">
              <a href="{{route('login')}}" class="nav-link">
                <i class="fas fa-sign-in-alt"></i>&ensp;Login</a>
            </li>
          @endguest
          @auth
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="user-dropdown" role="button"
                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle"></i> {{auth()->user()->email}}
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="user-dropdown">
                <a class="dropdown-item" href="#">Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.querySelector('#logout-form').submit();">
                  Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
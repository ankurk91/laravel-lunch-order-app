<header class="header mb-3">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">
        {{config('app.name')}}
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile-nav"
              aria-controls="mobile-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mobile-nav">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{url('/')}}"><i class="fas fa-home"></i> Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-dolly"></i> Orders</a>
          </li>
        </ul>
        <div class="right-section">
          @guest
            <a href="{{route('oauth.login','google')}}" class="btn btn-sm btn-danger" role="button">
              <i class="fab fa-google"></i>&ensp;Login</a>
          @endguest
          @auth
            <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="user-dropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-user-circle"></i> {{auth()->user()->email}}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="user-dropdown">
                  <a class="dropdown-item" href="#">Profile</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Logout</a>
                </div>
              </li>
            </ul>
          @endauth
        </div>
      </div>
    </div>
  </nav>
</header>

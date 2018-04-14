<nav aria-label="breadcrumb">
  <ol class="breadcrumb mb-0 bg-light">
    <li class="breadcrumb-item"><a href="{{url('/')}}">
        <i class="fas fa-home"></i><span class="sr-only">Home</span>
      </a>
    </li>
    @isset($links)
      @foreach($links as $label => $url)
        <li class="breadcrumb-item">
          <a href="{{$url}}" class="text-capitalize">{{$label}}</a>
        </li>
      @endforeach
    @endisset
    <li class="breadcrumb-item active" aria-current="page">{{ $slot }}</li>
  </ol>
</nav>

<section class="error-container text-center mt-5">
  <div class="display-1 text-muted mb-4">{{$errorCode}}</div>
  <h1 class="h2 mb-3">{{$errorHeading ?? 'Error'}}</h1>
  <p class="h4 text-muted font-weight-normal mb-2" role="alert">
    {{$slot}}
  </p>
  <p class="mt-4">
    <a class="btn btn-primary" href="{{$actionUrl ?? url('/')}}">
      <i class="fas fa-reply"></i> {{$actionLabel ?? 'Back to home'}}
    </a>
  </p>
</section>

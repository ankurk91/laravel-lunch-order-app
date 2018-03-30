<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="origin-when-cross-origin" name="referrer">

  <title> @yield('pageTitle', 'Home') | {{config('app.name')}}</title>

@include('_layouts.partials.styles')
<!-- Header scripts -->
  <script>
    window.appConfig = @json([
      'csrfToken' => csrf_token(),
      'env' => config('app.env', 'production')
    ]);
  </script>

</head>
<body class="bg-light {{'env-'.config('app.env', 'production')}} @yield('bodyClass')">
<main id="app" role="main">
@include('_layouts.partials.navbar')
<!-- Main content starts -->
  <div class="container mt-1 mb-5">
    @yield('content')
  </div>
  @include('_layouts.partials.footer')
</main>

@include('_layouts.partials.scripts')
<noscript><h3 class="text-center text-danger">The application requires a javascript enabled web browser.</h3></noscript>
</body>
</html>

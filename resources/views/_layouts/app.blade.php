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
<div id="app" class="app">
@include('_layouts.partials.navbar')
<!-- Main content starts -->
  <main class="container main mt-1 mb-4" id="main" role="main">
    @yield('content')
  </main>
  @include('_layouts.partials.footer')
</div>
@include('_layouts.partials.scripts')
</body>
</html>

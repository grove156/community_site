<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Community') }}</title>
    <link href="{{ elixir("css/app.css") }}" rel="stylesheet">
    @yield('style')
  </head>

  <body id="app-layout">


    <div class="container">
      @include('flash::message')

      @yield('content')
    </div>


    <script src="{{ elixir("js/app.js")}}"></script>
    @yield('script')
  </body>
</html>

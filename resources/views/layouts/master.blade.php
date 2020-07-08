@include('partials.head')
@stack('css')
  <body> 
    <div id="app" class="">
        <!-- navbar -->
        @include('partials.navbar')
        @yield('banner')
        <!-- content -->
        @yield('content')
      </div>
    <!-- footer -->
    @include('partials.footer')
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
  </body>
</html>
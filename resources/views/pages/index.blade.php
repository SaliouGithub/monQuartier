<!-- ======= Head ======= -->  
  @include('themes.head');
<!-- End Head -->

<body>

<!-- ======= Header ======= -->  
  @include('themes.header');
<!-- End Header -->


<!-- ======= Sidebar ======= -->
  @include('themes.sidebar');
<!-- End Sidebar-->


  <main id="main" class="main">
    @yield('content')
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
    @include('themes.footer');
  <!-- End Footer -->

 

</body>

</html>
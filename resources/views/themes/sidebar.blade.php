  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link" href="{{ route('pages.maison.index')}}">
          <i class="bi bi-grid"></i>
          <span>Maison</span>
        </a>
      </li><!-- End Maison Nav -->

      <li class="nav-item">
        <a class="nav-link" href="{{ route('pages.habitant.index')}}">
          <i class="bi bi-grid"></i>
          <span>Habitant</span>
        </a>
      </li><!-- End Habitant Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('pages.commune.index')}}">
              <i class="bi bi-circle"></i><span>Commune</span>
            </a>
          </li>
          <li>
            <a href="{{ route('pages.quartier.index')}}">
              <i class="bi bi-circle"></i><span>Quartier</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-heading">Administration</li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('pages.user.index')}}">
          <i class="bi bi-people"></i>
          <span>Utilisateurs</span>
        </a>
      </li><!-- End Dashboard Nav -->



    </ul>

  </aside><!-- End Sidebar-->

  <script>
(function ($) {
  $(document).ready(function () {
      $('.sidebar-nav .nav-link').click(function (event) {
        // event.preventDefault();
        $('.sidebar-nav .nav-link').removeClass('active');
        $(this).addClass('active');
      });
    });
})(jQuery);

</script>
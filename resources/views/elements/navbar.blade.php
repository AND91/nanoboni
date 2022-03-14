<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <div class="navbar-toggle">
        <button type="button" id="custom-navbar-toggler">
          <i id="custom-navbar-icon" class="fas fa-caret-square-right"></i>
        </button>
      </div>
      <p class="navbar-brand">Lara Boni</p>
    </div>
    <a class="" href="{{ route('logout') }}"
       onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
        <i class="nc-icon nc-button-power"></i>
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
  </div>
</nav>
<!-- End Navbar -->
<div class="content">

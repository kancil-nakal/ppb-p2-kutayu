<!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex gap-1 align-items-center">
        <img src="{{ asset('assets') }}/img/logo-pbb.png" alt="">
        <span class="d-none d-lg-block">PBB-P2</span>
        <small>(Desa Kutayu)</small>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->



    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center g-3">
        <li class="nav-item pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{ asset('assets') }}/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block  ps-2">{{ Auth::user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->

          {{-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ Auth::user()->name }}</h6>
              <span>{{ Auth::user()->username }}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>


            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item d-flex align-items-center" style="border: none; background: none; cursor: pointer;">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </li>

          </ul><!-- End Profile Dropdown Items --> --}}
        </li><!-- End Profile Nav -->
        <li class="nav-item pe-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"  style="border: none; background: none; cursor: pointer;">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </li>

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

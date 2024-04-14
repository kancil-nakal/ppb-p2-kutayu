<!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin') ? '' : 'collapsed' }}" href="{{ route('admin') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->



      {{-- <li class="nav-heading">Pages</li> --}}

      <li class="nav-item">
        <a class="nav-link {{ request()->is('setoran*') ? '' : 'collapsed' }}" href="{{ route('setoran.index') }}">
          <i class="bi bi-receipt-cutoff"></i>
          <span>Setoran</span>
        </a>
      </li><!-- End Setoran Page Nav -->
      <li class="nav-item">
        <a class="nav-link {{ request()->is('wajibpajak*') ? '' : 'collapsed' }}" href="{{ route('wajibpajak.index') }}">
          <i class="bi bi-briefcase"></i>
          <span>Wajib Pajak</span>
        </a>
      </li><!-- End Wajib Pajak Page Nav -->
      <li class="nav-item">
        <a class="nav-link {{ request()->is('rekap*') ? '' : 'collapsed' }}" href="{{ route('rekap.index') }}">
          <i class="bi bi-calendar-week"></i>
          <span>Rekap</span>
        </a>
      </li><!-- End Rekap Page Nav -->


      @if (Auth::user()->role == 'admin')
      <li class="nav-item ">
        <a class="nav-link {{ request()->is('penarik*') ? '' : 'collapsed' }}" href="{{ route('penarik.index') }}">
          <i class="bi bi-braces"></i>
          <span>Master Data</span>
        </a>
      </li><!-- End Profile Page Nav -->
      <li class="nav-item ">
        <a class="nav-link {{ request()->is('users*') ? '' : 'collapsed' }}" href="{{ route('users.index') }}">
          <i class="bi bi-people"></i>
          <span>User</span>
        </a>
      </li><!-- End Profile Page Nav -->

      @endif



    </ul>

  </aside><!-- End Sidebar-->

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Techno Wizard</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="nav-item  {{ Request::is('/*') ? 'active' : '' }}">
            <a href="{{ route('/') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
        </li>
        <li class="menu-header">Input Relasi</li>
        <li class="nav-item   {{ Request::is('kata*') ? 'active' : '' }}">
            <a href="{{ route('kata.index') }}" class="nav-link"><i class="fa-solid fa-file-pen"></i><span>Relasi Kata</span></a>
        </li>
        <li class="menu-header">Input Kata</li>
        <li class="nav-item   {{ Request::is('kategori*') ? 'active' : '' }}">
            <a href="{{ route('kategori.view') }}" class="nav-link"><i
                    class="fas fa-list"></i><span>Kata</span></a>
        </li>
        <li class="nav-item   {{ Request::is('kelas*') ? 'active' : '' }}">
            <a href="{{ route('kelas.view') }}" class="nav-link"><i
                    class="fas fa-list"></i><span>Kelas Kata</span></a>
        </li>
        <li class="menu-header">Cari Kata</li>
        <li class="nav-item   {{ Request::is('search*') ? 'active' : '' }}">
            <a href="{{route('kata.search') }}" class="nav-link">
                <i class="fa-solid fa-magnifying-glass"></i><span>Search</span></a>
        </li>
      </ul>

      <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
        <a href="" class="btn btn-primary btn-lg btn-block btn-icon-split">
          <i class="fas fa-rocket"></i> Selamat Datang
        </a>
      </div>        </aside>
  </div>

<div class="main-sidebar">
{{-- <div class="main-sidebar"> --}}

        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href=" / ">FUTAMI</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="/"></a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header"></li>
              <li class="nav-item dropdown">
              <a href="/" ><i class="fas fa-home"></i><span>Dashboard</span></a>
              </li>
              <li class="menu-header"></li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa fa-city"></i> <span>Produksi</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{ url('varian') }}">Variant</a></li>
                  <li><a class="nav-link" href="{{ url('downtime') }}">Downtime</a></li>
                  <li><a class="nav-link" href="{{ url('TimeReparation') }}">Preparation</a></li>
                  <li><a class="nav-link" href="{{ url('QuantityProduction') }}">Quantity Production</a></li>
                  <li><a class="nav-link" href="{{ route('FillingPerfomance.index') }}">Filling Performance</a></li>
                </ul>
              </li>
              <li class="menu-header"></li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa fa-plug"></i> <span>Engineering</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{ url('downtime') }}">Downtime</a></li>
                </ul>
              </li>
              <li class="menu-header"></li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-file-alt"></i> <span>QC</span></a>
                <ul class="dropdown-menu">
                   <li><a class="nav-link" href="{{ url('QuantityRelease') }}">Quantity Release QC</a></li>
                </ul>
              </li>
              <li class="menu-header"></li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa fa-money-bill"></i> <span>PPIC </span></a>
                <ul class="dropdown-menu">
                   <li><a class="nav-link" href="{{route('poproduksi.index')}}">PO Customer</a></li>
                </ul>
              </li>
        </aside>
      </div>
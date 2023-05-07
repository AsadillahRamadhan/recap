  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Recap App</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-header">Home</li>
          <li class="nav-item">
            <a href="/" class="nav-link @if($active == 'dashboard') {{ 'active' }} @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header">Product</li>
          <li class="nav-item">
            <a href="/products" class="nav-link @if($active == 'product') {{ 'active' }} @endif">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Product
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/histories" class="nav-link @if($active == 'history') {{ 'active' }} @endif">
              <i class="nav-icon fas fa-clock"></i>
              <p>
                History
              </p>
            </a>
          </li>
          <li class="nav-header">Financial</li>
          <li class="nav-item">
            <a href="/" class="nav-link @if($active == 'financial') {{ 'active' }} @endif">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Income Recap
              </p>
            </a>
          </li>
          <li class="nav-header">Share</li>
          <li class="nav-item">
            <a href="/" class="nav-link @if($active == 'share') {{ 'active' }} @endif">
              <i class="nav-icon fas fa-user-group"></i>
              <p>
                Product Sharing
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
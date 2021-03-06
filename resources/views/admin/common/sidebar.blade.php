  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/home') }}" class="brand-link">
      <img src="{{ asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name', 'Cruise Management system') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('uploads/'.$user->image) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ $user->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="{{ url('/home') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="fas fa-angle-right right"></i>     
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Cruise Ships
                <i class="fas fa-angle-left right"></i>                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/ships') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>See All</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/ships/create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                General Specifications
                <i class="fas fa-angle-left right"></i>                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item has-treeview">
                <a href="{{ url('/amenities') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Aminities
                    <i class="fas fa-angle-right right"></i>                
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="{{ url('/cruise-categories') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Cruise Categories
                    <i class="fas fa-angle-right right"></i>                
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="{{ url('/ship-types') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Ship Types
                    <i class="fas fa-angle-right right"></i>                
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="{{ url('/capacity-categories') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Capacity Categories
                    <i class="fas fa-angle-right right"></i>                
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-globe "></i>
              <p>
                Geography
                <i class="fas fa-angle-left right"></i>                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item has-treeview">
                <a href="{{ url('/islands') }}" class="nav-link">
                  <i class="far fas fa-mountain nav-icon"></i>
                  <p>
                    Islands
                    <i class="fas fa-angle-right right"></i>                
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="{{ url('/spots') }}" class="nav-link">
                  <i class="far fas fa-map-marker nav-icon"></i>
                  <p>
                    Spots
                    <i class="fas fa-angle-right right"></i>                
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="{{ url('/animals') }}" class="nav-link">
                  <i class="far fas fa-cat nav-icon"></i>
                  <p>
                    Animals/Birds
                    <i class="fas fa-angle-right right"></i>                
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ url('/itineraries') }}" onclick=""class="nav-link">
              <i class="nav-icon fas fas fa-globe-americas"></i>
              <p>
                Itineraries
                <i class="fas fa-angle-right right"></i>     
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ url('/tours') }}" onclick=""class="nav-link">
              <i class="nav-icon fas fas fa-plane-departure"></i>
              <p>
                Tours
                <i class="fas fa-angle-right right"></i>     
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ url('/users') }}" onclick=""class="nav-link">
              <i class="nav-icon fas fas fa-users"></i>
              <p>
                Manage Users
                <i class="fas fa-angle-right right"></i>     
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
                <i class="fas fa-angle-right right"></i>     
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

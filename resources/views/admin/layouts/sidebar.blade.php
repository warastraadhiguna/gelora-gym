  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ URL::to('/'); }}/admin/dashboard" class="brand-link">
      <img src="{{ URL::to('/storage'); }}/{{ $company->icon_url  }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Administrator</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ URL::to('/admin/dashboard'); }}" class="nav-link {{ Request::is('admin/dashboard')? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item  {{ Request::is('admin/company*') || Request::is('admin/social-media*')? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Perusahaan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ URL::to('/admin/company'); }}" class="nav-link {{ Request::is('admin/company*')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon ml-3"></i>
                  <p>Detail</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ URL::to('/admin/social-media'); }}" class="nav-link {{ Request::is('admin/social-media*')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon  ml-3"></i>
                  <p>Social Media</p>
                </a>
              </li>
            </ul>
          </li>   
          <li class="nav-item  {{ Request::is('admin/web*')? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-globe"></i>
              <p>
                Web
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ URL::to('/admin/web/banner'); }}" class="nav-link {{ Request::is('admin/web/banner')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon ml-3"></i>
                  <p>Banner</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ URL::to('/admin/web/benefit'); }}" class="nav-link {{ Request::is('admin/web/benefit')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon ml-3"></i>
                  <p>Benefit</p>
                </a>
              </li>
            </ul>      
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ URL::to('/admin/web/blog-category'); }}" class="nav-link {{ Request::is('admin/web/blog-category')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon ml-3"></i>
                  <p>Kategori Blog</p>
                </a>
              </li>
            </ul>         
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ URL::to('/admin/web/blog'); }}" class="nav-link {{ Request::is('admin/web/blog')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon ml-3"></i>
                  <p>Blog</p>
                </a>
              </li>
            </ul>     
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ URL::to('/admin/web/question'); }}" class="nav-link {{ Request::is('admin/web/question')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon ml-3"></i>
                  <p>Pertanyaan Umum</p>
                </a>
              </li>
            </ul>                                   
          </li>           
          <li class="nav-item  {{ Request::is('admin/building*') || Request::is('admin/court*') || Request::is('admin/schedule*') || Request::is('admin/weekly-booking*')? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Gedung
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ URL::to('/admin/building/type'); }}" class="nav-link {{ Request::is('admin/building/type')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon ml-3"></i>
                  <p>Jenis Gedung</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ URL::to('/admin/building'); }}" class="nav-link {{ Request::is('admin/building')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon ml-3"></i>
                  <p>Data Gedung</p>
                </a>
              </li>
            </ul>       
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ URL::to('/admin/court'); }}" class="nav-link {{ Request::is('admin/court*')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon ml-3"></i>
                  <p>Data Lapangan</p>
                </a>
              </li>
            </ul>     
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ URL::to('/admin/schedule'); }}" class="nav-link {{ Request::is('admin/schedule*')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon ml-3"></i>
                  <p>Data Jadwal</p>
                </a>
              </li>
            </ul>             
            {{-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ URL::to('/admin/weekly-booking'); }}" class="nav-link {{ Request::is('admin/weekly-booking*')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon ml-3"></i>
                  <p>Data Jadwal Mingguan</p>
                </a>
              </li>
            </ul>                                --}}
          </li>        
          <li class="nav-item  {{ Request::is('admin/receipt*')? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-receipt"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ URL::to('/admin/receipt'); }}" class="nav-link  {{ Request::is('admin/receipt*')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon ml-3"></i>
                  <p>Data Nota Sewa</p>
                </a>
              </li>
            </ul>
          </li>                          
          <li class="nav-item">
            <a href="{{ URL::to('/admin/user'); }}" class="nav-link {{ Request::is('admin/user*')? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User
              </p>
            </a>
          </li>            
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
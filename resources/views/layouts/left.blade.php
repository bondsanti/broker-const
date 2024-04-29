  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-1 sidebar-dark-lightblue sidebar-gardians">
    <!-- Brand Logo -->
    <a href="{{ route('main') }}" class="brand-link">

            <img src="{{ url('uploads/logo.png') }}" alt="vbeyond" class="brand-image elevation-0" style="opacity: .8">
            <span class="brand-text text-center"> VBEYOND {{ env('APP_NAME') }}</span>

    </a>



    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">

                <img src="{{ url('uploads/avatar.png') }}" class="img-circle elevation-2" alt="User Image">

            </div>
            <div class="info">
                <a href="#" class="d-block">คุณ </a>
            </div>
        </div>

            <!-- Sidebar -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('main') }}"
                            class="nav-link {{ request()->routeIs('main') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                แดชบอร์ด

                            </p>
                        </a>
                    </li>

                    <li class="nav-item">

                      <a style="" href=""
                          class="nav-link">
                          <i class="nav-icon fas fa-sign-out"></i>
                          <p>
                              ออกจากระบบ

                          </p>
                      </a>
                  </li>
                </ul>
            </nav>







        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

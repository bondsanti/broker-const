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
                      <a href="{{ route('main') }}" class="nav-link {{ request()->routeIs('main') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              แดชบอร์ด

                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-people-roof"></i>
                        <p>
                            ข้อมูลลูกค้า

                        </p>
                    </a>
                </li>
                  <li class="nav-item {{ request()->routeIs('users') ? 'menu-open' : '' }} {{ request()->routeIs('notify') ? 'menu-open' : '' }}">
                      <a href="#" class="nav-link {{ request()->routeIs('users') ? 'active' : '' }} {{ request()->routeIs('notify') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-cogs"></i>
                          <p>
                              ตั้งค่า
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">



                          <li class="nav-item">
                              <a href="{{route('users')}}" class="nav-link {{ request()->routeIs('users') ? 'active' : '' }}">
                                  <i class="fa fa-user nav-icon"></i>
                                  <p>ผู้ใช้งานระบบ</p>
                              </a>
                          </li>
                          <li class="nav-item">
                            <a href="{{route('notify')}}" class="nav-link {{ request()->routeIs('notify') ? 'active' : '' }}">
                                <i class="fa fa-envelope-circle-check nav-icon"></i>
                                <p>แจ้งเตือน</p>
                            </a>
                        </li>

                      </ul>
                  </li>
                  <li class="nav-item">

                      <a style="" href="" class="nav-link">
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

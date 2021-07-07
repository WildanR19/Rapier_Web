@if (auth()->user()->role_id == '1')
  <aside class="main-sidebar sidebar-dark elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dash.home') }}" class="brand-link">
      <img src="{{ asset('img/logo.png') }}" alt="Rapier Logo" class="brand-image" loading="lazy">
      <span class="brand-text font-weight-bolder">Rapier Tech</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
              <a href="{{ route('dash.home') }}" class="nav-link {{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
              </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>HR<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.employee') }}" class="nav-link {{ (request()->segment(2) == 'employee') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.department') }}" class="nav-link {{ (request()->segment(2) == 'department') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Department</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.job') }}" class="nav-link {{ (request()->segment(2) == 'job') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Job</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.leaves') }}" class="nav-link {{ (request()->segment(2) == 'leaves') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Leaves</p>
                </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('admin.payslip') }}" class="nav-link {{ (request()->segment(2) == 'payslip') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Payslip</p>
                  </a>
              </li>
              {{-- <li class="nav-item">
                  <a href="{{ route('admin.attendance') }}" class="nav-link {{ (request()->segment(2) == 'attendance') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Attendance</p>
                  </a>
              </li> --}}
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>Work<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.projects') }}" class="nav-link {{ (request()->segment(2) == 'projects') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Projects</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('dash.task') }}" class="nav-link {{ (request()->segment(1) == 'tasks') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tasks</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.event') }}" class="nav-link {{ (request()->segment(2) == 'event') ? 'active' : '' }}">
              <i class="nav-icon fas fa-calendar-week"></i>
              <p>Event</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
@else
<aside class="main-sidebar sidebar-dark elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('dash.home') }}" class="brand-link">
    <img src="{{ asset('img/logo.png') }}" alt="Rapier Logo" class="brand-image" loading="lazy">
    <span class="brand-text font-weight-bolder">Rapier Tech</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('dash.home') }}" class="nav-link {{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('dash.projects') }}" class="nav-link {{ (request()->segment(1) == 'projects') ? 'active' : '' }}">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>Projects</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('dash.task') }}" class="nav-link {{ (request()->segment(1) == 'tasks') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tasks"></i>
              <p>Tasks</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('dash.leave') }}" class="nav-link {{ (request()->segment(1) == 'leave') ? 'active' : '' }}">
              <i class="nav-icon fas fa-calendar-times"></i>
              <p>Leave</p>
          </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dash.payslip') }}" class="nav-link {{ (request()->segment(1) == 'payslip') ? 'active' : '' }}">
                <i class="nav-icon fas fa-money-bill-alt"></i>
                <p>Payslip</p>
            </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('dash.event') }}" class="nav-link {{ (request()->segment(1) == 'event') ? 'active' : '' }}">
            <i class="nav-icon fas fa-calendar-week"></i>
            <p>Event</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('dash.contacts') }}" class="nav-link {{ (request()->segment(1) == 'contacts') ? 'active' : '' }}">
            <i class="nav-icon fas fa-id-card"></i>
              <p>Contacts</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
@endif
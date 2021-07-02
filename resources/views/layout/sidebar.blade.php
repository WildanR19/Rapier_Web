@if (auth()->user()->role_id == '2')
<aside class="main-sidebar">
    <div class="sidebar p-0">
        <!-- Sidebar Menu -->
        <nav>
            <ul id="navbar" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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
                  <a href="{{ route('dash.task') }}" class="nav-link {{ (request()->segment(1) == 'task') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-chart-pie"></i>
                      <p>Tasks</p>
                  </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dash.goals') }}" class="nav-link {{ (request()->segment(1) == 'goals') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bullseye"></i>
                        <p>Goals</p>
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
                    <a href="{{ route('dash.holiday') }}" class="nav-link {{ (request()->segment(1) == 'holiday') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-plane-departure"></i>
                        <p>Holiday</p>
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
    </div>
    <div class="sidebar-overlay"></div>
</aside>
@endif

@if (auth()->user()->role_id == '1')
<aside class="main-sidebar">
    <div class="sidebar p-0">
        <!-- Sidebar Menu -->
        <nav>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dash.home') }}" class="nav-link {{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>HR<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                          <a href="{{ route('admin.employee') }}" class="nav-link {{ (request()->segment(2) == 'employee') ? 'active' : '' }}">
                            <p>Employee</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{ route('admin.department') }}" class="nav-link {{ (request()->segment(2) == 'department') ? 'active' : '' }}">
                            <p>Department</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{ route('admin.job') }}" class="nav-link {{ (request()->segment(2) == 'job') ? 'active' : '' }}">
                            <p>Job</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{ route('admin.leaves') }}" class="nav-link {{ (request()->segment(2) == 'leaves') ? 'active' : '' }}">
                            <p>Leaves</p>
                          </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.payslip') }}" class="nav-link {{ (request()->segment(2) == 'payslip') ? 'active' : '' }}">
                              <p>Payslip</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.attendance') }}" class="nav-link {{ (request()->segment(2) == 'attendance') ? 'active' : '' }}">
                              <p>Attendance</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>Work<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                          <a href="{{ route('admin.projects') }}" class="nav-link {{ (request()->segment(2) == 'projects') ? 'active' : '' }}">
                            <p>Projects</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{ route('dash.task') }}" class="nav-link {{ (request()->segment(1) == 'task') ? 'active' : '' }}">
                              <p>Tasks</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{ route('admin.goals') }}" class="nav-link {{ (request()->segment(2) == 'goals') ? 'active' : '' }}">
                            <p>Goals</p>
                          </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.holiday') }}" class="nav-link {{ (request()->segment(2) == 'holiday') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-plane-departure"></i>
                    <p>Holiday</p>
                  </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="sidebar-overlay"></div>
</aside>
@endif
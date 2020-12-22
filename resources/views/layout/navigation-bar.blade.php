@if (auth()->user()->role_id == '2')
<aside class="main-sidebar">
    <div class="sidebar p-0">
        <!-- Sidebar Menu -->
        <nav class="mt-2 bg-primary">
            <ul id="navbar" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="background-color: #59BECD;">
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
                    <a href="#" class="nav-link {{ (request()->segment(1) == 'tasks') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tasks"></i>
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
                    <a href="{{ route('dash.teams') }}" class="nav-link {{ (request()->segment(1) == 'teams') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Teams</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dash.payslip') }}" class="nav-link {{ (request()->segment(1) == 'payslip') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-money-bill-alt"></i>
                        <p>Payslip</p>
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
        <nav class="mt-2 bg-primary">
            <ul id="navbar" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="background-color: #59BECD;">
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
                          <a href="{{ route('dash.employee') }}" class="nav-link">
                            <p>Employee</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{ route('dash.department') }}" class="nav-link">
                            <p>Department</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{ route('dash.job') }}" class="nav-link">
                            <p>Job</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            <p>Attendance</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            <p>Leaves</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            <p>Holiday</p>
                          </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                              <p>Payslip</p>
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
                          <a href="#" class="nav-link">
                            <p>Projects</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            <p>Tasks</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            <p>Time Logs</p>
                          </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Report<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            <p>Task Report</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            <p>Leave Report</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            <p>Attendance Report</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            <p>Payslip Report</p>
                          </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    <div class="sidebar-overlay"></div>
</aside>
@endif
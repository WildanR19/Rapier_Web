@if (Auth::user()->role_id == 2)
<aside class="main-sidebar" style="margin-top:55px;">
    <div class="sidebar p-0">
        <!-- Sidebar Menu -->
        <nav class="mt-2 bg-primary text-center">
            <ul id="navbar" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="background-color: #59BECD;">
                <li class="nav-item">
                    <a href="{{ route('dash.home') }}" class="nav-link {{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}">
                        <p class="text-white">Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dash.projects') }}" class="nav-link {{ (request()->segment(1) == 'projects') ? 'active' : '' }}">
                        <p class="text-white">Projects</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dash.goals') }}" class="nav-link {{ (request()->segment(1) == 'goals') ? 'active' : '' }}">
                        <p class="text-white">Goals</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dash.leave') }}" class="nav-link {{ (request()->segment(1) == 'leave') ? 'active' : '' }}">
                        <p class="text-white">Leave</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dash.teams') }}" class="nav-link {{ (request()->segment(1) == 'teams') ? 'active' : '' }}">
                        <p class="text-white">Teams</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dash.payslip') }}" class="nav-link {{ (request()->segment(1) == 'payslip') ? 'active' : '' }}">
                        <p class="text-white">Payslip</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="sidebar-overlay"></div>
</aside>
@endif

@if (Auth::user()->role_id == 1)
<aside class="main-sidebar" style="margin-top:55px;">
    <div class="sidebar p-0">
        <!-- Sidebar Menu -->
        <nav class="mt-2 bg-primary text-center">
            <ul id="navbar" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="background-color: #59BECD;">
                <li class="nav-item">
                    <a href="{{ route('dash.employee') }}" class="nav-link {{ (request()->segment(1) == 'employee') ? 'active' : '' }}">
                        <p class="text-white">Employee</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dash.department') }}" class="nav-link {{ (request()->segment(1) == 'department') ? 'active' : '' }}">
                        <p class="text-white">Department</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dash.jobs') }}" class="nav-link {{ (request()->segment(1) == 'jobs') ? 'active' : '' }}">
                        <p class="text-white">Jobs</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="sidebar-overlay"></div>
</aside>
@endif
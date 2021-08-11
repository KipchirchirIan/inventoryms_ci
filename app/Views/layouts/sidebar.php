<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?php echo base_url('employee/dashboard'); ?>">Inventori</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo base_url('employee/dashboard'); ?>">In</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown active">
                <a href="<?= base_url('employee/dashboard') ?>" class="nav-link"><i class="fas fa-columns"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Quick Actions</li>
            <li class="dropdown">
                <a href="<?= base_url('employee/item/checkInOut') ?>" class="nav-link"><i class="fas fa-sort"></i><span>Check In/Out</span></a>
            </li>
            <li class="menu-header">Manage Users</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user-friends"></i><span>Employees</span></a>
                <ul class="dropdown-menu">
                    <li class=""><a class="nav-link" href="<?php echo base_url('employee/employee/index') ?>">View
                            Employees</a></li>
                </ul>
            </li>
            <li class="menu-header">Manage Items</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-list"></i>
                    <span>Items</span></a>
                <ul class="dropdown-menu">
                    <li class=""><a
                                class="nav-link"
                                href="<?php echo base_url('employee/item/index'); ?>">View Items</a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" target="_blank" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-paper-plane"></i>Support
            </a>
        </div>
    </aside>
</div>

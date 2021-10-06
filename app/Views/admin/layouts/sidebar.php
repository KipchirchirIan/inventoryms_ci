<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?php echo base_url('admin/dashboard'); ?>">Rescue Dada Centre</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo base_url('admin/dashboard'); ?>">RDC</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown active">
                <a href="<?= base_url('admin/dashboard') ?>" class="nav-link"><i class="fas fa-columns"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Quick Actions</li>
            <li class="dropdown">
                <a href="<?= base_url('admin/item/checkInOut') ?>" class="nav-link"><i class="fas fa-sort"></i><span>Check In/Out</span></a>
            </li>
            <li class="menu-header">Manage Users</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user-cog"></i> <span>Administrators</span></a>
                <ul class="dropdown-menu">
                    <li class=""><a
                                class="nav-link" href="<?php echo base_url(); ?>">View Admins</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-user-friends"></i><span>Employees</span></a>
                <ul class="dropdown-menu">
                    <li class=""><a class="nav-link" href="<?php echo base_url('admin/employee/create') ?>">Add
                            Employee</a></li>
                    <li class=""><a class="nav-link" href="<?php echo base_url('admin/employee/index') ?>">View
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
                                href="<?php echo base_url('admin/item/create'); ?>">Add Item</a>
                    </li>
                    <li class=""><a
                                class="nav-link"
                                href="<?php echo base_url('admin/item/index'); ?>">View Items</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Manage Item Categories</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i>
                    <span>Item Categories</span></a>
                <ul class="dropdown-menu">
                    <li class=""><a
                                class="nav-link"
                                href="<?php echo base_url('admin/category/create'); ?>">Add Category</a>
                    </li>
                    <li class=""><a
                                class="nav-link"
                                href="<?php echo base_url('admin/category/index'); ?>">View Categories</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Manage UoMs</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-balance-scale"></i>
                    <span>Unit of Measurements</span></a>
                <ul class="dropdown-menu">
                    <li class=""><a
                                class="nav-link"
                                href="<?php echo base_url('admin/uom/create'); ?>">Add UoM</a>
                    </li>
                    <li class=""><a
                                class="nav-link"
                                href="<?php echo base_url('admin/uom/index'); ?>">View UoMs</a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" target="_blank"
               class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-paper-plane"></i>Support
            </a>
        </div>
    </aside>
</div>

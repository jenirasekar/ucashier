<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        
        <span class="brand-text font-weight-light">UCashier</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/admin/dashboard" class="nav-link <?php echo e(Request::is('admin/dashboard') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Dashboard</p>
                    </a>
                <li class="nav-item">
                    <a href="/admin/transaksi" class="nav-link <?php echo e(Request::is('admin/transaksi') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>Transaksi</p>
                    </a>
                </li>
                <?php if(auth()->guard()->check()): ?>
                    <li class="nav-item">
                        <a href="/admin/produk" class="nav-link <?php echo e(Request::is('admin/produk*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-table"></i>
                            <p>Produk</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/kategori" class="nav-link <?php echo e(Request::is('admin/kategori*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-list"></i>
                            <p>Kategori</p>
                        </a>
                    </li>
                    <li class="nav-item" style="display: <?php echo e(auth()->user()->role != 'admin' ? 'none' : 'block'); ?>">
                        <a href="/admin/user" class="nav-link <?php echo e(Request::is('admin/user*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>User</p>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<div class="content-wrapper">
<?php /**PATH E:\ucashier\resources\views/admin/layouts/sidebar.blade.php ENDPATH**/ ?>
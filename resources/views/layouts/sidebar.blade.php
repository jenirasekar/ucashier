<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light"><b>Kasir</b>Ku</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @auth
                    @if (auth()->user()->isAdmin())
                        <!-- Display only for Admin -->
                        <li class="nav-item">
                            <a href="/admin/user" class="nav-link {{ Request::is('admin/user*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    User
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/produk" class="nav-link {{ Request::is('admin/produk*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Produk
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/kategori" class="nav-link {{ Request::is('admin/kategori*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Kategori
                                </p>
                            </a>
                        </li>
                    @endif

                    @if (auth()->user()->isManager())
                        <!-- Display only for Manager -->
                        <li class="nav-item">
                            <a href="/produk" class="nav-link {{ Request::is('produk*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Produk
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/kategori" class="nav-link {{ Request::is('kategori*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Kategori
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/transaksi" class="nav-link {{ Request::is('transaksi*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-exchange-alt"></i>
                                <p>
                                    Transaksi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/pelanggan" class="nav-link {{ Request::is('pelanggan*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Pelanggan
                                </p>
                            </a>
                    @endif
                    <li class="nav-item">
                        <a href="/laporan" class="nav-link {{ Request::is('laporan*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-solid fa-book"></i>
                            <p>
                                Laporan
                            </p>
                        </a>
                    </li>
                @endauth
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<div class="content-wrapper">

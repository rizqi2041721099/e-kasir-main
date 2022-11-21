<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mb-1 text-muted">
                <span>Profile</span>
                <span class="fas fa-user-circle"></span>
            </h6>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.edit', ['id' => Auth::user()->id]) }}">
                    {{ Auth::user()->name }}
                </a>
            </li>
            <li class="nav-item">
                <a role="button" class="nav-link btn-logout">
                    <span class="fas fa-right-from-bracket"></span>
                    Logout
                </a>
            </li>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Menu</span>
                <span class="fas fa-ellipsis-vertical"></span>
            </h6>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <span class="fas fa-house"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('user', 'user/*') ? 'active' : '' }}" href="{{ route('user') }}">
                    <span class="fas fa-users"></span>
                    Pengguna
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('product-category', 'product-category/*') ? 'active' : '' }}" href="{{ route('product-category') }}">
                    <span class="fas fa-boxes"></span>
                    Kategori Barang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('product', 'product/*') ? 'active' : '' }}" href="{{ route('product') }}">
                    <span class="fas fa-box"></span>
                    Barang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('transaction', 'transaction/*') ? 'active' : '' }}" href="{{ route('transaction') }}">
                    <span class="fas fa-cash-register"></span>
                    Transaksi
                </a>
            </li>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Kasir</span>
                <span class="fas fa-ellipsis-vertical"></span>
            </h6>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('cashier', 'cashier/*') ? 'active' : '' }}" href="{{ route('cashier') }}">
                    <span class="fas fa-cash-register"></span>
                    Kasir
                </a>
            </li>
        </ul>
    </div>
</nav>

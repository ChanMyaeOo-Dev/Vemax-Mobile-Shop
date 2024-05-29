<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center" href="{{ route('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-shipping-fast"></i>
        </div>
        <div class="sidebar-brand-text mx-1">VeMax Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Store
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->routeIs('products*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{ route('products.index') }}" data-toggle="collapse"
            data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-solid fa-tags"></i>
            <span>Product</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Management</h6>
                <a class="collapse-item" href="{{ route('products.index') }}">Product List</a>
                <a class="collapse-item" href="{{ route('products.create') }}">Add Product</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ request()->routeIs('categories*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{ route('categories.index') }}" data-toggle="collapse"
            data-target="#collapseCategory" aria-expanded="true" aria-controls="collapseCategory">
            <i class="fas fa-solid fa-layer-group"></i>
            <span>Category</span>
        </a>
        <div id="collapseCategory" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Management:</h6>
                <a class="collapse-item" href="{{ route('categories.index') }}">Category List</a>
            </div>
        </div>
    </li>


    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ request()->routeIs('orders*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{ route('categories.index') }}" data-toggle="collapse"
            data-target="#collapseOrder" aria-expanded="true" aria-controls="collapseOrder">
            <i class="fas fa-shopping-cart"></i>
            <span>Orders</span>
        </a>
        <div id="collapseOrder" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Customer Orders:</h6>
                <a class="collapse-item" href="{{ route('orders.index') }}">
                    New Orders
                    <span class="badge rounded-pill text-bg-danger ms-3 text-white">99+</span>
                </a>
                <a class="collapse-item" href="{{ route('order-shipping') }}">
                    Shipping Orders
                    <span class="badge rounded-pill text-bg-danger ms-3 text-white">99+</span>
                </a>
                <a class="collapse-item" href="{{ route('order-delivered') }}">
                    Delivered Orders
                    <span class="badge rounded-pill text-bg-danger ms-3 text-white">99+</span>
                </a>
            </div>
        </div>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Trash -->
    <li class="nav-item {{ request()->routeIs('trash*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('trash') }}">
            <i class="fas fa-trash-alt"></i>
            <span>Trash</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        {{-- <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="..."> --}}
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and
            more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Client View</a>
    </div>

</ul>

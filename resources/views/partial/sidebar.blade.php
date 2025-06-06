<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="/" class="logo text-white">
                Logistic System
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item active" id="dashboard">
                    <a class="collapsed" aria-expanded="false" href="/">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item" id="product-page">
                    <a href="/product">
                        <i class="fas fa-box"></i>
                        <p>Product</p>
                    </a>
                </li>
                <li class="nav-item" id="transaction-page">
                    <a data-bs-toggle="collapse" href="#submenu">
                        <i class="fas fa-file-invoice"></i>
                        <p>Transaction</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="submenu">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="/transaction/tableIn">
                                    <p>Transaction In</p>
                                </a>
                            </li>
                            <li>
                                <a href="/transaction/tableOut">
                                    <p>Transaction Out</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item" id="storage-page">
                    <a href="/storage">
                        <i class="fas fa-boxes"></i>
                        <p>Storage</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

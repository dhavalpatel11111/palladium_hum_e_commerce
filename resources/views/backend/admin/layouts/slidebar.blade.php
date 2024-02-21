@php
    $currentRouteName = \Route::currentRouteName();

@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link text-decoration-none">
            <span class="app-brand-text text-large menu-text fw-bolder ms-2">Admin Panel</span>
        </a>

        <a href="javascript:void(0);"
            class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item">
            <a href="index.html" class="menu-link text-decoration-none">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="index.html" class="menu-link text-decoration-none">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">User</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="index.html" class="menu-link text-decoration-none">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Product</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('admin.category') }}" class="menu-link text-decoration-none">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Category</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('admin.sub_category') }}" class="menu-link text-decoration-none">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Sub Category</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="index.html" class="menu-link text-decoration-none">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Purchase Order</div>
            </a>
        </li>


    </ul>
</aside>

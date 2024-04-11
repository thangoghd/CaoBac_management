<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion sidebar-fixed" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Cáo Bạc</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Tổng quan</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Report revenue Pages Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#reportPages"
            aria-expanded="true" aria-controls="reportPages">
            <i class="fa-regular fa-flag"></i>
            <span>Báo cáo</span>
        </a>
        <div id="reportPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('revenue.report')}}">BC bán hàng</a>
                <a class="collapse-item" href="">BC chi phí</a>
                <a class="collapse-item" href="">BC đơn hàng</a>
                <a class="collapse-item" href="">BC tồn kho</a>
                <a class="collapse-item" href="">BC công nợ nhà cung cấp</a>
                <div class="collapse-divider"></div>
            </div>
        </div>
    </li>
    <!-- Nav Item - Orders Pages Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ordersPages"
            aria-expanded="true" aria-controls="ordersPages">
            <i class="fa-solid fa-receipt"></i>
            <span>Đơn hàng</span>
        </a>
        <div id="ordersPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('add.order')}}">Tạo đơn hàng</a>
                <a class="collapse-item" href="{{route('view.orders')}}">Danh sách đơn hàng</a>
                <div class="collapse-divider"></div>
            </div>
        </div>
    </li>

      <!-- Nav Item - Categories & Products Pages Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#productsPages"
            aria-expanded="true" aria-controls="productsPages">
            <i class="fab fa-product-hunt"></i>
            <span>Sản phẩm</span>
        </a>
        <div id="productsPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('view.category') }}">Nhóm sản phẩm</a>
                <a class="collapse-item" href="{{ route('add.product') }}">Tạo sản phẩm</a>
                <a class="collapse-item" href="{{ route('view.product') }}">Danh sách sản phẩm</a>
                <div class="collapse-divider"></div>
            </div>
        </div>
    </li>

    <!-- Nav Item - Recieve goods revenue Pages Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#recieveGoodsPages"
            aria-expanded="true" aria-controls="recieveGoodsPages">
            <i class="fa-solid fa-parachute-box"></i>
            <span>Nhập hàng</span>
        </a>
        <div id="recieveGoodsPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('add.recienote')}}">Tạo đơn nhập hàng</a>
                <a class="collapse-item" href="{{route('view.recienotes')}}">Danh sách nhập hàng</a>
                <div class="collapse-divider"></div>
            </div>
        </div>
    </li>


    <!-- Nav Item - Delivery goods revenue Pages Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#deliveryGoodsPages"
            aria-expanded="true" aria-controls="deliveryGoodsPages">
            <i class="fa-solid fa-truck"></i>
            <span>Chuyển hàng</span>
        </a>
        <div id="deliveryGoodsPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('add.delinote')}}">Tạo đơn chuyển hàng</a>
                <a class="collapse-item" href="">Danh sách chuyển hàng</a>
                <div class="collapse-divider"></div>
            </div>
        </div>
    </li>

    
    <!-- Nav Item - Inventory goods revenue Pages Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inventoryGoodsPages"
            aria-expanded="true" aria-controls="inventoryGoodsPages">
            <i class="fa-solid fa-warehouse"></i>
            <span>Kiểm kê</span>
        </a>
        <div id="inventoryGoodsPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="" >Danh sách đơn vị cung ứng & yêu cầu</a>
                <a class="collapse-item" href="" >Danh sách hàng tồn</a>
                <div class="collapse-divider"></div>
            </div>
        </div>
    </li>

    <!-- Nav Item - Customers Pages Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#customersPages"
            aria-expanded="true" aria-controls="customersPages">
            <i class="fa-solid fa-person"></i>
            <span>Khách hàng</span>
        </a>
        <div id="customersPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('add.customer')}}">Tạo khách hàng</a>
                <a class="collapse-item" href="{{route('view.customers')}}">Danh sách khách hàng</a>
                <div class="collapse-divider"></div>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
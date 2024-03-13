<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="index.html" class="navbar-brand mx-4 mb-3">

            <h3 class="text-primary">
                <img src="/img/sidebar.png"  style="width: 215px; height: 100%;" class="logo">           
              </h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                {{-- <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;"> --}}
                <i class="fas fa-user"></i>
                {{-- <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div> --}}
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="/admin/dorm/dashboard" class="nav-item nav-link"><i class="fa fa-chart-line me-2"></i>Dashboard</a>
            {{-- <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Residents</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="button.html" class="dropdown-item">Students</a>
                    <a href="typography.html" class="dropdown-item">Faculty</a>
                    <a href="element.html" class="dropdown-item">Staff</a>
                </div>
            </div> --}}
            <a href="/admin/dorm/residents" class="nav-item nav-link"><i class="fa fa-users me-2"></i>Residents</a>
            <a href="/admin/dorm/rooms" class="nav-item nav-link"><i class="fa fa-person-booth me-2"></i>Rooms</a>
            <a href="/admin/dorm/announcements" class="nav-item nav-link"><i class="fa fa-bullhorn me-2"></i>Announcements</a>
            <a href="/admin/dorm/transactions" class="nav-item nav-link"><i class="fa fa-file-invoice-dollar me-2"></i>Payments</a>
            <a href="/admin/dorm/maintenance" class="nav-item nav-link"><i class="fa fa-solid fa-wrench me-2"></i></i>Maintenance</a>

            <a href="/admin/dorm/violations" class="nav-item nav-link"><i class="fa fa-user-alt-slash me-2"></i>Violations</a>
            <a href="/admin/dorm/laundry" class="nav-item nav-link"><i class="fa fa-calendar me-2"></i>Laundry</a>
            <a href="/admin/dorm/lostandfound" class="nav-item nav-link"><i class="fa fa-eye me-2"></i>Lost and Found</a>

            
        </div>
    </nav>
</div>
<!-- Sidebar End -->
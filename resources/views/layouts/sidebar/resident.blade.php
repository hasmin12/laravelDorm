<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="index.html" class="navbar-brand mx-4 mb-3">

            <h3 class="text-primary">
                <img class="rounded-circle" src="/img/tuplogo.png"  style="width: 40px; height: 40px;" class="logo me-2">
                DormXtend
              </h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                {{-- <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;"> --}}
                <i class="fas fa-user"></i>
                {{-- <span class="d-none d-lg-inline-flex">{{ auth()->user()->name }}</span> --}}
                {{-- <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div> --}}
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                <span>Resident</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            {{-- <a href="/profile" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Profile</a> --}}
            <a href="/resident/announcements" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Announcements</a>
            <a href="/resident/billingandpayment" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Billing</a>
            <a href="/resident/maintenance" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Maintenance</a>
            <a href="/resident/laundry" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Laundry</a>
            <a href="/resident/lostandfound" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Lost and Found</a>

            <a href="/resident/laundry" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Violations</a>
            
            {{-- <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Residents</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="button.html" class="dropdown-item">Students</a>
                    <a href="typography.html" class="dropdown-item">Faculty</a>
                    <a href="element.html" class="dropdown-item">Staff</a>
                </div>
            </div> --}}
            {{-- <a href="/residents" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Residents</a>
            <a href="/rooms" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Rooms</a>
            <a href="/announcements" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Announcements</a>
            <a href="/transactions" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Transactions</a>
            <a href="/violations" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Violations</a>
            <a href="/laundry" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Laundry</a>
            <a href="/lostandfound" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Lost and Found</a> --}}

            
        </div>
    </nav>
</div>
<!-- Sidebar End -->
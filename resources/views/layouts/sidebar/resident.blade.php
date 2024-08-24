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
            @if(auth()->user()->branch=="Hostel")
            <a href="/resident/reservations" class="nav-item nav-link"><i class="fa fa-bullhorn me-2"></i>Reservations</a>
            @endif
            <a href="/resident/announcements" class="nav-item nav-link"><i class="fa fa-bullhorn me-2"></i>Announcements</a>
            @if(auth()->user()->branch=="Dormitory")
            <a href="/resident/payments" class="nav-item nav-link"><i class="fa fa-file-invoice-dollar me-2"></i>Bills</a>
            @endif
            <a href="/resident/maintenance" class="nav-item nav-link"><i class="fa fa-solid fa-wrench me-2"></i>Maintenance</a>
            <a href="/resident/laundry" class="nav-item nav-link"><i class="fa fa-calendar me-2"></i>Laundry</a>
            <a href="/resident/lostandfound" class="nav-item nav-link"><i class="fa fa-eye me-2"></i>Lost and Found</a>            
        </div>
    </nav>
</div>
<!-- Sidebar End -->
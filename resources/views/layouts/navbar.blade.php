<!-- Navbar Start -->
<nav class="navbar navbar-expand bg-primary navbar-light sticky-top px-4 py-0">
    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    
    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown" id="notificationsRead">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-bell me-lg-2" style="position: relative;"> 
                    <span id="notification-count" class="badge bg-danger" style="position: absolute; bottom: 0; right: 0;"></span>
                </i>
                
                <span class="d-none d-lg-inline-flex" style="color: white; cursor: pointer;" onmouseover="this.style.color='red'" onmouseout="this.style.color='white'">Notifications</span>
            </a>
            <div id="notifications" class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0 w-5">
                <!-- Notifications will be dynamically inserted here -->
            </div>
        </div>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                {{-- <img class="rounded-circle me-lg-2" src="{{asset('img/user.jpg')}}" alt="" style="width: 40px; height: 40px;"> --}}
                <i class="fas fa-user"></i>
                <span class="d-none d-lg-inline-flex" style="color: white; cursor: pointer;" onmouseover="this.style.color='red'" onmouseout="this.style.color='white'">{{ auth()->user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="#" class="dropdown-item">My Profile</a>
                <a href="#" class="dropdown-item">Settings</a>
                {{-- <a href="{{ route('logout') }}" class="dropdown-item">Logout</a> --}}
                <button id="logoutButton" class="dropdown-item">Logout</button>
            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->
<script src="{{ secure_asset('js/auth.js') }}"></script>

@extends('layouts.base')

@section('content')
<head>
    <meta charset="utf-8">
    <title>Hostel Reserve - DormXtend</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    {{-- <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet"> --}}

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css1/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css1/style.css" rel="stylesheet">
</head>

   <!-- Topbar Start -->
   <div class="container-fluid px-5 d-none d-lg-block">
    <div class="row gx-5">
        <div class="col-lg-4 text-center py-3">
            <div class="d-inline-flex align-items-center">
                <i class="bi bi-geo-alt fs-1 text-primary me-3"></i>
                <div class="text-start">
                    <h6 class="text-uppercase fw-bold">Location</h6>
                    <span>Km 14. East Service Road, Western Bicutan, Taguig, Philippines</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-center border-start border-end py-3">
            <div class="d-inline-flex align-items-center">
                <i class="bi bi-envelope-open fs-1 text-primary me-3"></i>
                <div class="text-start">
                    <h6 class="text-uppercase fw-bold">Email Us</h6>
                    <span>dormxtend@tup.edu.ph</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-center py-3">
            <div class="d-inline-flex align-items-center">
                <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
                <div class="text-start">
                    <h6 class="text-uppercase fw-bold">Call Us</h6>
                    <span>09-XXX-XXX-XXXX</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar Start -->
<div class="container-fluid sticky-top bg-dark bg-light-radial shadow-sm px-5 pe-lg-0">
    <nav class="navbar navbar-expand-lg bg-dark bg-light-radial navbar-dark py-3 py-lg-0">
        <a href="index.html" class="navbar-brand">
            <h1 class="m-0 display-4 text-uppercase text-white">DORMXTEND</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                {{-- <a href="index.html" class="nav-item nav-link active">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <a href="service.html" class="nav-item nav-link">Service</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu m-0">
                        <a href="project.html" class="dropdown-item">Our Project</a>
                        <a href="team.html" class="dropdown-item">The Team</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="blog.html" class="dropdown-item">Blog Grid</a>
                        <a href="detail.html" class="dropdown-item">Blog Detail</a>
                    </div>
                </div> --}}
                <a href="http://localhost:8000/visitor" class="nav-item nav-link bg-primary text-white px-5 ms-3 d-none d-lg-block">Book a Visit <i class="bi bi-arrow-right"></i></a>

            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->

<div class="full-width-container">
    <section class="hero-section" style="background-image: url('{{ secure_asset('/img/tt.jpg')}}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">                 
                    <div class="hero-text">
                        <h1>DormXtend</h1>
                        <p>Dormitory and Hostel for TUP students, faculty, staffs, and visitors of the school.</p>
                        <a href="#" class="primary-btn">Discover Now</a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1">
                    {{-- <div class="service-item bg-white rounded d-flex flex-column align-items-center text-center"> --}}
                        {{-- <img class="img-fluid" src="img/service-2.jpg" alt=""> --}}
                        {{-- <div class="service-icon bg-white">
                            <i class="fa fa-3x fa-home text-primary"></i>
                        </div> --}}
                       <div class="booking-form">
                        <div class="service-icon bg-white y-3">
                            {{-- <i class="fa fa-3x fa-home text-primary"></i> --}}
                            <h4>Login</h4>
                        </div>
                        <form id="loginForm">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control custom-input" id="floatingInput" placeholder="name@example.com" name="email" >
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control custom-input" id="floatingPassword" placeholder="Password" name="password">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <a href="">Forgot Password</a>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-3">Sign In</button>
                            
                        </form>
                        <button onclick="window.location.href='{{ url('register') }}'" class="btn btn-primary w-100 py-3" style="margin-bottom:10px;">Apply Here</button>
                      
                        
                    </div>
                    <a href="{{ url('/auth/google') }}" class="btn btn-primary w-100 py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 48 48">
                            <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path><path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path><path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path><path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
                        </svg>
                        Google Sign In
                    </a>
                {{-- </div> --}}
                
                    </div>
                </div>
                
            </div>
        </div>
        <script src="{{ secure_asset('js/auth.js') }}"></script>
    </section>
    
    <!-- Sign In End -->
</div>





@include('layouts.footer')
@endsection

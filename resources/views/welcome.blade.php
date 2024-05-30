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
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

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
                        <h6 class="text-uppercase fw-bold">Our Office</h6>
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
            <a href="/" class="navbar-brand">
                <h1 class="m-0 display-4 text-uppercase text-white">DORMXTEND</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="http://localhost:8000/login" class="nav-item nav-link bg-primary text-white px-5 ms-3 d-none d-lg-block">Login</a>
    
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/land.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center width: fit-content;">
                        <div class="p-3" style="max-width: 900px;">
                            <i class="fa fa-home fa-4x text-primary mb-4 d-none d-sm-block"></i>
                            <h1 class="display-2 text-uppercase text-white mb-md-4">HOSTEL</h1>
                            <a href="{{ route('hostelrooms') }}" class="btn btn-primary py-md-3 px-md-5 mt-2">Book a Room</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/tup1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <i class="fa fa-building fa-4x text-primary mb-4 d-none d-sm-block"></i>
                            <h1 class="display-2 text-uppercase text-white mb-md-4">DORMITORY</h1>
                            <a href="{{ route('register') }}" class="btn btn-primary py-md-3 px-md-5 mt-2">Apply</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->

    <div class="container-fluid bg-light py-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 text-uppercase mb-4">Some Of Our <span class="text-primary">Popular</span> Dream Projects</h1>
        </div>
        <div class="row gx-5">
            <div class="col-12 text-center">
                <div class="d-inline-block bg-dark-radial text-center pt-4 px-5 mb-5">
                    <ul class="list-inline mb-0" id="portfolio-flters">
                        <li class="btn btn-outline-primary bg-white p-2 active mx-2 mb-4" data-filter="*">
                            <img src="/img/overlook.jpg" style="width: 150px; height: 100px;">
                            <div class="position-absolute top-0 start-0 end-0 bottom-0 m-2 d-flex align-items-center justify-content-center" style="background: rgba(4, 15, 40, .3);">
                                <h6 class="text-white text-uppercase m-0">All</h6>
                            </div>
                        </li>
                        <li class="btn btn-outline-primary bg-white p-2 mx-2 mb-4" data-filter=".first">
                            <img src="img/dormgallery2.jpg" style="width: 150px; height: 100px;">
                            <div class="position-absolute top-0 start-0 end-0 bottom-0 m-2 d-flex align-items-center justify-content-center" style="background: rgba(4, 15, 40, .3);">
                                <h6 class="text-white text-uppercase m-0">First Floor</h6>
                            </div>
                        </li>
                        <li class="btn btn-outline-primary bg-white p-2 mx-2 mb-4" data-filter=".second">
                            <img src="img/land.jpg" style="width: 150px; height: 100px;">
                            <div class="position-absolute top-0 start-0 end-0 bottom-0 m-2 d-flex align-items-center justify-content-center" style="background: rgba(4, 15, 40, .3);">
                                <h6 class="text-white text-uppercase m-0">Second Floor</h6>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row g-5 portfolio-container">
            <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item first">
                <div class="position-relative portfolio-box">
                    <img class="img-fluid w-100" src="img/facility1.jpg" style="height: 337px; width: 281px;" alt="">
                    <a class="portfolio-title shadow-sm" href="">
                        <p class="h4 text-center text-uppercase"><i class="fa fa-map-marker-alt text-primary me-2"></i>Building</p>
                    </a>
                    <a class="portfolio-btn" href="css1" data-lightbox="portfolio">
                        <i class="bi bi-plus text-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item second">
                <div class="position-relative portfolio-box">
                    <img class="img-fluid w-100" src="img/overlook2.jpg" style="height: 337px; width: 281px;" alt="">
                    <a class="portfolio-title shadow-sm" href="">
                        <p class="h4 text-center text-uppercase"><i class="fa fa-map-marker-alt text-primary me-2"></i>View</p>
                    </a>
                    <a class="portfolio-btn" href="img/overlook2.jpg" style="height: 337px; width: 281px;" data-lightbox="portfolio">
                        <i class="bi bi-plus text-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item first">
                <div class="position-relative portfolio-box">
                    <img class="img-fluid w-100" src="img/dorm1.jpg" style="height: 337px; width: 281px;" alt="">
                    <a class="portfolio-title shadow-sm" href="">
                        <p class="h4 text-center text-uppercase"><i class="fa fa-map-marker-alt text-primary me-2"></i>Hallway</p>
                       
                    </a>
                    <a class="portfolio-btn" href="img/dorm1.jpg" style="height: 337px; width: 281px;" data-lightbox="portfolio">
                        <i class="bi bi-plus text-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item second">
                <div class="position-relative portfolio-box">
                    <img class="img-fluid w-100" src="img/dorm2.jpg" style="height: 337px; width: 281px;" alt="">
                    <a class="portfolio-title shadow-sm" href="">
                        <p class="h4 text-center text-uppercase"><i class="fa fa-map-marker-alt text-primary me-2"></i>Study Area</p>
                    </a>
                    <a class="portfolio-btn" href="img/dorm2.jpg" style="height: 337px; width: 281px;" data-lightbox="portfolio">
                   
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item first">
                <div class="position-relative portfolio-box">
                    <img class="img-fluid w-100" src="img/kitchen.jpg" style="height: 337px; width: 281px;" alt="">
                    <a class="portfolio-title shadow-sm" href="">
                        <p class="h4 text-center text-uppercase"><i class="fa fa-map-marker-alt text-primary me-2"></i>Kitchen / Laundry</p>
                
                    </a>
                    <a class="portfolio-btn" href="img/kitchen.jpg" style="height: 337px; width: 281px;" data-lightbox="portfolio">
                        <i class="bi bi-plus text-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item second">
                <div class="position-relative portfolio-box">
                    <img class="img-fluid w-100" src="img/dorm2nd.jpg" style="height: 337px; width: 281px;">
                    <a class="portfolio-title shadow-sm" href="">
                        <p class="h4 text-center text-uppercase"><i class="fa fa-map-marker-alt text-primary me-2"></i>Living Room</p>
            
                    </a>
                    <a class="portfolio-btn" href="img/dorm2nd.jpg" style="height: 337px; width: 281px;" data-lightbox="portfolio">
                        <i class="bi bi-plus text-white"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-6 px-5">
        <div class="mb-4">
            <h1 class="display-5 text-center text-uppercase mb-4">Dormitory <span class="text-primary">Video</span> Tour</h1>
        </div>
        <video autoplay muted loop width="100%" height="auto">
            <source src="img/vid1.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>


    <div class="container-fluid bg-light py-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 text-uppercase mb-4">KNOW MORE ABOUT <span class="text-primary">Hostel</span></h1>
        </div>
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <div class="service-item bg-white d-flex flex-column align-items-center text-center">
                    <img class="img-fluid" src="img/hostel1.jpg" style="height: 180px; width:200%;" alt="">
                    <div class="service-icon bg-white">
                        <i class="fa fa-3x fa-building text-primary"></i>
                    </div>
                    <div class="px-4 pb-4">
                        <h4 class="text-uppercase mb-3">Facility</h4>
                        <p>Duo dolore et diam sed ipsum stet amet duo diam. Rebum amet ut amet sed erat sed sed amet magna elitr amet kasd diam duo</p>
                    </div>
                </div>OP
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-item bg-white rounded d-flex flex-column align-items-center text-center">
                    <img class="img-fluid" src="img/booking.jpg" alt="">
                    <div class="service-icon bg-white">
                        <i class="fa fa-3x fa-home text-primary"></i>
                    </div>
                    <div class="px-4 pb-4">
                        <h4 class="text-uppercase mb-3">Booking</h4>
                        <p>Duo dolore et diam sed ipsum stet amet duo diam. Rebum amet ut amet sed erat sed sed amet magna elitr amet kasd diam duo</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-item bg-white rounded d-flex flex-column align-items-center text-center">
                    <img class="img-fluid" src="img/comfort.jpg" alt="">
                    <div class="service-icon bg-white">
                        <i class="fa fa-3x fa-drafting-compass text-primary"></i>
                    </div>
                    <div class="px-4 pb-4">
                        <h4 class="text-uppercase mb-3">Comfortability</h4>
                        <p>Duo dolore et diam sed ipsum stet amet duo diam. Rebum amet ut amet sed erat sed sed amet magna elitr amet kasd diam duo</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Start -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
     <!-- JavaScript Libraries -->
     <script src="{{ secure_asset('https://code.jquery.com/jquery-3.4.1.min.js')}}"></script>
     <script src="{{ secure_asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js')}}"></script>
     <script src="{{ secure_asset('css1/lib/easing/easing.min.js')}}"></script>
     <script src="{{ secure_asset('css1/lib/waypoints/waypoints.min.js')}}"></script>
     <script src="{{ secure_asset('css1/lib/owlcarousel/owl.carousel.min.js')}}"></script>
     <script src="{{ secure_asset('css1/lib/tempusdominus/js/moment.min.js')}}"></script>
     <script src="{{ secure_asset('css1/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
     <script src="{{ secure_asset('css1/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>
     <script src="{{ secure_asset('css1/lib/isotope/isotope.pkgd.min.js')}}"></script>
     <script src="{{ secure_asset('css1/lib/lightbox/js/lightbox.min.js')}}"></script>
 
     <!-- Template Javascript -->
     <script src="{{ secure_asset('css1/js/main.js')}}"></script>


@include('layouts.footer')
@endsection



<head>
    <meta charset="utf-8">
    <title>LOGIN - DormXtend</title>
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
    <link href="lib/owlcarousel/secure_assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->

    <link href="{{ secure_asset('/css1/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('/css1/style.css') }}" rel="stylesheet">
    {{-- <link href="{{ secure_asset('css/style1.css') }}" rel="stylesheet"> --}}

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
    
    <!-- Css Styles -->
   


    <link rel="stylesheet" href="{{ secure_asset('css/style1/style.css') }}" type="text/css">
      
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
                    <span>+012 345 6789</span>
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
                <a href="index.html" class="nav-item nav-link active">Home</a>
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
                </div>
                <a href="contact.html" class="nav-item nav-link">Contact</a>
                
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-bell me-lg-2"></i>
                        <span class="d-none d-lg-inline-flex">Notifications</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <a href="#" class="dropdown-item">
                            <h6 class="fw-normal mb-0">Profile updated</h6>
                            <small>15 minutes ago</small>
                        </a>
                        <hr class="dropdown-divider">
                        <a href="#" class="dropdown-item">
                            <h6 class="fw-normal mb-0">New user added</h6>
                            <small>15 minutes ago</small>
                        </a>
                        <hr class="dropdown-divider">
                        <a href="#" class="dropdown-item">
                            <h6 class="fw-normal mb-0">Password changed</h6>
                            <small>15 minutes ago</small>
                        </a>
                        <hr class="dropdown-divider">
                        <a href="#" class="dropdown-item text-center">See all notifications</a>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        {{-- <img class="rounded-circle me-lg-2" src="{{ secure_asset('img/user.jpg')}}" alt="" style="width: 40px; height: 40px;"> --}}
                        <i class="fas fa-user"></i>
                        <span class="d-none d-lg-inline-flex">{{ auth()->user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <a href="#" class="dropdown-item">My Profile</a>
                        <a href="#" class="dropdown-item">Settings</a>
                        {{-- <a href="{{ route('logout') }}" class="dropdown-item">Logout</a> --}}
                        <button id="logoutButton" class="dropdown-item">Logout</button>
                    </div>
                </div>

            </div>
        </div>
    </nav>
</div>

<!-- Navbar End -->




<div class="container-fluid bg-light py-6 px-5">
    <div class="text-center mx-auto mb-5" style="max-width: 600px;">
        <h1 class="display-5 text-uppercase mb-4">Dormitory<span class="text-primary"> Gallery</span></h1>
    </div>
    <div class="row gx-5">
        <div class="col-12 text-center">
            <div class="d-inline-block bg-dark-radial text-center pt-4 px-5 mb-5">
                <ul class="list-inline mb-0" id="portfolio-flters">
                    <li class="btn btn-outline-primary bg-white p-2 active mx-2 mb-4" data-filter="*">
                        <img src="/css1/img/portfolio-1.jpg" style="width: 150px; height: 100px;">
                        <div class="position-absolute top-0 start-0 end-0 bottom-0 m-2 d-flex align-items-center justify-content-center" style="background: rgba(4, 15, 40, .3);">
                            <h6 class="text-white text-uppercase m-0">All</h6>
                        </div>
                    </li>
                    <li class="btn btn-outline-primary bg-white p-2 mx-2 mb-4" data-filter=".first">
                        <img src="/css1/img/portfolio-2.jpg" style="width: 150px; height: 100px;">
                        <div class="position-absolute top-0 start-0 end-0 bottom-0 m-2 d-flex align-items-center justify-content-center" style="background: rgba(4, 15, 40, .3);">
                            <h6 class="text-white text-uppercase m-0">Construction</h6>
                        </div>
                    </li>
                    <li class="btn btn-outline-primary bg-white p-2 mx-2 mb-4" data-filter=".second">
                        <img src="/css1/img/portfolio-3.jpg" style="width: 150px; height: 100px;">
                        <div class="position-absolute top-0 start-0 end-0 bottom-0 m-2 d-flex align-items-center justify-content-center" style="background: rgba(4, 15, 40, .3);">
                            <h6 class="text-white text-uppercase m-0">Renovation</h6>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row g-5 portfolio-container">
        <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item first">
            <div class="position-relative portfolio-box">
                <img class="img-fluid w-100" src="/img/tup1.jpg" alt="">
                <a class="portfolio-title shadow-sm" href="">
                    <p class="h4 text-uppercase">Project Name</p>
                    <span class="text-body"><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA</span>
                </a>
                <a class="portfolio-btn" href="/img/tup1.jpg" data-lightbox="portfolio">
                    <i class="bi bi-plus text-white"></i>
                </a>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item second">
            <div class="position-relative portfolio-box">
                <img class="img-fluid w-100" src="/img/tup1.jpg" alt="">
                <a class="portfolio-title shadow-sm" href="">
                    <p class="h4 text-uppercase">Project Name</p>
                    <span class="text-body"><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA</span>
                </a>
                <a class="portfolio-btn" href="/img/tup1.jpg" data-lightbox="portfolio">
                    <i class="bi bi-plus text-white"></i>
                </a>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item first">
            <div class="position-relative portfolio-box">
                <img class="img-fluid w-100" src="/img/tup1.jpg" alt="">
                <a class="portfolio-title shadow-sm" href="">
                    <p class="h4 text-uppercase">Project Name</p>
                    <span class="text-body"><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA</span>
                </a>
                <a class="portfolio-btn" href="/img/tup1.jpg" data-lightbox="portfolio">
                    <i class="bi bi-plus text-white"></i>
                </a>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item second">
            <div class="position-relative portfolio-box">
                <img class="img-fluid w-100" src="/img/tup1.jpg" alt="">
                <a class="portfolio-title shadow-sm" href="">
                    <p class="h4 text-uppercase">Project Name</p>
                    <span class="text-body"><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA</span>
                </a>
                <a class="portfolio-btn" href="/img/tup1.jpg" data-lightbox="portfolio">
                    <i class="bi bi-plus text-white"></i>
                </a>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item first">
            <div class="position-relative portfolio-box">
                <img class="img-fluid w-100" src="/img/tup1.jpg" alt="">
                <a class="portfolio-title shadow-sm" href="">
                    <p class="h4 text-uppercase">Project Name</p>
                    <span class="text-body"><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA</span>
                </a>
                <a class="portfolio-btn" href="/img/tup1.jpg" data-lightbox="portfolio">
                    <i class="bi bi-plus text-white"></i>
                </a>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item second">
            <div class="position-relative portfolio-box">
                <img class="img-fluid w-100" src="/img/tup1.jpg" alt="">
                <a class="portfolio-title shadow-sm" href="">
                    <p class="h4 text-uppercase">Project Name</p>
                    <span class="text-body"><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA</span>
                </a>
                <a class="portfolio-btn" href="/img/tup1.jpg" data-lightbox="portfolio">
                    <i class="bi bi-plus text-white"></i>
                </a>
            </div>
        </div>
    </div>
</div>



<div class="container-fluid py-6 px-5">
    <div class="text-center mx-auto mb-5" style="max-width: 600px;">
        <h1 class="display-5 text-uppercase mb-4">Please <span class="text-primary">Feel Free</span> To Contact Us</h1>
    </div>
    <div class="row gx-0 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0" style="height: 600px;">
            <iframe class="w-100 h-100"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
        <div class="col-lg-6">
            <div class="contact-form bg-light p-5">
                <div class="row g-3">
                    <div class="col-12 col-sm-6">
                        <input type="text" class="form-control border-0" placeholder="Your Name" style="height: 55px;">
                    </div>
                    <div class="col-12 col-sm-6">
                        <input type="email" class="form-control border-0" placeholder="Your Email" style="height: 55px;">
                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control border-0" placeholder="Subject" style="height: 55px;">
                    </div>
                    <div class="col-12">
                        <textarea class="form-control border-0" rows="4" placeholder="Message"></textarea>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- <footer class="footer-section">
    <div class="container">
        <div class="footer-text">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ft-about">
                        <div class="logo">
                            <a href="#">
                                <img src="/img/dxtwhite.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="ft-contact">
                        <h6>Contact Us</h6>
                        <ul>
                            <li>(12) 345 67890</li>
                            <li>dormxtend@tup.edu.ph</li>
                            <li>Km 14. East Service Road, Western Bicutan, Taguig, Philippines</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="ft-newslatter">
                        <h6>New latest</h6>
                        <p>Get the latest updates and offers.</p>
                        <form action="#" class="fn-form">
                            <input type="text" placeholder="Email">
                            <button type="submit"><i class="fa fa-send"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <ul>
                        {{-- <li><a href="#">Contact</a></li>
                        <li><a href="#">Terms of use</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Environmental Policy</a></li> --}}
                    </ul>
                </div>
                <div class="col-lg-5">
                    <div class="co-text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                </div>
            </div>
        </div>
    </div>
</footer> -->

<script src="{{ secure_asset('js/auth.js') }}"></script>


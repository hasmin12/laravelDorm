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

            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->


<div class="container-xxl position-relative bg-white d-flex p-0">
    <!-- Spinner Start -->
    {{-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> --}}
    <!-- Spinner End -->

    <div class="container-fluid mt-4" style="width: 50%;">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <h3 class="mb-0">Visitor's Form</h3>
        </div>

        <!-- New Resident Form Start -->
        <form id="visitorForm" enctype="multipart/form-data">
            @csrf <!-- Add CSRF token for Laravel form submission -->

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>

            <div class="mb-3">
                <label for="visit_date" class="form-label">Visit Date</label>
                <input type="date" class="form-control" id="visitDate" name="visit_date" required>
            </div>

            <div class="mb-3">
                {{-- <label for="residentDropdown" class="form-label">Select Resident</label>
                <select class="form-select" id="residentDropdown" name="residentDropdown" required>
                    <option value="1">asd</option>
                    <option value="2">asd</option>
                    <option value="3">asd</option>
                </select> --}}

                <label for="residentName" class="form-label">Resident</label>
                <input type="text" class="form-control" id="residentName" name="residentName" required>
            </div>
            
            

            <div class="mb-3">
                <label for="relationship" class="form-label">Relationship</label>
                <input type="text" class="form-control" id="relationship" name="relationship" required>
            </div>

            <div class="mb-3">
                <label for="purpose" class="form-label">Purpose</label>
                <input type="text" class="form-control" id="purpose" name="purpose" required>
            </div>

            <div class="mb-3">
                <label for="validId" class="form-label">Valid ID</label>
                <input type="file" class="form-control" id="validId" name="validId" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="agreeCheckbox" name="agreeCheckbox" required>
                <label class="form-check-label"  data-bs-toggle="modal" data-bs-target="#termsModal">I agree to the terms and conditions of the Visitor Terms and Agreement</label>
            </div>
        
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <!-- New Resident Form End -->
    </div>
</div>
<!-- Modal for Terms and Agreement -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Visitor Terms and Agreement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    By checking the box and submitting this form, you acknowledge and agree to the following terms and conditions:
                </p>
                <ol>
                    <li>This visitor form is to be used for official purposes only.</li>
                    <li>You are responsible for providing accurate and complete information in the form.</li>
                    <li>Visitors must adhere to the rules and regulations of the school dormitory.</li>
                    <li>The school reserves the right to deny or revoke visitor access for any reason.</li>
                    <li>You understand that false information may result in disciplinary action.</li>
                    <li>Visitors are expected to respect the privacy and rights of dormitory residents.</li>
                </ol>
                <p>
                    Violation of any terms may lead to expulsion from the dormitory premises and other appropriate actions.
                </p>
                <p>
                    By submitting this form, you agree to comply with all applicable rules and policies.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<br>
    {{-- @include('layouts.footer') --}}


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

<script src="{{ secure_asset('js/guest/visitor.js') }}"></script>


@include('layouts.footer')
@endsection

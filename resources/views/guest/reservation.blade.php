@extends('layouts.base')
@section('content')

    <head>
        <meta charset="utf-8">
        <title>Hostel Reserve - DormXtend</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free HTML Templates" name="keywords">
        <meta content="Free HTML Templates" name="description">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
            rel="stylesheet">

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

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>

    <style>
        .row {
            --bs-gutter-x: -0.5rem;
        }
    </style>
    <body>
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
                        <!-- Add any additional navbar items here -->
                    </div>
                </div>
            </nav>
        </div>
        <!-- Navbar End -->

        <!-- Search and Filter Container -->
        <div class="container-fluid bg-white d-flex p-4">
            <div class="bg-light rounded p-4 w-100">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h3 class="mb-0">Hostel Rooms</h3>
                </div>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <label for="start-date" class="form-label">Start Date:</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="start-date">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label for="end-date" class="form-label">End Date:</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="end-date">
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end" style="padding: 10px;">
                        <button class="btn btn-primary" id="apply-dates">Submit</button>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <input type="text" id="search-bar" class="form-control"
                        placeholder="Search by room name, description, or amenities...">
                </div>
                <div id="filters">
                    <label class="pr-2"><input type="checkbox" id="wifi" name="features" value="wifi"> WiFi</label>
                    <label class="pr-2"><input type="checkbox" id="air_conditioning" name="features" value="air_conditioning"> Air
                        Conditioning</label>
                    <label class="pr-2"><input type="checkbox" id="kettle" name="features" value="kettle"> Kettle</label>
                    <label class="pr-2"><input type="checkbox" id="tv_with_cable" name="features" value="tv_with_cable"> TV with
                        Cable</label>
                    <label class="pr-2"><input type="checkbox" id="hot_shower" name="features" value="hot_shower"> Hot Shower</label>
                    <label class="pr-2"><input type="checkbox" id="refrigerator" name="features" value="refrigerator">
                        Refrigerator</label>
                    <label class="pr-2"><input type="checkbox" id="kitchen" name="features" value="kitchen"> Kitchen</label>
                    <label class="pr-2"><input type="checkbox" id="hair_dryer" name="features" value="hair_dryer"> Hair Dryer</label>
                </div>
            </div>
        </div>

        <div class="container-fluid position-relative bg-white d-flex p-0">
            <div class="bg-light rounded p-4 mb-4 w-100">
                <div class="row" id="room-container">
                    <!-- Room cards will be dynamically added here -->
                </div>
            </div>
        </div>


        <!-- Room Details Modal -->
        <div class="modal fade" id="roomModal" tabindex="-1" role="dialog" aria-labelledby="roomModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="roomModalLabel">Room Details</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Carousel for Room Images -->
                            <div class="col-md-6 mx-2">
                                <div id="roomImageCarousel" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <!-- Carousel items will be added here dynamically -->
                                    </div>
                                </div>
                                <div id="roomImageContainer"></div>
                            </div>
                            <div class="col-md-6 mx-2">
                                <h5 id="modalRoomName"></h5>
                                <p id="modalRoomDescription"></p>
                                <p id="modalRoomType"></p>
                                <p id="modalRoomPax"></p>
                                <p id="modalRoomPrice"></p>
                                <p id="roomStatus"></p>
                                <p id="modalRoomAmenities"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reservation Modal -->
        <div class="modal fade" id="reservationModal" tabindex="-1" role="dialog"
            aria-labelledby="reservationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reservationModalLabel">Reservation</h5>
                    </div>
                    <div class="modal-body">
                        <form id="createReservationForm" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 p-3">
                                    <input type="text" id="room_id" name="room_id" hidden>
                                    <h4 id="reservationModalTitle"></h4>
                                    <p id="reservationModalDescription"></p>
                                    <p id="reservationModalType"></p>
                                    <p id="reservationModalPax"></p>
                                    <p id="reservationModalPrice"></p>
                                    <div class="mb-3">
                                        <label for="checkinDate" class="form-label">Check-in Date</label>
                                        <input type="date" class="form-control" id="checkinDate" name="checkinDate"
                                            required min="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="checkoutDate" class="form-label">Check-out Date</label>
                                        <input type="date" class="form-control" id="checkoutDate" name="checkoutDate"
                                            required min="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Payment Information</h5>
                                            <p id="paymentInfo" class="card-text"></p>

                                            <p id="downPaymentInfo" class="card-text"></p>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="payments" class="form-label">Payment</label>
                                        <input type="file" class="form-control" id="payments" name="payments"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6 p-2">
                                    <h4>Personal Information</h4>
                                    <div class="mb-3">
                                        <label for="residentName" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="residentName" name="residentName"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="residentSex" class="form-label">Sex</label>
                                        <select class="form-select" id="residentSex" name="residentSex" required>
                                            <option value="" selected hidden></option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="birthdate" class="form-label">Birthdate</label>
                                        <input type="date" class="form-control" id="birthdate" name="birthdate"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="validId" class="form-label">Valid ID</label>
                                        <input type="file" class="form-control" id="validId" name="validId"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="img_path" class="form-label">Image</label>
                                        <input type="file" class="form-control" id="img_path" name="img_path"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Reservation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ secure_asset('js/guest/reservations.js') }}"></script>

        @include('layouts.footer')
    @endsection

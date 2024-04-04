<!DOCTYPE html>
<html lang="en">
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
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css1/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css1/style.css" rel="stylesheet">
</head>


<body>
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
                {{-- <div class="navbar-nav ms-auto py-0">
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
                    <a href="" class="nav-item nav-link bg-primary text-white px-5 ms-3 d-none d-lg-block">Get A Quote <i class="bi bi-arrow-right"></i></a>
                </div> --}}
            </div>
        </nav>
    </div>
    <!-- Navbar End -->
<div class="container-xxl position-relative bg-white d-flex p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->
    <div class="bg-light rounded p-4">

        <div class="d-flex align-items-center justify-content-between mb-2">
            <h3 class="mb-0">Hostel Rooms</h3>
        </div>
    
        <div class="row" id="room-container">
            <!-- Room cards will be dynamically added here -->
        </div>
    </div>

</div>

<div class="modal fade" id="roomModal" tabindex="-1" role="dialog" aria-labelledby="roomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roomModalLabel">Room Details</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Carousel for Room Images -->
                    <div class="col-md-6">
                        
                        <div id="roomImageCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <!-- Images will be dynamically added here -->
                            </div>
                            {{-- <a class="carousel-control-prev" href="#roomImageCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#roomImageCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a> --}}
                        </div>
                        <div id="roomImageContainer"></div>
                    </div>
                    <div class="col-md-6">
                        <h5 id="modalRoomName"></h5>
                        <p id="modalRoomDescription"></p>
                        <p id="modalRoomType"></p>
                        <p id="modalRoomPax"></p>
                        <p id="modalRoomPrice"></p>
                        <p id="roomStatus"></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservationModalLabel">Reservation</h5>
            </div>
            <div class="modal-body">
                
                <form id="createReservationForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            {{-- <h4>Reserve Room</h4> --}}
                            <input type="text"  id="room_id" name="room_id"  hidden>
                            <h4 id="reservationModalTitle"></h4>
                            <p id="reservationModalDescription"></p>

                            <p id="reservationModalType"></p>
                            <p id="reservationModalPax"></p>
                            <p id="reservationModalPrice"></p>
                            
                            
                            <div class="mb-3">
                                <label for="checkinDate" class="form-label">Check-in Date</label>
                                <input type="date" class="form-control" id="checkinDate" name="checkinDate" required>
                            </div>
                            <div class="mb-3">
                                <label for="checkoutDate" class="form-label">Check-out Date</label>
                                <input type="date" class="form-control" id="checkoutDate" name="checkoutDate" required>
                            </div>

                            <div class="card" style="cursor: pointer;" >
                                <div class="card-body">
                                    <h5 class="card-title">Payment Information</h5>
                                    <p id="paymentInfo" class="card-text"></p>
                                    <p id="downPaymentInfo" class="card-text"></p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="payments" class="form-label">Payment</label>
                                <input type="file" class="form-control" id="payments" name="payments" required>
                            </div>
                    

                        </div>
                        <div class="col-md-6">

                            <h4>Personal Information</h4>
                            <div class="mb-3">
                                <label for="residentName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="residentName" name="residentName" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required>
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
                                <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                            </div>
                    
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
            
                            <div class="mb-3">
                                <label for="validId" class="form-label">Valid ID</label>
                                <input type="file" class="form-control" id="validId" name="validId" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="img_path" class="form-label">Image</label>
                                <input type="file" class="form-control" id="img_path" name="img_path" required>
                            </div>
                            
                        </div>
                        <button type="submit" class="btn btn-primary">Create Reservation</button>
                    </div>
                </form>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submitReservation()">Submit Reservation</button>
            </div> --}}
        </div>
    </div>
</div>

<script src="{{ asset('js/guest/reservation.js') }}"></script>

</body>
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


</html>


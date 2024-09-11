<!DOCTYPE html>
<html lang="en">

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
        <a href="{{ url('/') }}" class="navbar-brand">
            <h1 class="m-0 display-4 text-uppercase text-white" href="">DORMXTEND</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">

                <a href="http://localhost:8000/visitor"
                    class="nav-item nav-link bg-primary text-white px-5 ms-3 d-none d-lg-block">Book a Visit <i
                        class="bi bi-arrow-right"></i></a>

            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->
<br>
<br>
<br>
<div class="container newsletter mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="row justify-content-center">
        <div class="room-item shadow rounded overflow-hidden">
            <div class="bg-white rounded text-center p-5">
                <div class="card-body">
                    <form id="registrationForm" method="POST" action="/dormregister" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <h4>Step 1: Account Information</h4>
                            <!-- Name -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase">
                                    <label for="name">{{ __('Name') }}</label>
                                </h5>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" autocomplete="name" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tuptnum -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase">
                                    <label for="Tuptnum">{{ __('Tuptnum') }}</label>
                                </h5>
                                <div class="col-md-6">
                                    <input id="Tuptnum" type="text"
                                        class="form-control @error('Tuptnum') is-invalid @enderror" name="Tuptnum"
                                        value="{{ old('Tuptnum') }}" autocomplete="Tuptnum" required>
                                    @error('Tuptnum')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase">
                                    <label for="email">{{ __('E-Mail Address') }}</label>
                                </h5>
                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase">
                                    <label for="password">{{ __('Password') }}</label>
                                </h5>
                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        value="{{ old('password') }}" autocomplete="off" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Type -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase">
                                    <label for="type">{{ __('Type') }}</label>
                                </h5>
                                <div class="col-md-6">
                                    <select id="type" class="form-control @error('type') is-invalid @enderror"
                                        name="type" required>
                                        <option value="" disabled selected>Select Type</option>
                                        <option value="Student">Student</option>
                                        <option value="Faculty">Faculty</option>
                                        <option value="Staff">Staff</option>
                                    </select>
                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Image Path -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase">
                                    <label for="img_path">{{ __('Image') }}</label>
                                </h5>
                                <div class="col-md-6">
                                    <input id="img_path" type="file"
                                        class="form-control-file @error('img_path') is-invalid @enderror"
                                        name="img_path" required>
                                    @error('img_path')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </fieldset>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>



{{-- <script src="{{ secure_asset('js/guest/registration.js') }}"></script> --}}
<br>
<br>
<br>
<br>
<br>

@include('layouts.footer')

</html>

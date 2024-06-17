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
        <a href="{{url('/')}}" class="navbar-brand">
            <h1 class="m-0 display-4 text-uppercase text-white" href="">DORMXTEND</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
               
                <a href="http://localhost:8000/visitor" class="nav-item nav-link bg-primary text-white px-5 ms-3 d-none d-lg-block">Book a Visit <i class="bi bi-arrow-right"></i></a>

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
                    <form id="registrationForm" enctype="multipart/form-data">
                        @csrf
                        <!-- Step 1: Account Information -->
                        <fieldset>
                            <h4>Step 1: Account Information</h4>
                            <h4>Account Information</h4>
                                    <!-- Email -->
                                    <div class="form-group row mb-2">
                                        <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="email" >{{ __('E-Mail Address') }}</label></h5>
                                        <div class="col-md-6">
                                            
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-2">
                                        <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="password">{{ __('Password') }}</label></h5>
                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}"  autocomplete="off" autofocus>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                        <!-- Type -->
                                        <div class="form-group row mb-2">
                                            <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="type">{{ __('Type') }}</label></h5>
                                            <div class="col-md-6">
                                                <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" >
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

                                    <!-- img path -->
                                    <div class="form-group row mb-2">
                                        <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="img_path" >{{ __('Image') }}</label></h5>
                                        <div class="col-md-6">
                                            <input id="img_path" type="file" class="form-control-file @error('img_path') is-invalid @enderror" name="img_path" >
                                            @error('img_path')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </fieldset>
                        <!-- Step 2: Personal Information -->
                        <fieldset>
                            <h4>Step 2: Personal Information</h4>
                              <!-- Tuptnum -->
                              <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="Tuptnum">{{ __('TUPT Number') }}</label></h5>
                                <div class="col-md-6">
                                    <input id="Tuptnum" type="text" class="form-control @error('Tuptnum') is-invalid @enderror" name="Tuptnum" value="{{ old('Tuptnum') }}" >
                                    @error('Tuptnum')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Full Name -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="name">{{ __('Full Name') }}</label></h5>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="course">{{ __('Course') }}</label></h5>
                                <div class="col-md-6">
                                    <select id="course" class="form-control @error('course') is-invalid @enderror" name="course" >
                                        {{-- <option value="" selected hidden></option> --}}
                                        <option value="BET Major in Automotive Technology">BETAT-T</option>
                                        <option value="BET Major in Chemical Technology">BETChT-T</option>
                                        <option value="BET Major in Construction Technology">BETCT-T</option>
                                        <option value="BET Major in Electrical Technology">BETET-T</option>
                                        <option value="BET Major in Electromechanical Technology">BETEMT-T</option>
                                        <option value="BET Major in Electronics Technology">BETElxT-T</option>
                                        <option value="BET Major in Instrumentation and Control Technology">BETInCT-T</option>
                                        <option value="BET Major in Mechanical Technology">BETMT-T</option>
                                        <option value="BET Major in Mechatronics Technology">BETMecT-T</option>
                                        <option value="BET Major in Non-Destructive Testing Technology">BETNDTT-T</option>
                                        <option value="BET Major in Dies & Moulds Technology">BETDMT-T</option>
                                        <option value="BET Major in Heating, Ventilation and Airconditioning/Refrigeration Technology">BETHVAC/RT-T</option>
                                        <option value="Bachelor of Science in Civil Engineering">BSCESEP-T</option>
                                        <option value="Bachelor of Science in Electrical Engineering">BSEESEP-T</option>
                                        <option value="Bachelor of Science in Electronics Engineering">BSECESEP-T</option>
                                        <option value="Bachelor of Science in Mechanical Engineering">BSMESEP-T</option>   
                                        <option value="Bachelor of Science in Information Technology">BSIT-T</option> 
                                        <option value="Bachelor of Science in Information System">BSIS-T</option> 
                                        <option value="Bachelor of Science in Environmental Science">BSESSDP-T</option> 
                                        <option value="Bachelor in Graphics Technology Major in Architecture Technology">BGTAT-T</option> 
                                        <option value="BTVTE Major in Electrical Technology">BTVTEdET-T</option> 
                                        <option value="BTVTE Major in Electronics Technology">BTVTEdElxT-T</option> 
                                        <option value="BTVTE Major in Information and Communication Technology">BTVTEdICT-T</option> 
                                    
                                    </select>
                                    @error('course')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Year -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="year">{{ __('Year') }}</label></h5>
                                <div class="col-md-6">
                                    <input id="year" type="text" class="form-control @error('year') is-invalid @enderror" name="year" value="{{ old('year') }}"  autocomplete="year" autofocus>
                                    @error('year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>                           

                            <!-- Birthdate -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="birthdate">{{ __('Birthdate') }}</label></h5>
                                <div class="col-md-6">
                                    <input id="birthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" >
                                    @error('birthdate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- age -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="age">{{ __('Age') }}</label></h5>
                                <div class="col-md-6">
                                    <input id="age" type="text" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}"  autocomplete="age" autofocus>
                                    @error('age')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Sex -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="sex">{{ __('Sex') }}</label></h5>
                                <div class="col-md-6">
                                    <select id="sex" class="form-control @error('sex') is-invalid @enderror" name="sex" >
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    @error('sex')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <!-- Religion -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="religion">{{ __('Religion') }}</label></h5>
                                <div class="col-md-6">
                                    <input id="religion" type="text" class="form-control @error('religion') is-invalid @enderror" name="religion" value="{{ old('religion') }}"  autocomplete="religion" autofocus>
                                    @error('religion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> 

                            <!-- Civil Status -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="civil_status">{{ __('Civil Status') }}</label></h5>
                                <div class="col-md-6">
                                    <input id="civil_status" type="text" class="form-control @error('civil_status') is-invalid @enderror" name="civil_status" value="{{ old('civil_status') }}"  autocomplete="civil_status" autofocus>
                                    @error('civil_status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> 

                            <!-- Address -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="address">{{ __('Permanent Address') }}</label></h5>
                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}"  autocomplete="address" autofocus>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Contacts -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="contactNumber">{{ __('Contact Number') }}</label></h5>
                                <div class="col-md-6">
                                    <input id="contactNumber" type="text" class="form-control @error('contactNumber') is-invalid @enderror" name="contactNumber" value="{{ old('contactNumber') }}" >
                                    @error('contactNumber')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- COR -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="cor">{{ __('COR') }}</label></h5>
                                <div class="col-md-6 ">
                                    
                                    <input id="cor" type="file" class="form-control-file input_container @error('cor') is-invalid @enderror" name="cor" >
                                    @error('cor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            

                            <!-- Valid ID -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="validId">{{ __('School ID') }}</label></h5>
                                <div class="col-md-6">
                                    <input id="validId" type="file" class="form-control-file input_container @error('validId') is-invalid @enderror" name="validId" >
                                    @error('validId')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Vaccine Card -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="vaccineCard">{{ __('Vaccine Card') }}</label></h5>
                                <div class="col-md-6">
                                    <input id="vaccineCard" type="file" class="form-control-file input_container @error('vaccineCard') is-invalid @enderror" name="vaccineCard" >
                                    @error('vaccineCard')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Vaccine Card -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="applicationForm">{{ __('Application Form') }}</label></h5>
                                <div class="col-md-6">
                                    <input id="applicationForm" type="file" class="form-control-file input_container @error('applicationForm') is-invalid @enderror" name="applicationForm" >
                                    @error('applicationForm')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Vaccine Card -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="laptop"></label></h5>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input id="laptop" type="checkbox" class="form-check-input @error('laptop') is-invalid @enderror" name="laptop" {{ old('laptop') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="laptop">
                                            {{ __('Has Laptop') }}
                                        </label>
                                    </div>
                                    @error('laptop')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <!-- Vaccine Card -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="electricfan"></label></h5>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input id="electricfan" type="checkbox" class="form-check-input @error('electricfan') is-invalid @enderror" name="electricfan"  {{ old('electricfan') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="electricfan">
                                            {{ __('Has Electric Fan') }}
                                        </label>
                                    </div>
                                    @error('electricfan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary previous-step">Previous</button>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </fieldset>
                        <!-- Step 3: Guardian Information -->
                        <fieldset>
                            <h4>Step 3: Guardian Information</h4>
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="guardianName">{{ __('Name') }}</label></h5>
                                <div class="col-md-6">
                                    <input id="guardianName" type="text" class="form-control @error('guardianName') is-invalid @enderror" name="guardianName" value="{{ old('guardianName') }}" required autocomplete="guardianName" autofocus>
                                    @error('guardianName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Guardian Contact Number -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="guardianContactNumber">{{ __('Contact Number') }}</label></h5>
                                <div class="col-md-6">
                                    <input id="guardianContactNumber" type="text" class="form-control @error('guardianContactNumber') is-invalid @enderror" name="guardianContactNumber" value="{{ old('guardianContactNumber') }}" required autocomplete="guardianContactNumber" autofocus>
                                    @error('guardianContactNumber')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Guardian Address -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="guardianAddress">{{ __('Address') }}</label></h5>
                                <div class="col-md-6">
                                    <input id="guardianAddress" type="text" class="form-control @error('guardianAddress') is-invalid @enderror" name="guardianAddress" value="{{ old('guardianAddress') }}" required autocomplete="guardianAddress" autofocus>
                                    @error('guardianAddress')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        
                            <!-- Relationship -->
                            <div class="form-group row mb-2">
                                <h5 class="col-md-4 col-form-label text-md-right text-primary text-uppercase"><label for="guardianRelationship">{{ __('Relationship') }}</label></h5>
                                <div class="col-md-6">
                                    <input id="guardianRelationship" type="text" class="form-control @error('guardianRelationship') is-invalid @enderror" name="guardianRelationship" value="{{ old('guardianRelationship') }}" required autocomplete="guardianRelationship" autofocus>
                                    @error('guardianRelationship')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                         
                            <button type="button" class="btn btn-secondary previous-step">Previous</button>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="{{ asset('js/guest/registration.js') }}"></script>
<br>
<br>
<br>
<br>
<br>

@include('layouts.footer')
@endsection

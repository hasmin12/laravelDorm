@extends('layouts.base')

@section('content')
<div class="full-width-container">
    {{-- <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End --> --}}

    <!-- Sign In Start -->
    {{-- <div class="container-fluid"> --}}
    <section class="hero-section">
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
                    <div class="booking-form">
                        <h3>Login</h3>
                        <form id="loginForm">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                <a href="">Forgot Password</a>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>

                            <a href="{{ url('auth/google') }}" style="margin-top: 0px !important;background: green;color: #ffffff;padding: 5px;border-radius:7px;" class="ml-2">
                                <strong>Google Login</strong>
                              </a> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-slider owl-carousel">
            <div class="hs-item" style="background-image: url('{{ asset('/img/tt.jpg')}}')"></div>
            <div class="hs-item" style="background-image: url('{{ asset('/img/tup1.jpg')}}')"></div>
            <div class="hs-item" style="background-image: url('{{ asset('/img/tup2.jpg')}}')"></div>
        </div>
        
    </section>
    @include('layouts.footer')
    {{-- </div> --}}
    <!-- Sign In End -->
</div>
<script src="{{ asset('js/auth.js') }}"></script>

@endsection

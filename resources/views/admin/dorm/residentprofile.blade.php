@extends('layouts.base')
@section('content')
<div class="container-xxl position-relative bg-white d-flex p-0">
<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->

@include('layouts.sidebar.dorm.admin')

<!-- Content Start -->
<div class="content">
    @include('layouts.navbar')
        <div class="bg-light rounded p-4">
            <h3>Residents's Profile</h3>
        </div>
    
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="row">
                <div class="col-md-4">
                    {{-- User Details Card --}}
                    <div class="card">
                        <div class="card-header">
                            User Details
                        </div>
                        <div class="card-body">
                            <p>Name: Datu</p>
                            <p>TUPT Number: Datu@gmail.com</p>
                            <p>TUPT Number: Datu@gmail.com</p>
                            <p>Contacts: Datu@gmail.com</p>
                            <p>Address: Datu@gmail.com</p>

                            <p>Email: Datu@gmail.com</p>
                            {{-- Add more user details as needed --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    {{-- User Invoices Card --}}
                    <div class="card">
                        <div class="card-header">
                            User Invoices
                        </div>
                        <div class="card-body">
                         UserInvoices
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
    </div>
    <!-- Recent Sales End -->


    

    @include('layouts.footer')

</div>
<!-- Content End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>
@endsection

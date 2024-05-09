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

@include('layouts.sidebar.resident')

<!-- Content Start -->
<div class="content">
    @include('layouts.navbar')
       
           
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
          
            <div class="card">
                <div class="card-header">Personal Information</div>

                <div class="card-body" style="text-align: left;">
                    <p><strong>Name:</strong> {{ auth()->user()->name }} </p>
                    <p><strong>Email:</strong> {{ auth()->user()->email }} </p>
                    <p><strong>Room Number:</strong> </p>
                    {{-- Add more resident details as needed --}}

                    {{-- You can also add an edit button or link to allow residents to edit their profiles --}}
                    {{-- <a href="{{ route('residents.edit', $resident->id) }}" class="btn btn-primary">Edit Profile</a> --}}
                    <a href="#" class="btn btn-primary">Edit Profile</a>
                
                </div>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->


    

    <!-- @include('layouts.footer') -->

</div>
<!-- Content End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>
@endsection

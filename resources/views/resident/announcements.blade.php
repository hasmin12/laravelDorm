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
    <div class="h-100 bg-light rounded">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <h3 class="mb-0">Announcements</h3>
        </div>

        <div class="container my-5 py-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-10 col-xl-8">  
                    <div id="announcements-container">
                        <!-- Display existing announcements here using JavaScript -->
                    </div>       
                </div>
            </div>
        </div>


        <!-- Modal for creating a new announcement -->
        <div class="modal fade" id="createAnnouncementModal" tabindex="-1" aria-labelledby="createAnnouncementModalLabel" aria-hidden="true">
            <!-- Add your modal HTML structure here -->
        </div>
    </div>
    @include('layouts.footer')
</div>
<!-- Content End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>
<script src="{{ asset('js/resident/announcement.js') }}"></script>
@endsection

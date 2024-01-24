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

@include('layouts.sidebar.hostel.resident')

<!-- Content Start -->
<div class="content">
    @include('layouts.navbar')
    {{-- Calendar --}}
    <div class="h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <h3 class="mb-0">Request Repair</h3>
            {{-- <button id="addMaintenanceButton" class="btn btn-primary">Request Repair</button> --}}
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRepairModal">Request Repair</button>                   
        </div>

        <div id="repair-items-container" class="row">
            <!-- Display existing repair items here using JavaScript -->
        </div>
    </div>

    <!-- Modal for creating a new repair -->
<div class="modal fade" id="createRepairModal" tabindex="-1" aria-labelledby="createRepairModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createRepairModalLabel">Request Repair</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add your form fields for creating a new repair here -->
                <form id="createRepairForm" enctype="multipart/form-data">
                    <!-- Example: Name -->
                    <div class="mb-3">
                        <label for="itemName" class="form-label">Item</label>
                        <input type="text" class="form-control" id="itemName" name="itemName" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="img_path" class="form-label">Image</label>
                        <input type="file" class="form-control" id="img_path" name="img_path">
                    </div>

                    <!-- Add other form fields as needed -->

                    <button type="submit" class="btn btn-primary">Request Repair</button>
                </form>
            </div>
        </div>
    </div>
</div>

  
    @include('layouts.footer')

</div>
<!-- Content End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>


<script src="{{ asset('js/resident/maintenance.js') }}"></script>
@endsection

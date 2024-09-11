@extends('layouts.base')
@section('content')
<div class="container-fluid position-relative bg-white d-flex p-0">
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
    {{-- Calendar --}}
    <div class="h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <h3 class="mb-0">Request Maintenance</h3>
            {{-- <button id="addMaintenanceButton" class="btn btn-primary">Request Maintenance</button> --}}
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createMaintenanceModal">Request Maintenance</button>                   
        </div>

        <div id="maintenance-items-container" class="row">
            <!-- Display existing maintenance items here using JavaScript -->
        </div>
    </div>

    <!-- Modal for creating a new maintenance -->
<div class="modal fade" id="createMaintenanceModal" tabindex="-1" aria-labelledby="createMaintenanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createMaintenanceModalLabel">Request Maintenance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add your form fields for creating a new maintenance here -->
                <form id="createMaintenanceForm" enctype="multipart/form-data">
                    <!-- Example: Name -->
                        
                    <div class="mb-3">
                        <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Choose Maintenance') }}</label>
                                    <div class="col-md-6">
                                        <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" required>
                                            <option value="Plumber">Plumber</option>
                                            <option value="House Keeping">House Keeping </option>
                                            <option value="Electrician">Electrician</option>
                                        </select>
                                        @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Problem Description</label>
                        <textarea class="form-control" id="description" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="img_path" class="form-label">Image </label>
                        <input type="file" class="form-control" id="img_path" name="img_path">
                    </div>

                    <!-- Add other form fields as needed -->

                    <button type="submit" class="btn btn-primary">Request Maintenance</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="pendingMaintenanceModal" tabindex="-1" aria-labelledby="pendingMaintenanceLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pendingMaintenanceTitle">Maintenance Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="pendingMaintenanceBody">    
                
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="inprogressMaintenanceModal" tabindex="-1" aria-labelledby="inprogressMaintenanceLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inprogressMaintenanceTitle">In Progress</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="inprogressMaintenanceBody">
                <!-- Maintenance request details will be displayed here -->
                <b>Completion Percentage:</b>
            <div class="progress" style="height: 20px;">
                {{-- <div class="progress-bar bg-success" role="progressbar" style="width: ${completionPercentage}%" aria-valuenow="${completionPercentage}" aria-valuemin="0" aria-valuemax="100">${completionPercentage}%</div> --}}
            </div><br>
            <b>Assigned Technician:</b><br>
            <b>Maintenance Changes:</b><br>
            <table class="table" id="maintenanceChangesTable">
            </table>
            </div>
        </div>
    </div>
</div>


  
    {{-- <!-- @include('layouts.footer') --> --}}

</div>
<!-- Content End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>


<script src="{{ asset('js/resident/maintenance.js') }}"></script>
@endsection

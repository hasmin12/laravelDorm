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

@include('layouts.sidebar.maintenanceuser')

<!-- Content Start -->
<div class="content">
    @include('layouts.navbar')
    {{-- Calendar --}}
    <div class="h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <h3 class="mb-0">Maintenance Requests</h3>
            {{-- <button id="addMaintenanceButton" class="btn btn-primary">Request Maintenance</button> --}}
    
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
                        <label for="itemName" class="col-md-4 col-form-label text-md-right">{{ __('itemName') }}</label>
                                    <div class="col-md-6">
                                        <select id="itemName" class="form-control @error('itemName') is-invalid @enderror" name="itemName" required>
                                            <option value="General Maintenance">General Maintenance</option>
                                            <option value="Technician">Technician</option>
                                            <option value="Handy Man">Handy Man</option>
                                        </select>
                                        @error('itemName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
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
                <form id="assignTechnicianForm">
                    <div id="pendingMaintenanceDetails" class="mb-3">
                    </div>
               
                    <div class="mb-3">
                        <label for="technicianSelect" class="form-label">Select Technician:</label>
                        <select class="form-select" id="technicianDropdown" required>
                            
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Assign Technician</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- In Progress Maintenance Modal -->
<div class="modal fade" id="inprogressMaintenanceModal" tabindex="-1" aria-labelledby="inprogressMaintenanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inprogressMaintenanceTitle">Maintenance Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="inprogressMaintenanceBody">
                <div id="inprogressMaintenanceDetails" class="mb-3">
                    <!-- Maintenance details will be populated here -->
                </div>
                <!-- Check if completionDays has a value -->
                @if(isset($completionDays))
                <!-- Accept Button -->
                <div class="text-end">
                    <button type="button" class="btn btn-primary" onclick="showAcceptModal()">Accept</button>
                </div>
                @else
                <!-- Update Button -->
                <div class="text-end">
                    <button type="button" class="btn btn-primary" onclick="showUpdateModal()">Update</button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Accept Maintenance Modal -->
<div class="modal fade" id="acceptModal" tabindex="-1" aria-labelledby="acceptModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="acceptModalLabel">Accept Maintenance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="acceptForm">
                    <div class="mb-3">
                        <label for="completionDays" class="form-label">Completion Days</label>
                        <input type="number" class="form-control" id="completionDays" name="completionDays" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Accept</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Update Maintenance Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Maintenance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm">
                    <div class="mb-3">
                        <label for="completionPercentage" class="form-label">Completion Percentage</label>
                        <input type="number" class="form-control" id="completionPercentage" name="completionPercentage" required>
                    </div>
                    <div class="mb-3">
                        <label for="statusdescription" class="form-label">Description</label>
                        <textarea class="form-control" id="statusdescription" name="statusdescription" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="markAsDone()">Done</button>
            </div>
        </div>
    </div>
</div>



  
    {{-- @include('layouts.footer') --}}

</div>
<!-- Content End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>


<script src="{{ secure_asset('js/technician/maintenance.js') }}"></script>
@endsection

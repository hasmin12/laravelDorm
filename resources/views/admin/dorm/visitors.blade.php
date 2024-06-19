@extends('layouts.base')

@section('content')
<div class="container-xxl position-relative bg-white d-flex p-0">
    <!-- Your existing content goes here -->

    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    @include('layouts.sidebar.dorm.admin')

    <!-- Content Start -->
    <div class="content">
        @include('layouts.navbar')
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h3 class="mb-0">Visitors</h3>
                
                {{-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createVisitorModal">Create Lost Item</button> --}}
            </div>
          
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            {{-- <th scope="col"><input class="form-check-input" type="checkbox"></th> --}}
                            <th scope="col">Visitor ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Visit Date</th>
                            <th scope="col">Resident</th>
                            <th scope="col">Relationship</th>
                            <th scope="col">Purpose</th>
                      

                        </tr>
                    </thead>
                    <tbody id="visitorTableBody">
                        
                    </tbody>
                </table>
            </div>
        </div>

            <!-- Modal for creating a new lost item -->
            <div class="modal fade" id="createVisitorModal" tabindex="-1" aria-labelledby="createVisitorModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createVisitorModalLabel">Create New Lost Item</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Add your form fields for creating a new lost item here -->
                            <form id="createVisitorForm" enctype="multipart/form-data">
                                @csrf
                                <!-- Example: Name -->
                                <div class="mb-3">
                                    <label for="itemName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="itemName" name="itemName" required>
                                </div>

                                <div class="mb-3">
                                    <label for="locationLost" class="form-label">Found in</label>
                                    <input type="text" class="form-control" id="locationLost" name="locationLost" required>
                                </div>

                                <div class="mb-3">
                                    <label for="findersName" class="form-label">Find by</label>
                                    <input type="text" class="form-control" id="findersName" name="findersName" required>
                                </div>
                               
                                <div class="mb-3">
                                    <label for="img_path" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="img_path" name="img_path" required>
                                </div>

                                <!-- Add other form fields as needed -->

                                <button type="submit" class="btn btn-primary">Create Lost Item</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="visitorDetailsModal" tabindex="-1" aria-labelledby="visitorDetailsModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="visitorDetailsModalLabel">Visitor Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Visitor details will be injected here -->
                        </div>
                    </div>
                </div>
            </div>
            
        <div class="modal fade" id="updateVisitorModal" tabindex="-1" aria-labelledby="updateVisitorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateVisitorModalLabel">Update Visitor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img id="visitorImage" src="" class="img-fluid mb-3" alt="Room Image">
                            </div>
                            <div class="col-md-6">
                                <p><strong>Visitor ID:</strong> <span id="resId"></span></p>

                                <p><strong>Room:</strong> <span id="resRoomName"></span></p>
                                <p><strong>Check-in Date:</strong> <span id="resCheckin"></span></p>
                                <p><strong>Check-out Date:</strong> <span id="resCheckout"></span></p>
                                <p><strong>Name:</strong> <span id="resName"></span></p>
                                <p><strong>Email:</strong> <span id="resEmail"></span></p>
                                <p><strong>Contacts:</strong> <span id="resContacts"></span></p>
                                <p><strong>Status:</strong> 
                                    <select id="resStatus" class="form-select">
                                        <option value="Check-In">Check-In</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="updateStatus">Update Visitor</button>
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
<script src="{{ secure_asset('js/admin/dorm/visitor.js') }}"></script>
@endsection
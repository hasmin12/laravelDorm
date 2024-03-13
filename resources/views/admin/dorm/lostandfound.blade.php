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
        <div class="h-100 bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h3 class="mb-0">Lost and Found</h3>
                
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createLostItemModal">Create Lost Item</button>
            </div>

            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            {{-- <th scope="col"><input class="form-check-input" type="checkbox"></th> --}}
                            <th scope="col">Item Name</th>
                            <th scope="col">Location</th>
                            <th scope="col">Claimed By</th>
                            <th scope="col">Claimed Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date Posted</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="lostitemTableBody">
                        
                    </tbody>
                </table>
            </div>
        </div>

            <!-- Modal for creating a new lost item -->
            <div class="modal fade" id="createLostItemModal" tabindex="-1" aria-labelledby="createLostItemModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createLostItemModalLabel">Create New Lost Item</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Add your form fields for creating a new lost item here -->
                            <form id="createLostItemForm" enctype="multipart/form-data">
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

        <div class="modal fade" id="itemDetailsModal" tabindex="-1" aria-labelledby="itemDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="modal-title" id="itemDetailsModalLabel"></h5>

                        </div>    
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img id="itemDetailsModalImage" src="" alt="Lost Item Image" class="img-fluid mb-2" style="max-height: 150px;">
                            </div>
                            <div class="col-md-6">
                                <p id="dateLost"></p>
                                <p id="locationLost"></p>
                                <p id="findersName"></p>
                                <p id="status"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="modal fade" id="updateLostItemModal" tabindex="-1" aria-labelledby="updateLostItemModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateLostItemModalLabel">Update Lost Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
        
                        <form id="updateLostItemForm">
                            <div class="mb-3">
                                <label for="updateitemName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="updateitemName" name="updateitemName" required>
                            </div>

                            <div class="mb-3">
                                <label for="updatelocationLost" class="form-label">Found in</label>
                                <input type="text" class="form-control" id="updatelocationLost" name="updatelocationLost" required>
                            </div>

                            <div class="mb-3">
                                <label for="updatefindersName" class="form-label">Find by</label>
                                <input type="text" class="form-control" id="updatefindersName" name="updatefindersName" required>
                            </div>

                            <div class="mb-3">
                                <label for="updateclaimedBy" class="form-label">Claimed by</label>
                                <input type="text" class="form-control" id="updateclaimedBy" name="updateclaimedBy">
                            </div>
                           
                            <div class="mb-3">
                                <label for="updateimg_path" class="form-label">Image</label>
                                <input type="file" class="form-control" id="updateimg_path" name="updateimg_path">
                                <img id="updateImgPreview" src="" alt="Image Preview" style="max-width: 100%; margin-top: 10px; display: none;">
                            </div>

        
                            <button type="submit" class="btn btn-primary">Update Lost Item</button>
                        </form>
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
<script src="{{ asset('js/lostandfound.js') }}"></script>
@endsection
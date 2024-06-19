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
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h3 class="mb-0">Registered Users</h3>
                
            </div>
            <form class="d-none d-md-flex ms-4">
                <input class="form-control border-0" type="search" placeholder="Search" id="searchInput">
            </form>
            <br>
            <div class="btn-group" role="group">
                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked value="All">
                <label class="btn btn-outline-primary" for="btnradio1">All</label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" value="Student">
                <label class="btn btn-outline-primary" for="btnradio2">Students</label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" value="Faculty">
                <label class="btn btn-outline-primary" for="btnradio3">Faculties</label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off" value="Staff">
                <label class="btn btn-outline-primary" for="btnradio4">Staffs</label>
            </div>
            {{-- <button class="btn btn-primary" id="sendEmailButton">Send Email</button> --}}
        </div>
    
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
          
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            {{-- <th scope="col"><input class="form-check-input" type="checkbox"></th> --}}
                            <th scope="col">TUPT Number</th>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Sex</th>
                            <th scope="col">Contract</th>
                            <th scope="col">COR</th>
                            <th scope="col">Student ID</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="registereduserTableBody">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->

    <div class="modal fade" id="createRegisteredUserModal" tabindex="-1" aria-labelledby="createRegisteredUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRegisteredUserModalLabel">Create New Registered User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add your form fields for creating a registered user -->
                    <form id="createRegisteredUserForm">
                        <div class="mb-3">
                            <label for="roomDropdown" class="form-label">Room</label>
                            <select class="form-select" id="roomDropdown" required>
                                <!-- Populate room options dynamically based on sex and type -->
                                <!-- For example, you can use JavaScript to fetch and populate options -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="bedDropdown" class="form-label">Bed</label>
                            <select class="form-select" id="bedDropdown" required>
                                <!-- Populate bed options dynamically based on selected room -->
                                <!-- For example, you can use JavaScript to fetch and populate options -->
                            </select>
                        </div>
                        <!-- Add other necessary form fields -->
                        <button type="submit" class="btn btn-primary">Add Registered User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add a modal for displaying PDFs -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">PDF Viewer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="pdfViewer" width="100%" height="600px" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- Add a modal for displaying images -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Image Viewer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="imageViewer" class="img-fluid" src="" alt="Image Viewer">
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
<script src="{{ secure_asset('js/admin/dorm/registereduser.js') }}"></script>
@endsection

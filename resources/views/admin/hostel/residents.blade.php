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

@include('layouts.sidebar.hostel.admin')

<!-- Content Start -->
<div class="content">
    @include('layouts.navbar')
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h3 class="mb-0">Residents</h3>
                <button id="addResidentButton" class="btn btn-primary">Add Resident</button>
            </div>
            <form class="d-none d-md-flex ms-4">
                <input class="form-control border-0" type="search" placeholder="Search" id="searchInput">
            </form>
            {{-- <br> --}}
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
                            <th scope="col">Name</th>
                            <th scope="col">Sex</th>
                            <th scope="col">Contacts</th>
                            <th scope="col">Birthdate</th>
                            <th scope="col">Room</th>
                            <th scope="col">Image</th>

                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="residentTableBody">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->

    <div class="modal fade" id="createResidentModal" tabindex="-1" aria-labelledby="createResidentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createResidentModalLabel">Create New Resident</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add your form fields for creating a resident -->
                    <form id="createResidentForm">
                        <div class="mb-3">
                            <label for="residentName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="residentName" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="residentSex" class="form-label">Sex</label>
                            <select class="form-select" id="residentSex" required>
                                <option value="" selected hidden></option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="residentType" class="form-label">Type</label>
                            <select class="form-select" id="residentType" required>
                                <option value="" selected hidden></option>
                                <option value="student">Student</option>
                                <option value="faculty">Faculty</option>
                                <option value="staff">Staff</option>
                            </select>
                        </div>
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

                        <div class="mb-3">
                            <label for="corFile" class="form-label">Cor Document</label>
                            <input type="file" class="form-control" id="corFile" required>
                        </div>
                        <div class="mb-3">
                            <label for="schoolIDFile" class="form-label">School ID Document</label>
                            <input type="file" class="form-control" id="schoolIDFile" required>
                        </div>
                        <div class="mb-3">
                            <label for="vaccineCardFile" class="form-label">Vaccine Card Document</label>
                            <input type="file" class="form-control" id="vaccineCardFile" required>
                        </div>
                        <div class="mb-3">
                            <label for="contractFile" class="form-label">Contract Document</label>
                            <input type="file" class="form-control" id="contractFile" required>
                        </div>
    
                        <button type="submit" class="btn btn-primary">Create Resident</button>
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
<script src="{{ asset('js/admin/hostel/resident.js') }}"></script>
@endsection

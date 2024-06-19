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
                <h3 class="mb-0">Rooms</h3>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoomModal">Create Room</button>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-2">
         
            {{-- <div class="btn-group" role="group">
                <input type="radio" class="btn-check" name="roomRadiobtn" id="btnradio1" autocomplete="off" checked value="">
                <label class="btn btn-outline-primary" for="btnradio1">All</label>

                <input type="radio" class="btn-check" name="roomRadiobtn" id="btnradio2" autocomplete="off" value="Student">
                <label class="btn btn-outline-primary" for="btnradio2">Students</label>

                <input type="radio" class="btn-check" name="roomRadiobtn" id="btnradio3" autocomplete="off" value="Faculty">
                <label class="btn btn-outline-primary" for="btnradio3">Faculties</label>

                <input type="radio" class="btn-check" name="roomRadiobtn" id="btnradio4" autocomplete="off" value="Staff">
                <label class="btn btn-outline-primary" for="btnradio4">Staffs</label>

            </div> --}}

            <div class="btn-group" role="group">
                <input type="radio" class="btn-check" name="branchRadiobtn" id="branchBtnradio1" autocomplete="off" checked  value="Dormitory">
                <label class="btn btn-outline-primary" for="branchBtnradio1">Dormitory</label>

                <input type="radio" class="btn-check" name="branchRadiobtn" id="branchBtnradio2" autocomplete="off" value="Hostel">
                <label class="btn btn-outline-primary" for="branchBtnradio2">Hostel</label>

            </div>
        </div>

        </div>

        <style>
            thead {
                background-color: salmon;
            }
        </style>
    
        <!-- Resident Logs Table Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="col-sm-12 col-xl-18">
                <div class="bg-light rounded h-100 p-4">
                <div class="table-responsive">       
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead id="roomTable">
                        {{-- <tr class="text-dark">
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Category</th>
                            <th scope="col">Slot</th>
                            <th scope="col">Available</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr> --}}
                    </thead>
                    <tbody id="roomsTableBody">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->

    

    <!-- Create Room Modal -->
    <div class="modal fade" id="createRoomModal" tabindex="-1" aria-labelledby="createRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRoomModalLabel">Create New Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add your form fields for creating a room -->
                    <form id="createRoomForm">
                        <div class="mb-3">

                        <label for="createbranchDropdown" class="form-label">Branch</label>
                            <select class="form-select" id="createbranchDropdown" required>
                                <option value="" selected hidden></option>
                                <option value="Dormitory">Dormitory</option>
                                <option value="Hostel">Hostel</option>
                            </select>
                        </div>
                        <div id="createContent">

                        </div>
                    <button type="submit" class="btn btn-primary">Create Room</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateRoomModal" tabindex="-1" aria-labelledby="updateRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateRoomModalLabel">Update Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <form id="updateRoomForm">
                        <div class="mb-3">
                            <label for="updateName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="updateName" autocomplete="off" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="updateType" class="form-label">Type</label>
                            <select class="form-select" id="updateType" required>
                                <option value="" selected hidden></option>
                                <option value="Student">Student</option>
                                <option value="Faculty">Faculty</option>
                                <option value="Staff">Staff</option>
                            </select>
                        </div>
    
                        <div class="mb-3">
                            <label for="updateCategory" class="form-label">Category</label>
                            <select class="form-select" id="updateCategory" required>
                                <option value="" selected hidden></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="updateStatus" class="form-label">Status</label>
                            <select class="form-select" id="updateStatus" required>
                                <option value="" selected hidden></option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
 
                       
    
                        <button type="submit" class="btn btn-primary">Update Room</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

  
    
{{-- 
    @include('layouts.footer') --}}

</div>
<!-- Content End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<script src="{{ secure_asset('js/admin/dorm/room.js') }}"></script>
@endsection

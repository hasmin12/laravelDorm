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
                <h3 class="mb-0">Applicants</h3>
                <a href='/admin/dorm/newresident' class="btn btn-primary">Add Applicant</a>
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
            <button class="btn btn-primary" id="sendEmailButton">Send Email</button>                      
        </div>
         <!-- Toggle Button for View -->
         <div class="form-check form-switch ms-3">
            <input class="form-check-input form-switch-lg" type="checkbox" id="viewToggle">
            <label class="form-check-label" for="viewToggle">Toggle View</label>
        </div>
       

  <!-- Tile View Start -->
<div class="container-fluid pt-4 px-4" id="residentTilesContainer">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
        <!-- Resident tiles will be dynamically added here -->
    </div>
</div>

<!-- Modal Start -->
<div class="modal fade" id="residentDetailsModal" tabindex="-1" aria-labelledby="residentDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="residentDetailsModalLabel">Resident Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="residentDetailsModalBody">
                <!-- Resident details will be dynamically added here -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-warning" onclick="updateRoom(${resident.id})">Update</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteRoom(${resident.id})">Delete</button>
            </div>
        </div>
    </div>
</div>





        <!-- Table View Start -->
        <div class="container-fluid pt-10 px-10" id="residentTableView">
            <div class="bg-light text-center rounded p-4">
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0" class="table table-dark">
                        <thead>
                            <tr>
                                {{-- <th scope="col"><input class="form-check-input" type="checkbox"></th> --}}
                                <th scope="col">TUPT Number</th>
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Sex</th>
                                <th scope="col">Contacts</th>
                                <th scope="col">Room & Bed</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="residentTableBody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Table View End -->

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
                            <!-- ... (unchanged) ... -->
                        </form>
                    </div>
                </div>
            </div>
        </div>


        

    </div>
    <!-- Content End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>
<!-- Modal Structure -->
<div class="modal fade" id="updateResidentModal" tabindex="-1" role="dialog" aria-labelledby="updateResidentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateResidentModalLabel">Update Resident</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateResidentForm">
                    <div class="mb-3">
                        <label for="updateName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="updateName" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="updateType" class="form-label">Type </label>
                        <input type="text" class="form-control" id="updateType" name="type">
                    </div>
                    <div class="mb-3">
                        <label for="updateSex" class="form-label">Sex</label>
                        <input type="text" class="form-control" id="updateSex" name="sex">
                    </div>
                    <!-- Add other input fields for resident details -->
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>            
        </div>
    </div>
</div>


<script src="{{ asset('js/admin/dorm/applicant.js') }}"></script>

<!-- ... (your existing HTML code) ... -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Check the localStorage for the last selected view
        const lastView = localStorage.getItem('residentView');

        // Get the tile and table view elements
        const tileView = document.getElementById('residentTilesContainer');
        const tableView = document.getElementById('residentTableView');

        // Set the default view based on the localStorage or default to tile view
        const defaultView = lastView === 'table' ? 'table' : 'tile';
        const initialView = localStorage.getItem('residentView') || defaultView;

        // Hide/show views based on the initial state
        if (initialView === 'tile') {
            tileView.style.display = 'block';
            tableView.style.display = 'none';
        } else {
            tileView.style.display = 'none';
            tableView.style.display = 'block';
        }

        // Event listener for the toggle view button
        document.getElementById('viewToggle').addEventListener('change', function () {
            // Update the localStorage with the current selected view
            localStorage.setItem('residentView', this.checked ? 'tile' : 'table');

            // Show/hide views based on the toggle state
            tileView.style.display = this.checked ? 'block' : 'none';
            tableView.style.display = this.checked ? 'none' : 'block';
        });
    });
</script>



@include('layouts.footer')

@endsection

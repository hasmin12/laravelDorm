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

    @include('layouts.sidebar.dorm.admin')

    <!-- Content Start -->
    <div class="content">
        @include('layouts.navbar')
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h3 class="mb-0">Violators</h3>
                <button id="addViolationButton" class="btn btn-primary">Add Violators</button>
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
                        <thead class="text-dark">
                            <tr class="text-dark">
                                <th scope="col">Violator</th>
                                <th scope="col">Violation</th>
                                <th scope="col">Penalty</th>
                                <th scope="col">Violation Date</th>
                                <th scope="col">Violation Type</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="violationTableBody">
                            <!-- Table rows will be populated dynamically by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Recent Sales End -->

        <!-- Create Violation Modal -->
        <div class="modal fade" id="createViolationModal" tabindex="-1" aria-labelledby="createViolationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createViolationModalLabel">Create New Violation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="createViolationForm">
                            <div class="mb-3">
                                <label for="residentDropdown" class="form-label">Resident Name</label>
                                <select class="form-select" id="residentDropdown" required>
                                    <!-- Resident options will be populated dynamically by JavaScript -->
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="violationName" class="form-label">Violation Name</label>
                                <input type="text" class="form-control" id="violationName" required>
                            </div>
                            <div class="mb-3">
                                <label for="violationType" class="form-label">Violation Type</label>
                                <input type="text" class="form-control" id="violationType" required>
                            </div>
                            <div class="mb-3">
                                <label for="penalty" class="form-label">Penalty</label>
                                <input type="text" class="form-control" id="penalty" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Violation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Content End -->
    <script src="{{ asset('js/admin/dorm/violation.js') }}"></script>
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>
@endsection

@extends('layouts.base')
@section('content')
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
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
                    <h3 class="mb-0">Reports</h3>
                </div>
                <div class="row mb-2">
                    <select id="report" class="form-control" name="report">
                        <option value="Residents">Residents</option>
                        <option value="Maintenance">Maintenance</option>
                        <option value="Visitors">Visitors</option>
                        <option value="Laundry">Laundry Schedules</option>

                        {{-- <option value="Announcements">Announcements</option> --}}


                    </select>
                </div>
                <div id="branchDiv" class="btn-group" role="group">
                    <input type="radio" class="btn-check" name="branchbtnradio" id="branchbtnradio1" autocomplete="off"
                        checked value="Dormitory">
                    <label class="btn btn-outline-primary" for="branchbtnradio1">Dormitory</label>

                    <input type="radio" class="btn-check" name="branchbtnradio" id="branchbtnradio2" autocomplete="off"
                        value="Hostel">
                    <label class="btn btn-outline-primary" for="branchbtnradio2">Hostel</label>
                </div>
                <div class="btn-group" role="group">
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked
                        value="All">
                    <label class="btn btn-outline-primary" for="btnradio1">All</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off"
                        value="Daily">
                    <label class="btn btn-outline-primary" for="btnradio2">Daily</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off"
                        value="Weekly">
                    <label class="btn btn-outline-primary" for="btnradio3">Weekly</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off"
                        value="Monthly">
                    <label class="btn btn-outline-primary" for="btnradio4">Monthly</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio5" autocomplete="off"
                        value="Yearly">
                    <label class="btn btn-outline-primary" for="btnradio5">Yearly</label>
                </div>
                <button id="downloadPdfBtn" class="btn btn-primary">Download PDF</button>
            </div>
            <div id="resident-reports">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Residents Information Report</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0"
                            class="table table-dark">
                            <thead>
                                <tr class="text-dark">
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Birth Date</th>
                                    <th>Sex</th>
                                    <th>Phone Number</th>
                                    <th>Registered</th>
                                </tr>
                            </thead>
                            <tbody id="residentReportBody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div id="hostel-reports">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Hostel Reservations Report</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0"
                            class="table table-dark">
                            <thead>
                                <tr class="text-dark">
                                    <th>Name</th>
                                    <th>Room</th>
                                    <th>Total Payment</th>
                                    <th>Reservation Date</th>
                                    <th>Check-In Date</th>
                                    <th>Check-Out Dater</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="hostelReportBody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>




            <div id="maintenance-reports">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Maintenance Report</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0"
                            class="table table-dark">
                            <thead>
                                <tr class="text-dark">
                                    <th>Resident Name</th>
                                    <th>Room Number</th>
                                    <th>Technician</th>
                                    <th>Maintenance Type</th>
                                    <th>Date Requested</th>
                                    <th>Date Finished</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="maintenanceReportBody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="visitors-reports">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Visitors Report</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0"
                            class="table table-dark">
                            <thead>
                                <tr class="text-dark">
                                    <th>Visitor Name</th>
                                    <th>Contact Number</th>
                                    <th>Visit Date</th>
                                    <th>Resident Name</th>
                                    <th>Relationship</th>
                                    <th>Purpose</th>
                                </tr>
                            </thead>
                            <tbody id="visitorReportBody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="laundry-reports">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Laundry Schedule Report</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0"
                            class="table table-dark">
                            <thead>
                                <tr class="text-dark">
                                    <th>Resident Name</th>

                                    <th>Laundry Date</th>
                                    <th>Laundry Time</th>
                                    <th>Status</th>
                                    <th>Created At</th>

                                </tr>
                            </thead>
                            <tbody id="laundryReportBody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- <div id="announcements-reports">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Announcements Report</h6>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0" class="table table-dark">
                        <thead>
                            <tr class="text-dark">
                                <th>Title</th>
                                <th>Content</th>
                                <th>Type</th>
                                <th>Birth Date</th>
                                <th>Sex</th>
                                <th>Phone Number</th>
                                <th>Registered</th>
                            </tr>
                        </thead>
                        <tbody id="residentReportBody">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
        </div>
    </div>
    <!-- Content End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <script src="{{ secure_asset('js/admin/dorm/reports.js') }}"></script>
@endsection

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
                <h3 class="mb-0">Resident Logs</h3>
                
            </div>
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div class="btn-group" role="group">
                    <input type="radio" class="btn-check" name="branchRadiobtn" id="branchBtnradio1" autocomplete="off" checked  value="Leave">
                    <label class="btn btn-outline-primary" for="branchBtnradio1">Leave</label>

                    <input type="radio" class="btn-check" name="branchRadiobtn" id="branchBtnradio2" autocomplete="off" value="Sleep">
                    <label class="btn btn-outline-primary" for="branchBtnradio2">Sleep</label>

                    <select id="dateDropdown" class="form-select">
                        <!-- Date options will be populated dynamically here -->
                    </select>
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
                        <thead>
                            <tr class="text-dark">
                                <th>Action</th>
                                <th>Student Name</th>
                                <th>Leave Date</th>
                                <th>Expected Return</th>
                                <th>Return Date</th>
                                <th>Purpose</th>
                                <th>Gatepass</th>
                                <th>Status</th>
                                <th>Date Logged</th>
                            </tr>
                        </thead>
                        <tbody id="logsTableBody">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Resident Logs Table End -->
    </div>
    <!-- Content End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<script src="{{ asset('js/admin/dorm/logs.js') }}"></script>
@endsection

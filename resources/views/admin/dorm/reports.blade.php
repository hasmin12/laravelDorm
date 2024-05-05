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
            <h3 class="mb-0">Reports</h3>
        </div>
        <div class="row mb-2">
            <select id="reportBranch" class="form-control" name="reportBranch">
                <option value="Dormitory">Dormitory</option>
                <option value="Hostel">Hostel</option>
            </select>
        </div>
            <div class="btn-group" role="group">
                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked value="All">
                <label class="btn btn-outline-primary" for="btnradio1">All</label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" value="Daily">
                <label class="btn btn-outline-primary" for="btnradio2">Daily</label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" value="Weekly">
                <label class="btn btn-outline-primary" for="btnradio3">Weekly</label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off" value="Monthly">
                <label class="btn btn-outline-primary" for="btnradio4">Monthly</label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio5" autocomplete="off" value="Yearly">
                <label class="btn btn-outline-primary" for="btnradio5">Yearly</label>
            </div>
            <button id="downloadPdfBtn" class="btn btn-primary">Download PDF</button>
        </div>
        <div id="resident-reports">
            <div class="bg-light text-center rounded p-4">

            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Residents</h6>
                </div>
                <canvas id="billingChart"></canvas>
                <em>Notes:  This chart visualizes billing trends and payment statuses over time.</em>
                <br>
                <br>

                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0" class="table table-dark">
                        <thead>
                            <tr class="text-dark">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Room</th>
                                <th>Total Amount</th>
                                <th>Paid Date</th>

                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="residentReportBody">
                            
                        </tbody>
                    </table>
                </div>
                <div class="explanations mt-4">
                    <h6>Explanations:</h6>
                    <ul>
                        <li>Number of residents not yet paid : This metric reflects the count of residents who have not made their payments within a specific month. Currently, there are <span id="notPaidCount">0</span> residents who have not paid.</li>
                        <li>Number of residents paid on time : This statistic represents the number of residents who have made their payments within the stipulated timeframe for a given month. Currently, there are <span id="paidCount">0</span> residents who have paid on time.</li>
                        <li>Number of residents with late fees : This figure indicates the count of residents who have incurred late fees due to delayed payments. Currently, there are <span id="lateFeeCount">0</span> residents with late fees.</li>
                    </ul>
                </div>
                
            </div>
        </div>

        </div>
        
        <div id="announcements-reports">
        </div>
        <div id="maintenance-reports">
        </div>
        <div id="lostandfound-reports">
        </div>
        <div id="vistors-reports">
        </div>
        <div id="laundry-reports">
        </div>
        <div id="hostel-reports">
        </div>
      
    </div>
</div>
<!-- Content End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>
<script src="{{ asset('js/admin/dorm/reports.js') }}"></script>

@endsection

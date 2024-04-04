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

@include('layouts.sidebar.resident')

<!-- Content Start -->
<div class="content">
    @include('layouts.navbar')
    {{-- Calendar --}}
    <div class="h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <h3 class="mb-0">Calendar</h3>
        </div>
        
        <div id="calendar"></div>
        
    </div>

    <div class="modal fade" id="createLaundryScheduleModal" tabindex="-1" aria-labelledby="createLaundryScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createLaundryScheduleModalLabel">Schedule Laundry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add your form fields for scheduling laundry here -->
                    <form id="createLaundryScheduleForm">
                        <!-- Example: Laundry type -->
                        <div class="mb-3">
                            <label for="scheduleDate" class="form-label">Schedule Date</label>
                            <input type="date" class="form-control" id="scheduleDate" name="scheduleDate" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="laundryTime" class="form-label">Time</label>
                            <select class="form-select" id="laundryTime" required>
                                <option value="" selected hidden></option>
                                <option value="Morning">Morning</option>
                                <option value="Afternoon">Afternoon</option>
                            </select>
                        </div>
    
                       
    
                        <!-- Add other form fields as needed -->
    
                        <button type="submit" class="btn btn-primary">Schedule Laundry</button>
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


<script src="{{ secure_asset('js/resident/laundry.js') }}"></script>
@endsection

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

    <!-- Modal for uploading receipt -->
<!-- Modal for uploading receipt -->
<!-- Modal for uploading receipt -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                
                <h5 class="modal-title" id="uploadModalLabel">Upload Receipt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" enctype="multipart/form-data">
                    <input type="hidden" name="payment_id" id="payment_id">
                    <!-- Display payment details -->
                    <div class="mb-3">
                        <strong class="fw-bold">Payment Month:</strong>
                        <span id="payment_month"></span>
                    </div>
                    <div class="mb-3">
                        <strong class="fw-bold">Total Amount:</strong>
                        <span id="total_amount"></span>
                    </div>
                    <div class="mb-3">
                        <strong class="fw-bold">Status:</strong>
                        <span id="status"></span>
                    </div>
                    <div class="mb-3">
                        <strong class="fw-bold">Room Details:</strong>
                        <span id="room_details"></span>
                    </div>
                    <div class="mb-3">
                        <strong class="fw-bold">Electric Fan:</strong>
                        <span id="electric_fan"></span>
                    </div>
                    <div class="mb-3">
                        <strong class="fw-bold">Laptop:</strong>
                        <span id="laptop"></span>
                    </div>
                    <div class="mb-3">
                        <label for="receipt" class="form-label">Official Receipt Number:</label>
                        <input type="text" class="form-control" id="receipt" required>
                    </div>
    
                    <div class="mb-3">
                        <label for="img_path" class="form-label">Upload Receipt</label>
                        <input type="file" class="form-control" id="img_path" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Your payment history table and other content -->


    <div class="content">
        @include('layouts.navbar')
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h3 class="mb-0">Bills and History</h3>
            </div>
            <form class="d-none d-md-flex ms-4">
                <input class="form-control border-0" type="search" placeholder="Search" id="searchInput">
            </form>
            <br>    
            <div class="bg-light rounded btn-group align-items-center" role="group">
                <button id="billsButton" type="button" class="btn btn-outline-primary btn-toggle" autocomplete="off" value="Pending">Bills</button>
                <button id="historyButton" type="button" class="btn btn-outline-primary btn-toggle" autocomplete="off" value="PAID">History</button>
            </div>
        </div>      
        <div id="payments-container" class="mt-4"></div> <!-- This is where the table will be inserted -->         
    </div>





    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<script src="{{ asset('js/resident/payment.js') }}"></script>

<style>
    .btn-group.align-items-center {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
@endsection

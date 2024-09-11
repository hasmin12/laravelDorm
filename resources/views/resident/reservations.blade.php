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

    @include('layouts.sidebar.resident')

    <div class="content">
        @include('layouts.navbar')
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h3 class="mb-0">Reservations</h3>
            </div>
            <form class="d-none d-md-flex ms-4">
                <input class="form-control border-0" type="search" placeholder="Search" id="searchInput">
            </form>
            <br>    
            
        </div>      
        <div id="reservations-container" class="mt-4">
        </div> 
                 
    </div>

  <!-- Reservation Details Modal -->
<div class="modal fade" id="reservationDetailsModal" tabindex="-1" aria-labelledby="reservationDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservationDetailsModalLabel">Reservation Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Room Name:</strong> <span id="roomName"></span></p>
                        <p><strong>Check-in Date:</strong> <span id="checkinDate"></span></p>
                        <p><strong>Check-out Date:</strong> <span id="checkoutDate"></span></p>
                        <p><strong>Down Payment:</strong> $<span id="downPayment"></span></p>
                        <p><strong>Total Payment:</strong> $<span id="totalPayment"></span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>User Information:</strong></p>
                        <p><strong>Name:</strong> <span id="userName"></span></p>
                        <p><strong>Email:</strong> <span id="userEmail"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<script src="{{ asset('js/resident/reservation.js') }}"></script>

<style>
    .btn-group.align-items-center {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
@endsection

@extends('layouts.base')

@section('content')
<div class="container-xxl position-relative bg-white d-flex p-0">
    <!-- Your existing content goes here -->

    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    @include('layouts.sidebar.dorm.admin')

    <!-- Content Start -->
    <div class="content">
        @include('layouts.navbar')
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h3 class="mb-0">Reservations</h3>
                
                {{-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createReservationModal">Create Lost Item</button> --}}
            </div>
            <form class="d-none d-md-flex ms-4">
                <input class="form-control border-0" type="search" placeholder="Search" id="searchInput">
            </form>
            <br>
            <div class="btn-group" role="group">
                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked value="Pending">
                <label class="btn btn-outline-primary" for="btnradio1">Pending</label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" value="Check-In">
                <label class="btn btn-outline-primary" for="btnradio2">Check-In</label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" value="Check-Out">
                <label class="btn btn-outline-primary" for="btnradio3">Check-Out</label>

              
            </div>
        </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            {{-- <th scope="col"><input class="form-check-input" type="checkbox"></th> --}}
                            <th scope="col">Reservation ID</th>
                            <th scope="col">Room Number</th>
                            <th scope="col">Check-In Date</th>
                            <th scope="col">Check-Out Date</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contacts</th>
                            <th scope="col">Status</th>

                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody id="reservationTableBody">
                        
                    </tbody>
                </table>
            </div>
        </div>

            <!-- Modal for creating a new lost item -->
            <div class="modal fade" id="createReservationModal" tabindex="-1" aria-labelledby="createReservationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createReservationModalLabel">Create New Lost Item</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Add your form fields for creating a new lost item here -->
                            <form id="createReservationForm" enctype="multipart/form-data">
                                @csrf
                                <!-- Example: Name -->
                                <div class="mb-3">
                                    <label for="itemName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="itemName" name="itemName" required>
                                </div>

                                <div class="mb-3">
                                    <label for="locationLost" class="form-label">Found in</label>
                                    <input type="text" class="form-control" id="locationLost" name="locationLost" required>
                                </div>

                                <div class="mb-3">
                                    <label for="findersName" class="form-label">Find by</label>
                                    <input type="text" class="form-control" id="findersName" name="findersName" required>
                                </div>
                               
                                <div class="mb-3">
                                    <label for="img_path" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="img_path" name="img_path" required>
                                </div>

                                <!-- Add other form fields as needed -->

                                <button type="submit" class="btn btn-primary">Create Lost Item</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="reservationDetailsModal" tabindex="-1" aria-labelledby="reservationDetailsModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="reservationDetailsModalLabel">Reservation Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Reservation details will be injected here -->
                        </div>
                    </div>
                </div>
            </div>
            
        <div class="modal fade" id="updateReservationModal" tabindex="-1" aria-labelledby="updateReservationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateReservationModalLabel">Update Reservation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img id="reservationImage" src="" class="img-fluid mb-3" alt="Room Image">
                            </div>
                            <div class="col-md-6">
                                <p><strong>Reservation ID:</strong> <span id="resId"></span></p>

                                <p><strong>Room:</strong> <span id="resRoomName"></span></p>
                                <p><strong>Check-in Date:</strong> <span id="resCheckin"></span></p>
                                <p><strong>Check-out Date:</strong> <span id="resCheckout"></span></p>
                                <p><strong>Name:</strong> <span id="resName"></span></p>
                                <p><strong>Email:</strong> <span id="resEmail"></span></p>
                                <p><strong>Contacts:</strong> <span id="resContacts"></span></p>
                                <p><strong>Status:</strong> 
                                    <select id="resStatus" class="form-select">
                                        <option value="Check-In">Check-In</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="updateStatus">Update Reservation</button>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- @include('layouts.footer') --}}
    </div>
    <!-- Content End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>
<script src="{{ asset('js/admin/dorm/reservation.js') }}"></script>
@endsection
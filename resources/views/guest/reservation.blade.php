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
    <div class="bg-light rounded p-4">

        <div class="d-flex align-items-center justify-content-between mb-2">
            <h3 class="mb-0">Hostel Rooms</h3>
        </div>
    
        <div class="row" id="room-container">
            <!-- Room cards will be dynamically added here -->
        </div>
    </div>

</div>

<div class="modal fade" id="roomModal" tabindex="-1" role="dialog" aria-labelledby="roomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roomModalLabel">Room Details</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Carousel for Room Images -->
                    <div class="col-md-6">
                        
                        <div id="roomImageCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <!-- Images will be dynamically added here -->
                            </div>
                            {{-- <a class="carousel-control-prev" href="#roomImageCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#roomImageCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a> --}}
                        </div>
                        <div id="roomImageContainer"></div>
                    </div>
                    <div class="col-md-6">
                        <h5 id="modalRoomName"></h5>
                        <p id="modalRoomDescription"></p>
                        <p id="modalRoomType"></p>
                        <p id="modalRoomPax"></p>
                        <p id="modalRoomPrice"></p>
                        <p id="roomStatus"></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservationModalLabel">Reservation</h5>
            </div>
            <div class="modal-body">
                
                <form id="createReservationForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            {{-- <h4>Reserve Room</h4> --}}
                            <input type="text"  id="room_id" name="room_id"  hidden>
                            <h4 id="reservationModalTitle"></h4>
                            <p id="reservationModalDescription"></p>

                            <p id="reservationModalType"></p>
                            <p id="reservationModalPax"></p>
                            <p id="reservationModalPrice"></p>
                            
                            
                            <div class="mb-3">
                                <label for="checkinDate" class="form-label">Check-in Date</label>
                                <input type="date" class="form-control" id="checkinDate" name="checkinDate" required>
                            </div>
                            <div class="mb-3">
                                <label for="checkoutDate" class="form-label">Check-out Date</label>
                                <input type="date" class="form-control" id="checkoutDate" name="checkoutDate" required>
                            </div>

                            <div class="card" style="cursor: pointer;" >
                                <div class="card-body">
                                    <h5 class="card-title">Payment Information</h5>
                                    <p id="paymentInfo" class="card-text"></p>
                                    <p id="downPaymentInfo" class="card-text"></p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="payments" class="form-label">Payment</label>
                                <input type="file" class="form-control" id="payments" name="payments" required>
                            </div>
                    

                        </div>
                        <div class="col-md-6">

                            <h4>Personal Information</h4>
                            <div class="mb-3">
                                <label for="residentName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="residentName" name="residentName" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="residentSex" class="form-label">Sex</label>
                                <select class="form-select" id="residentSex" name="residentSex" required>
                                    <option value="" selected hidden></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="birthdate" class="form-label">Birthdate</label>
                                <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                            </div>
                    
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
            
                            <div class="mb-3">
                                <label for="validId" class="form-label">Valid ID</label>
                                <input type="file" class="form-control" id="validId" name="validId" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="img_path" class="form-label">Image</label>
                                <input type="file" class="form-control" id="img_path" name="img_path" required>
                            </div>
                            
                        </div>
                        <button type="submit" class="btn btn-primary">Create Reservation</button>
                    </div>
                </form>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submitReservation()">Submit Reservation</button>
            </div> --}}
        </div>
    </div>
</div>

<script src="{{ asset('js/guest/reservation.js') }}"></script>
@endsection
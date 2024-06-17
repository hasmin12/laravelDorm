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

    @include('layouts.sidebar.dorm.maintenance')

    <!-- Content Start -->
    <div class="content">
        @include('layouts.navbar')
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h3 class="mb-0">Transactions</h3>
                {{-- <a href='/admin/dorm/newresident' class="btn btn-primary">Add Resident</a> --}}
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
      
       



        <select id="MY_dropdown" class="form-control">
            <option value="All">All</option>
        </select>
        
        <div class="container-fluid pt-10 px-10" id="residentTableView">
            <div class="bg-light text-center rounded p-4">
                <div class="table-responsive">
                    <table id="payments-table" border="1" class="table text-start align-middle table-bordered table-hover mb-0" class="table table-dark">
                        <thead>
                            <tr>
                                {{-- <th scope="col"><input class="form-check-input" type="checkbox"></th> --}}
                                <th scope="col">View Receipt</th>
                                <th scope="col">Resident Name</th>
                                <th scope="col">Receipt</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Payment Month</th>
                            </tr>
                        </thead>
                        <tbody id="payments-body">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        

    </div>
    <!-- Content End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>



<script src="{{ asset('js/admin/dorm/payment.js') }}"></script>

<!-- ... (your existing HTML code) ... -->


{{-- @include('layouts.footer') --}}

@endsection
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
                <h3 class="mb-0">Transactions</h3>
                {{-- <a href='/admin/dorm/newresident' class="btn btn-primary">Add Resident</a> --}}
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
      
       



        <select id="MY_dropdown" class="form-control">
            <option value="All">All</option>
        </select>
        
        <div class="container-fluid pt-10 px-10" id="residentTableView">
            <div class="bg-light text-center rounded p-4">
                <div class="table-responsive">
                    <table id="payments-table" border="1" class="table text-start align-middle table-bordered table-hover mb-0" class="table table-dark">
                        <thead>
                            <tr>
                                {{-- <th scope="col"><input class="form-check-input" type="checkbox"></th> --}}
                                <th scope="col">View Receipt</th>
                                <th scope="col">Resident Name</th>
                                <th scope="col">Receipt</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Payment Month</th>
                            </tr>
                        </thead>
                        <tbody id="payments-body">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        

    </div>
    <!-- Content End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>



<script src="{{ asset('js/admin/dorm/payment.js') }}"></script>

<!-- ... (your existing HTML code) ... -->


{{-- @include('layouts.footer') --}}

@endsection

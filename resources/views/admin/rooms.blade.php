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

@include('layouts.sidebar.admin')

<!-- Content Start -->
<div class="content">
    @include('layouts.navbar')
        <div class="bg-light rounded p-4">
            <h3 class="mb-4">Rooms</h3>
            {{-- <form class="d-none d-md-flex ms-4">
                <input class="form-control border-0" type="search" placeholder="Search" id="searchInput">
            </form> --}}
            {{-- <br> --}}
            <div class="btn-group" role="group">
                <input type="radio" class="btn-check" name="roomRadiobtn" id="btnradio1" autocomplete="off" checked value="">
                <label class="btn btn-outline-primary" for="btnradio1">All</label>

                <input type="radio" class="btn-check" name="roomRadiobtn" id="btnradio2" autocomplete="off" value="Student">
                <label class="btn btn-outline-primary" for="btnradio2">Students</label>

                <input type="radio" class="btn-check" name="roomRadiobtn" id="btnradio3" autocomplete="off" value="Faculty">
                <label class="btn btn-outline-primary" for="btnradio3">Faculties</label>

                <input type="radio" class="btn-check" name="roomRadiobtn" id="btnradio4" autocomplete="off" value="Staff">
                <label class="btn btn-outline-primary" for="btnradio4">Staffs</label>

            </div>
        </div>
    
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Category</th>
                            <th scope="col">Slot</th>
                            <th scope="col">Available</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="roomsTableBody">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->


    

    @include('layouts.footer')

</div>
<!-- Content End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>
@endsection

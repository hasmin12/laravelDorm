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
                <h3 class="mb-0">Repairs</h3>
                {{-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoomModal">Create Room</button> --}}
            </div>
        </div>
    
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Room</th>
                            <th scope="col">Request Date</th>
                            <th scope="col">Item</th>
                           
                            <th scope="col">Technician</th>
                            <th scope="col">Resident</th>
                         
                            <th scope="col">Image</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody id="repairsTableBody">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->

  
    

    {{-- @include('layouts.footer') --}}

</div>
<!-- Content End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<script src="{{ asset('js/admin/repair.js') }}"></script>
@endsection

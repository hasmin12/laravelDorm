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
            <h3 class="mb-4">Beds</h3>
        </div>
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        
        <div class="bg-light text-center rounded p-4">
        <button type="button" class="btn btn-lg btn-lg-square btn-primary m-2" onclick="goBack()"><i class="fa fa-arrow-left"></i></button>

            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Resident</th>                       
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="bedsTableBody">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateBedModal" tabindex="-1" aria-labelledby="updateBedModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateBedModalLabel">Update Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <form id="updateBedForm">
                        <div class="mb-3">
                            <label for="updateName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="updateName" autocomplete="off" @readonly(true)>
                        </div>
    
                        <div class="mb-3">
                            <label for="updateType" class="form-label">Type</label>
                            <input type="text" class="form-control" id="updateType" autocomplete="off" @readonly(true)>
                        </div>
  
                        <div class="mb-3">
                            <label for="updateStatus" class="form-label">Status</label>
                            <select class="form-select" id="updateStatus" required>
                                <option value="" selected hidden></option>
                                <option value="Vacant">Vacant</option>
                                <option value="Occupied">Occupied</option>
                            </select>
                        </div>
 
                       
    
                        <button type="submit" class="btn btn-primary">Update Room</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    


</div>
<!-- Content End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>
<script src="{{ secure_asset('js/beds.js') }}"></script>
@endsection

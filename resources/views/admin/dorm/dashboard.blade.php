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
    @include('layouts.sidebar.dorm.admin')
    <!-- Content Start -->
    <div class="content">
        @include('layouts.navbar')
        <!-- Sale & Revenue Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row mb-2">
                <select id="dashboardBranch" class="form-control" name="dashboardBranch">
                    <option value="Both">All</option>
                    <option value="Dormitory">Dormitory</option>
                    <option value="Hostel">Hostel</option>
                </select>
            </div>
            
            <div class="row g-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-users fa-2x text-primary"></i>
                        <div id = "residentData" class="ms-3">
                         
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-bar fa-3x text-primary"></i>
                        <div id = "roomData" class="ms-3">
                         
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-area fa-3x text-primary"></i>
                        <div id = "monthlyRevenueData" class="ms-3">
                         
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-pie fa-3x text-primary"></i>
                        <div id = "totalData" class="ms-3">
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sale & Revenue End -->


        <!-- Sales Chart Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Residents</h6>
                            {{-- <a href="">Show All</a> --}}
                        </div>
                        {{-- <canvas id="worldwide-sales"></canvas> --}}
                    <canvas id="residentCanvas"></canvas>

                    </div>
                </div>
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Revenue</h6>
                            {{-- <a href="">Show All</a> --}}
                        </div>
                        <canvas id="DormPaymentCanvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- Content End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>
<script>

if (localStorage.getItem('token') === null) {
    console.log(localStorage.getItem('token'))
    getAuthUser();
}
function getAuthUser() {
    fetch('/getAuthUser', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        credentials: 'include',
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log(data);
        localStorage.setItem('token', data.remember_token);
        localStorage.setItem('email', data.email);
    })
    .catch(error => console.error('Error fetching user data:', error));
}
</script>

<script src="{{ asset('/js/admin/dorm/dashboard.js') }}"></script>

@endsection

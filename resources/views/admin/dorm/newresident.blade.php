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
                <h3 class="mb-0">New Resident</h3>
            </div>

            <!-- New Resident Form Start -->
            <form id="newResidentForm" action="/admin/newresident" method="post" enctype="multipart/form-data">
                @csrf <!-- Add CSRF token for Laravel form submission -->

                <!-- Personal Information -->
                <h4>Personal Information</h4>
                <div class="mb-3">
                    <label for="residentName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="residentName" name="residentName" required>
                </div>

                <div class="mb-3">
                    <label for="residentSex" class="form-label">Sex</label>
                    <select class="form-select" id="residentSex" name="residentSex" required>
                        <option value="" selected hidden></option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <!-- Contacts -->
                <h4>Contacts</h4>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>

                <!-- File Uploads -->
                <h4>File Uploads</h4>
                <div class="mb-3">
                    <label for="corFile" class="form-label">Cor Document</label>
                    <input type="file" class="form-control" id="corFile" name="corFile" required>
                </div>

                <div class="mb-3">
                    <label for="schoolIDFile" class="form-label">School ID Document</label>
                    <input type="file" class="form-control" id="schoolIDFile" name="schoolIDFile" required>
                </div>

                <!-- Room Assignment -->
                <h4>Room Assignment</h4>
                <div class="mb-3">
                    <label for="roomDropdown" class="form-label">Room</label>
                    <select class="form-select" id="roomDropdown" name="roomDropdown" required>
                        <!-- Populate room options dynamically based on sex and type -->
                        <!-- For example, you can use JavaScript to fetch and populate options -->
                    </select>
                </div>

                <div class="mb-3">
                    <label for="bedDropdown" class="form-label">Bed</label>
                    <select class="form-select" id="bedDropdown" name="bedDropdown" required>
                        <!-- Populate bed options dynamically based on selected room -->
                        <!-- For example, you can use JavaScript to fetch and populate options -->
                    </select>
                </div>

                <!-- Add other necessary form fields -->

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Create Resident</button>
            </form>
            <!-- New Resident Form End -->
        </div>

        @include('layouts.footer')

    </div>
    <!-- Content End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>
<script src="{{ asset('js/resident.js') }}"></script>
@endsection

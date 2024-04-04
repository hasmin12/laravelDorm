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

    <div class="container-fluid mt-4" style="width: 50%;">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <h3 class="mb-0">Visitor's Form</h3>
        </div>

        <!-- New Resident Form Start -->
        <form id="visitorForm" enctype="multipart/form-data">
            @csrf <!-- Add CSRF token for Laravel form submission -->

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>

            <div class="mb-3">
                <label for="visit_date" class="form-label">Visit Date</label>
                <input type="date" class="form-control" id="visitDate" name="visit_date" required>
            </div>

            <div class="mb-3">
                <label for="resident_id" class="form-label">Select Resident</label>
                <select class="form-select" id="resident_id" name="resident_id" required>
                    <option value="" selected disabled></option>
                </select>
            </div>
            

            <div class="mb-3">
                <label for="relationship" class="form-label">Relationship</label>
                <input type="text" class="form-control" id="relationship" name="relationship" required>
            </div>

            <div class="mb-3">
                <label for="purpose" class="form-label">Purpose</label>
                <input type="text" class="form-control" id="purpose" name="purpose" required>
            </div>

            <div class="mb-3">
                <label for="validId" class="form-label">Valid ID</label>
                <input type="file" class="form-control" id="validId" name="validId" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="agreeCheckbox" name="agreeCheckbox" required>
                <label class="form-check-label"  data-bs-toggle="modal" data-bs-target="#termsModal">I agree to the terms and conditions of the Visitor Terms and Agreement</label>
            </div>
        
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <!-- New Resident Form End -->
    </div>
</div>
<!-- Modal for Terms and Agreement -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Visitor Terms and Agreement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    By checking the box and submitting this form, you acknowledge and agree to the following terms and conditions:
                </p>
                <ol>
                    <li>This visitor form is to be used for official purposes only.</li>
                    <li>You are responsible for providing accurate and complete information in the form.</li>
                    <li>Visitors must adhere to the rules and regulations of the school dormitory.</li>
                    <li>The school reserves the right to deny or revoke visitor access for any reason.</li>
                    <li>You understand that false information may result in disciplinary action.</li>
                    <li>Visitors are expected to respect the privacy and rights of dormitory residents.</li>
                </ol>
                <p>
                    Violation of any terms may lead to expulsion from the dormitory premises and other appropriate actions.
                </p>
                <p>
                    By submitting this form, you agree to comply with all applicable rules and policies.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    {{-- @include('layouts.footer') --}}


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

<script src="{{ secure_asset('js/guest/visitor.js') }}"></script>
@endsection

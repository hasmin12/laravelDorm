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

@include('layouts.sidebar.hostel.admin')

<!-- Content Start -->
<div class="content">
    @include('layouts.navbar')
    <div class="h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <h3 class="mb-0">Announcements</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAnnouncementModal">Create</button>
        </div>

        <div id="announcements-container">
            <!-- Display existing announcements here using JavaScript -->
        </div>

        <!-- Modal for creating a new announcement -->
        <div class="modal fade" id="createAnnouncementModal" tabindex="-1" aria-labelledby="createAnnouncementModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createAnnouncementModalLabel">Create New Announcement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Add your form fields for creating an announcement -->
                        <form id="createAnnouncementForm">
                            <div class="mb-3">
                                <label for="announcementTitle" class="form-label">Title</label>
                                <input type="text" class="form-control" id="announcementTitle" required>
                            </div>
                            <div class="mb-3">
                                <label for="announcementContent" class="form-label">Content</label>
                                <textarea class="form-control" id="announcementContent" rows="4" required></textarea>
                            </div>
                            <!-- Add other necessary form fields -->
                            <div class="mb-3">
                                <label for="receiver" class="form-label">Announce To</label>
                                <select class="form-select" id="receiver" required>
                                    <option value="" selected hidden></option>
                                    <option value="Residents">Residents</option>
                                    <option value="Public">Public</option>
                                </select>
                            </div>
        
                            <button type="submit" class="btn btn-primary">Create Announcement</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for creating a new announcement -->
        
        <!-- Modal for Updateing announcement -->
        <div class="modal fade" id="updateAnnouncementModal" tabindex="-1" aria-labelledby="updateAnnouncementModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateAnnouncementModalLabel">Update Announcement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Add your form fields for updating an announcement -->
                        <form id="updateAnnouncementForm">
                            <div class="mb-3">
                                <label for="updateTitleInput" class="form-label">Title</label>
                                <input type="text" class="form-control" id="updateTitleInput" required>
                            </div>
                            <div class="mb-3">
                                <label for="updateContentInput" class="form-label">Content</label>
                                <textarea class="form-control" id="updateContentInput" rows="4" required></textarea>
                            </div>
                            <!-- Add other necessary form fields -->
        
                            <button type="submit" class="btn btn-primary">Update Announcement</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for Updateing announcement -->

    </div>
    @include('layouts.footer')
</div>
<!-- Content End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<script src="{{ asset('js/announcement.js') }}"></script>
@endsection

document.addEventListener('DOMContentLoaded', function () {
    fetchAnnouncements();
    const announcementsContainer = document.getElementById('announcements-container');
    announcementsContainer.addEventListener('click', function (event) {
        const target = event.target;
        const announcementId = target.dataset.announcementId;

        if (target.classList.contains('update-btn')) {
            openUpdateModal(announcementId);
        } else if (target.classList.contains('delete-btn')) {
            confirmDelete(announcementId);
        }
    });
});




function openUpdateModal(announcementId) {
    const updateAnnouncementForm = document.getElementById('updateAnnouncementForm');
    updateAnnouncementForm.dataset.announcementId = announcementId; // Set announcement ID in the form's data attribute

    const updateTitleInput = document.getElementById('updateTitleInput');
    const updateContentInput = document.getElementById('updateContentInput');

    const token = localStorage.getItem('token');

    fetch(`/api/getAnnouncement/${announcementId}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}`,
        },
        credentials: 'include',
    })
    .then(response => response.json())
    .then(data => {
        // Populate the update modal fields with the retrieved data
        updateTitleInput.value = data.announcement.title;
        updateContentInput.value = data.announcement.content;

        // Show the update modal
        $('#updateAnnouncementModal').modal('show');
    })
    .catch(error => {
        console.error('Error fetching announcement details:', error);

        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while fetching announcement details. Please try again.',
        });
    });
}

function confirmDelete(announcementId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteAnnouncement(announcementId);
        }
    });
}

function deleteAnnouncement(announcementId) {
    const token = localStorage.getItem('token');

    fetch(`/api/deleteAnnouncement/${announcementId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}`,
        },
        credentials: 'include',
    })
    .then(response => response.json())
    .then(data => {
        console.log('Announcement deleted successfully:', data);

        fetchAnnouncements();

        Swal.fire({
            icon: 'success',
            title: 'Announcement Deleted',
            text: 'Your announcement has been successfully deleted.',
        });
    })
    .catch(error => {
        console.error('Error deleting announcement:', error);

        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while deleting the announcement. Please try again.',
        });
    });
}

function fetchAnnouncements() {
    const token = localStorage.getItem('token');

    fetch(`/api/getAnnouncements`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}`, 
        },
        credentials: 'include',
    })
    .then(response => response.json())
    .then(data => {
        console.log('Announcements data:', data); 
        const announcementsContainer = document.getElementById('announcements-container');
        announcementsContainer.innerHTML = '';

       data.announcements.forEach(announcement => {
    const formattedDate = new Date(announcement.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });

    // Check if announcement is not locked
    if (announcement.locked === 'No') {
        announcementsContainer.innerHTML += `
        <div class="row d-flex justify-content-center border-bottom py-5">
            <div class="col-md-50 col-lg-50 col-xl-50">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-start align-items-center py-3">
                            <img class="rounded-circle shadow-1-strong me-3" src="${announcement.img_path}" alt="avatar" width="60" height="60" />
                            <div>
                                <h6 class="fw-bold text-primary mb-1">${announcement.postedBy}</h6>
                                <p class="text-muted small mb-0">
                                    ${announcement.branch} - ${formattedDate}
                                </p>
                            </div>
                        </div>
                        <h6 class="fw-bold align-items-center text-center mb-1">${announcement.title}</h6>
                        <img class="img-fluid mx-auto mb-4" src="${announcement.img_path}" style="width: 500; height: 350px;">
                        <p class="mt-3 mb-4 pb-2">
                            ${announcement.content}                                      
                        </p>
                      
                        <div class="small d-flex justify-content-start">
                            <a href="#!" class="d-flex align-items-center me-3">
                                <i class="far fa-thumbs-up me-2"></i>
                                <p class="mb-0">Like</p>
                            </a>
                            <a href="#!" class="d-flex align-items-center me-3">
                                <i class="far fa-comment-dots me-2"></i>
                                <p class="mb-0">Comment</p>
                            </a>
                        </div>
                    </div>
                    <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                        <div class="d-flex flex-start w-100">
                            <img class="rounded-circle shadow-1-strong me-3" src="{{ auth()->user()->img_path}}" alt="avatar" width="40" height="40" />
                            <div data-mdb-input-init class="form-outline w-100">
                                <textarea class="form-control" id="textAreaExample" rows="4" style="background: #fff;"></textarea>
                                <label class="form-label" for="textAreaExample">Message</label>
                            </div>
                        </div>
                        <div class="float-end mt-2 pt-1">
                            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-sm">Post comment</button>
                            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary btn-sm">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
    } else {
        announcementsContainer.innerHTML += `
        <div class="row d-flex justify-content-center border-bottom py-5">
            <div class="col-md-50 col-lg-50 col-xl-50">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-start align-items-center py-3">
                            <img class="rounded-circle shadow-1-strong me-3" src="${announcement.img_path}" alt="avatar" width="60" height="60" />
                            <div>
                                <h6 class="fw-bold text-primary mb-1">${announcement.postedBy}</h6>
                                <p class="text-muted small mb-0">
                                    ${announcement.branch} - ${formattedDate}
                                </p>
                            </div>
                        </div>
                        <h6 class="fw-bold align-items-center text-center mb-1">${announcement.title}</h6>
                        <img class="img-fluid mx-auto mb-4" src="${announcement.img_path}" style="width: 500; height: 350px;">
                        <p class="mt-3 mb-4 pb-2">
                            ${announcement.content}                                      
                        </p>
                    </div>
                </div>
            </div>
        </div>`;
        console.log('Announcement is locked. Comment section not displayed.');
    }
});

    })
    .catch(error => console.error('Error fetching announcements:', error));
}

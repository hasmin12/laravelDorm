document.addEventListener('DOMContentLoaded', function () {
    fetchAnnouncements();

    const createAnnouncementForm = document.getElementById('createAnnouncementForm');
    createAnnouncementForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const titleInput = document.getElementById('announcementTitle');
        const contentInput = document.getElementById('announcementContent');
        const receiverInput = document.getElementById('receiver');
        const imageInput = $('#img_path')[0].files[0];


        const title = titleInput.value;
        const content = contentInput.value;
        const receiver = receiverInput.value;


        const formData = new FormData();
        formData.append('title', title);
        formData.append('content', content);
        formData.append('receiver', receiver);
        formData.append('img_path', imageInput);

        const token = localStorage.getItem('token');

        $.ajax({
            url: '/api/announcement',
            type: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token,
            },
            data: formData,
            processData: false,  
            contentType: false,
            success: function (data) {
            console.log('Announcement created successfully:', data);

            $('#createAnnouncementModal').modal('hide');

            titleInput.value = '';
            contentInput.value = '';

            fetchAnnouncements();

            Swal.fire({
                icon: 'success',
                title: 'Announcement Created',
                text: 'Your announcement has been successfully created.',
            });
        },
        error: function (error) {
            console.error('Error creating lost item:', error);

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while creating the lost item. Please try again.',
            });
        }
    });
});
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


const updateAnnouncementForm = document.getElementById('updateAnnouncementForm');
updateAnnouncementForm.addEventListener('submit', function (event) {
    event.preventDefault();

    const updateTitleInput = document.getElementById('updateTitleInput');
    const updateContentInput = document.getElementById('updateContentInput');
    const announcementId = updateAnnouncementForm.dataset.announcementId; // Add a data attribute to store announcement ID

    const updatedFormData = {
        title: updateTitleInput.value,
        content: updateContentInput.value,
    };

    const token = localStorage.getItem('token');

    fetch(`/api/updateAnnouncement/${announcementId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}`,
        },
        credentials: 'include',
        body: JSON.stringify(updatedFormData),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Announcement updated successfully:', data);

        $('#updateAnnouncementModal').modal('hide');

        updateTitleInput.value = '';
        updateContentInput.value = '';

        fetchAnnouncements();

        Swal.fire({
            icon: 'success',
            title: 'Announcement Updated',
            text: 'Your announcement has been successfully updated.',
        });
    })
    .catch(error => {
        console.error('Error updating announcement:', error);

        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while updating the announcement. Please try again.',
        });
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
            // const userName = announcement.user.name; // Accessing the user's name
            // Do whatever you want with the user's name
            // console.log(userName);
            announcementsContainer.innerHTML += `
            <div class="d-flex align-items-center border-bottom py-3">
            <div class="w-100 ms-3">
                <div class="d-flex w-100 justify-content-between">
                    <div class="d-flex align-items-center">
                        <img src="${announcement.img_path}" alt="Admin Image" class="me-2 rounded" width="40px" height="40px">
                        <h6 class="mb-0">${announcement.postedBy}</h6>
                    </div>
                    <div class="btn-group">
                        <div class="btn-group">
                            <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><button class="dropdown-item update-btn" data-announcement-id="${announcement.id}"><i class="bi bi-pencil"></i> Update</button></li>
                                <li><button class="dropdown-item delete-btn" data-announcement-id="${announcement.id}"><i class="bi bi-trash"></i> Delete</button></li>
                                <li class="m-3">
                                <div class="form-check">
                                    <input class="form-check-input lock-comments-checkbox" type="checkbox" id="lockCommentsToggle${announcement.id}" data-announcement-id="${announcement.id}">
                                    <label class="form-check-label" for="lockCommentsToggle${announcement.id}">Lock Comments</label>
                                </div>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="d-flex w-100 justify-content-between align-items-center">
                    <h6>${announcement.title}</h6>
                </div>
                <p>${announcement.content}</p>
                <small>${formattedDate}</small>
            </div>
        </div>         
        `;
        // <img src="${announcement.img_path}" alt="Announcement Image" width="250px" height="250px"> <!-- Include the image --></img>
        });
    })
    .catch(error => console.error('Error fetching announcements:', error));
}

$(document).ready(function() {
    $('.lock-comments-checkbox').change(function() {
        var announcementId = $(this).data('announcement-id');
        var isChecked = $(this).prop('checked');

        // Send an AJAX request to your server to handle locking/unlocking comments
        // Example:
        // $.ajax({
        //     url: '/lock-comments',
        //     method: 'POST',
        //     data: {
        //         announcementId: announcementId,
        //         isChecked: isChecked
        //     },
        //     success: function(response) {
        //         console.log('Comments locked/unlocked successfully');
        //     },
        //     error: function(xhr, status, error) {
        //         console.error('Error:', error);
        //     }
        // });
    });
});
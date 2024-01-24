document.addEventListener('DOMContentLoaded', function () {
    fetchAnnouncements();

    const createAnnouncementForm = document.getElementById('createAnnouncementForm');
    createAnnouncementForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const titleInput = document.getElementById('announcementTitle');
        const contentInput = document.getElementById('announcementContent');

        const title = titleInput.value;
        const content = contentInput.value;

        const formData = {
            title: title,
            content: content,
        };

        const token = localStorage.getItem('token');

        fetch('/api/announcement', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`,
            },
            credentials: 'include',
            body: JSON.stringify(formData),
        })
        .then(response => response.json())
        .then(data => {
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
        })
        .catch(error => {
            console.error('Error creating announcement:', error);

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while creating the announcement. Please try again.',
            });
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
            announcementsContainer.innerHTML += `
                <div class="d-flex align-items-center border-bottom py-3">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-0">${announcement.user.name}</h6>
                            <small>${formattedDate}</small>
                        </div>
                        <div class="d-flex w-100 justify-content-between">

                            <h6>${announcement.title}</h6>
                            
                        </div>
                       
                        <p>${announcement.content}</p>
                        
                    </div>
                </div>
            `;
        });
    })
    .catch(error => console.error('Error fetching announcements:', error));
}

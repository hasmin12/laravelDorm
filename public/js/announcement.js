document.addEventListener('DOMContentLoaded', function () {
    fetchAnnouncements();
});

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
        }) // Replace with your actual route
        .then(response => response.json())
        .then(data => {
            // Update the HTML content with the fetched announcements
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
                            <h6>${announcement.title}</h6>
                            <p>${announcement.content}</p>
                        </div>
                    </div>
                `;
            });
        })
        .catch(error => console.error('Error fetching announcements:', error));
}

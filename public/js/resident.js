document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('#searchInput');
    const residentTypeButtons = document.querySelectorAll('input[name="btnradio"]');
    const residentTableBody = document.querySelector('#residentTableBody');
    const sendEmailButton = document.querySelector('#sendEmailButton');
    const token = localStorage.getItem('token');

    function updateResidents() {
        const residentType = document.querySelector('input[name="btnradio"]:checked').value;
        const searchQuery = searchInput.value;

        // Retrieve the token from localStorage
        console.log("Resident Type:", residentType);
        console.log("Search Query:", searchQuery);

        fetch(`/api/getResidents?resident_type=${residentType}&search_query=${searchQuery}`, {
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
            // Clear the existing table rows
            console.log("Fetched Data:", data);
            residentTableBody.innerHTML = '';

            // Add new rows based on the fetched data
            data.beds.forEach(bed => {
                const row = `
                    
                        <td>${bed.resident.Tuptnum}</td>
                        <td>${bed.resident.name}</td>
                        <td>${bed.resident.type}</td>
                        <td>${bed.resident.sex}</td>
                        <td>${bed.resident.contacts}</td>
                        <td>${bed.room.name}: ${bed.name}</td>
                        <td>
                            <button class="btn btn-sm btn-success" onclick="checkRoom(${bed.resident.id})">Check</button>
                            <button class="btn btn-sm btn-warning" onclick="updateRoom(${bed.resident.id})">Update</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteRoom(${bed.resident.id})">Delete</button>
                        </td>
           
                `;
                residentTableBody.innerHTML += row;
            });
        });
    }

    // Event listeners
    searchInput.addEventListener('input', updateResidents);
    residentTypeButtons.forEach(button => button.addEventListener('change', updateResidents));

    // Add an event listener to the tbody to handle row clicks
    residentTableBody.addEventListener('click', function (event) {
        const clickedRow = event.target.closest('tr');
        if (clickedRow) {
            // Extract user ID from the row ID
            const userId = clickedRow.id.split('-')[1];
            
            // Navigate to the user profile page using the user ID
            window.location.href = `/user/profile/${userId}`;
        }
    });

    function sendEmails() {
        // Make an AJAX request to the notify-residents route
        fetch('/api/notifyResidents', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`,
            },
            credentials: 'include',
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error: ${response.status} - ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            // Check for success property in the response
            if (data.success) {
                alert('Emails sent successfully!');
            } else {
                throw new Error('Error sending emails.');
            }
        })
        .catch(error => {
            console.error('Error sending emails:', error.message);
            alert('Error sending emails. Please try again later.');
        });
    }
    sendEmailButton.addEventListener('click', sendEmails);

    // Initial residents update
    updateResidents();
});

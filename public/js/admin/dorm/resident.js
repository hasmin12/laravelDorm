document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('#searchInput');
    const residentTypeButtons = document.querySelectorAll('input[name="btnradio"]');
    const residentTableBody = document.querySelector('#residentTableBody');
    const sendEmailButton = document.querySelector('#sendEmailButton');
    const token = localStorage.getItem('token');

    function fetchResidents() {
        const residentType = document.querySelector('input[name="btnradio"]:checked').value;
        const searchQuery = searchInput.value;

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
            
            residentTableBody.innerHTML = '';

            // Add new rows based on the fetched data
            data.residents.forEach(resident => {
                
                const row = `
                    
                        <td>${resident.Tuptnum}</td>
                        <td>${resident.name}</td>
                        <td>${resident.type}</td>
                        <td>${resident.sex}</td>
                        <td>${resident.contacts}</td>
                        <td>${resident.roomdetails}</td>
                        <td>
                            <button class="btn btn-sm btn-success" onclick="checkRoom(${resident.id})">Check</button>
                            <button class="btn btn-sm btn-warning" onclick="updateRoom(${resident.id})">Update</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteRoom(${resident.id})">Delete</button>
                        </td>
           
                `;
                residentTableBody.innerHTML += row;
            });
        });
    }

    // Event listeners
    searchInput.addEventListener('input', fetchResidents);
    residentTypeButtons.forEach(button => button.addEventListener('change', fetchResidents));

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
    fetchResidents();

    function fetchRooms(sex, type) {
        // Replace the URL with your actual API endpoint for fetching rooms
        const apiUrl = `/api/getRooms?sex=${sex}&room_type=${type}`;

        // Assuming you're using Fetch API
        fetch(apiUrl, {
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
                // Populate room dropdown
                const roomDropdown = document.getElementById('roomDropdown');
                roomDropdown.innerHTML = '<option value="" disabled selected></option>';
                data.rooms.forEach(room => {
                    const option = document.createElement('option');
                    option.value = room.id;
                    option.textContent = room.name;
                    roomDropdown.appendChild(option);
                });

                // Clear and disable bed dropdown
                const bedDropdown = document.getElementById('bedDropdown');
                bedDropdown.innerHTML = '<option value="" disabled selected></option>';
                bedDropdown.disabled = true;
            })
            .catch(error => console.error('Error fetching rooms:', error));
    }

    // Fetch beds based on the selected room
    function fetchBeds(roomId) {
        // Replace the URL with your actual API endpoint for fetching beds
        const apiUrl = `/api/getBeds?room_id=${roomId}`;

        // Assuming you're using Fetch API
        fetch(apiUrl, {
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
                // Populate bed dropdown
                const bedDropdown = document.getElementById('bedDropdown');
                bedDropdown.innerHTML = '<option value="" disabled selected></option>';
                data.beds.forEach(bed => {
                if (bed.resident_name === null) {
                        const option = document.createElement('option');
                        option.value = bed.id;
                        option.textContent = "Bed " + bed.name;
                        bedDropdown.appendChild(option);
                    }
                });

                // Enable bed dropdown
                bedDropdown.disabled = false;
            })
            .catch(error => console.error('Error fetching beds:', error));
    }

    // Event listener for changes in sex dropdown
    document.getElementById('residentSex').addEventListener('change', function () {
        const sex = this.value;
        const type = document.getElementById('residentType').value;

        fetchRooms(sex, type);
    });

    // Event listener for changes in type dropdown
    document.getElementById('residentType').addEventListener('change', function () {
        const sex = document.getElementById('residentSex').value;
        const type = this.value;
        fetchRooms(sex, type);
    });

    // Event listener for changes in room dropdown
    document.getElementById('roomDropdown').addEventListener('change', function () {
        const roomId = this.value;

        // Fetch beds based on the selected room
        fetchBeds(roomId);
    });
});

document.getElementById('addResidentButton').addEventListener('click', function() {
    window.location.href = '/admin/newresident';
});



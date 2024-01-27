document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('#searchInput');
    const registereduserTypeButtons = document.querySelectorAll('input[name="btnradio"]');
    const registereduserTableBody = document.querySelector('#registereduserTableBody');
    const sendEmailButton = document.querySelector('#sendEmailButton');
    const token = localStorage.getItem('token');
    let selectedRegisteredUserId;
    function fetchRegisteredusers() {
        const registereduserType = document.querySelector('input[name="btnradio"]:checked').value;
        const searchQuery = searchInput.value;
        fetch(`/api/getRegisteredusers?registereduser_type=${registereduserType}&search_query=${searchQuery}`, {
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
            
            registereduserTableBody.innerHTML = '';

            // Add new rows based on the fetched data
            data.registeredusers.forEach(registereduser => {
                
                const row = `
                    
                        <td>${registereduser.Tuptnum}</td>
                        <td>${registereduser.name}</td>
                        <td>${registereduser.type}</td>
                        <td>${registereduser.sex}</td>
                        <td><a href="#" class="pdf-link" data-pdf="${registereduser.contract}">View Contract</a></td>
                        <td><a href="#" class="pdf-link" data-pdf="${registereduser.cor}">View COR</a></td>
                        <td><a href="#" class="image-link" data-image="${registereduser.validId}">View ID</a></td>
                        <td>
                            <button class="btn btn-sm btn-success" data-id="${registereduser.id}">Add</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </td>
           
                `;
                registereduserTableBody.innerHTML += row;
            });
        });
    }

    // Event listeners
    searchInput.addEventListener('input', fetchRegisteredusers);
    registereduserTypeButtons.forEach(button => button.addEventListener('change', fetchRegisteredusers));

    // Add an event listener to the tbody to handle row clicks
 

    function sendEmails() {
        // Make an AJAX request to the notify-registeredusers route
        fetch('/api/notifyRegisteredusers', {
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
    // sendEmailButton.addEventListener('click', sendEmails);

    // Initial registeredusers update
    fetchRegisteredusers();

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
        const apiUrl = `/api/getBeds/${roomId}`;

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
                console.log(data);
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

    document.getElementById('roomDropdown').addEventListener('change', function () {
        const roomId = this.value;
        fetchBeds(roomId);
    });

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('pdf-link')) {
            event.preventDefault();
            const pdfUrl = event.target.getAttribute('data-pdf');
            openPdfModal(pdfUrl);
        }
    });

    // Function to open PDF in the modal
    function openPdfModal(pdfUrl) {
        const pdfViewer = document.getElementById('pdfViewer');
        const pdfModal = new bootstrap.Modal(document.getElementById('pdfModal'));
        pdfViewer.src = pdfUrl;
        pdfModal.show();
    }

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('image-link')) {
            event.preventDefault();
            const imageUrl = event.target.getAttribute('data-image');
            openImageModal(imageUrl);
        }
    });

 
    function openImageModal(imageUrl) {
        const imageViewer = document.getElementById('imageViewer');
        const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        imageViewer.src = imageUrl;
        imageModal.show();
    }

    const createRegisteredUserModal = new bootstrap.Modal(document.getElementById('createRegisteredUserModal'));
    registereduserTableBody.addEventListener('click', function (event) {
        const clickedRow = event.target.closest('tr');
        const addBtn = event.target.closest('.btn-success'); // Updated selector
        if (clickedRow && addBtn) {
            event.preventDefault();
    
            const sex = clickedRow.querySelector('td:nth-child(4)').textContent; 
            const type = clickedRow.querySelector('td:nth-child(3)').textContent; 
            const registeredUserId = addBtn.getAttribute('data-id');
    
            selectedRegisteredUserId = registeredUserId;
            openCreateRegisteredUserModal(sex, type);
        }
    });
    

    function openCreateRegisteredUserModal(sex, type) {
   
        createRegisteredUserModal.show();
        fetchRooms(sex, type);
    }


    const createRegisteredUserForm = document.getElementById('createRegisteredUserForm');
    createRegisteredUserForm.addEventListener('submit', function (event) {
        
        event.preventDefault();

        const selectedRoom = document.getElementById('roomDropdown').value;
        const selectedBed = document.getElementById('bedDropdown').value;


console.log(selectedRegisteredUserId)
        const formData = {
            room_id: selectedRoom,
            bed_id: selectedBed,
            registereduser_id: selectedRegisteredUserId,
        };

        const token = localStorage.getItem('token');

        fetch('/api/addRegistereduser', {
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
            console.log('User Added successfully:', data);

            createRegisteredUserModal.hide();
            createRegisteredUserForm.reset();
           

            fetchRegisteredusers();

            Swal.fire({
                icon: 'success',
                title: 'User Added',
                text: 'Your Room has been successfully created.',
            });
        })
        .catch(error => {
            console.error('Error creating user:', error);

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while creating the user. Please try again.',
            });
        });
    });

    
});



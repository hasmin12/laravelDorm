const token = localStorage.getItem('token');
let currentView = 'tiles';

document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('#searchInput');
    const residentTypeButtons = document.querySelectorAll('input[name="btnradio"]');
    const residentTableBody = document.querySelector('#residentTableBody');
    const residentTilesContainer = document.querySelector('#residentTilesContainer');
    const roomDropdown = document.getElementById('roomDropdown');
    const bedsCard = document.getElementById('bedsCard');
    let selectedResident;

    // Set the initial view to 'tiles'
    function fetchRooms() {
        fetch(`/api/getRooms`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`,
            },
            credentials: 'include',
        }) // Replace '/getRooms' with the actual route to fetch rooms
            .then(response => response.json())
            .then(data => {
                
                const option = document.createElement('option');
                    option.value = "";
                    option.textContent = "";
                    roomDropdown.appendChild(option);
                data.rooms.forEach(room => {
                    const option = document.createElement('option');
                    option.value = room.id;
                    option.textContent = room.name;
                    roomDropdown.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching rooms:', error));
    }

    function displayBedDetails(roomId) {
        fetch(`/api/getBeds/${roomId}`, {
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
            // Clear previous content
            bedsCard.innerHTML = '';
    
            let row; // Variable to hold the current row
    
            data.beds.forEach((bed, index) => {
                if (index % 2 === 0) {
                    row = document.createElement('div');
                    row.classList.add('row');
                    bedsCard.appendChild(row);
                }
                
                const cardDiv = document.createElement('div');
                cardDiv.classList.add('col-md-6', 'mb-3'); // Each card takes 6 columns in Bootstrap grid system
        
                const card = document.createElement('div');
                card.classList.add('card', 'custom-border-red');
                card.style.width = '100%';
        
                const bedImage = document.createElement('img');
                bedImage.classList.add('card-img-top');
                bedImage.style.width = '100%';
                bedImage.style.height = '300px';
        
                const cardBody = document.createElement('div');
                cardBody.classList.add('card-body', 'text-center');
        
                const bedName = document.createElement('h5');
                bedName.classList.add('card-title');
                bedName.textContent = `Bed ${bed.name}`;
    
                const bedType = document.createElement('h5');
                bedType.classList.add('card-title');
                bedType.textContent = `Bed ${bed.type}`;
    
                const bedStatus = document.createElement('h6');
                bedStatus.classList.add('card-title');
                bedStatus.textContent = `${bed.status}`;
    
                if (bed.status !== 'Occupied') {
                    const assignForm = document.createElement('form');
                    assignForm.addEventListener('submit', function(event) {
                        event.preventDefault();
                        assignBed(bed.id); 
                    });
                    const assignButton = document.createElement('button');
                    assignButton.setAttribute('type', 'submit');
                    assignButton.classList.add('btn', 'btn-sm', 'btn-primary');
                    assignButton.textContent = 'Assign';
                    assignForm.appendChild(assignButton);
                    cardBody.appendChild(assignForm);
                }
        
                cardBody.appendChild(bedName);
                cardBody.appendChild(bedType);
                cardBody.appendChild(bedStatus);
                
                card.appendChild(bedImage); 
                card.appendChild(cardBody);
                cardDiv.appendChild(card);
                row.appendChild(cardDiv);
            });
        })
        .catch(error => console.error('Error fetching beds:', error));
    }
    
    
    
    roomDropdown.addEventListener('change', function () {
        const selectedRoomId = parseInt(this.value); 
        displayBedDetails(selectedRoomId); 
    });

    // Fetch rooms when the page loads
    fetchRooms();
    
    

    function sendEmail() {
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

    
    // Event listeners
    searchInput.addEventListener('input', () => fetchResidents(currentView));
    residentTypeButtons.forEach(button => button.addEventListener('change', () => fetchResidents(currentView)));

    // Fetch residents with the initial view type
    fetchResidents(currentView);

    
const updateResidentForm = document.getElementById('updateResidentForm');
updateResidentForm.addEventListener('submit', function (event) {
    event.preventDefault();

    const updateName = document.getElementById('updateName');
    const updateType = document.getElementById('updateType');
    const updateSex = document.getElementById('updateSex');
    const residentId = updateResidentForm.dataset.residentId; // Add a data attribute to store resident ID

    const formData = new FormData();
    formData.append('name', updateName.value);
    formData.append('type', updateType.value);
    formData.append('sex', updateSex.value);

    const token = localStorage.getItem('token');

        $.ajax({
            url: `/api/updateResident/${residentId}`,
            type: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token,
            },
            data: formData,
            processData: false,  
            contentType: false,
            success: function (data) {
            console.log('Resident updated successfully:', data);

            $('#updateResidentModal').modal('hide');

            updateName.value = '';
            updateType.value = '';
            updateSex.value = '';

            fetchResidents();

            Swal.fire({
                icon: 'success',
                title: 'Resident Updated',
                text: 'Your resident has been successfully updated.',
            });
        },
        error: function (error) {
            console.error('Error updating resident:', error);

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while updating the resident. Please try again.',
            });
        }
    });

});
});
const styleElement = document.createElement('style');

// Define the CSS rules with maroon color
const cssRules = `
.custom-table thead th {
    background-color: maroon;
    color: white;
}
`;

// Set the CSS rules as the content of the <style> element
styleElement.textContent = cssRules;

// Append the <style> element to the document's <head>
document.head.appendChild(styleElement);
function fetchResidents(viewType = 'tiles') {
    const residentType = document.querySelector('input[name="btnradio"]:checked').value;
    const searchQuery = searchInput.value;

    fetch(`/api/getApplicants`, {
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
        
        residentTableBody.innerHTML = '';
        residentTilesContainer.innerHTML = '';

        
        // Create a single row to contain all the cards
        const cardRow = document.createElement('div');
        cardRow.classList.add('row');

        data.applicants.forEach(resident => {
            // Card HTML structure
            const card = `
                <div class="col-md-4 mb-3">
                    <div class="card custom-border-red" style="width: 18rem;">
                        <img class="card-img-top" style="width: 285px; height: 285px;" src="${resident.img_path}" alt="Card image cap">
                        <div class="card-body text-center">
                            <h5 class="card-title">${resident.name}</h5>
                            <button class="btn btn-sm btn-success" onclick="showResidentDetails(${resident.id})" data-bs-toggle="modal" data-bs-target="#residentDetailsModal">
                                View Details
                            </button>
                            <button class="btn btn-sm btn-warning" onclick="updateResident(${resident.id})">Update</button>
                            <button class="btn btn-sm btn-info" onclick="assignResident(${resident.id})">Assign</button>
                        </div>
                    </div>
                </div>
            `;

            // Append each card to the row
            cardRow.innerHTML += card;

            // Table row HTML structure
            const tableRow = `
                <tr class="text-dark">
                    <td>${resident.Tuptnum}</td>
                    <td>${resident.name}</td>
                    <td>${resident.type}</td>
                    <td>${resident.sex}</td>
                    <td>${resident.contactNumber}</td>
                    <td>
                        <button class="btn btn-sm btn-success" onclick="showResidentDetails(${resident.id})" data-bs-toggle="modal" data-bs-target="#residentDetailsModal">
                            View Details
                        </button>
                        <button class="btn btn-sm btn-warning" onclick="updateResident(${resident.id})">Update</button>
                        <button class="btn btn-sm btn-info" onclick="assignResident(${resident})">Assign</button>
                    </td>
                </tr>
            `;

            // Append each table row
            residentTableBody.insertAdjacentHTML('beforeend', tableRow);
        });

        // Insert the row containing all cards into the container
        residentTilesContainer.appendChild(cardRow);
    })
    .catch(error => console.error('Error fetching residents:', error))
    .finally(() => {
        // Hide spinner or loading indicator
        document.getElementById('spinner').classList.remove('show');
    });
}

function assignBed(bedId) {
    console.log(selectedResident)
    const residentId = updateResidentForm.dataset.residentId; // Add a data attribute to store resident ID

    // const formData = new FormData();
    // formData.append('bedId', bedId);
    // formData.append('residentId', selectedResident);
    const formData = {
        bedId: bedId,
        residentId: selectedResident,

    };
    const token = localStorage.getItem('token');
    fetch(`/api/assignResident`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': 'Bearer ${token}',
        },
        credentials: 'include',
        body: JSON.stringify({
            formData
        })
    })
    .then(response => response.json())
    .then(data => {
        $('#residentAssignModal').modal('hide');
        roomDropdown.selectedIndex = 0; 
        bedsCard.innerHTML = '';
        selectedResident = null;

        fetchResidents(currentView);
        fetchRooms();

        Swal.fire({
            icon: 'success',
            title: 'Resident Assigned',
            text: 'Your resident has been successfully updated.',
        });
    })
}
// Function to show resident details in modal
function showResidentDetails(residentId) {
    const modalBody = document.getElementById('residentDetailsModalBody');
    const token = localStorage.getItem('token');

    // Fetch resident details by id
    fetch(`/api/getResident/${residentId}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}`, // Assuming you have a token variable
        },
        credentials: 'include',
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const resident = data.resident; // Assuming the key in the response is 'resident'
        console.log(resident)

        // Construct the HTML for resident details
        const residentDetailsHTML = `
        
        <div class="container-fluid">
            <div class="card border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="${resident.img_path}" class="img-fluid mb-3 rounded" alt="Resident Image" style="max-width: 100%; height: auto;">
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <strong class="fw-bold fs-5">TUPT Number:</strong>
                                <span class="fs-5">${resident.Tuptnum}</span>
                            </div>
                            <div class="mb-3">
                                <strong class="fw-bold fs-5">Type:</strong>
                                <span class="fs-5">${resident.type}</span>
                            </div>
                            <div class="mb-3">
                                <strong class="fw-bold fs-5">Sex:</strong>
                                <span class="fs-5">${resident.sex}</span>
                            </div>
                            <div class="mb-3">
                                <strong class="fw-bold fs-5">Contacts:</strong>
                                <span class="fs-5">${resident.contacts}</span>
                            </div>
                            <div class="mb-3">
                                <strong class="fw-bold fs-5">Room & Bed:</strong>
                                <span class="fs-5">${resident.roomdetails}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
        <div class="btn-group" role="group">
            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked value="All">
            <label class="btn btn-outline-primary" for="btnradio1">Bills</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" value="Faculty">
            <label class="btn btn-outline-primary" for="btnradio3">Leave</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off" value="Staff">
            <label class="btn btn-outline-primary" for="btnradio4">Sleep</label>
        </div>
    </div>
        `;

        // Set the HTML content of the modal body
        modalBody.innerHTML = residentDetailsHTML;

        // Show the modal
        $('#residentDetailsModal').modal('show');
    })
    .catch(error => console.error('Error fetching resident details:', error));
}





function updateResident(residentId) {
    const updateResidentForm = document.getElementById('updateResidentForm');
    updateResidentForm.dataset.residentId = residentId; 

    const updateName = document.getElementById('updateName');
    const updateType = document.getElementById('updateType');
    const updateSex = document.getElementById('updateSex');

    const token = localStorage.getItem('token');

    fetch(`/api/getResident/${residentId}`, {
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
        console.log(data)
        updateName.value = data.resident.name;
        updateType.value = data.resident.type;
        updateSex.value = data.resident.sex;
        $('#updateResidentModal').modal('show');
        // console.log(updateResidentForm.dataset.residentId)

    })
    .catch(error => {
        console.error('Error fetching resident details:', error);

        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while fetching resident details. Please try again.',
        });
    });
}

function assignResident(resident) {
    selectedResident = resident
    console.log(selectedResident)
    $('#residentAssignModal').modal('show');
    
}
// document.getElementById('addResidentButton').addEventListener('click', function() {
//     window.location.href = '/admin/dorm/newresident';
// });





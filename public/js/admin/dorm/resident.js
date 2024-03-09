document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('#searchInput');
    const residentTypeButtons = document.querySelectorAll('input[name="btnradio"]');
    const residentTableBody = document.querySelector('#residentTableBody');
    const sendEmailButton = document.querySelector('#sendEmailButton');
    const residentTilesContainer = document.querySelector('#residentTilesContainer');
    const token = localStorage.getItem('token');

    // Set the initial view to 'tiles'
    let currentView = 'tiles';

    function fetchResidents(viewType = 'tiles') {
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
            // Clear the existing table rows and tiles
            residentTableBody.innerHTML = '';
            residentTilesContainer.innerHTML = '';

            // Create a single row to contain all the cards
            const cardRow = document.createElement('div');
            cardRow.classList.add('row');

            data.residents.forEach(resident => {
                // Card HTML structure
                const card = `
                        <div class="col-md-4 mb-3">
                        <div class="card custom-border-red" style="width: 18rem;">
                            <img class="card-img-top" src="..." alt="Card image cap">
                            <div class="card-body text-center">
                                <h5 class="card-title">${resident.name}</h5>
                                <button class="btn btn-sm btn-success" onclick="showResidentDetails(${resident.id})" data-bs-toggle="modal" data-bs-target="#residentDetailsModal">
                                    View Details
                                </button>
                                <button class="btn btn-sm btn-warning" onclick="updateResident(${resident.id})">Update</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteRoom(${resident.id})">Delete</button>
                            </div>
                        </div>
                    </div>
            
                `;

                // Append each card to the row
                cardRow.innerHTML += card;

                // Table row HTML structure
                const tableRow = `
                    <tr>
                        <td>${resident.Tuptnum}</td>
                        <td>${resident.name}</td>
                        <td>${resident.type}</td>
                        <td>${resident.sex}</td>
                        <td>${resident.contacts}</td>
                        <td>${resident.roomdetails}</td>
                        <td>
                        <button class="btn btn-sm btn-success" onclick="showResidentDetails(${resident.id})" data-bs-toggle="modal" data-bs-target="#residentDetailsModal">
                             View Details
                         </button>                      
                            <button class="btn btn-sm btn-warning" onclick="updateResident(${resident.id})">Update</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteRoom(${resident.id})">Delete</button>
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

    function sendEmail() {
        // Implement your logic to send emails here
        // This is a placeholder function, customize it based on your requirements
        alert('Emails will be sent to selected residents.');
    }

    // Event listeners
    searchInput.addEventListener('input', () => fetchResidents(currentView));
    residentTypeButtons.forEach(button => button.addEventListener('change', () => fetchResidents(currentView)));
    sendEmailButton.addEventListener('click', sendEmail);

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
        <div class="container-fluid ">
            <div class="card border-0"> <!-- Removed card class and added border-0 -->
                <div class="card-body">
                    <div class="row">
                        <!-- Left Column for Picture -->
                        <div class="col-md-6">
                            <img src="residentImageUrl.jpg" class="img-fluid mb-3 rounded" alt="Resident Image" style="max-width: 150%; height: 150%;">
                        </div>
                        <!-- Right Column for Resident Details -->
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
                            <!-- Add more resident details as needed -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    
        <!-- Separate Row for Card Section -->
            <!-- Card Section -->
            <div class="col-sm-12 col-xl-6">
                <div class="card border-0">
                    <div class="card-body center">
                        <table class="table table-dark w-100 custom-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>John</td>
                                    <td>Doe</td>
                                    <td>john@email.com</td>
                                    <td>john@email.com</td>
                                    <td>john@email.com</td>
                                    <td>john@email.com</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>mark@email.com</td>
                                    <td>john@email.com</td>
                                    <td>john@email.com</td>
                                    <td>john@email.com</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>jacob@email.com</td>
                                    <td>john@email.com</td>
                                    <td>john@email.com</td>
                                    <td>john@email.com</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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



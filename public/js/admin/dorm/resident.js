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
                            <img class="card-img-top" style="width: 285px; height: 285px;" src="${resident.img_path}" alt="Card image cap">
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
                    <tr class="text-dark">
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
                fetchNotifications();
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



function showResidentDetails(residentId) {
    const modalBody = document.getElementById('residentDetailsModalBody');
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
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const resident = data.resident;

        // Construct the HTML for resident details
        const residentDetailsHTML = `
            <div class="container-fluid pt-4 px-4">
            <div class="h-100 bg-light rounded p-10">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-4 col-xl-6">
                        <img src="${resident.img_path}" class="img-fluid mb-2 rounded " alt="Resident Image" style="max-width: 350px; height: 250px;">
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-5">
                        
                            <div class="resident-details">
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
            <br>
            <br>
         
        `;

        // Set the HTML content of the modal body for resident details
        modalBody.innerHTML = residentDetailsHTML;

        // Construct the HTML for radio buttons
        const radioButtonsHTML = `
            <div class="row justify-content-center">
                <div class="btn-group" role="group">
                    <input type="radio" class="btn-check" name="modalBtnradio" id="modalBtnradio1" autocomplete="off" checked value="Bill">
                    <label class="btn btn-outline-primary" for="modalBtnradio1">Bills</label>
                    
                    <input type="radio" class="btn-check" name="modalBtnradio" id="modalBtnradio2" autocomplete="off" value="Leave">
                    <label class="btn btn-outline-primary" for="modalBtnradio2">Leave</label>
                    
                    <input type="radio" class="btn-check" name="modalBtnradio" id="modalBtnradio3" autocomplete="off" value="Sleep">
                    <label class="btn btn-outline-primary" for="modalBtnradio3">Sleep</label>
                </div>
            </div>
        `;
        // Append the HTML content of radio buttons to the modal body
        modalBody.innerHTML += radioButtonsHTML;

// Function to clear content added by specific radio button
const clearRadioButtonContent = () => {
    const contentToRemove = modalBody.querySelector('.radio-button-content');
    if (contentToRemove) {
        contentToRemove.remove();
    }
};

// Add event listener to the parent container and delegate to radio buttons
modalBody.addEventListener('change', event => {
    const target = event.target;
    console.log('Change event triggered'); // Debugging: Check if change event is triggered
    if (target.matches('input[name="modalBtnradio"]')) {
        console.log('Radio button change event triggered');
        const value = target.value;
        console.log('Selected radio button value:', value);
        clearRadioButtonContent(); // Clear content added by previously selected radio button
        if (value === 'Bill') {
            showBills();
        } else if (value === 'Leave') {
            showLeaveLogs();
        } else if (value === 'Sleep') {
            showSleepLogs();
        }
    }
});

// Function to show bills
const showBills = () => {
    console.log('Displaying bills table');
    console.log('Resident payments:', resident.payments);
    console.log('Modal body:', modalBody); // Debugging: Check if modalBody is correctly referenced
    if (resident.payments && resident.payments.length > 0) {
        const html = `
            <div class="bills-table radio-button-content"> <!-- Added unique class for identification -->
                <table class="table table-dark w-100 custom-table">
                    <thead>
                        <tr>
                            <th scope="col">Receipt</th>
                            <th scope="col">Total Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Paid Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${resident.payments.map(payment => `
                            <tr>
                                <td>${payment.receipt}</td>
                                <td>${payment.totalAmount}</td>
                                <td>${payment.status}</td>
                                <td>${payment.paidDate ? new Date(payment.paidDate).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' }) : '-'}</td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            </div>
        `;
        modalBody.insertAdjacentHTML('beforeend', html);
    } else {
        console.log('No payments found for the resident.'); // Debugging: Check if payments are available
    }
};

// Function to show leave logs
const showLeaveLogs = () => {
    const token = localStorage.getItem('token');
    fetch(`/api/getLogs/${residentId}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}`,
        },
        credentials: 'include',
    })
    .then(response => response.json())
    .then(logs => {
        console.log('Leave logs:', logs); 
        let html = `
            <div class="leave-logs radio-button-content">
                <table class="table table-dark w-100 custom-table">
                    <thead>
                        <tr>
                            <th>Leave Date</th>
                            <th>Expected Return</th>
                            <th>Return Date</th>
                            <th>Purpose</th>
                            <th>Gatepass</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
        `;
        logs.forEach(log => {
            html += `
                <tr>
                    <td>${log.leave_date}</td>
                    <td>${log.expectedReturn}</td>
                    <td>${log.return_date}</td>
                    <td>${log.purpose}</td>
                    <td>${log.gatepass}</td>
                    <td>${log.status}</td>
                </tr>
            `;
        });
        html += `
                    </tbody>
                </table>
            </div>
        `;
        modalBody.insertAdjacentHTML('beforeend', html);
    })
    .catch(error => console.error('Error fetching leave logs:', error));
};

// Function to show sleep logs
const showSleepLogs = () => {
    const token = localStorage.getItem('token');
    fetch(`/api/getSleepLogs/${residentId}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}`,
        },
        credentials: 'include',
    })
    .then(response => response.json())
    .then(sleeplogs => {
        console.log('Sleep logs:', sleeplogs); 
        let html = `
            <div class="sleep-logs radio-button-content">
                <table class="table table-dark w-100 custom-table">
                    <thead>
                        <tr>
                            <th>Leave Date</th>
                            <th>Expected Return</th>
                            <th>Return Date</th>
                            <th>Purpose</th>
                            <th>Gatepass</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
        `;
        sleeplogs.forEach(log => {
           
            html += `
                <tr>
                    <td>${log.leave_date}</td>
                    <td>${log.expectedReturn}</td>
                    <td>${log.return_date}</td>
                    <td>${log.purpose}</td>
                    <td>${log.gatepass}</td>
                    <td>${log.status}</td>
                </tr>
            `;
        });
        html += `
                    </tbody>
                </table>
            </div>
        `;
        modalBody.insertAdjacentHTML('beforeend', html);
    })
    .catch(error => console.error('Error fetching sleep logs:', error));
};


        $('#residentDetailsModal').modal('show');
    })
    .catch(error => console.error('Error fetching resident details:', error));
}






// Event listener for radio buttons outside the modal
const radioButtonsOutsideModal = document.querySelectorAll('.content input[name="btnradio"]');
radioButtonsOutsideModal.forEach(button => {
    button.addEventListener('change', event => {
        const value = event.target.value;
        // Handle radio button change outside the modal
    });
});











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

// document.getElementById('addResidentButton').addEventListener('click', function() {
//     window.location.href = '/admin/dorm/newresident';
// });





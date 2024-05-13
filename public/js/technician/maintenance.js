document.addEventListener('DOMContentLoaded', function () {
    fetchTechnicians();
    fetchmaintenances();
});

let maintenance_id;

function fetchmaintenances() {
    const token = localStorage.getItem('token');
    fetch('/api/technician/getMaintenance', {
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
        const maintenancesContainer = document.getElementById('maintenance-items-container');
        maintenancesContainer.innerHTML = '';
        data.forEach(maintenance => {
            const cardContainer = document.createElement('div');
            cardContainer.classList.add('col-sm-12', 'col-md-4');
            let statusColorClass;
            switch (maintenance.status) {
                case 'Pending':
                    statusColorClass = 'text-warning';
                    break;
                case 'In Progress':
                    statusColorClass = 'text-info';
                    break;
                case 'Completed':
                    statusColorClass = 'text-success';
                    break;
                case 'Cancelled':
                    statusColorClass = 'text-danger';
                    break;
                default:
                    statusColorClass = 'text-dark'; // Default color
            }

            if (maintenance.status == "PENDING") {
                const cardContent = `
                    <div class="card h-100" style="cursor: pointer;" onclick="showItemDetails('${maintenance.id}','${maintenance.status}','${maintenance.type}','${maintenance.description}','${maintenance.technicianName}','${maintenance.completionPercentage}','${maintenance.branch}','${maintenance.room_number}','${maintenance.request_date}')">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h5 class="card-title">${maintenance.type}</h5>
                                <small class="text-warning">${maintenance.status}<br><small class="text-dark">${maintenance.request_date}</small></small>
                            </div>
                            <img src="${maintenance.img_path}" alt="Maintenance Item Image" class="card-img-top" style="max-height: 150px;">
                        </div>
                    </div>
                `;
                cardContainer.innerHTML = cardContent;

            } else if (maintenance.status == "In Progress") {
                const cardContent = `
                    <div class="card h-100" style="cursor: pointer;" onclick="showItemDetails('${maintenance.id}','${maintenance.status}','${maintenance.type}','${maintenance.description}','${maintenance.technicianName}','${maintenance.completionPercentage}','${maintenance.branch}','${maintenance.room_number}','${maintenance.request_date}')">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h5 class="card-title">${maintenance.type}</h5>
                                <small class="text-warning">${maintenance.status}<br><small class="text-dark">${maintenance.request_date}</small></small>
                            </div>
                            <img src="${maintenance.img_path}" alt="Maintenance Item Image" class="card-img-top" style="max-height: 150px;">
                        </div>
                    </div>
                `;
                cardContainer.innerHTML = cardContent;

            } else {
                const cardContent = `
                    <div class="card h-100" style="cursor: pointer;" onclick="showItemDetails('${maintenance.id}','${maintenance.status}','${maintenance.type}','${maintenance.description}','${maintenance.technicianName}','${maintenance.completionPercentage}','${maintenance.branch}','${maintenance.room_number}','${maintenance.request_date}')">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h5 class="card-title">${maintenance.type}</h5>
                                <small class="text-success">${maintenance.status}<br><small class="text-dark">${maintenance.request_date}</small></small>
                            </div>
                            <img src="${maintenance.img_path}" alt="Maintenance Item Image" class="card-img-top" style="max-height: 150px;">
                        </div>
                    </div>
                `;
                cardContainer.innerHTML = cardContent;

            }
            maintenancesContainer.appendChild(cardContainer);
        });
    })
    .catch(error => console.error('Error fetching maintenance items:', error));
}

function fetchTechnicians() {
    const technicianDropdown = document.getElementById('technicianDropdown');
    const token = localStorage.getItem('token');
    fetch(`/api/getTechnicians`, {
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
        data.forEach(technician => {
            const option = document.createElement('option');
            option.value = technician.id;
            option.textContent = technician.name;
            technicianDropdown.appendChild(option);
        });
    })
    .catch(error => console.error('Error fetching technicians:', error));
}

const createMaintenanceForm = $('#createMaintenanceForm');
const token = localStorage.getItem('token');    
createMaintenanceForm.submit(function (event) {
    event.preventDefault();
    const itemNameInput = $('#itemName');
    const descriptionInput = $('#description');
    const imageInput = $('#img_path')[0].files[0];
    const itemName = itemNameInput.val();
    const description = descriptionInput.val();
    const formData = new FormData();
    formData.append('itemName', itemName);
    formData.append('description', description);
    formData.append('img_path', imageInput);
    const token = localStorage.getItem('token');

    $.ajax({
        url: '/api/createMaintenance',
        type: 'POST',
        headers: {
            'Authorization': 'Bearer ' + token,
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        processData: false,  
        contentType: false,
        success: function (data) {
            console.log('Maintenance request successfully:', data);
            $('#createMaintenanceModal').modal('hide');
            itemNameInput.val('');
            descriptionInput.val('');
            $('#img_path').val('');
            fetchmaintenances(); // Update the function name to match your lost items
            Swal.fire({
                icon: 'success',
                title: 'Maintenance Created',
                text: 'Your request has been successfully created.',
            });
        },
        error: function (error) {
            console.error('Error creating request:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while creating the request. Please try again.',
            });
        }
    });
});

function showItemDetails(id, status, itemName, description, technicianName, completionPercentage) {
    maintenance_id = id;
    if (status === "PENDING") {
        const maintenanceDetails = document.getElementById('pendingMaintenanceDetails');

        let details = `
            <b>Item Name:</b> ${itemName}<br>
            <b>Description:</b> ${description}<br>
            <b>Status:</b> ${status}<br>
        `;
        maintenanceDetails.innerHTML = details;
        $('#pendingMaintenanceModal').modal('show');
    } else { 
        const maintenanceDetails = document.getElementById('inprogressMaintenanceDetails');

        let details = `
            <b>Item Name:</b> ${itemName}<br>
            <b>Description:</b> ${description}<br>
            <b>Status:</b> ${status}<br>
            <b>Completion Percentage:</b>
            <div class="progress" style="height: 20px;">
                <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: ${completionPercentage}%" aria-valuenow="${completionPercentage}" aria-valuemin="0" aria-valuemax="100">${completionPercentage}%</div>
            </div><br>
            <b>Assigned Technician:</b> ${technicianName}<br>
          
        `;
        maintenanceDetails.innerHTML = details;
        fetchMaintenanceChanges(id);
        $('#inprogressMaintenanceModal').modal('show');
    }
}

// Function to fetch and populate maintenance changes for in-progress requests
function fetchMaintenanceChanges(maintenanceId) {
    const token = localStorage.getItem('token');
    fetch(`/api/getMaintenanceChanges?maintenance_id=${maintenanceId}`, {
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
        const maintenanceChangesTbody = document.getElementById('maintenanceChangesTbody');
        maintenanceChangesTbody.innerHTML = "";
        // Check if there are any changes fetched
        if (data.length > 0) {
            data.forEach(changes => {
                const row = `
                    <tr>
                        <td>${changes.description}</td>
                        <td>${changes.changePercentage}</td>
                    </tr>
                `;
                maintenanceChangesTbody.innerHTML += row;
            });
        } else {
            // If no changes are fetched, display a message
            maintenanceChangesTbody.innerHTML = `<tr><td colspan="2">No progress yet</td></tr>`;
        }
    })
    .catch(error => console.error('Error fetching maintenance changes:', error));
}

const assignTechnicianForm = $('#assignTechnicianForm');
assignTechnicianForm.submit(function (event) {
    event.preventDefault();
    const technician_id = document.getElementById('technicianDropdown').value ;
    const formData = new FormData();
    formData.append('technician_id', technician_id);
    formData.append('maintenance_id', maintenance_id);
    const token = localStorage.getItem('token');
    $.ajax({
        url: '/api/assignTechnician',
        type: 'POST',
        headers: {
            'Authorization': 'Bearer ' + token,
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        processData: false,  
        contentType: false,
        success: function (data) {
            $('#pendingMaintenanceModal').modal('hide');
            fetchmaintenances(); // Update the function name to match your lost items
            Swal.fire({
                icon: 'success',
                title: 'Maintenance Assigned',
                text: 'Your request has been successfully assigned.',
            });
        },
        error: function (error) {
            console.error('Error creating request:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while assigning the request. Please try again.',
            });
        }
    });
});

// Function to show the completion days modal
function showCompletionDaysModal() {
    $('#completionDaysModal').modal('show');
}

// Function to handle submitting the completion days form
$('#completionDaysForm').submit(function (event) {
    event.preventDefault();
    const completionDays = $('#completionDays').val();
    const maintenanceId = maintenance_id; // Assuming you have the maintenance_id stored
    acceptMaintenance(maintenanceId, completionDays);
});

// Function to accept maintenance
function acceptMaintenance(maintenanceId, completionDays) {
    const token = localStorage.getItem('token');
    fetch('/api/technician/acceptMaintenance', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + token,
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        credentials: 'include',
        body: JSON.stringify({
            maintenance_id: maintenanceId,
            completionDays: completionDays
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Maintenance accepted:', data);
        $('#completionDaysModal').modal('hide');
        // Show success message
        Swal.fire({
            icon: 'success',
            title: 'Maintenance Accepted',
            text: 'The maintenance has been accepted and saved in the database.'
        });
    })
    .catch(error => {
        console.error('Error accepting maintenance:', error);
        // Show error message
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while accepting the maintenance. Please try again.'
        });
    });
}

function addMaintenanceStatus(maintenanceId, description, changePercentage) {
    const token = localStorage.getItem('token');
    console.log(description)
    fetch('/api/addMaintenanceStatus', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + token,
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        credentials: 'include',
        body: JSON.stringify({
            maintenance_id: maintenanceId,
            description: description,
            changePercentage: changePercentage
        })
    })
    .then(response => response.json())
    .then(data => {
    fetchmaintenances();

        console.log('Maintenance status added:', data);
        Swal.fire({
            icon: 'success',
            title: 'Maintenance Updated',
            text: 'Maintenance status has been updated successfully.',
        });
    })
    .catch(error => {
        console.error('Error adding maintenance status:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while updating the maintenance status. Please try again.',
        });
    });
}

// Function to show the Accept Maintenance modal
function showAcceptModal() {
    $('#acceptModal').modal('show');
}

// Function to show the Update Maintenance modal
function showUpdateModal() {
    $('#updateModal').modal('show');
}


// Function to handle form submission for accepting maintenance
$('#acceptForm').submit(function(event) {
    event.preventDefault();
    const completionDays = $('#completionDays').val();
    acceptMaintenance(maintenance_id, completionDays);
    $('#acceptModal').modal('hide');
});


// Function to mark maintenance as done
function markAsDone() {
    const completionPercentage = 100;
    const description = "Maintenance completed.";
    Swal.fire({
        icon: 'warning',
        title: 'Are you sure?',
        text: 'This will mark the maintenance as done.',
        showCancelButton: true,
        confirmButtonText: 'Yes, mark it as done',
        cancelButtonText: 'No, keep it',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            addMaintenanceStatus(maintenance_id, description, completionPercentage);
        }
    });
}

// Function to handle form submission for updating maintenance
$('#updateForm').submit(function(event) {
    event.preventDefault();
    const completionPercentage = $('#completionPercentage').val();
    const description = $('#statusdescription').val();
    addMaintenanceStatus(maintenance_id, description, completionPercentage);
    $('#updateModal').modal('hide');
});
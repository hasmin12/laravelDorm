document.addEventListener('DOMContentLoaded', function () {
    fetchmaintenances();
    
});

function fetchmaintenances() {
    const token = localStorage.getItem('token');
    console.log(token)
    fetch('/api/getMaintenances', {
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
            console.log(data)
           
            data.forEach(maintenance => {
                const cardContainer = document.createElement('div');
                cardContainer.classList.add('col-sm-12', 'col-md-4');
                
                // Set color based on status
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

                const cardContent = `
                    <div class="card h-100" style="cursor: pointer;" onclick="showItemDetails('${maintenance.id}','${maintenance.status}', '${maintenance.itemName}','${maintenance.description}', '${maintenance.technicianName}','${maintenance.completionPercentage}')">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h5 class="card-title">${maintenance.itemName}</h5>
                                <small class="${statusColorClass}">${maintenance.status}</small>
                            </div>
                            <img src="${maintenance.img_path}" alt="Maintenance Item Image" class="card-img-top" style="max-height: 150px;">
                        </div>
                    </div>
                `;

                cardContainer.innerHTML = cardContent;
                maintenancesContainer.appendChild(cardContainer);
            });
        })
        .catch(error => console.error('Error fetching maintenance items:', error));
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
    const modalTitle = document.getElementById('maintenanceModalTitle');
    const modalBody = document.getElementById('maintenanceModalBody');

    modalTitle.innerText = 'Maintenance Request Details';

    let modalContent = `
        <b>Item Name:</b> ${itemName}<br>
        <b>Description:</b> ${description}<br>
        <b>Status:</b> ${status}<br>
    `;

    if (status === "Pending" || status === "Cancelled") {
        modalContent += `<b>Status:</b> Waiting for approval`;
    } else {
        modalContent += `
            <b>Completion Percentage:</b>
            <div class="progress" style="height: 20px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: ${completionPercentage}%" aria-valuenow="${completionPercentage}" aria-valuemin="0" aria-valuemax="100">${completionPercentage}%</div>
            </div><br>
            <b>Assigned Technician:</b> ${technicianName}
        `;
    }

    modalBody.innerHTML = modalContent;

    $('#maintenanceModal').modal('show');
}


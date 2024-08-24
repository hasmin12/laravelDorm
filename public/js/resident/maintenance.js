document.addEventListener('DOMContentLoaded', function () {
    fetchmaintenances();
    
});

function fetchmaintenances() {
    const token = localStorage.getItem('token');
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
           
            data.forEach(maintenance => {
                const cardContainer = document.createElement('div');
                cardContainer.classList.add('col-sm-12', 'col-md-4', 'pt-4', 'px-4');
    
                cardContainer.style.setProperty('padding-left', '9.5rem', 'important');
                const createdAt = new Date(maintenance.created_at);
                const timeOnly = createdAt.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
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
                if (maintenance.status == "PENDING") {
                const cardContent = `
                    <div class="card shadow h-100" style="cursor: pointer; width: 100.333%;" onclick="showItemDetails('${maintenance.id}','${maintenance.status}','${maintenance.type}','${maintenance.description}','${maintenance.technicianName}','${maintenance.completionPercentage}','${maintenance.branch}','${maintenance.room_number}','${maintenance.request_date}')">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h5 class="card-title">${maintenance.type}</h5>
                                <small class="text-warning">${maintenance.status}<br><small class="text-dark">${maintenance.request_date}<br>${timeOnly}</small></small>
                            </div>
                            <img src="${maintenance.img_path}" alt="Maintenance Item Image" class="card-img-top" style="width: 345px; height: 290px;">
                        </div>
                    </div>
                `;
                cardContainer.innerHTML = cardContent;

                } else if (maintenance.status == "In Progress") {
                    const cardContent = `
                    <div class="card shadow h-100" style="cursor: pointer; width: 100.333%;" onclick="showItemDetails('${maintenance.id}','${maintenance.status}','${maintenance.type}','${maintenance.description}','${maintenance.technicianName}','${maintenance.completionPercentage}','${maintenance.branch}','${maintenance.room_number}','${maintenance.request_date}')">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h5 class="card-title">${maintenance.type}</h5>
                                <small class="text-warning">${maintenance.status}<br><small class="text-dark">${maintenance.request_date}<br>${timeOnly}</small></small>
                            </div>
                            <img src="${maintenance.img_path}" alt="Maintenance Item Image" class="card-img-top" style="max-height: 150px;">
                        </div>
                    </div>
                `;
                cardContainer.innerHTML = cardContent;
     
                } else{

                    const cardContent = `
                    <div class="card shadow h-100" style="cursor: pointer; width: 100.333%;" onclick="showItemDetails('${maintenance.id}','${maintenance.status}','${maintenance.type}','${maintenance.description}','${maintenance.technicianName}','${maintenance.completionPercentage}','${maintenance.branch}','${maintenance.room_number}','${maintenance.request_date}')">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h5 class="card-title">${maintenance.type}</h5>
                                <small class="text-warning">${maintenance.status}<br><small class="text-dark">${maintenance.request_date}<br>${timeOnly}</small></small>
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


const createMaintenanceForm = $('#createMaintenanceForm');
    const token = localStorage.getItem('token');    
    createMaintenanceForm.submit(function (event) {
    event.preventDefault();

    const typeInput = $('#type');
    const descriptionInput = $('#description');
    const imageInput = $('#img_path')[0].files[0];

    const type = typeInput.val();
    const description = descriptionInput.val();

    const formData = new FormData();
    formData.append('type', type);
    formData.append('description', description);
    formData.append('img_path', imageInput);

    const token = localStorage.getItem('token');

    $.ajax({
        url: '/api/resident/createMaintenance',
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

            typeInput.val('');
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

function showItemDetails(id, status, type, description, technicianName, completionPercentage,branch,room_number,request_date) {


    let modalContent = `
     <ul class="list-group list-group-flush">
     <li class="list-group-item bg-transparent"><b>Maintenance Type:</b> ${type}</li>
     <li class="list-group-item bg-transparent"><b>Description:</b> ${description}</li>
     <li class="list-group-item bg-transparent"><b>Room Details:</b> ${branch}: ${room_number}</li>
     <li class="list-group-item bg-transparent"><b>Request Date:</b> ${request_date}</li>    
    `;

    if (status === "PENDING" || status === "Cancelled") {
        modalContent += `<li class="list-group-item bg-transparent"><b>Status:</b> Waiting for approval<li> </ul> `;
    const modalBody = document.getElementById('pendingMaintenanceBody');

    modalBody.innerHTML = modalContent;

    $('#pendingMaintenanceModal').modal('show');

    } else {
        modalContent += `
            <b>Completion Percentage:</b>
            <div class="progress" style="height: 20px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: ${completionPercentage}%" aria-valuenow="${completionPercentage}" aria-valuemin="0" aria-valuemax="100">${completionPercentage}%</div>
            </div><br>
            <b>Assigned Technician:</b> ${technicianName}
        `;
        
    const modalBody = document.getElementById('inprogressMaintenanceBody');

    modalBody.innerHTML = modalContent;

    $('#inprogressMaintenanceModal').modal('show');

    }


}


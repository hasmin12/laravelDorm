document.addEventListener('DOMContentLoaded', function () {
    fetchrepairs();
});

function fetchrepairs() {
    const token = localStorage.getItem('token');

    fetch('/api/getRepairs', {
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
            const repairsContainer = document.getElementById('repair-items-container');
            repairsContainer.innerHTML = '';

            data.repairs.forEach((repair, index) => {
                const cardContainer = document.createElement('div');
                cardContainer.classList.add('col-sm-12', 'col-md-4');

                // Set color based on status
                let statusColorClass;
                switch (repair.status) {
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
                    <div class="card h-100" style="cursor: pointer;" onclick="showItemDetails('${repair.itemName}', '${repair.img_path}', '${repair.status}', '${repair.dateRepair}')">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h5 class="card-title">${repair.itemName}</h5>
                                <small class="${statusColorClass}">${repair.status}</small>
                            </div>
                            <img src="${repair.img_path}" alt="Repair Item Image" class="card-img-top" style="max-height: 150px;">
                        </div>
                    </div>
                `;

                cardContainer.innerHTML = cardContent;
                repairsContainer.appendChild(cardContainer);
            });
        })
        .catch(error => console.error('Error fetching repair items:', error));
}


const createRepairForm = $('#createRepairForm');

createRepairForm.submit(function (event) {
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
        url: '/api/createRepair',
        type: 'POST',
        headers: {
            'Authorization': 'Bearer ' + token,
        },
        data: formData,
        processData: false,  
        contentType: false,
        success: function (data) {
            console.log('Repair request successfully:', data);

            $('#createRepairModal').modal('hide');

            itemNameInput.val('');
            descriptionInput.val('');
            $('#img_path').val('');

            fetchrepairs(); // Update the function name to match your lost items

            Swal.fire({
                icon: 'success',
                title: 'Repair Created',
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

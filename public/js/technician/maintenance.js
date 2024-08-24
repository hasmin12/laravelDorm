
    document.addEventListener('DOMContentLoaded', function () {
        fetchTechnicians();
        fetchmaintenances();
        $('#updateForm').on('submit', updateMaintenance);
        const steps = document.querySelectorAll('input[name="maintenanceSteps"]');
        
        steps.forEach((step, index) => {
            step.addEventListener('change', () => {
                toggleNextStep(steps, index);
            });
        });

        function toggleNextStep(steps, index) {
            if (steps[index].checked) {
                if (index + 1 < steps.length) {
                    steps[index + 1].disabled = false;
                }
            } else {
                for (let i = index + 1; i < steps.length; i++) {
                    steps[i].checked = false;
                    steps[i].disabled = true;
                }
            }
        }
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
            console.log(data)
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
                        statusColorClass = 'text-dark';
                }

                const cardContent = `
                    <div class="card h-100" style="cursor: pointer;" onclick="showItemDetails('${maintenance.id}','${maintenance.status}','${maintenance.type}','${maintenance.description}','${maintenance.technicianName}','${maintenance.completionPercentage}','${maintenance.branch}','${maintenance.room_number}','${maintenance.request_date}')">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h5 class="card-title">${maintenance.type}</h5>
                                <small class="${statusColorClass}">${maintenance.status}<br><small class="text-dark">${maintenance.request_date}</small></small>
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

    function showItemDetails(id, status, itemName, description, technicianName, completionPercentage) {
        maintenance_id = id;
        if (status === "PENDING") {
            const maintenanceDetails = document.getElementById('pendingMaintenanceDetails');
            maintenanceDetails.innerHTML = `
                <b>Item Name:</b> ${itemName}<br>
                <b>Description:</b> ${description}<br>
                <b>Status:</b> ${status}<br>
            `;
            $('#pendingMaintenanceModal').modal('show');
        } else if(status === "DONE"){
            const maintenanceDetails = document.getElementById('doneMaintenanceDetails');
            maintenanceDetails.innerHTML = `
                <b>Item Name:</b> ${itemName}<br>
                <b>Description:</b> ${description}<br>
                <b>Status:</b> ${status}<br>
                <b>Completion Percentage:</b>
                <div class="progress" style="height: 20px;">
                    <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: ${completionPercentage}%" aria-valuenow="${completionPercentage}" aria-valuemin="0" aria-valuemax="100">${completionPercentage}%</div>
                </div><br>
                <b>Assigned Technician:</b> ${technicianName}<br>
            `;
            fetchMaintenanceChanges(id);
            $('#doneMaintenanceModal').modal('show');
        }
        else {
            const maintenanceDetails = document.getElementById('inprogressMaintenanceDetails');
            maintenanceDetails.innerHTML = `
                <b>Item Name:</b> ${itemName}<br>
                <b>Description:</b> ${description}<br>
                <b>Status:</b> ${status}<br>
                <b>Completion Percentage:</b>
                <div class="progress" style="height: 20px;">
                    <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: ${completionPercentage}%" aria-valuenow="${completionPercentage}" aria-valuemin="0" aria-valuemax="100">${completionPercentage}%</div>
                </div><br>
                <b>Assigned Technician:</b> ${technicianName}<br>
            `;
            fetchMaintenanceChanges(id);
            $('#inprogressMaintenanceModal').modal('show');
        }
    }

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
                maintenanceChangesTbody.innerHTML = `<tr><td colspan="2">No progress yet</td></tr>`;
            }
        })
        .catch(error => console.error('Error fetching maintenance changes:', error));
    }

    function showUpdateModal() {
        maintenance_id = maintenance_id;
        fetchMaintenanceStatus(maintenance_id);
        $('#updateModal').modal('show');
    }

    function fetchMaintenanceStatus(id) {
        const token = localStorage.getItem('token');
        console.log(id)
        $.ajax({
            url: `/api/getMaintenanceStatus?maintenance_id=${id}`,
            type: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`
            },
            success: function(response) {
                console.log('Fetched maintenance status successfully', response);
                updateFormFields(response);
            },
            error: function(error) {
                console.error('Error fetching maintenance status', error);
                alert('Error fetching maintenance status');
            }
        });
    }

    

    function updateFormFields(percentage) {
        const checkboxes = $('input[name="maintenanceSteps"]');
        const status = $('#statusdescription');
        status.val('');
        checkboxes.prop('checked', false);
        checkboxes.prop('disabled', true);
        checkboxes.eq(0).prop('disabled', false);
    
        let stepsToCheck = 0;
        if (percentage >= 10) stepsToCheck = 1;
        if (percentage >= 20) stepsToCheck = 2;
        if (percentage >= 30) stepsToCheck = 3;
        if (percentage >= 80) stepsToCheck = 4;
    
        // Check the appropriate number of steps
        for (let i = 0; i < stepsToCheck; i++) {
            checkboxes.eq(i).prop('checked', true);
            checkboxes.eq(i + 1).prop('disabled', false);
        }
    }
    

    function updateMaintenance(event) {
        event.preventDefault();
        
        let maintenanceSteps = [];
        $('input[name="maintenanceSteps"]:checked').each(function() {
            maintenanceSteps.push($(this).val());
        });

        let description = $('#statusdescription').val();
        let totalPercentage = 0;
        
        for (let step of maintenanceSteps) {
            totalPercentage += parseInt(step);
            console.log(totalPercentage);

        }

        let data = {
            maintenance_id: maintenance_id,
            completionPercentage: totalPercentage,
            description: description
        };

        $.ajax({
            url: '/api/addMaintenanceStatus',
            type: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log('Maintenance updated successfully', response);
                $('#inprogressMaintenanceModal').modal('hide');
                $('#updateModal').modal('hide');

                Swal.fire({
                    icon: 'success',
                    title: 'Maintenance Updated',
                    text: 'The maintenance has been updated.'
                });
                fetchmaintenances();

            },
            error: function(error) {
                console.error('Error updating maintenance', error);
                alert('Error updating maintenance');
            }
        });
    }

    function showAcceptModal() {
        $('#acceptModal').modal('show');
    }

   

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

    $('#completionDaysForm').submit(function (event) {
        event.preventDefault();
        const completionDays = $('#completionDays').val();
        acceptMaintenance(maintenance_id, completionDays);
    });

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
            Swal.fire({
                icon: 'success',
                title: 'Maintenance Accepted',
                text: 'The maintenance has been accepted and saved in the database.'
            });
        })
        .catch(error => {
            console.error('Error accepting maintenance:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while accepting the maintenance. Please try again.'
            });
        });
    }

    const assignTechnicianForm = $('#assignTechnicianForm');
    assignTechnicianForm.submit(function(event) {
        event.preventDefault();
        const technicianId = $('#technicianDropdown').val();
        assignTechnician(maintenance_id, technicianId);
    });

    function assignTechnician(maintenanceId, technicianId) {
        const token = localStorage.getItem('token');
        fetch('/api/technician/assignTechnician', {
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
                technician_id: technicianId
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Technician assigned:', data);
            Swal.fire({
                icon: 'success',
                title: 'Technician Assigned',
                text: 'The technician has been successfully assigned.'
            });
        })
        .catch(error => {
            console.error('Error assigning technician:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while assigning the technician. Please try again.'
            });
        });
    }

    // function addMaintenanceStatus(maintenanceId, description, completionPercentage) {
    //     const token = localStorage.getItem('token');
    //     fetch('/api/addMaintenanceStatus', {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json',
    //             'Accept': 'application/json',
    //             'Authorization': 'Bearer ' + token,
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         credentials: 'include',
    //         body: JSON.stringify({
    //             maintenance_id: maintenanceId,
    //             description: description,
    //             completionPercentage: completionPercentage
    //         })
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         console.log('Maintenance status updated:', data);
    //         fetchmaintenances();
    //         $('#inprogressMaintenanceModal').modal('hide');
    //         Swal.fire({
    //             icon: 'success',
    //             title: 'Maintenance Updated',
    //             text: 'The maintenance status has been successfully updated.'
    //         });
    //     })
    //     .catch(error => {
    //         console.error('Error updating maintenance status:', error);
    //         Swal.fire({
    //             icon: 'error',
    //             title: 'Error',
    //             text: 'An error occurred while updating the maintenance status. Please try again.'
    //         });
    //     });
    // }

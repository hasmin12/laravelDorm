document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('#searchInput');
    const violationTypeButtons = document.querySelectorAll('input[name="btnradio"]');
    const sendEmailButton = document.querySelector('#sendEmailButton');
    const token = localStorage.getItem('token');
    const residentDropdown = document.getElementById('residentDropdown');
    // Set the initial view to 'tiles'
    let currentView = 'tiles';
    
    function fetchResidents() {
        fetch(`/api/getResidents`, {
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
            const residentDropdown = document.getElementById('residentDropdown');
            residentDropdown.innerHTML = ''; // Clear previous options
    
            // Add a default empty option
            const defaultOption = document.createElement('option');
            defaultOption.value = "";
            defaultOption.textContent = "Select Resident";
            residentDropdown.appendChild(defaultOption);
    
            // Filter residents with role 'Resident' and status 'Active'
            const activeResidents = data.residents.filter(resident => {
                return resident.role === 'Resident' && resident.status === 'Active';
            });
    
            // Populate the dropdown with active resident options
            activeResidents.forEach(resident => {
                const option = document.createElement('option');
                option.value = resident.id;
                option.textContent = resident.name;
                residentDropdown.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching residents:', error));
    }
    

    function fetchViolations() {
        const token = localStorage.getItem('token');

        fetch('/api/getViolations', {
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
            const violationTableBody = document.getElementById('violationTableBody');

            violationTableBody.innerHTML = '';
            console.log(data)
            // Add new rows based on the fetched data
            data.violations.forEach(violation => {
                const row = `
                    <tr>
                        <td>${violation.residentName}</td>
                        <td>${violation.violationName}</td>                          
                        <td>${violation.penalty}</td>
                        <td>${violation.violationDate}</td>
                        <td>${violation.violationType}</td>
                        <td>${violation.status}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" onclick="updateLostItem(${violation.id})">Update</button>
                            <button class="btn btn-sm btn-danger" onclick="confirmDeleteLostItem(${violation.id})">Delete</button>
                        </td>
                    </tr>
                `;
                violationTableBody.innerHTML += row;
            });
        })
        .catch(error => console.error('Error fetching Violations items:', error));
    }

    function createViolation() {
        const createViolationForm = document.getElementById('createViolationForm');
        createViolationForm.addEventListener('submit', function(event) {
            event.preventDefault();
    
            // Get form input values
            const residentId = document.getElementById('residentDropdown').value;
            const violationName = document.getElementById('violationName').value;
            const violationType = document.getElementById('violationType').value;
            const penalty = document.getElementById('penalty').value;
    
            // Prepare data for submission
            const formData = new FormData();
            formData.append('user_id', residentId);
            formData.append('violationName', violationName);
            formData.append('violationType', violationType);
            formData.append('penalty', penalty);
    
            // Fetch API endpoint to create violation
            fetch('/api/createViolation', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                console.log('Violation created successfully:', data);
                // Clear form inputs
                createViolationForm.reset();
                // Close modal
                $('#createViolationModal').modal('hide');
                // Fetch and update violation table
                fetchViolations();
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Violation Created',
                    text: 'The violation has been successfully created.',
                });
            })
            .catch(error => {
                console.error('Error creating violation:', error);
                // Show error message
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while creating the violation. Please try again.',
                });
            });
        });
    }
    

    function sendEmail() {
        // Implement your logic to send emails here
        // You can fetch selected residents, their email addresses, etc., and send emails
        // This is a placeholder function, customize it based on your requirements
        alert('Emails will be sent to selected violator.');
    }

    // Event listeners
    searchInput.addEventListener('input', () => fetchViolations(currentView));
    violationTypeButtons.forEach(button => button.addEventListener('change', () => fetchViolations(currentView)));
    sendEmailButton.addEventListener('click', sendEmail);

    // Fetch violations with the initial view type
    fetchViolations(currentView);
    fetchResidents();
    createViolation();
    // Event listener for Add Violators button to show the create violation modal
    document.getElementById('addViolationButton').addEventListener('click', function() {
        $('#createViolationModal').modal('show');
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('#searchInput');
    const violationTypeButtons = document.querySelectorAll('input[name="btnradio"]');
    const violationTableBody = document.querySelector('#violationTableBody');
    const sendEmailButton = document.querySelector('#sendEmailButton');
    const violationTilesContainer = document.querySelector('#violationTilesContainer');
    const token = localStorage.getItem('token');

    // Set the initial view to 'tiles'
    let currentView = 'tiles';

    function fetchViolations(viewType = 'tiles') {
        const violationType = document.querySelector('input[name="btnradio"]:checked').value;
        const searchQuery = searchInput.value;

        fetch(`/api/getViolations?violation_type=${violationType}&search_query=${searchQuery}`, {
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
            violationTableBody.innerHTML = '';
            violationTilesContainer.innerHTML = '';

            // Create a single row to contain all the cards
            const cardRow = document.createElement('div');
            cardRow.classList.add('row');

            data.violations.forEach(violation => {
                // Card HTML structure
                    const card = `
                        <div class="col-md-4 mb-3"> <!-- Added mb-3 class for margin-bottom -->
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="..." alt="Card image cap">
                                <div class="card-body text-center">
                                    <h5 class="card-title">${violation.name}</h5>
                                    <button class="btn btn-sm btn-success" onclick="showViolationDetails(${violation.id})" data-bs-toggle="modal" data-bs-target="#violationDetailsModal">
                                        Check
                                    </button>
                                    <button class="btn btn-sm btn-warning" onclick="updateRoom(${violation.id})">Update</button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteRoom(${violation.id})">Delete</button>
                                </div>
                            </div>
                        </div>
                    `;

                // Append each card to the row
                cardRow.innerHTML += card;

                // Table row HTML structure
                const tableRow = `
                    <tr>
                    <td>${violation.violationName}</td>
                    <td>${violation.user_id}</td>
                    <td>${violation.penalty}</td>
                    <td>${violation.violationDate}</td>
                    <td>${violation.violationType}</td>
                    <td>${violation.status}</td>
                        <td>
                        <button class="btn btn-sm btn-success" onclick="showViolationDetails(${JSON.stringify(violation)})" data-bs-toggle="modal" data-bs-target="#violationDetailsModal">
                            Check
                        </button>

                            <button class="btn btn-sm btn-warning" onclick="updateRoom(${violation.id})">Update</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteRoom(${violation.id})">Delete</button>
                        </td>
                    </tr>
                `;

                // Append each table row
                violationTableBody.insertAdjacentHTML('beforeend', tableRow);
            });

            // Insert the row containing all cards into the container
            violationTilesContainer.appendChild(cardRow);
        })
        .catch(error => console.error('Error fetching violations:', error))
        .finally(() => {
            // Hide spinner or loading indicator
            document.getElementById('spinner').classList.remove('show');
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

    // Fetch residents with the initial view type
    fetchViolations(currentView);
});


document.getElementById('addViolationButton').addEventListener('click', function() {
    window.location.href = '/admin/newviolation';
});


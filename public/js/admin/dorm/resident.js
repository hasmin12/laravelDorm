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
                        <div class="col-md-4 mb-3"> <!-- Added mb-3 class for margin-bottom -->
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="..." alt="Card image cap">
                                <div class="card-body text-center">
                                    <h5 class="card-title">${resident.name}</h5>
                                    <button class="btn btn-sm btn-success" onclick="showResidentDetails(${resident.id})" data-bs-toggle="modal" data-bs-target="#residentDetailsModal">
                                        Check
                                    </button>
                                    <button class="btn btn-sm btn-warning" onclick="updateRoom(${resident.id})">Update</button>
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
                        <button class="btn btn-sm btn-success" onclick="showResidentDetails(${JSON.stringify(resident)})" data-bs-toggle="modal" data-bs-target="#residentDetailsModal">
                            Check
                        </button>

                            <button class="btn btn-sm btn-warning" onclick="updateRoom(${resident.id})">Update</button>
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
        // You can fetch selected residents, their email addresses, etc., and send emails
        // This is a placeholder function, customize it based on your requirements
        alert('Emails will be sent to selected residents.');
    }

    // Event listeners
    searchInput.addEventListener('input', () => fetchResidents(currentView));
    residentTypeButtons.forEach(button => button.addEventListener('change', () => fetchResidents(currentView)));
    sendEmailButton.addEventListener('click', sendEmail);

    // Fetch residents with the initial view type
    fetchResidents(currentView);
});


document.getElementById('addResidentButton').addEventListener('click', function() {
    window.location.href = '/admin/newresident';
});


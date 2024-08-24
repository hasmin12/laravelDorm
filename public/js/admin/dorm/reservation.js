document.addEventListener('DOMContentLoaded', function () {
    fetchReservations();
    const searchInput = document.querySelector('#searchInput');
    searchInput.addEventListener('input', () => fetchReservations());

    const statusButtons = document.querySelectorAll('input[name="btnradio"]');
    statusButtons.forEach(button => button.addEventListener('change', () => fetchReservations()));
    document.getElementById('updateStatus').addEventListener('click', updateStatus);
    
});



function fetchReservations() {
    const token = localStorage.getItem('token');
    const searchInput = document.querySelector('#searchInput');

    const status = document.querySelector('input[name="btnradio"]:checked').value;
    const searchQuery = searchInput.value;

    fetch(`/api/getReservations?search_query=${searchQuery}`, {
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
        const reservationTableBody = document.querySelector('#reservationTableBody');
        reservationTableBody.innerHTML = '';

        data.forEach(reservation => {
            let actionButton = '';
            if (reservation.status === 'Pending') {
                actionButton = `<button class="btn btn-sm btn-warning" onclick="updateReservation('${reservation.id}','${reservation.roomName}','${reservation.checkin_date}','${reservation.checkout_date}','${reservation.name}','${reservation.email}','${reservation.contacts}','${reservation.status}','${reservation.img_path}')">Update</button>`;
            } else if (reservation.status === 'Check-In') {
                actionButton = `<button class="btn btn-sm btn-primary" onclick="checkoutReservation('${reservation.id}')">Checkout</button>`;
            } else if (reservation.status === 'Check-Out') {
                actionButton = `<button class="btn btn-sm btn-primary" onclick="viewDetails('${reservation.id}','${reservation.roomName}','${reservation.checkin_date}','${reservation.checkout_date}','${reservation.name}','${reservation.email}','${reservation.contacts}','${reservation.status}','${reservation.img_path}')">View Details</button>`;
                
            }
            if (reservation.status.toLowerCase() === status.toLowerCase()) {
                const row = `
                    <td>${reservation.id}</td>
                    <td>${reservation.roomName}</td>
                    <td>${reservation.checkin_date}</td>
                    <td>${reservation.checkout_date}</td>
                    <td>${reservation.name}</td>
                    <td>${reservation.email}</td>
                    <td>${reservation.contacts}</td>
                    <td>${reservation.status}</td>
                    <td>${actionButton}</td>
                `;
                reservationTableBody.innerHTML += row;
            }
        });
    })
    .catch(error => console.error('Error fetching reservations:', error));
}

function viewDetails(reservationId, roomName, checkin_date, checkout_date, name, email, contacts, status, img) {

    // Display reservation details in a modal or any other preferred way
    const reservationDetailsModal = document.getElementById('reservationDetailsModal');
    const modalBody = reservationDetailsModal.querySelector('.modal-body');

    modalBody.innerHTML = `
        <p><strong>Reservation ID:</strong> ${reservationId}</p>
        <p><strong>Room Name:</strong> ${roomName}</p>
        <p><strong>Check-in Date:</strong> ${checkin_date}</p>
        <p><strong>Checkout Date:</strong> ${checkout_date}</p>
        <p><strong>Name:</strong> ${name}</p>
        <p><strong>Email:</strong> ${email}</p>
        <p><strong>Contacts:</strong> ${contacts}</p>
        <p><strong>Status:</strong> ${status}</p>
    `;

    $('#reservationDetailsModal').modal('show');
}

    
function updateReservation(reservationId, roomName, checkin_date, checkout_date, name, email, contacts, status, img) {
    const reservationImage = document.getElementById('reservationImage');
    const resId = document.getElementById('resId');

    const resRoomName = document.getElementById('resRoomName');
    const resCheckin = document.getElementById('resCheckin');
    const resCheckout = document.getElementById('resCheckout');
    const resName = document.getElementById('resName');
    const resEmail = document.getElementById('resEmail');
    const resContacts = document.getElementById('resContacts');
    const resStatus = document.getElementById('resStatus');

    reservationImage.src = img; // Set the image source
    resId.textContent = reservationId;
    resRoomName.textContent = roomName;
    resCheckin.textContent = checkin_date;
    resCheckout.textContent = checkout_date;
    resName.textContent = name;
    resEmail.textContent = email;
    resContacts.textContent = contacts;
    resStatus.value = status; // Set the status value


    $('#updateReservationModal').modal('show');
}
function promptRating(reservationId) {
    const review = prompt("Please enter your review:");
    if (review !== null) {
        // User clicked OK, now prompt for rating
        const rating = prompt("Please enter your rating (1-5):");
        if (rating !== null) {
            // User clicked OK, now send review and rating to the server
            sendRating(reservationId, review, parseInt(rating));
        }
    }
}

// function sendRating(reservationId, review, rating) {
//     fetch(`/api/sendRating?reservationId=${reservationId}&review=${review}&rating=${rating}`, {
//         method: 'GET',
//         headers: {
//             'Content-Type': 'application/json',
//             'Accept': 'application/json',
//             'Authorization': `Bearer ${token}`,
//         },
//         credentials: 'include',
//     })
//     .then(response => {
//         if (response.ok) {
//             $('#updateReservationModal').modal('hide'); 
//             fetchReservations(); 
//         } else {
//             // Handle error
//             throw new Error('Failed to sending reviews');
//         }
//     })
//     .catch(error => console.error('Error SENDING reviews:', error));
// }
function updateStatus() {
    const token = localStorage.getItem('token');
    const resId = document.getElementById('resId').textContent;
    const newStatus = document.getElementById('resStatus').value;

    fetch(`/api/updateReservationStatus?reservationId=${resId}&newStatus=${newStatus}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}`,
        },
        credentials: 'include',
    })
    .then(response => {
        if (response.ok) {
            $('#updateReservationModal').modal('hide'); 
            fetchReservations(); 
        } else {
            // Handle error
            throw new Error('Failed to update status');
        }
    })
    .catch(error => console.error('Error updating status:', error));
}

function checkoutReservation(resId) {
    const token = localStorage.getItem('token');

    fetch(`/api/checkoutReservation?reservationId=${resId}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}`,
        },
        credentials: 'include',
    })
    .then(response => {
        if (response.ok) {
            fetchReservations(); 
        } else {
            // Handle error
            throw new Error('Failed to update status');
        }
    })
    .catch(error => console.error('Error updating status:', error));
}

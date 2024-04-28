document.addEventListener('DOMContentLoaded', function () {
    fetchReservations();
});

function fetchReservations() {
    const token = localStorage.getItem('token');

    fetch(`/api/myReservations`, {
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
        const reservationsContainer = document.getElementById('reservations-container');
        reservationsContainer.innerHTML = '';

        data.forEach(reservation => {
            const formattedInDate = new Date(reservation.checkin_date).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
            const formattedOutDate = new Date(reservation.checkout_date).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
            
            const reservationElement = document.createElement('div');
            reservationElement.classList.add('d-flex', 'align-items-center', 'border-bottom', 'py-3');
            reservationElement.innerHTML = `
                <div class="w-100 ms-3">
                    <div class="d-flex w-100 justify-content-between">
                        <h6 class="mb-0">${reservation.roomName}</h6>
                        <small>${formattedInDate} - ${formattedOutDate}</small>
                    </div>
                    <div class="d-flex w-100 justify-content-between">
                        <h6>${reservation.roomName}</h6>
                        <div class="btn-group">
                            <button class="btn btn-primary update-btn" data-reservation-id="${reservation.id}">Update</button>
                            <button class="btn btn-danger delete-btn" data-reservation-id="${reservation.id}">Delete</button>
                        </div>
                    </div>
                </div>
            `;
            reservationsContainer.appendChild(reservationElement);

            // Add event listener for entire reservation element
            reservationElement.addEventListener('click', () => {
                openModal(reservation);
            });
        });
    })
    .catch(error => console.error('Error fetching reservations:', error));
}
function openModal(reservation) {
    // Populate modal with reservation details
    document.getElementById('roomName').textContent = reservation.roomName;
    document.getElementById('checkinDate').textContent = reservation.checkin_date;
    document.getElementById('checkoutDate').textContent = reservation.checkout_date;
    document.getElementById('downPayment').textContent = reservation.downPayment;
    document.getElementById('totalPayment').textContent = reservation.totalPayment;
    document.getElementById('userName').textContent = reservation.name;
    document.getElementById('userEmail').textContent = reservation.email;

    // Show the modal
    var myModal = new bootstrap.Modal(document.getElementById('reservationDetailsModal'), {
        keyboard: false
    });
    myModal.show();
}

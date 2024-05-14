document.addEventListener('DOMContentLoaded', function () {
    fetchHostelRooms();

    const checkinDateInput = document.getElementById('checkinDate');
    const checkoutDateInput = document.getElementById('checkoutDate');

    checkinDateInput.addEventListener('change', recalculatePayment);
    checkoutDateInput.addEventListener('change', recalculatePayment);
    document.getElementById('apply-dates').addEventListener('click', function() {
        fetchHostelRooms();
    });
});
let reservationModalData
function fetchHostelRooms() {
    fetch('/api/getHostelrooms', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        credentials: 'include',
    })
    .then(response => response.json())
    .then(data => {
        console.log('Response data:', data);

        const roomContainer = document.getElementById('room-container');
        roomContainer.innerHTML = '';

        if (data && Array.isArray(data)) {
            const startDate = document.getElementById('start-date').value;
            const endDate = document.getElementById('end-date').value;

            data.forEach((room) => {
                const cardContainer = document.createElement('div');
                cardContainer.classList.add('col-sm-12', 'col-md-4');

                let reserveButton = '';
                let statusText = '';
                if (room.reservations.length === 0) {
                    statusText = '<span class="text-success">Vacant</span>';
                    reserveButton = `<button class="btn btn-primary" onclick="showReservationModal(event,${room.id},'${room.name}', '${room.description}', '${room.bedtype}', '${room.pax}', '${room.price}','${room.reservations}')">Reserve Now</button>`;
                } else {
                    const hasReservation = room.reservations.some(reservation => {
                        return (reservation.checkin_date <= endDate && reservation.checkout_date >= startDate);
                    });

                    if (hasReservation) {
                        statusText = '<span class="text-warning">Reserved</span>';
                    } else {
                        statusText = '<span class="text-success">Vacant</span>';
                        reserveButton = `<button class="btn btn-primary" onclick="showReservationModal(event,${room.id},'${room.name}', '${room.description}', '${room.bedtype}', '${room.pax}', '${room.price}','${room.reservations}')">Reserve Now</button>`;
                    }
                }

                const cardContent = `
                    <div class="card h-100" style="cursor: pointer;" onclick="showRoomDetails('${room.name}', '${room.description}', '${room.bedtype}', '${room.pax}', '${room.price}','${room.status}', '${room.img_paths.join(',')}', '${room.reservations}')">
                        <img src="${room.img_paths[0]}" class="card-img-top" alt="Room Image">
                        <div class="card-body">
                            <h5 class="card-title">${room.name}</h5>
                            <p class="card-text">${room.description}</p>
                            <p class="card-text">Type: ${room.bedtype}</p>
                            <p class="card-text">Pax: ${room.pax}</p>
                            <p class="card-text">Price: ₱${room.price}/day</p>
                            <p class="card-text">Status: ${statusText}</p>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                ${reserveButton}                          
                            </div>
                        </div>
                    </div>
                `;

                cardContainer.innerHTML = cardContent;
                roomContainer.appendChild(cardContainer);
            });
        } else {
            console.error('Invalid or missing data:', data);
        }
    })
    .catch(error => console.error('Error fetching hostel rooms:', error));
}
function showReservationModal(event, roomId, name, description, bedtype, pax, price) {
    event.preventDefault();
    event.stopPropagation();

    // Set the room details in the reservation modal
    const reservationModalTitle = document.getElementById('reservationModalTitle');
    const reservationModalPax = document.getElementById('reservationModalPax');
    const reservationModalType = document.getElementById('reservationModalType');
    const reservationModalPrice = document.getElementById('reservationModalPrice');
    const reservationModalDescription = document.getElementById('reservationModalDescription');

    const roomIdInput = document.getElementById('room_id');
    roomIdInput.value = roomId;
    reservationModalTitle.textContent = `Reserve ${name}`;
    reservationModalDescription.textContent = `${description}`;

    reservationModalPax.textContent = `Pax: ${pax}`;
    reservationModalType.textContent = `Type: ${bedtype}`;
    reservationModalPrice.textContent = `Price: ₱${price}/day`;

    // Show the reservation modal
    $('#reservationModal').modal('show');
    console.log
    // Handle reservations data
}

function showRoomDetails(name, description, type, pax, price,status, imgPaths ) {
    const imgPathsArray = imgPaths.split(',');
    const modalRoomName = document.getElementById('modalRoomName');
    const modalRoomDescription = document.getElementById('modalRoomDescription');
    const modalRoomType = document.getElementById('modalRoomType');
    const modalRoomPax = document.getElementById('modalRoomPax');
    const modalRoomPrice = document.getElementById('modalRoomPrice');

    modalRoomName.textContent = name;
    modalRoomDescription.textContent = description;
    modalRoomType.textContent = "Type: " + type;
    modalRoomPax.textContent = "Pax: " + pax;
    modalRoomPrice.textContent = "Price: ₱" + price;

  

    // Clear existing carousel items
    const roomImageCarousel = document.querySelector('#roomImageCarousel .carousel-inner');
    roomImageCarousel.innerHTML = '';

    // Populate carousel with images
    imgPathsArray.forEach((imgPath, index) => {
        const carouselItem = document.createElement('div');
        carouselItem.classList.add('carousel-item');

        const imgElement = document.createElement('img');
        imgElement.src = imgPath;
        imgElement.classList.add('d-block', 'w-100');
        imgElement.style.width = '500px'; 
        imgElement.style.height = '300px';
        // Highlight the first image
        if (index === 0) {
            carouselItem.classList.add('active');
        }

        carouselItem.appendChild(imgElement);
        roomImageCarousel.appendChild(carouselItem);
    });

    // Create a row of thumbnail images at the bottom
    const roomImageContainer = document.getElementById('roomImageContainer');
    roomImageContainer.innerHTML = '';
    imgPathsArray.forEach((imgPath, index) => {
        const thumbnail = document.createElement('img');
        thumbnail.src = imgPath;
        thumbnail.classList.add('thumbnail-img');
        thumbnail.addEventListener('click', () => showSelectedImage(index));

        roomImageContainer.appendChild(thumbnail);
    });

    // Show the modal
    $('#roomModal').modal('show');
}

// Function to highlight the selected image
function showSelectedImage(index) {
    const roomImageCarousel = new bootstrap.Carousel(document.getElementById('roomImageCarousel'), {
        interval: false
    });
    roomImageCarousel.to(index);
}


// Function to get status color
function getStatusColor(status) {
    switch (status) {
        case 'Vacant':
            return 'green'; 
        case 'Reserved':
            return 'orange'; 
        case 'Occupied':
            return 'red'; 
        default:
            return 'black'; 
    }
}

// function showReservationModal(event, room_id, name, description, bedtype, pax, price, reservations) {
//     event.preventDefault();
//     event.stopPropagation();
//     const reservationModalTitle = document.getElementById('reservationModalTitle');
//     const reservationModalPax = document.getElementById('reservationModalPax');
//     const reservationModalType = document.getElementById('reservationModalType');
//     const reservationModalPrice = document.getElementById('reservationModalPrice');
//     const reservationModalDescription = document.getElementById('reservationModalDescription');

//     const roomId = document.getElementById('room_id');
//     roomId.value = room_id;
//     reservationModalTitle.textContent = `Reserve ${name}`;
//     reservationModalDescription.textContent = `${description}`;

//     reservationModalPax.textContent = `Pax: ${pax}`;
//     reservationModalType.textContent = `Type: ${bedtype}`;
//     reservationModalPrice.textContent = `Price: ₱${price}/day`;

//     // Get checkinDate and checkoutDate elements
//     const checkinDateInput = document.getElementById('checkinDate');
//     const checkoutDateInput = document.getElementById('checkoutDate');

//     // Disable past dates in checkinDate and checkoutDate
//     const today = new Date().toISOString().split('T')[0];
//     checkinDateInput.setAttribute('min', today);
//     checkoutDateInput.setAttribute('min', today);

    
//     reservations.forEach(reservation => {
//         const startDate = new Date(reservation.checkin_date);
//         const endDate = new Date(reservation.checkout_date);

//         let currentDate = startDate;
//         while (currentDate <= endDate) {
//             const dateString = currentDate.toISOString().split('T')[0];
//             const dateInput = document.querySelector(`input[type="date"][value="${dateString}"]`);
//             if (dateInput) {
//                 dateInput.setAttribute('disabled', true);
//             }
//             currentDate.setDate(currentDate.getDate() + 1); // Move to the next day
//         }
//     });

//     // Show the reservation modal
//     $('#reservationModal').modal('show');
// }


const createReservationForm = document.getElementById('createReservationForm');

createReservationForm.addEventListener('submit', function (event) {
    event.preventDefault();
    
    const room_id = document.getElementById('room_id').value;
    const name = document.getElementById('residentName').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    const sex = document.getElementById('residentSex').value;
    const address = document.getElementById('address').value;
    const contacts = document.getElementById('phone').value;
    const birthdate = document.getElementById('birthdate').value;
    const validId = document.getElementById('validId').value;
    const imgPathInput = document.getElementById('img_path');
    const imgPath = imgPathInput.files[0];
    const checkin_date = document.getElementById('checkinDate').value;
    const checkout_date = document.getElementById('checkoutDate').value;
    const downPayment = parseFloat(document.getElementById('downPaymentInfo').textContent.replace('50% Downpayment: ₱', '').replace(',', ''));
    const totalPayment = parseFloat(document.getElementById('paymentInfo').textContent.replace('Total Payment: ₱', '').replace(',', ''));
    const receipt = document.getElementById('payments').files[0];


    const formData = new FormData();
    formData.append('name', name);
    formData.append('email', email);
    formData.append('password', password);

    formData.append('sex', sex);
    formData.append('address', address);
    formData.append('contacts', contacts);
    formData.append('birthdate', birthdate);
    formData.append('validId', validId);
    formData.append('img_path', imgPath);
    formData.append('room_id', room_id);
    formData.append('checkin_date', checkin_date);
    formData.append('downPayment', downPayment);
    formData.append('checkout_date', checkout_date);
    formData.append('totalPayment', totalPayment);
    formData.append('downreceipt', receipt);



    fetch('/api/createReservation', {
        method: 'POST',
        headers: {         
            'Accept': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        credentials: 'include',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        console.log('Reservation created successfully:', data);

        $('#reservationModal').modal('hide');

        // Clear form values
        createReservationForm.reset();

        fetchHostelRooms();

        Swal.fire({
            icon: 'success',
            title: 'Reservation Created',
            text: 'Your reservation has been successfully created.',
        });
    })
    .catch(error => {
        console.error('Error creating reservation:', error);

        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while creating the reservation. Please try again.',
        });
    });
});


function recalculatePayment() {
    const checkinDate = document.getElementById('checkinDate').value;
    const checkoutDate = document.getElementById('checkoutDate').value;

    // Check if both check-in and check-out dates are selected
    if (checkinDate && checkoutDate) {
        // Calculate the number of days between check-in and check-out
        const oneDay = 24 * 60 * 60 * 1000; // hours * minutes * seconds * milliseconds
        const checkinTimestamp = new Date(checkinDate).getTime();
        const checkoutTimestamp = new Date(checkoutDate).getTime();
        const numberOfDays = Math.round(Math.abs((checkoutTimestamp - checkinTimestamp) / oneDay));

        // Assuming room price is per day, calculate the total payment
        const roomPricePerDay = parseFloat(document.getElementById('reservationModalPrice').textContent.replace('Price: ₱', '').replace('/day', ''));
        const totalPayment = numberOfDays * roomPricePerDay;

        // Calculate 50% downpayment
        const downpayment = totalPayment * 0.5;

        // Display the recalculated payment and downpayment
        const paymentInfo = document.getElementById('paymentInfo');
        paymentInfo.textContent = `Total Payment: ₱${totalPayment}`;
        
        const downPaymentInfo = document.getElementById('downPaymentInfo');
        downPaymentInfo.textContent = `50% Downpayment: ₱${downpayment}`;
    }
}

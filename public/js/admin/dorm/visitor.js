document.addEventListener('DOMContentLoaded', function () {
    fetchVisitors();
});



function fetchVisitors() {
    const token = localStorage.getItem('token');

    fetch('/api/getVisitors', {
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
        const visitorTableBody = document.querySelector('#visitorTableBody');
        visitorTableBody.innerHTML = '';

        data.visitors.forEach(visitor => {
          
                const row = `
                    <td>${visitor.id}</td>
                    <td>${visitor.name}</td>
                    <td>${visitor.phone}</td>
                    <td>${visitor.visit_date}</td>
                    <td>${visitor.name}</td>
                    <td>${visitor.relationship}</td>
                    <td>${visitor.purpose}</td>
                `;
                visitorTableBody.innerHTML += row;
            }
        );
    })
    .catch(error => console.error('Error fetching visitors:', error));
}

// function viewDetails(visitorId, roomName, checkin_date, checkout_date, name, email, contacts, status, img) {

//     // Display visitor details in a modal or any other preferred way
//     const visitorDetailsModal = document.getElementById('visitorDetailsModal');
//     const modalBody = visitorDetailsModal.querySelector('.modal-body');

//     modalBody.innerHTML = `
//         <p><strong>Visitor ID:</strong> ${visitorId}</p>
//         <p><strong>Room Name:</strong> ${roomName}</p>
//         <p><strong>Check-in Date:</strong> ${checkin_date}</p>
//         <p><strong>Checkout Date:</strong> ${checkout_date}</p>
//         <p><strong>Name:</strong> ${name}</p>
//         <p><strong>Email:</strong> ${email}</p>
//         <p><strong>Contacts:</strong> ${contacts}</p>
//         <p><strong>Status:</strong> ${status}</p>
//     `;

//     $('#visitorDetailsModal').modal('show');
// }

    
// function updateVisitor(visitorId, roomName, checkin_date, checkout_date, name, email, contacts, status, img) {
//     const visitorImage = document.getElementById('visitorImage');
//     const resId = document.getElementById('resId');

//     const resRoomName = document.getElementById('resRoomName');
//     const resCheckin = document.getElementById('resCheckin');
//     const resCheckout = document.getElementById('resCheckout');
//     const resName = document.getElementById('resName');
//     const resEmail = document.getElementById('resEmail');
//     const resContacts = document.getElementById('resContacts');
//     const resStatus = document.getElementById('resStatus');

//     visitorImage.src = img; // Set the image source
//     resId.textContent = visitorId;
//     resRoomName.textContent = roomName;
//     resCheckin.textContent = checkin_date;
//     resCheckout.textContent = checkout_date;
//     resName.textContent = name;
//     resEmail.textContent = email;
//     resContacts.textContent = contacts;
//     resStatus.value = status; // Set the status value


//     $('#updateVisitorModal').modal('show');
// }
// function promptRating(visitorId) {
//     const review = prompt("Please enter your review:");
//     if (review !== null) {
//         // User clicked OK, now prompt for rating
//         const rating = prompt("Please enter your rating (1-5):");
//         if (rating !== null) {
//             // User clicked OK, now send review and rating to the server
//             sendRating(visitorId, review, parseInt(rating));
//         }
//     }
// }

// // function sendRating(visitorId, review, rating) {
// //     fetch(`/api/sendRating?visitorId=${visitorId}&review=${review}&rating=${rating}`, {
// //         method: 'GET',
// //         headers: {
// //             'Content-Type': 'application/json',
// //             'Accept': 'application/json',
// //             'Authorization': `Bearer ${token}`,
// //         },
// //         credentials: 'include',
// //     })
// //     .then(response => {
// //         if (response.ok) {
// //             $('#updateVisitorModal').modal('hide'); 
// //             fetchVisitors(); 
// //         } else {
// //             // Handle error
// //             throw new Error('Failed to sending reviews');
// //         }
// //     })
// //     .catch(error => console.error('Error SENDING reviews:', error));
// // }
// function updateStatus() {
//     const token = localStorage.getItem('token');
//     const resId = document.getElementById('resId').textContent;
//     const newStatus = document.getElementById('resStatus').value;

//     fetch(`/api/updateVisitorStatus?visitorId=${resId}&newStatus=${newStatus}`, {
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
//             $('#updateVisitorModal').modal('hide'); 
//             fetchVisitors(); 
//         } else {
//             // Handle error
//             throw new Error('Failed to update status');
//         }
//     })
//     .catch(error => console.error('Error updating status:', error));
// }

// function checkoutVisitor(resId) {
//     const token = localStorage.getItem('token');

//     fetch(`/api/checkoutVisitor?visitorId=${resId}`, {
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
//             fetchVisitors(); 
//         } else {
//             // Handle error
//             throw new Error('Failed to update status');
//         }
//     })
//     .catch(error => console.error('Error updating status:', error));
// }

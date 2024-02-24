document.addEventListener('DOMContentLoaded', function () {
    fetchPayments();

    const createPaymentForm = document.getElementById('createPaymentForm');
    createPaymentForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const titleInput = document.getElementById('paymentTitle');
        const contentInput = document.getElementById('paymentContent');

        const title = titleInput.value;
        const content = contentInput.value;

        const formData = {
            title: title,
            content: content,
        };

        const token = localStorage.getItem('token');

        fetch('/api/payment', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`,
            },
            credentials: 'include',
            body: JSON.stringify(formData),
        })
        .then(response => response.json())
        .then(data => {
            console.log('Payment created successfully:', data);

            $('#createPaymentModal').modal('hide');

            titleInput.value = '';
            contentInput.value = '';

            fetchPayments();

            Swal.fire({
                icon: 'success',
                title: 'Payment Created',
                text: 'Your payment has been successfully created.',
            });
        })
        .catch(error => {
            console.error('Error creating payment:', error);

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while creating the payment. Please try again.',
            });
        });
    });

    const paymentsContainer = document.getElementById('payments-container');
    paymentsContainer.addEventListener('click', function (event) {
        const target = event.target;
        const paymentId = target.dataset.paymentId;

        if (target.classList.contains('update-btn')) {
            openUpdateModal(paymentId);
        } else if (target.classList.contains('delete-btn')) {
            confirmDelete(paymentId);
        }
    });
});

const updatePaymentForm = document.getElementById('updatePaymentForm');
updatePaymentForm.addEventListener('submit', function (event) {
    event.preventDefault();

    const updateTitleInput = document.getElementById('updateTitleInput');
    const updateContentInput = document.getElementById('updateContentInput');
    const paymentId = updatePaymentForm.dataset.paymentId; // Add a data attribute to store payment ID

    const updatedFormData = {
        title: updateTitleInput.value,
        content: updateContentInput.value,
    };

    const token = localStorage.getItem('token');

    fetch(`/api/updatePayment/${paymentId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}`,
        },
        credentials: 'include',
        body: JSON.stringify(updatedFormData),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Payment updated successfully:', data);

        $('#updatePaymentModal').modal('hide');

        updateTitleInput.value = '';
        updateContentInput.value = '';

        fetchPayments();

        Swal.fire({
            icon: 'success',
            title: 'Payment Updated',
            text: 'Your payment has been successfully updated.',
        });
    })
    .catch(error => {
        console.error('Error updating payment:', error);

        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while updating the payment. Please try again.',
        });
    });
});


function openUpdateModal(paymentId) {
    const updatePaymentForm = document.getElementById('updatePaymentForm');
    updatePaymentForm.dataset.paymentId = paymentId; // Set payment ID in the form's data attribute

    const updateTitleInput = document.getElementById('updateTitleInput');
    const updateContentInput = document.getElementById('updateContentInput');

    const token = localStorage.getItem('token');

    fetch(`/api/getPayment/${paymentId}`, {
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
        // Populate the update modal fields with the retrieved data
        updateTitleInput.value = data.payment.title;
        updateContentInput.value = data.payment.content;

        // Show the update modal
        $('#updatePaymentModal').modal('show');
    })
    .catch(error => {
        console.error('Error fetching payment details:', error);

        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while fetching payment details. Please try again.',
        });
    });
}

function confirmDelete(paymentId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            deletePayment(paymentId);
        }
    });
}

function deletePayment(paymentId) {
    const token = localStorage.getItem('token');

    fetch(`/api/deletePayment/${paymentId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}`,
        },
        credentials: 'include',
    })
    .then(response => response.json())
    .then(data => {
        console.log('Payment deleted successfully:', data);

        fetchPayments();

        Swal.fire({
            icon: 'success',
            title: 'Payment Deleted',
            text: 'Your payment has been successfully deleted.',
        });
    })
    .catch(error => {
        console.error('Error deleting payment:', error);

        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while deleting the payment. Please try again.',
        });
    });
}

function fetchPayments() {
    const token = localStorage.getItem('token');

    fetch(`/api/myPaymentHistory`, {
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
        console.log('Payments data:', data); 
        const paymentsContainer = document.getElementById('payments-container');
        paymentsContainer.innerHTML = '';

        data.forEach(payment => {
            // Create a card for each payment
            const paymentCard = document.createElement('div');
            paymentCard.classList.add('card', 'mb-3');

            // Set background color based on status
            if (payment.status === 'PAID') {
                paymentCard.classList.add('bg-lightgreen'); // Use light green for PAID
            } else if (payment.status === 'Pending') {
                paymentCard.classList.add('bg-lightred'); // Use light red for Pending
            }

            const cardBody = document.createElement('div');
            cardBody.classList.add('card-body', 'd-flex', 'justify-content-between', 'align-items-center');

            const paymentDetails = document.createElement('div');
            paymentDetails.classList.add('d-flex', 'flex-column');

            // Display paidDate only if the status is PAID
            if (payment.status === 'PAID') {
                const formattedDate = new Date(payment.paidDate).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                const dateElement = document.createElement('h6');
                dateElement.textContent = formattedDate;
                paymentDetails.appendChild(dateElement);
            }

            const receiptElement = document.createElement('h4');
            receiptElement.textContent = payment.receipt;
            paymentDetails.appendChild(receiptElement);

            const amountElement = document.createElement('h6');
            amountElement.textContent = `₱${payment.totalAmount}`;
            paymentDetails.appendChild(amountElement);

            cardBody.appendChild(paymentDetails);

            // Indicate the payment status
            const statusElement = document.createElement('h6');
            statusElement.textContent = payment.status;
            cardBody.appendChild(statusElement);

            paymentCard.appendChild(cardBody);

            paymentsContainer.appendChild(paymentCard);
        });
    })
    .catch(error => console.error('Error fetching payments:', error));
}

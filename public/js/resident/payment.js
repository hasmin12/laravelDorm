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

        fetch('/api/createPayment', {
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

// function fetchPayments() {

//     const token = localStorage.getItem('token');

//     fetch(`/api/myPaymentHistory`, {
//         method: 'GET',
//         headers: {
//             'Content-Type': 'application/json',
//             'Accept': 'application/json',
//             'Authorization': `Bearer ${token}`,
//         },
//         credentials: 'include',
//     })
//     .then(response => response.json())
//     .then(data => {
//         console.log('Payments data:', data);
//         const paymentsContainer = document.getElementById('payments-container');
//         paymentsContainer.innerHTML = '';

//         // Create table element
//         const table = document.createElement('table');
//         table.classList.add('table', 'table-bordered', 'table-hover', 'custom-table');

//         // Create table header
//         const tableHeader = document.createElement('thead');
//         tableHeader.innerHTML = `
//             <tr class="table-dark">
//                 <th>Receipt</th>
//                 <th>Total Amount</th>
//                 <th>Status</th>
//                 <th>Paid Date</th>
//             </tr>
//         `;
//         table.appendChild(tableHeader);

//         // Create table body
//         const tableBody = document.createElement('tbody');
//         data.forEach(payment => {
//             const row = document.createElement('tr');

//             const receiptCell = document.createElement('td');
//             receiptCell.textContent = payment.receipt;
//             row.appendChild(receiptCell);

//             const amountCell = document.createElement('td');
//             amountCell.textContent = `₱${payment.totalAmount}`;
//             row.appendChild(amountCell);

//             const statusCell = document.createElement('td');
//             statusCell.textContent = payment.status;
//             row.appendChild(statusCell);

//             const paidDateCell = document.createElement('td');
//             if (payment.status === 'PAID') {
//                 const formattedDate = new Date(payment.paidDate).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
//                 paidDateCell.textContent = formattedDate;
//             } else {
//                 paidDateCell.textContent = '-';
//             }
//             row.appendChild(paidDateCell);

//             tableBody.appendChild(row);
//         });
//         table.appendChild(tableBody);

//         paymentsContainer.appendChild(table);
//     })
//     .catch(error => console.error('Error fetching payments:', error));

//     // Event listener for Bills button
//     const billsButton = document.getElementById('billsButton');
//     billsButton.addEventListener('click', () => {
//         filterPayments('Pending');
//     });

//     // Event listener for History button
//     const historyButton = document.getElementById('historyButton');
//     historyButton.addEventListener('click', () => {
//         filterPayments('PAID');
//     });
// }


// function filterPayments(status) {
//     const rows = document.querySelectorAll('#payments-container table tbody tr');
//     rows.forEach(row => {
//         const rowStatus = row.querySelector('td:nth-child(3)').textContent.trim();
//         if (rowStatus === status) {
//             row.style.display = 'table-row';
//         } else {
//             row.style.display = 'none';
//         }
//     });
// }

// // Call fetchPayments function when the page loads
// window.onload = fetchPayments;


// function fetchPayments() {
//     const token = localStorage.getItem('token');

//     fetch(`/api/myPaymentHistory`, {
//         method: 'GET',
//         headers: {
//             'Content-Type': 'application/json',
//             'Accept': 'application/json',
//             'Authorization': `Bearer ${token}`,
//         },
//         credentials: 'include',
//     })
//     .then(response => response.json())
//     .then(data => {
//         console.log('Payments data:', data);
//         const paymentsContainer = document.getElementById('payments-container');
//         paymentsContainer.innerHTML = '';

//         // Create table element
//         const table = document.createElement('table');
//         table.classList.add('table', 'table-bordered', 'table-hover', 'custom-table');

//         // Create table header
//         const tableHeader = document.createElement('thead');
//         tableHeader.innerHTML = `
//             <tr class="table-dark">
//                 <th>Receipt</th>
//                 <th>Total Amount</th>
//                 <th>Status</th>
//                 <th>Paid Date</th>
//             </tr>
//         `;
//         table.appendChild(tableHeader);

//         // Create table body
//         const tableBody = document.createElement('tbody');
//         data.forEach(payment => {
//             const row = document.createElement('tr');

//             const receiptCell = document.createElement('td');
//             receiptCell.textContent = payment.receipt;

//             // Add upload receipt button for pending payments
//             if (payment.status === 'Pending') {
//                 const uploadButton = document.createElement('button');
//                 uploadButton.textContent = 'Upload Receipt';
//                 uploadButton.classList.add('btn', 'btn-primary', 'upload-button');
//                 uploadButton.setAttribute('data-toggle', 'modal');
//                 uploadButton.setAttribute('data-target', '#uploadModal');
//                 uploadButton.addEventListener('click', () => openModal(payment.receipt)); // Passing receipt info

//                 // Append upload button to receipt cell
//                 receiptCell.appendChild(uploadButton);
//             }

//             row.appendChild(receiptCell);

//             const amountCell = document.createElement('td');
//             amountCell.textContent = `₱${payment.totalAmount}`;
//             row.appendChild(amountCell);

//             const statusCell = document.createElement('td');
//             statusCell.textContent = payment.status;
//             row.appendChild(statusCell);

//             const paidDateCell = document.createElement('td');
//             if (payment.status === 'PAID') {
//                 const formattedDate = new Date(payment.paidDate).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
//                 paidDateCell.textContent = formattedDate;
//             } else {
//                 paidDateCell.textContent = '-';
//             }
//             row.appendChild(paidDateCell);

//             tableBody.appendChild(row);
//         });
//         table.appendChild(tableBody);

//         paymentsContainer.appendChild(table);
//     })
//     .catch(error => console.error('Error fetching payments:', error));

//     // Event listener for Bills button
//     const billsButton = document.getElementById('billsButton');
//     billsButton.addEventListener('click', () => {
//         filterPayments('Pending');
//     });

//     // Event listener for History button
//     const historyButton = document.getElementById('historyButton');
//     historyButton.addEventListener('click', () => {
//         filterPayments('PAID');
//     });
// }

// function openModal(receipt) {
//     // Clear previous form data
//     document.getElementById('uploadForm').reset();

//     // Set receipt information in the modal if needed
//     // For example:
//     // document.getElementById('receiptInfo').textContent = receipt;

//     // Open the modal
//     $('#uploadModal').modal('show');

//     // Handle form submission
//     const uploadForm = document.getElementById('uploadForm');
//     uploadForm.addEventListener('submit', function(event) {
//         event.preventDefault();

//         // Get the uploaded file
//         const file = document.getElementById('receiptFile').files[0];

//         // Here you can implement the logic to handle the file upload
//         // For example, you can use FormData to send the file to the server via AJAX
//         const formData = new FormData();
//         formData.append('receiptFile', file);
        
//         // Example: Sending the file using fetch
//         fetch('/api/uploadReceipt', {
//             method: 'POST',
//             body: formData,
//             headers: {
//                 'Authorization': `Bearer ${localStorage.getItem('token')}`
//             }
//         })
//         .then(response => {
//             if (response.ok) {
//                 // Handle successful upload
//                 console.log('Receipt uploaded successfully!');
//                 // Close the modal
//                 $('#uploadModal').modal('hide');
//             } else {
//                 // Handle error
//                 console.error('Failed to upload receipt:', response.statusText);
//                 // You can display an error message to the user if needed
//             }
//         })
//         .catch(error => {
//             console.error('Error uploading receipt:', error);
//             // You can display an error message to the user if needed
//         });
//     });
// }

// // Call fetchPayments function when the page loads
// window.onload = fetchPayments;




function fetchPayments() {
    const token = localStorage.getItem('token');
    let filterPayment = 'Pending'; // Initialize filterPayment

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

        const billsButton = document.getElementById('billsButton');
        billsButton.addEventListener('click', () => {
            filterPayment = 'Pending';
            filterPayments('Pending');
        });
    
        // Event listener for History button
        const historyButton = document.getElementById('historyButton');
        historyButton.addEventListener('click', () => {
            filterPayment = 'PAID';
            filterPayments('PAID');
        });

        // Create table element
        const table = document.createElement('table');
        table.classList.add('table', 'table-bordered', 'table-hover', 'custom-table');

        // Create table head
        const tableHeader = document.createElement('thead');
        console.log(filterPayment)
        tableHeader.innerHTML = `
            <tr class="table-dark">
                <th>Receipt</th>
                <th>Payment Month</th>
                <th>Total Amount</th>
                <th>Status</th>
            </tr>
        `;
        table.appendChild(tableHeader);

        // Create table body
        const tableBody = document.createElement('tbody');
        data.forEach(payment => {
            const row = document.createElement('tr');

            const receiptCell = document.createElement('td');
            receiptCell.textContent = payment.receipt;

            // Add upload receipt button for pending payments
            if (payment.status === 'Pending') {
                const uploadButton = document.createElement('button');
                uploadButton.textContent = 'Upload Receipt';
                uploadButton.classList.add('btn', 'btn-primary', 'upload-button');
                uploadButton.setAttribute('data-toggle', 'modal');
                uploadButton.setAttribute('data-target', '#uploadModal');
                uploadButton.addEventListener('click', () => openModal(payment)); // Passing receipt info

                // Append upload button to receipt cell
                receiptCell.appendChild(uploadButton);
            }

            row.appendChild(receiptCell);

            const monthCell = document.createElement('td');
            monthCell.textContent = `${payment.payment_month}`;
            row.appendChild(monthCell);

            const amountCell = document.createElement('td');
            amountCell.textContent = `₱${payment.totalAmount}`;
            row.appendChild(amountCell);

            const statusCell = document.createElement('td');
            statusCell.textContent = payment.status;
            row.appendChild(statusCell);

            tableBody.appendChild(row);
        });
        table.appendChild(tableBody);

        paymentsContainer.appendChild(table);

       

        // Filter payments based on initial filter status
        filterPayments(filterPayment);
       
      

    })
    .catch(error => console.error('Error fetching payments:', error));

    // Event listener for Bills button
   
}

function filterPayments(status) {
    const rows = document.querySelectorAll('#payments-container table tbody tr');
    rows.forEach(row => {
        const rowStatus = row.querySelector('td:nth-child(4)').textContent.trim();
        if (rowStatus === status) {        
            row.style.display = 'table-row';
        } else {
            row.style.display = 'none';
        }
    });
}




// Call fetchPayments function when the page loads
window.onload = fetchPayments;

function openModal(payment) {
    // Clear previous form data
    document.getElementById('uploadForm').reset();

    // Set payment ID in a hidden input field
    console.log(payment)

    
        // Populate modal with payment details
        document.getElementById('payment_month').textContent = payment.payment_month;
        document.getElementById('total_amount').textContent = `₱${payment.totalAmount}`;
        document.getElementById('status').textContent = payment.status;
        document.getElementById('room_details').textContent = payment.roomdetails ? payment.roomdetails : '-';
        document.getElementById('electric_fan').textContent = payment.electricfan ? 'Yes' : 'No';
        document.getElementById('laptop').textContent = payment.laptop ? 'Yes' : 'No';



    // Open the modal
    $('#uploadModal').modal('show');

    // Fetch payment details by ID
   

    // Handle form submission
    const uploadForm = document.getElementById('uploadForm');
    uploadForm.addEventListener('submit', function(event) {
        event.preventDefault();

        // Get the uploaded file
        const file = document.getElementById('img_path').files[0];
        const receipt = document.getElementById('receipt').value;

        // Create FormData object and append file and payment_id
        const formData = new FormData();
        formData.append('receipt', receipt);
        formData.append('img_path', file);
        formData.append('payment_id', payment.id);

        // Send the file using fetch
        fetch('/api/createPayment', {
            method: 'POST',
            body: formData,
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            }
        })
        .then(response => {
            if (response.ok) {
                // Handle successful upload
                console.log('Receipt uploaded successfully!');
                // Close the modal
                $('#uploadModal').modal('hide');

                fetchPayments();

                Swal.fire({
                    icon: 'success',
                    title: 'Payment Success',
                    text: 'Your payment transaction complete.',
                });
            } else {
                // Handle error
                console.error('Failed to upload receipt:', response.statusText);
                // Display an error message to the user if needed
            }
        })
        .catch(error => {
            console.error('Error uploading receipt:', error);
            // Display an error message to the user if needed
        });
    });
}

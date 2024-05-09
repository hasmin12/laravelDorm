document.addEventListener('DOMContentLoaded', function () {
    fetchPayments();
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

const createAnnouncementForm = document.getElementById('uploadForm');
    createAnnouncementForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const idInput = document.getElementById('payment_id').value;
        const receipt = document.getElementById('receipt').value;
        const imageInput = $('#img_path')[0].files[0];



        const formData = new FormData();
        formData.append('payment_id', idInput);
        formData.append('receipt', receipt);
        formData.append('img_path', imageInput);

        const token = localStorage.getItem('token');

        $.ajax({
            url: '/api/createPayment',
            type: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            processData: false,  
            contentType: false,
            success: function (data) {

            $('#uploadModal').modal('hide');

            idInput.value = '';
            receipt.value = '';

            fetchPayments();

            Swal.fire({
                icon: 'success',
                title: 'Payment Success',
                text: 'Your payment has been successfully created.',
            });
        },
        error: function (error) {
            console.error('Error creating payment:', error);

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while creating the payment. Please try again.',
            });
        }
    });
});


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

function openModal(payment) {
    // Clear previous form data
    document.getElementById('uploadForm').reset();

    // Set payment ID in a hidden input field
    console.log(payment)

    
        // Populate modal with payment details
        document.getElementById('payment_id').value = payment.id;

        document.getElementById('payment_month').textContent = payment.payment_month;
        document.getElementById('total_amount').textContent = `₱${payment.totalAmount}`;
        document.getElementById('status').textContent = payment.status;
        document.getElementById('room_details').textContent = payment.roomdetails ? payment.roomdetails : '-';
        document.getElementById('electric_fan').textContent = payment.electricfan ? 'Yes' : 'No';
        document.getElementById('laptop').textContent = payment.laptop ? 'Yes' : 'No';



    // Open the modal
    $('#uploadModal').modal('show');
}
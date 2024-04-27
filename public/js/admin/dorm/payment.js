document.addEventListener('DOMContentLoaded', function () {

    const tableBody = document.getElementById('payments-body');
    const token = localStorage.getItem('token');
    const monthyeardropdown = document.getElementById('MY_dropdown');

    // Function to fetch all payments data
    function fetchAllPayments() {
        fetch('/api/getDormPayments', {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
            },
        })
            .then(response => response.json())
            .then(data => {
                // Populate table with all payments data
                populateTable(data.payments);

                // Populate dropdown with available month and year options
            })
            .catch(error => console.error('Error fetching payments:', error));
    }

    function paymentMonth() {
        fetch('/api/getDormPayments', {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
            },
        })
            .then(response => response.json())
            .then(data => {
                // Populate table with all payments data
                // Populate dropdown with available month and year options
                data.payment_month.forEach(payment_month => {
                    const option = document.createElement('option');
                    option.value = payment_month.payment_month;
                    option.textContent = payment_month.payment_month;
                    monthyeardropdown.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching payments:', error));
    }
    paymentMonth()
    // Function to populate table with payments data
    function populateTable(payments) {
        tableBody.innerHTML = ''; // Clear existing table rows

        payments.forEach(payment => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="text-dark">${payment.img_path}</td>
                <td class="text-dark">${payment.user_id}</td>
                <td class="text-dark">${payment.receipt}</td>
                <td class="text-dark">${payment.totalAmount}</td>
                <td class="text-dark">${payment.status}</td>
                <td class="text-dark">${payment.payment_month}</td>
            `;
            tableBody.appendChild(row);
        });
    }

    function displayPayment(monthyear) {
        // Filter payments based on selected month and year
        fetch('/api/getDormPayments', {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
            },
        })
        .then(response => response.json())
        .then(data => {
            const filteredPayments = data.payments.filter(payment => payment.payment_month === monthyear);
            // Populate table with filtered payments data
            populateTable(filteredPayments);
        })
        .catch(error => console.error('Error fetching payments:', error));
    }

    monthyeardropdown.addEventListener('change', function () {
        const selectedpaymentmonth = this.value; // Get the selected payment month and year
        if (selectedpaymentmonth === 'All') {
            fetchAllPayments(); // Display all payments
        } else {
            displayPayment(selectedpaymentmonth); // Display payments for the selected month and year
        }
    });

    // Initial fetch to populate the table with all payments
    fetchAllPayments();
});

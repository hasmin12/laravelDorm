document.addEventListener('DOMContentLoaded', function () {
    fetchNotifications();
   
    const notifs = document.querySelector('#notificationsRead');
    notifs.addEventListener('click', updateNotificationStatus);

    
})

function updateNotificationStatus() {
    const token = localStorage.getItem('token');

    fetch('/api/notificationRead', {
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
            console.log('Status updated successfully');
            fetchNotifications();
        } else {
            throw new Error('Error updating status');
        }
    })
    .catch(error => {
        console.error('Error updating status:', error);
    });
}
function fetchNotifications() {
    const token = localStorage.getItem('token');

    fetch(`/api/getNotifications`, {
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
            // Handle the received notifications
            displayNotifications(data.notifications);
        })
        .catch(error => console.error('Error fetching notifications:', error));
}

function displayNotifications(notifications) {
    const dropdownMenu = document.getElementById('notifications');
    dropdownMenu.innerHTML = ''; 
    const notificationCountBadge = document.getElementById('notification-count');

    const unreadNotificationsCount = notifications.filter(notification => notification.status === 'Unread').length;

if (unreadNotificationsCount > 0) {
    notificationCountBadge.textContent = unreadNotificationsCount;
    notificationCountBadge.style.display = 'inline';
} else {
    notificationCountBadge.style.display = 'none';
}
    notifications.forEach(notification => {
        const notificationItem = document.createElement('a');
        notificationItem.classList.add('dropdown-item');

        const title = document.createElement('h6');
        title.classList.add('fw-normal', 'mb-0','font-weight-bold');
        title.textContent = notification.notification_type;

        const sender = document.createElement('p');
        sender.textContent = `From: Admin`;

        // Check message length
        let messageText = notification.message;
        const maxLength = 80; 
        if (messageText.length > maxLength) {
            messageText = messageText.substring(0, maxLength) + '...'; // Truncate message
        }
        const message = document.createElement('p');
        message.textContent = messageText;

        const time = document.createElement('small');
        const createdAtDate = new Date(notification.created_at);
        const formattedDate = `${createdAtDate.toLocaleString('en-US', { month: 'short' })} ${createdAtDate.getDate()}, ${createdAtDate.getFullYear()} ${createdAtDate.toLocaleTimeString()}`;
        time.textContent = formattedDate;

        notificationItem.appendChild(title);
        notificationItem.appendChild(sender);
        notificationItem.appendChild(message);
        notificationItem.appendChild(time);

        if (notification.attachment) {
            const attachment = document.createElement('img');
            attachment.src = notification.attachment; // Assuming attachment is a URL
            attachment.classList.add('attachment');
            notificationItem.appendChild(attachment);
        }

        dropdownMenu.appendChild(notificationItem);

        const divider = document.createElement('hr');
        divider.classList.add('dropdown-divider');
        dropdownMenu.appendChild(divider);

        notificationItem.addEventListener('click', () => {
            if (notification.notification_type === "Monthly Payment") {
                window.location.href = "/resident/payments";
            } else {
                console.log('Notification clicked');
            }
        });
    });
}


//  Pusher.logToConsole = true;
    var pusher = new Pusher('468f37493652a7952193', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('notification-channel');
    channel.bind('NotificationEvent', function(data) {
        const email = localStorage.getItem('email');

       if (data.data.email==email){
            fetchNotifications();
            toastr.info('New Notification')
            if (data.data.notification_type=="Monthly Payment"){
                fetchPayments();
                }
       }
       
    });

    function fetchPayments() {
        const token = localStorage.getItem('token');
        let filterPayment = 'Pending'; 
    
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

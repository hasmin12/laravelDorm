document.addEventListener('DOMContentLoaded', function () {
    fetchNotifications();
  
    
})
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

    if (notifications.length > 0) {
        notificationCountBadge.textContent = notifications.length;
        notificationCountBadge.style.display = 'inline';
    } else {
        notificationCountBadge.style.display = 'none';
    }
    notifications.forEach(notification => {
        const notificationItem = document.createElement('a');
        notificationItem.classList.add('dropdown-item');

        const title = document.createElement('h6');
        title.classList.add('fw-normal', 'mb-0');
        title.textContent = notification.notification_type;

        const sender = document.createElement('p');
        sender.textContent = `From: ${notification.senderName}`;

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

       if (data.name==email){
            fetchNotifications();
            toastr.info('New Notification')
       }
    });

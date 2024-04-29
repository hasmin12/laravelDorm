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

    notifications.forEach(notification => {
        const notificationItem = document.createElement('a');
        notificationItem.classList.add('dropdown-item');
        const title = document.createElement('h6');
        title.classList.add('fw-normal', 'mb-0');
        title.textContent = notification.notification_type;
        const time = document.createElement('small');
        const createdAtDate = new Date(notification.created_at);
        const formattedDate = `${createdAtDate.toLocaleString('en-US', { month: 'short' })} ${createdAtDate.getDate()}, ${createdAtDate.getFullYear()} ${createdAtDate.toLocaleTimeString()}`;
        time.textContent = formattedDate;
        notificationItem.appendChild(title);
        notificationItem.appendChild(time);
        dropdownMenu.appendChild(notificationItem);

        const divider = document.createElement('hr');
        divider.classList.add('dropdown-divider');
        dropdownMenu.appendChild(divider);
    });

    // Add a link to see all notifications
    const seeAllLink = document.createElement('a');
    seeAllLink.href = '#';
    seeAllLink.classList.add('dropdown-item');
    seeAllLink.textContent = 'See all notifications';
    dropdownMenu.appendChild(seeAllLink);
}

// Pusher.logToConsole = true;

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

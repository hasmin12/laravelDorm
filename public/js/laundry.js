
document.addEventListener('DOMContentLoaded', function () {
    // Fetch laundry schedules from the controller
    const token = localStorage.getItem('token');
    fetchAndUpdateLaundrySchedules();

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        dayRender: function (date, cell) {
            if (date.isBefore(moment(), 'day')) {
                cell.addClass('fc-past-day');
            }
        },
        
    });

    
function fetchAndUpdateLaundrySchedules() {
    fetch(`/api/getLaundry`, {
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
        // Update FullCalendar events
        
        const events = data.map(schedule => ({
            title: schedule.title, // Assuming you have a 'user_name' field in your data
            start: schedule.laundrydate + 'T' + mapLaundryTimeToTimeRange(schedule.laundrytime), // Combine date and time
            allDay: false, // Assuming laundrytime represents specific times of the day
            // Add other properties as needed
        }));
        $('#calendar').fullCalendar('removeEvents');
        $('#calendar').fullCalendar('addEventSource', events);
        $('#calendar').fullCalendar('refetchEvents');
    })
    .catch(error => console.error('Error fetching and updating laundry schedules:', error));
}

function mapLaundryTimeToTimeRange(laundrytime) {
    // Map laundrytime text to time range
    switch (laundrytime.toLowerCase()) {
        case 'morning':
            return '09:00:00'; // Assuming morning starts at 9:00 AM
        case 'afternoon':
            return '14:00:00'; // Assuming afternoon starts at 2:00 PM
        case 'evening':
            return '18:00:00'; // Assuming evening starts at 6:00 PM
        default:
            return '00:00:00'; // Default to midnight
    }
}


});

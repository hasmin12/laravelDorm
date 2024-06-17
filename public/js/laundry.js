
document.addEventListener('DOMContentLoaded', function () {
    // Fetch laundry schedules from the controller
    const token = localStorage.getItem('token');
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
            const events = data.map(schedule => ({
                title: schedule.title,
                start: schedule.laundrydate + 'T' + mapLaundryTimeToTimeRange(schedule.laundrytime),
                allDay: false, 
            }));
            $('#calendar').fullCalendar('removeEvents');
            $('#calendar').fullCalendar('addEventSource', events);
            $('#calendar').fullCalendar('refetchEvents');
        })
    .catch(error => console.error('Error fetching laundry schedules:', error))
    .finally(() => {
        // Hide the spinner once data is loaded
        document.getElementById('spinner').classList.remove('show');
    });
});


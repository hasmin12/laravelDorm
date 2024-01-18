
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
            // Initialize FullCalendar
            $('#calendar').fullCalendar({
                events: data, // Assuming your controller returns laundry schedules in the required format
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                // Add other FullCalendar configurations as needed
            });
        })
    .catch(error => console.error('Error fetching laundry schedules:', error))
    .finally(() => {
        // Hide the spinner once data is loaded
        document.getElementById('spinner').classList.remove('show');
    });
});


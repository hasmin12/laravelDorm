document.addEventListener('DOMContentLoaded', function () {
    // Fetch laundry schedules from the controller
    const token = localStorage.getItem('token');
    fetchAndUpdateLaundrySchedules();

    // Initialize FullCalendar
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        // Add other FullCalendar configurations as needed
        dayClick: function (date, jsEvent, view) {
            // Show modal for scheduling laundry
            showLaundryModal(date);
        }
    });

    const createLaundryScheduleForm = $('#createLaundryScheduleForm');

    createLaundryScheduleForm.submit(function (event) {
        event.preventDefault();
    
        const laundryTimeInput = $('#laundryTime');
        const scheduleDateInput = $('#scheduleDate');
    
        const laundryTime = laundryTimeInput.val();
        const laundryDate = scheduleDateInput.val();
    
        const formData = new FormData();
        formData.append('laundryTime', laundryTime);
        formData.append('laundryDate', laundryDate);
    
        $.ajax({
            url: '/api/laundryschedule', // Update the URL to match your API endpoint for laundry scheduling
            type: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token,
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log('Laundry schedule created successfully:', data);
    
                $('#createLaundryScheduleModal').modal('hide');
    
                // Fetch and update laundry schedules after creating a new schedule
                fetchAndUpdateLaundrySchedules();
    
                if (data.message) {
                    // User is already scheduled, display the custom message
                    Swal.fire({
                        icon: 'warning',
                        title: 'Already Scheduled',
                        text: data.message,
                    });
                } else {
                    // Display success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Laundry Schedule Created',
                        text: 'Your laundry schedule has been successfully created.',
                    });
                }
            },
            error: function (error) {
                console.error('Error creating laundry schedule:', error);
    
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while creating the laundry schedule. Please try again.',
                });
            }
        });
    });
    

    // Function to fetch laundry schedules and update the FullCalendar
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
            $('#calendar').fullCalendar('removeEvents');
            $('#calendar').fullCalendar('addEventSource', data);
            $('#calendar').fullCalendar('refetchEvents');
        })
        .catch(error => console.error('Error fetching and updating laundry schedules:', error));
    }
});

function showLaundryModal(date) {
    const formattedDate = date.format("YYYY-MM-DD");
    $('#scheduleDate').val(formattedDate); 

    // Show the modal
    $('#createLaundryScheduleModal').modal('show');
}


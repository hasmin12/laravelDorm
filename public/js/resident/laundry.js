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
        dayRender: function (date, cell) {
            // Check if the date is in the past
            if (date.isBefore(moment(), 'day')) {
                // Date is in the past, add a CSS class to style it gray
                cell.addClass('fc-past-day');
            }
        },
        // Add other FullCalendar configurations as needed
        dayClick: function (date, jsEvent, view) {
            // Check if the clicked date is in the past
            if (date.isBefore(moment(), 'day')) {
                // Date is in the past, prevent default action
                return false;
            }
    
            // Date is not in the past, show modal for scheduling laundry
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
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
});

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

function showLaundryModal(date) {
    const formattedDate = date.format("YYYY-MM-DD");
    $('#scheduleDate').val(formattedDate); 

    // Show the modal
    $('#createLaundryScheduleModal').modal('show');
}


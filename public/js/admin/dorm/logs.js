$(document).ready(function() {
    // Function to fetch logs based on type and date
    function fetchLogs(type, date) {
        const token = localStorage.getItem('token');

        // Fetch logs and unique dates from the server
        $.ajax({
            url: "/api/admin/logs",
            method: "GET",
            headers: {
                'Authorization': `Bearer ${token}`,
            },
            data: { type: type }, // Include type parameter
            dataType: "json",
            beforeSend: function() {
                $('#spinner').addClass('show');
            },
            success: function(data) {
                $('#spinner').removeClass('show');
                console.log(data)
                if (data.success) {
                    // Clear existing table data
                    $('#logsTableBody').empty();

                    // Populate table with logs data
                    $.each(data.logs, function(index, log) {
                        var statusIcon = log.status === 'Active' ? '❌' : '✅'; // X emoji for "Active", check emoji for "Inactive"
                        var gatepassImage = log.gatepass ? '<button class="btn btn-secondary download-image" data-url="' + log.gatepass + '">Download Gatepass</button>' : ''; // Download button if gatepass image exists
                        var row = '<tr class="text-dark">' +
                            '<td><span class="status-icon">' + statusIcon + '</span></td>' + // Display X emoji for "Active", check emoji for "Inactive"
                            '<td>' + log.student_name + '</td>' +
                            '<td>' + log.leave_date + '</td>' +
                            '<td>' + log.expected_return + '</td>' +
                            '<td>' + log.return_date + '</td>' +
                            '<td>' + log.purpose + '</td>' +
                            '<td>' + gatepassImage + '</td>' +
                            '<td>' + log.status + '</td>' +
                            '<td>' + log.date_log + '</td>' +
                            '</tr>';
                        $('#logsTableBody').append(row);
                    });

                    // Populate dropdown menu with dates from the logs data
                    populateDateDropdown(data.logs.map(log => log.date_log), date);
                } else {
                    // Handle error
                    console.error(data.message);
                }
            },
            error: function(xhr, status, error) {
                $('#spinner').removeClass('show');
                console.error(error);
            }
        });
    }

    // Function to populate the dropdown menu with unique dates
    function populateDateDropdown(dates, selectedDate) {
        // Extract unique dates
        var uniqueDates = [...new Set(dates)];

        var dropdown = $('#dateDropdown');
        dropdown.empty();
        dropdown.append('<option value="">Select Date</option>'); // Add default option
        uniqueDates.forEach(function(date) {
            dropdown.append($('<option></option>').text(date));
        });
        // Set selected date if provided
        if (selectedDate) {
            dropdown.val(selectedDate);
        }
    }

    // Fetch logs data for default type and date
    fetchLogs('Leave', '');

    // Handle radio button change event
    $('input[name="branchRadiobtn"]').change(function() {
        var type = $(this).val();
        var date = $('#dateDropdown').val(); // Get selected date from dropdown
        fetchLogs(type, date);
    });

    // Handle dropdown change event
    $('#dateDropdown').change(function() {
        var type = $('input[name="branchRadiobtn"]:checked').val(); // Get selected type
        var date = $(this).val();
        fetchLogs(type, date);
    });

    // Handle click event for download image button
    $('#logsTableBody').on('click', '.download-image', function() {
        var imageUrl = $(this).data('url');
        // Trigger download for the image
        window.open(imageUrl, '_blank');
    });
});

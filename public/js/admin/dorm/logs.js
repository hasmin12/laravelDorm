$(document).ready(function() {
    const logsNameButtons = document.querySelectorAll('input[name="nameRadiobtn"]');
    logsNameButtons.forEach(button => button.addEventListener('change', () => fetchLogs()));

    function fetchLogs() {
        const logsName = document.querySelector('input[name="nameRadiobtn"]:checked').value;
        const LeaveTable = document.getElementById('LeaveTable');
        const SleepTable = document.getElementById('SleepTable');

        const LeaveTbody = document.getElementById('LeaveTbody');
        const SleepTbody = document.getElementById('SleepTbody');
        
        const token = localStorage.getItem('token');
        if (logsName == "Leave") {
            LeaveTable.style.display = "block"
            SleepTable.style.display = "none"
            SleepTbody.innerHTML = "";
            LeaveTbody.innerHTML = "";

            $.ajax({
                url: "/api/getAllLogs",
                method: "GET",
                headers: {
                    'Authorization': `Bearer ${token}`,
                },
                dataType: "json",
                beforeSend: function() {
                    $('#spinner').addClass('show');
                },
                success: function(data) {
                console.log(data)

                        data.forEach(logs => {
                            if (logs.name == "Leave") {
                                    const tableRow = `
                                    <tr class="text-dark">
                                    
                                        <td>${logs.user_id}</td>
                                        <td>${logs.purpose}</td>

                                        <td>${logs.leave_date}</td>
                                        <td>${logs.expectedReturn}</td>
                                        <td>${logs.return_date}</td>

                                        <td>${logs.status}</td>
                                        <td>${logs.gatepass}</td>
                                        
                                    </tr>
                                `;

                                LeaveTbody.insertAdjacentHTML('beforeend', tableRow);
                            }

                        })
                                        
                    $('#spinner').removeClass('show');

                },
                error: function(xhr, status, error) {
                    $('#spinner').removeClass('show');
                    console.error(error);
                }
            });
    }else{
        LeaveTable.style.display = "none"
        SleepTable.style.display = "block"
        LeaveTbody.innerHTML = "";
        SleepTbody.innerHTML = "";

        $.ajax({
            url: "/api/getAllSleepLogs",
            method: "GET",
            headers: {
                'Authorization': `Bearer ${token}`,
            },
            dataType: "json",
            beforeSend: function() {
                $('#spinner').addClass('show');
            },
            success: function(data) {
                const currentDate = new Date();
                const currentMonth = currentDate.getMonth() + 1; // Months are zero-based in JavaScript
            
                const daysInMonth = new Date(currentDate.getFullYear(), currentMonth, 0).getDate();
            
                const tableHeader = document.getElementById("SleepTable").getElementsByTagName("thead")[0].getElementsByTagName("tr")[0];
                for (let i = 1; i <= daysInMonth; i++) {
                    const th = document.createElement("th");
                    th.textContent = i;
                    tableHeader.appendChild(th);
                }
            
                const tbody = document.getElementById("SleepTable").getElementsByTagName("tbody")[0];
                tbody.innerHTML = ""; 
            
                data.attendance.forEach(attendance => {
                    const row = document.createElement("tr");
                
                    const nameTd = document.createElement("td");
                    nameTd.textContent = attendance.resident;
                    row.appendChild(nameTd);
                
                    for (let i = 0; i < daysInMonth; i++) {
                        const td = document.createElement("td");
                        const attendanceValue = attendance.attendance[data.currentMonth][i];
                        td.textContent = attendanceValue; 
                        if (attendanceValue === 'P') {
                            td.style.backgroundColor = 'lightgreen';
                        } else if (attendanceValue === 'A') {
                            td.style.backgroundColor = 'pink';
                        } else {
                            td.style.backgroundColor = 'lightblue';
                        }
                        row.appendChild(td);
                    }
                
                    tbody.appendChild(row);
                });
                
            
                $('#spinner').removeClass('show');
            },
            
            error: function(xhr, status, error) {
                $('#spinner').removeClass('show');
                console.error(error);
            }
        });
    }

    }

    function populateDateDropdown(dates, selectedDate) {
        var uniqueDates = [...new Set(dates)];

        var dropdown = $('#dateDropdown');
        dropdown.empty();
        dropdown.append('<option value="">Select Date</option>'); 
        uniqueDates.forEach(function(date) {
            dropdown.append($('<option></option>').text(date));
        });
        if (selectedDate) {
            dropdown.val(selectedDate);
        }
    }

    fetchLogs('Leave', '');

    $('input[name="branchRadiobtn"]').change(function() {
        var type = $(this).val();
        var date = $('#dateDropdown').val(); // Get selected date from dropdown
        fetchLogs(type, date);
    });

    $('#dateDropdown').change(function() {
        var type = $('input[name="branchRadiobtn"]:checked').val(); // Get selected type
        var date = $(this).val();
        fetchLogs(type, date);
    });

    $('#logsTableBody').on('click', '.download-image', function() {
        var imageUrl = $(this).data('url');
        window.open(imageUrl, '_blank');
    });
});

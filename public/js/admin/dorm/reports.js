document.addEventListener('DOMContentLoaded', function () {
    const changeButtons = document.querySelectorAll('input[name="btnradio"]');
    const reportBranch = document.querySelectorAll('input[name="branchbtnradio"]');
    const report = document.getElementById('report');
    const maintenanceDiv = document.getElementById('maintenance-reports');
    const visitorDiv = document.getElementById('visitors-reports');
    const laundryDiv = document.getElementById('laundry-reports');
    const hosteldiv = document.getElementById('hostel-reports');

    laundryDiv.style.display = 'none';
    hosteldiv.style.display = 'none';


    maintenanceDiv.style.display = 'none';
        visitorDiv.style.display = 'none';
    report.addEventListener('change', changeDiv); 

    

    reportBranch.forEach(button => button.addEventListener('change', () => changeBranch()));
    changeButtons.forEach(button => button.addEventListener('change', () => changeFilter()));
    document.getElementById('downloadPdfBtn').addEventListener('click', downloadResidentsReport);

    fetchResidentsReport();
    fetchLaundryReport();
    fetchMaintenanceReport();
    fetchVisitorsReport();
});

function changeDiv() {
    const reportValue = document.getElementById('report').value;
    const selectedBranch = document.querySelector('input[name="branchbtnradio"]:checked').value;

    // Get the div elements
    const residentDiv = document.getElementById('resident-reports');
    const hosteldiv = document.getElementById('hostel-reports');

    const maintenanceDiv = document.getElementById('maintenance-reports');
    const visitorDiv = document.getElementById('visitors-reports');
    const laundryDiv = document.getElementById('laundry-reports');

    const branchDiv = document.getElementById('branchDiv');

    if (reportValue === "Residents") {
        if(selectedBranch  === "Dormitory"){
            residentDiv.style.display = 'block';
            branchDiv.style.display = 'block';
            maintenanceDiv.style.display = 'none';
            visitorDiv.style.display = 'none';
            laundryDiv.style.display = 'none';
            hosteldiv.style.display = 'none';

        }else{
            residentDiv.style.display = 'none';
            branchDiv.style.display = 'block';
            maintenanceDiv.style.display = 'none';
            visitorDiv.style.display = 'none';
            laundryDiv.style.display = 'none';
            hosteldiv.style.display = 'block';
        }
        

    } else if (reportValue === "Maintenance") {
        residentDiv.style.display = 'none';
        branchDiv.style.display = 'none';
        maintenanceDiv.style.display = 'block';
        visitorDiv.style.display = 'none';
        laundryDiv.style.display = 'none';
        hosteldiv.style.display = 'none';


    } else if (reportValue === "Visitors") {
        residentDiv.style.display = 'none';
        branchDiv.style.display = 'none';
        maintenanceDiv.style.display = 'none';
        visitorDiv.style.display = 'block';
        laundryDiv.style.display = 'none';
        hosteldiv.style.display = 'none';

    }else{
        residentDiv.style.display = 'none';
        branchDiv.style.display = 'none';
        maintenanceDiv.style.display = 'none';
        visitorDiv.style.display = 'none';
        laundryDiv.style.display = 'block';
        hosteldiv.style.display = 'none';

    }
}

function changeBranch() {
    
    const reportValue = document.getElementById('report').value;
    const selectedBranch = document.querySelector('input[name="branchbtnradio"]:checked').value;

    const residentDiv = document.getElementById('resident-reports');
    const hosteldiv = document.getElementById('hostel-reports');



    const maintenanceDiv = document.getElementById('maintenance-reports');
    const visitorDiv = document.getElementById('visitors-reports');
    const laundryDiv = document.getElementById('laundry-reports');  
    fetchResidentsReport()
    const branchDiv = document.getElementById('branchDiv');
    if (reportValue === "Residents") {
        if(selectedBranch  === "Dormitory"){
            residentDiv.style.display = 'block';
            branchDiv.style.display = 'block';
            maintenanceDiv.style.display = 'none';
            visitorDiv.style.display = 'none';
            laundryDiv.style.display = 'none';
            hosteldiv.style.display = 'none';

        }else{
            residentDiv.style.display = 'none';
            branchDiv.style.display = 'block';
            maintenanceDiv.style.display = 'none';
            visitorDiv.style.display = 'none';
            laundryDiv.style.display = 'none';
            hosteldiv.style.display = 'block';
        }
       
        

    } 
}

function changeFilter() {
     if (reportValue === "Residents") {
         fetchResidentsReport();
    } else if (reportValue === "Maintenance") {
        fetchMaintenanceReport();

    } else if (reportValue === "Visitors") {
        fetchVisitorsReport();

    }else{
        fetchLaundryReport();
    }
}
function fetchResidentsReport() {
    const token = localStorage.getItem('token');
    const selectedBranch = document.querySelector('input[name="branchbtnradio"]:checked').value;

    const changeValue = document.querySelector('input[name="btnradio"]:checked').value;

    const formData = new FormData();
    formData.append('branch', selectedBranch);
    formData.append('change', changeValue);

    fetch(`/api/residentsReport?branch=${selectedBranch}&change=${changeValue}`, {
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + token,
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (selectedBranch=="Dormitory"){
            const residentTableBody = document.querySelector('#residentReportBody');
            residentTableBody.innerHTML = '';

            data.forEach(resident => {
                const createdAtDate = new Date(resident.created_at);
                const formattedCreatedAt = `${createdAtDate.getMonth() + 1}/${createdAtDate.getDate()}/${createdAtDate.getFullYear()}`;
                const row = `
                        <td>${resident.name}</td>
                        <td>${resident.email}</td>
                        <td>${resident.type}</td>
                        <td>${resident.birthdate}</td>
                        <td>${resident.sex}</td>
                        <td>${resident.contactNumber}</td>
                        <td>${formattedCreatedAt}</td>
                `;
                residentTableBody.innerHTML += row;
            });
        }else{
            const hostelReportBody = document.querySelector('#hostelReportBody');
            hostelReportBody.innerHTML = '';

            data.forEach(reservation => {
                const reservation_date = new Date(reservation.reservation_date);
                const checkin_date = new Date(reservation.checkin_date);
                const checkout_date = new Date(reservation.checkout_date);

                const formatResercation = `${reservation_date.getMonth() + 1}/${reservation_date.getDate()}/${reservation_date.getFullYear()}`;
                const formatCheckin = `${checkin_date.getMonth() + 1}/${checkin_date.getDate()}/${checkin_date.getFullYear()}`;
                const formatCheckout = `${checkout_date.getMonth() + 1}/${checkout_date.getDate()}/${checkout_date.getFullYear()}`;

                const row = `
                        <td>${reservation.name}</td>
                        <td>${reservation.roomName}</td>
                        <td>${reservation.totalPayment}</td>
                        <td>${formatResercation}</td>
                        <td>${formatCheckin}</td>
                        <td>${formatCheckout }</td>
                        <td>${reservation.status}</td>
                `;
                hostelReportBody.innerHTML += row;

            });
        }
    
    })
    .catch(error => {
        console.error('Error fetching residents report:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while fetching the residents report. Please try again.',
        });
    });
}

function fetchMaintenanceReport() {
    const token = localStorage.getItem('token');
    const selectedBranch = document.querySelector('input[name="branchbtnradio"]:checked').value;

    const changeValue = document.querySelector('input[name="btnradio"]:checked').value;

    const formData = new FormData();
    formData.append('branch', selectedBranch);
    formData.append('change', changeValue);

    fetch(`/api/maintenanceReport?branch=${selectedBranch}&change=${changeValue}`, {
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + token,
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const maintenanceReportBody = document.querySelector('#maintenanceReportBody');
        maintenanceReportBody.innerHTML = '';

            data.forEach(maintenance => {
                const requestDate = new Date(maintenance.request_date);
                const formattedRequestDate = `${requestDate.getMonth() + 1}/${requestDate.getDate()}/${requestDate.getFullYear()}`;
                const completedDate = new Date(maintenance.completed_date);
                const formattedCompletedDate = `${completedDate.getMonth() + 1}/${completedDate.getDate()}/${completedDate.getFullYear()}`;
                const row = `
                        <td>${maintenance.residentName}</td>
                        <td>${maintenance.room_number}</td>
                        <td>${maintenance.technicianName}</td>
                        <td>${maintenance.type}</td>
                        <td>${formattedRequestDate}</td>
                        <td>${formattedCompletedDate}</td>
                        <td>${maintenance.status}</td>

                `;
                maintenanceReportBody.innerHTML += row;
            });
    
    })
    .catch(error => {
        console.error('Error fetching residents report:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while fetching the residents report. Please try again.',
        });
    });
}

function fetchVisitorsReport() {
    const token = localStorage.getItem('token');
    const selectedBranch = document.querySelector('input[name="branchbtnradio"]:checked').value;

    const changeValue = document.querySelector('input[name="btnradio"]:checked').value;

    const formData = new FormData();
    formData.append('change', changeValue);

    fetch(`/api/visitorsReport?change=${changeValue}`, {
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + token,
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {

        const visitorReportBody = document.querySelector('#visitorReportBody');
        visitorReportBody.innerHTML = '';

            data.forEach(visitor => {
                const createdAtDate = new Date(visitor.visit_date);
                const formattedCreatedAt = `${createdAtDate.getMonth() + 1}/${createdAtDate.getDate()}/${createdAtDate.getFullYear()}`;
                const row = `
                        <td>${visitor.name}</td>
                        <td>${visitor.phone}</td>
                        <td>${formattedCreatedAt}</td>
                        <td>${visitor.residentName}</td>
                        <td>${visitor.relationship}</td>
                        <td>${visitor.purpose}</td>
                `;
                visitorReportBody.innerHTML += row;
            });
    
    })
    .catch(error => {
        console.error('Error fetching residents report:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while fetching the residents report. Please try again.',
        });
    });
}


function fetchLaundryReport() {
    const token = localStorage.getItem('token');
    const selectedBranch = document.querySelector('input[name="branchbtnradio"]:checked').value;

    const changeValue = document.querySelector('input[name="btnradio"]:checked').value;

    const formData = new FormData();
    formData.append('change', changeValue);

    fetch(`/api/laundryReport?branch=${selectedBranch}&change=${changeValue}`, {
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + token,
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log(data);
        const laundryReportBody = document.querySelector('#laundryReportBody');
        laundryReportBody.innerHTML = '';

            data.forEach(laundry => {
                const createdAtDate = new Date(laundry.created_at);
                const formattedCreatedAt = `${createdAtDate.getFullYear()}-${createdAtDate.getMonth() + 1}-${createdAtDate.getDate()}`;
                const row = `
                        <td>${laundry.name}</td>
                        <td>${laundry.laundrydate}</td>
                        <td>${laundry.laundrytime}</td>
                        <td>${laundry.status}</td>
                        <td>${formattedCreatedAt}</td>

                `;
                laundryReportBody.innerHTML += row;
            });
    
    })
    .catch(error => {
        console.error('Error fetching residents report:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while fetching the residents report. Please try again.',
        });
    });
}

function downloadResidentsReport() {
    const token = localStorage.getItem('token');
    const selectedBranch = document.querySelector('input[name="branchbtnradio"]:checked').value;
    const reportValue = document.getElementById('report').value;

    const changeValue = document.querySelector('input[name="btnradio"]:checked').value;
    if (reportValue === "Residents") {
        fetch(`/api/generateResidentsReport?branch=${selectedBranch}&change=${changeValue}`, {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token,
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.blob();
        })
        .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = 'residents_report.pdf';
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
        })
        .catch(error => {
            console.error('Error fetching residents report:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while fetching the residents report. Please try again.',
            });
        });

    } else if (reportValue === "Maintenance") {
        fetch(`/api/generateMaintenanceReport?branch=${selectedBranch}&change=${changeValue}`, {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token,
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.blob(); // Get the response as a Blob (binary data)
        })
        .then(blob => {
            // Create a link element, use it to download the PDF
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = 'Maintenance_report.pdf';
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
        })
        .catch(error => {
            console.error('Error fetching residents report:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while fetching the residents report. Please try again.',
            });
        });

    } else if (reportValue === "Visitors") {
        fetch(`/api/generateVisitorsReport?branch=${selectedBranch}&change=${changeValue}`, {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token,
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.blob(); // Get the response as a Blob (binary data)
        })
        .then(blob => {
            // Create a link element, use it to download the PDF
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = 'visitors_report.pdf';
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
        })
        .catch(error => {
            console.error('Error fetching residents report:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while fetching the residents report. Please try again.',
            });
        });

    }else{
        fetch(`/api/generateLaundryReport?change=${changeValue}`, {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token,
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.blob(); 
        })
        .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = 'laundry_schedule_report.pdf';
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
        })
        .catch(error => {
            console.error('Error fetching residents report:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while fetching the residents report. Please try again.',
            });
        });

    }
    
}





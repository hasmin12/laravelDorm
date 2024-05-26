document.addEventListener('DOMContentLoaded', function () {
    const changeButtons = document.querySelectorAll('input[name="btnradio"]');
    const reportBranch = document.querySelectorAll('input[name="branchbtnradio"]');
    const report = document.getElementById('report');
    const maintenanceDiv = document.getElementById('maintenance-reports');
    const visitorDiv = document.getElementById('visitors-reports');
    maintenanceDiv.style.display = 'none';
        visitorDiv.style.display = 'none';
    report.addEventListener('change', changeDiv); // Corrected event name

    reportBranch.forEach(button => button.addEventListener('change', () => fetchResidentsReport()));
    changeButtons.forEach(button => button.addEventListener('change', () => fetchResidentsReport()));
    document.getElementById('downloadPdfBtn').addEventListener('click', downloadResidentsReport);

    fetchResidentsReport();
});

function changeDiv() {
    const reportValue = document.getElementById('report').value;

    // Get the div elements
    const residentDiv = document.getElementById('resident-reports');
    const maintenanceDiv = document.getElementById('maintenance-reports');
    const visitorDiv = document.getElementById('visitors-reports');
    const branchDiv = document.getElementById('branchDiv');

    if (reportValue === "Residents") {
        residentDiv.style.display = 'block';
        branchDiv.style.display = 'block';
        maintenanceDiv.style.display = 'none';
        visitorDiv.style.display = 'none';
    } else if (reportValue === "Maintenance") {
        residentDiv.style.display = 'none';
        branchDiv.style.display = 'block';
        maintenanceDiv.style.display = 'block';
        visitorDiv.style.display = 'none';
    } else {
        residentDiv.style.display = 'none';
        branchDiv.style.display = 'none';
        maintenanceDiv.style.display = 'none';
        visitorDiv.style.display = 'block';
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
                const requestDate = new Date(resident.request_date);
                const formattedRequestDate = `${requestDate.getMonth() + 1}/${requestDate.getDate()}/${requestDate.getFullYear()}`;
                const completedDate = new Date(resident.completed_date);
                const formattedCompletedDate = `${completedDate.getMonth() + 1}/${completedDate.getDate()}/${completedDate.getFullYear()}`;
                const row = `
                        <td>${maintenance.residentName}</td>
                        <td>${maintenance.room_number}</td>
                        <td>${maintenance.technicianName}</td>
                        <td>${maintenance.type}</td>
                        <td>${formattedRequestDate}</td>
                        <td>${formattedCompletedDate}</td>
                        <td>${resident.status}</td>

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
                const createdAtDate = new Date(resident.visit_date);
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

    }else{
        fetch(`/api/generateVisitorsReport?change=${changeValue}`, {
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

    }
    
}





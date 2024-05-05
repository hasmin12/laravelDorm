document.addEventListener('DOMContentLoaded', function () {
    const reportBranch = document.getElementById('reportBranch');
    const changeButtons = document.querySelectorAll('input[name="btnradio"]');

    reportBranch.addEventListener('change', fetchResidentsReport);
    changeButtons.forEach(button => button.addEventListener('change', () => fetchResidentsReport()));
    document.getElementById('downloadPdfBtn').addEventListener('click', downloadPdf);

    fetchResidentsReport();
});


function fetchResidentsReport() {
    const token = localStorage.getItem('token');
    const selectedBranch = document.getElementById('reportBranch').value;
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
        document.getElementById('notPaidCount').innerText = data.notPaid;
        document.getElementById('paidCount').innerText = data.Paid;
        document.getElementById('lateFeeCount').innerText = data.lateFee;
        billingTable(data.report);
        billingChart(data.report);
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


function billingTable(data) {
    const residentReportBody = document.querySelector('#residentReportBody');

    residentReportBody.innerHTML = '';

    data.forEach(residentReport => {
        const row = `
            
                <td>${residentReport.billingId}</td>
                <td>${residentReport.residentName}</td>
                <td>${residentReport.roomdetails}</td>
                <td>${residentReport.totalAmount}</td>
                <td>${residentReport.updated_at}</td>

                <td>${residentReport.status}</td>

        `;
        residentReportBody.innerHTML += row;
    });

}

function billingChart(data) {
    var ctx = document.getElementById('billingChart').getContext('2d');
    if (window.billingChartInstance !== undefined) {
        window.billingChartInstance.destroy();
    }

    window.billingChartInstance = new Chart(ctx, {
        type: 'bar', 
        data: {
            labels: data.map(function(billing) { return billing.residentName; }),
            datasets: [{
                label: 'Total Amount',
                data: data.map(function(billing) { return billing.totalAmount; }),
                backgroundColor: 'rgba(54, 162, 235, 0.2)', 
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// Function to download content as PDF
function downloadPdf() {
    const pdfContent = document.getElementById('resident-reports');

    html2canvas(pdfContent).then(canvas => {
        const imgData = canvas.toDataURL('image/png');

        const pdf = new jsPDF();
        const pdfWidth = pdf.internal.pageSize.width;
        const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

        // Add logo
        const logoImg = new Image();
        logoImg.onload = function() {
            const logoHeight = 10; // Adjust logo height as needed
            const logoWidth = (this.width * logoHeight) / this.height;
            pdf.addImage(this, 'PNG', 10, 10, logoWidth, logoHeight);

            // Add header text
            const headerText = 'Resident Report'; // Modify header text as needed
            const headerHeight = 15; // Adjust header height as needed
            pdf.setFontSize(18);
            pdf.text(headerText, pdfWidth / 2, 10, { align: 'center' });

            // Add main content
            pdf.addImage(imgData, 'PNG', 0, headerHeight + logoHeight, pdfWidth, pdfHeight - headerHeight - logoHeight);

            pdf.save('resident_report.pdf');
        };
        logoImg.onerror = function(error) {
            console.error('Error loading logo:', error);
        };
        logoImg.src = '/img/dxtlogo.png'; 
    }).catch(error => {
        console.error('Error generating PDF:', error);
    });
}



// Attach click event listener to the download button

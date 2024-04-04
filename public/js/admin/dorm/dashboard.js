document.addEventListener('DOMContentLoaded', function () {
    fetchData();
    fetchResidentChart();
    fetchPaymentChart();

    const dashboardBranch = document.getElementById('dashboardBranch');

    dashboardBranch.addEventListener('change', fetchData);
});

function fetchData() {
    const token = localStorage.getItem('token');
    const selectedBranch = document.getElementById('dashboardBranch').value;

    fetch(`/api/getDashboardData?branch=${selectedBranch}`, {
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
        const residentDataDiv = document.getElementById('residentData');
        residentDataDiv.innerHTML = '';
        const roomDataDiv = document.getElementById('roomData');
        roomDataDiv.innerHTML = '';
        const monthlyRevenueDataDiv = document.getElementById('monthlyRevenueData');
        monthlyRevenueDataDiv.innerHTML = '';
        const totalDataDiv = document.getElementById('totalData');
        totalDataDiv.innerHTML = '';
        if (selectedBranch=="Dormitory"|| selectedBranch=="Hostel"){
            const residentP = document.createElement('p');
            residentP.classList.add('mb-2');
         
            residentP.textContent += 'Residents';
            const residentH = document.createElement('h6');
            residentH.textContent = data.dormResidents;
            residentH.classList.add('mb-0');
            const residentIcon = document.createElement('i');
            residentIcon.classList.add('fa', 'fa-user', 'ms-2');
            residentH.appendChild(residentIcon);
            residentDataDiv.appendChild(residentP);
            residentDataDiv.appendChild(residentH);
    
            
            const roomP = document.createElement('p');
            roomP.classList.add('mb-2');
           
            roomP.textContent += 'Rooms';
            
            const roomH = document.createElement('h6');
            roomH.textContent = data.totalRooms;
            roomH.classList.add('mb-0');
            const roomIcon = document.createElement('i');
            roomIcon.classList.add('fa', 'fa-door-open', 'me-2'); 
            roomH.appendChild(roomIcon);
            roomDataDiv.appendChild(roomP);
            roomDataDiv.appendChild(roomH);
    
            
            const monthlyRevenueP = document.createElement('p');
            monthlyRevenueP.textContent = 'Monthly Revenue';
            monthlyRevenueP.classList.add('mb-2');
            const monthlyRevenueH = document.createElement('h6');
            monthlyRevenueH.textContent = "₱" + data.monthlyRevenue; 
            monthlyRevenueH.classList.add('mb-0');
            monthlyRevenueDataDiv.appendChild(monthlyRevenueP);
            monthlyRevenueDataDiv.appendChild(monthlyRevenueH);
    
            
            const totalP = document.createElement('p');
            totalP.textContent = 'Total Revenue';
            totalP.classList.add('mb-2');
            const totalH = document.createElement('h6');
            totalH.textContent = "₱" + data.totalRevenue;
            totalH.classList.add('mb-0');
            totalDataDiv.appendChild(totalP);
            totalDataDiv.appendChild(totalH);
        }else{
            residentDataDiv.innerHTML = `
                <div class="ms-3">
                    <p class="mb-2">Residents</p>
                    <h6 class"mb-0">${data.totalResidents} <i class="fa fa-users me-2 "></i></h6>
                </div>
            `;
            
            roomDataDiv.innerHTML = `
                <div class="ms-3">
                    <p class="mb-2">Rooms</p>
                    <h6 class"mb-0">${data.totalRooms} <i class="fa fa-door-open me-2 "></i></h6>
                </div>
            `;
            
            
            
            const monthlyRevenueP = document.createElement('p');
            monthlyRevenueP.textContent = 'Monthly Revenue';
            monthlyRevenueP.classList.add('mb-2');
            const monthlyRevenueH = document.createElement('h6');
            monthlyRevenueH.textContent = "₱" + data.monthlyRevenue; 
            monthlyRevenueH.classList.add('mb-0');
            monthlyRevenueDataDiv.appendChild(monthlyRevenueP);
            monthlyRevenueDataDiv.appendChild(monthlyRevenueH);
    
            
            const totalP = document.createElement('p');
            totalP.textContent = 'Total Revenue';
            totalP.classList.add('mb-2');
            const totalH = document.createElement('h6');
            totalH.textContent = "₱" + data.totalRevenue;
            totalH.classList.add('mb-0');
            totalDataDiv.appendChild(totalP);
            totalDataDiv.appendChild(totalH);
        }
        

    })
    .catch(error => console.error('Error fetching maintenance items:', error));
}

function fetchResidentChart() {
    const token = localStorage.getItem('token');
    const selectedBranch = document.getElementById('dashboardBranch').value;

    fetch(`/api/countResidentsByType`, {
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
        console.log(data)        
        renderResidentData(data);
    })
    .catch(error => console.error('Error fetching data:', error));
}

function fetchPaymentChart() {
    const token = localStorage.getItem('token');
    const selectedBranch = document.getElementById('dashboardBranch').value;

    fetch(`/api/getDormPaymentChartData`, {
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
        console.log(data)        
        renderPaymentData(data);
    })
    .catch(error => console.error('Error fetching data:', error));
}

function renderResidentData(residentData) {
    // Extract data from residentData object
    const months = residentData.months;
    const datasets = residentData.datasets;

    // Prepare data for Chart.js
    const chartData = {
        labels: months,
        datasets: datasets.map(dataset => ({
            label: dataset.type,
            data: dataset.counts,
            backgroundColor: dataset.backgroundColor
        }))
    };

    // Render chart using Chart.js
    const ctx = document.getElementById('residentCanvas').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

function renderPaymentData(paymentData) {
    // Extract data from residentData object
    const months = paymentData.months;
    const datasets = paymentData.datasets;

    // Prepare data for Chart.js
    const chartData = {
        labels: months,
        datasets: datasets.map(dataset => ({
            label: dataset.status,
            data: dataset.totals,
            backgroundColor: dataset.backgroundColor
        }))
    };

    // Render chart using Chart.js
    const ctx = document.getElementById('DormPaymentCanvas').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: chartData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}
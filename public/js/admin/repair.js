document.addEventListener('DOMContentLoaded', function () {
    fetchrepairs();
});


const repairTableBody = document.querySelector('#repairsTableBody');

function fetchrepairs() {
    

    // Retrieve the token from localStorage
    const token = localStorage.getItem('token');

    fetch(`/api/admin/getRepairs`, {
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
        // Clear the existing table rows
        repairTableBody.innerHTML = '';
    console.log(data)
        // Add new rows based on the fetched data
        data.repairs.forEach(repair => {
            const row = `
                <tr>
                    <!-- Populate your resident data here -->
                    <td>${repair.room_number}</td>
                    <td>${repair.request_date}</td>
                    <td>${repair.itemName}</td>
                 
                    <td>${repair.technicianName}</td>
                    <td>${repair.residentName}</td>
                   
                    <td>                            
                        <img src="${repair.img_path}" alt="Lost Item Image" class="card-img-top" style="max-height: 100px;">
                    </td>
                    <td>${repair.status}</td>
                    <td>
                        <button class="btn btn-sm btn-success" onclick="checkrepair(${repair.id})">Check</button>
                        <button class="btn btn-sm btn-warning" onclick="updaterepair(${repair.id})">Update</button>
                        <button class="btn btn-sm btn-danger" onclick="confirmDelete(${repair.id})">Delete</button>
                    </td>

                </tr>
            `;
            repairTableBody.innerHTML += row;
        });
    });
}

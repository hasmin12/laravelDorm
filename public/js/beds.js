document.addEventListener('DOMContentLoaded', function () {
    const bedTableBody = document.querySelector('#bedsTableBody');

    function fetchBeds() {
        // Use roomId in the fetch request or other logic
        const token = localStorage.getItem('token');
        const getRoomId = localStorage.getItem('room_id');

        fetch(`/api/getBeds/${getRoomId}`, {
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
            bedTableBody.innerHTML = '';
            // Add new rows based on the fetched data
            data.beds.forEach(bed => {
            const residentName = bed.resident_name ? bed.resident_name : 'Unoccupied';

                const row = `
                    <tr>
                        <td>Bed ${bed.name}</td>
                        <td>${residentName}</td>
                        <td>${bed.status}</td>
                        <td>
                            <button class="btn btn-sm btn-success" onclick="checkRoom(${bed.id})">Check</button>
                            <button class="btn btn-sm btn-warning" onclick="updateRoom(${bed.id})">Update</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteRoom(${bed.id})">Delete</button>
                        </td>
                      
                    </tr>
                `;
                bedTableBody.innerHTML += row;
            });
        });
    }

    

    // Initial residents update
    fetchBeds();
});

function goBack() {
    location.href = "/admin/dorm/rooms";

}
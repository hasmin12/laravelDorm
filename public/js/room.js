document.addEventListener('DOMContentLoaded', function () {
    
    const roomTypeButtons = document.querySelectorAll('input[name="roomRadiobtn"]');
    const roomTableBody = document.querySelector('#roomsTableBody');

    function updateRooms() {
        const roomType = document.querySelector('input[name="roomRadiobtn"]:checked').value;
        

        // Retrieve the token from localStorage
        const token = localStorage.getItem('token');

        fetch(`/api/getRooms?room_type=${roomType}`, {
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
            roomTableBody.innerHTML = '';
        
            // Add new rows based on the fetched data
            data.rooms.forEach(room => {
                const row = `
                    <tr>
                        <!-- Populate your resident data here -->
                        <td>${room.name}</td>
                        <td>${room.type}</td>
                        <td>${room.category}</td>
                        <td>${room.slot}</td>
                        <td>${room.totalBeds}</td>
                        <td>${room.status}</td>
                        <td>
                            <button class="btn btn-sm btn-success" onclick="checkRoom(${room.id})">Check</button>
                            <button class="btn btn-sm btn-warning" onclick="updateRoom(${room.id})">Update</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteRoom(${room.id})">Delete</button>
                        </td>

                    </tr>
                `;
                roomTableBody.innerHTML += row;
            });
        });
    }

    // Event listeners
    roomTypeButtons.forEach(button => button.addEventListener('change', updateRooms));

    // Initial residents update
    updateRooms();
});

function checkRoom(roomId) {
    // Implement logic for checking a room
    localStorage.removeItem("room_id");
    localStorage.setItem('room_id', roomId);
    location.href = "/admin/beds";
    // Trigger custom event with room_id
}

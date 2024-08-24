document.addEventListener('DOMContentLoaded', function () {
    console.log("DOMContentLoaded event fired");
    
    const roomTypeButtons = document.querySelectorAll('input[name="roomRadiobtn"]');
    const roomBranchButtons = document.querySelectorAll('input[name="branchRadiobtn"]');
    
    console.log(roomTypeButtons.length + " roomTypeButtons found");
    console.log(roomBranchButtons.length + " roomBranchButtons found");
    
    // Initial rooms
    fetchRooms();

    // Event listeners
    roomTypeButtons.forEach(button => button.addEventListener('change', fetchRooms));
    roomBranchButtons.forEach(button => button.addEventListener('change', fetchRooms));
});

const createRoomForm = document.getElementById('createRoomForm');
    createRoomForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const roomName = document.getElementById('roomName');
        const roomCategory = document.getElementById('roomCategory');
        const roomType = document.getElementById('roomType');
        const numBeds = document.getElementById('numBeds');

        const name = roomName.value;
        const category = roomCategory.value;
        const type = roomType.value;
        const numBed = numBeds.value;


        const formData = {
            name: name,
            category: category,
            type: type,
            numBed: numBed,
        };

        const token = localStorage.getItem('token');

        fetch('/api/createRoom', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            credentials: 'include',
            body: JSON.stringify(formData),
        })
        .then(response => response.json())
        .then(data => {
            console.log('Room created successfully:', data);

            $('#createRoomModal').modal('hide');

            roomName.value = '';
            roomCategory.value = '';
            roomType.value = '';
            numBeds.value = '';

            fetchRooms();

            Swal.fire({
                icon: 'success',
                title: 'Room Created',
                text: 'Your Room has been successfully created.',
            });
        })
        .catch(error => {
            console.error('Error creating room:', error);

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while creating the room. Please try again.',
            });
        });
    });
const roomTableBody = document.querySelector('#roomsTableBody');

function fetchRooms() {
    const branch = document.querySelector('input[name="branchRadiobtn"]:checked').value;
    
    // Retrieve the token from localStorage
    const token = localStorage.getItem('token');
    console.log(branch); // Make sure this line is logging the branch value
    if (!branch || branch=="") {
        console.error('No branch radio button is checked.');
        return;
    }
    fetch(`/api/getRooms?branch=${branch}`, {
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
                        <button class="btn btn-sm btn-success" onclick="checkRoom(${room.id})">Check Beds</button>
                        <button class="btn btn-sm btn-warning" onclick="updateRoom(${room.id})">Update</button>
                        <button class="btn btn-sm btn-danger" onclick="confirmDelete(${room.id})">Delete</button>
                    </td>
                </tr>
            `;
            roomTableBody.innerHTML += row;
        });
    })
    .catch(error => {
        console.error('Error fetching rooms:', error);
        // Handle error
    });
}

const updateRoomForm = document.getElementById('updateRoomForm');
updateRoomForm.addEventListener('submit', function (event) {
    event.preventDefault();

    const updateName = document.getElementById('updateName');
    const updateType = document.getElementById('updateType');
    const updateCategory = document.getElementById('updateCategory');
    const updateStatus = document.getElementById('updateStatus');

    const roomId = updateRoomForm.dataset.roomId; // Add a data attribute to store room ID

    const updatedFormData = {
        name: updateName.value,
        type: updateType.value,
        category: updateCategory.value,
        status: updateStatus.value,

    };

    const token = localStorage.getItem('token');

    fetch(`/api/updateRoom/${roomId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}`,
        },
        credentials: 'include',
        body: JSON.stringify(updatedFormData),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Room updated successfully:', data);

        $('#updateRoomModal').modal('hide');

        updateName.value = '';
        updateType.value = '';
        updateCategory.value = '';
      
        fetchRooms(); 

        Swal.fire({
            icon: 'success',
            title: 'Room Updated',
            text: 'Your room has been successfully updated.',
        });
    })
    .catch(error => {
        console.error('Error updating room:', error);

        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while updating the room. Please try again.',
        });
    });
});

function updateRoom(roomId) {
    const updateRoomForm = document.getElementById('updateRoomForm');
    updateRoomForm.dataset.roomId = roomId; 

    const updateName = document.getElementById('updateName');
    const updateType = document.getElementById('updateType');
    const updateCategory = document.getElementById('updateCategory');

    const token = localStorage.getItem('token');

    fetch(`/api/getRoom/${roomId}`, {
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
     
        updateName.value = data.room.name;
        updateType.value = data.room.type;
        updateCategory.value = data.room.category;
       
        $('#updateRoomModal').modal('show');
    })
    .catch(error => {
        console.error('Error fetching room details:', error);

        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while fetching room details. Please try again.',
        });
    });
}



function checkRoom(roomId) {
    // Implement logic for checking a room
    localStorage.removeItem("room_id");
    localStorage.setItem('room_id', roomId);
    location.href = "/admin/beds";
    // Trigger custom event with room_id
}

function confirmDelete(roomId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteRoom(roomId);
        }
    });
}

function deleteRoom(roomId) {
    const token = localStorage.getItem('token');

    fetch(`/api/deleteRoom/${roomId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}`,
        },
        credentials: 'include',
    })
    .then(response => response.json())
    .then(data => {
        console.log('Room deleted successfully:', data);

        fetchRooms(); 

        Swal.fire({
            icon: 'success',
            title: 'Room Deleted',
            text: 'Your room has been successfully deleted.',
        });
    })
    .catch(error => {
        console.error('Error deleting room:', error);

        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while deleting the room. Please try again.',
        });
    });
}

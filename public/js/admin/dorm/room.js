document.addEventListener('DOMContentLoaded', function () {
    
    // const roomTypeButtons = document.querySelectorAll('input[name="roomRadiobtn"]');
    const roomBranchButtons = document.querySelectorAll('input[name="branchRadiobtn"]');
   
    const createbranchDropdown = document.getElementById('createbranchDropdown');
    createbranchDropdown.addEventListener('change', displaycreateForm);
    
    // Initial rooms
    fetchRooms();
    

    // Event listeners
    // roomTypeButtons.forEach(button => button.addEventListener('change', fetchRooms));
    roomBranchButtons.forEach(button => button.addEventListener('change', fetchRooms));


    const createRoomForm = document.getElementById('createRoomForm');
    createRoomForm.addEventListener('submit', function (event) {
        event.preventDefault();
    
        let formData = {};
    
        if (createbranchDropdown.value == "Dormitory") {
            formData = {
                branch: createbranchDropdown.value,
                name: document.getElementById('roomName').value,
                category: document.getElementById('roomCategory').value,
                type: document.getElementById('roomType').value,
                numBed: document.getElementById('numBeds').value
            };
        } else {
            formData = {
                branch: createbranchDropdown.value,
                name: document.getElementById('roomName').value,
                floorNum: document.getElementById('floorNum').value,
                bedtype: document.getElementById('bedtype').value,
                description: document.getElementById('description').value,
                pax: document.getElementById('pax').value,
                price: document.getElementById('price').value

            };
        }
    
        const token = localStorage.getItem('token');
    
        fetch('/api/createRoom', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`,
            },
            credentials: 'include',
            body: JSON.stringify(formData),
        })
        .then(response => response.json())
        .then(data => {
            console.log('Room created successfully:', data);
    
            $('#createRoomModal').modal('hide');
            createRoomForm.reset();

    
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
    
});
const roomTableBody = document.querySelector('#roomsTableBody');
const roomTable = document.querySelector('#roomTable');
function displaycreateForm(){
    const createbranchDropdown = document.getElementById('createbranchDropdown').value;
    const createContent = document.getElementById('createContent');
    createContent.innerHTML="";
    console.log(createbranchDropdown)
    if(createbranchDropdown=="Dormitory"){
        createContent.innerHTML = `
        <div class="mb-3">
                            <label for="roomName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="roomName" autocomplete="off" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="roomType" class="form-label">Type</label>
                            <select class="form-select" id="roomType" required>
                                <option value="" selected hidden></option>
                                <option value="Student">Student</option>
                                <option value="Faculty">Faculty</option>
                                <option value="Staff">Staff</option>
                            </select>
                        </div>
    
                        <div class="mb-3">
                            <label for="roomCategory" class="form-label">Category</label>
                            <select class="form-select" id="roomCategory" required>
                                <option value="" selected hidden></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <!-- Add other category options as needed -->
                            </select>
                        </div>
    
                        <div class="mb-3">
                            <label for="numBeds" class="form-label">Number of Beds</label>
                            <select class="form-select" id="numBeds" required>
                                <option value="" selected hidden></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>

                            </select>
                        </div>
`
    }else{
        createContent.innerHTML = `
        <div class="mb-3">
            <label for="roomName" class="form-label">Name</label>
            <input type="text" class="form-control" id="roomName" autocomplete="off" required>
        </div>

        <div class="mb-3">
            <label for="roomName" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" autocomplete="off" required>
        </div>

        <div class="mb-3">
            <label for="roomName" class="form-label">Floor Number</label>
            <input type="text" class="form-control" id="floorNum" autocomplete="off" required>
        </div>

        <div class="mb-3">
            <label for="roomName" class="form-label">Bed Type</label>
            <input type="text" class="form-control" id="bedtype" autocomplete="off" required>
        </div>
        
        <div class="mb-3">
            <label for="roomName" class="form-label">Pax</label>
            <input type="text" class="form-control" id="pax" autocomplete="off" required>
        </div>

        <div class="mb-3">
            <label for="roomName" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" autocomplete="off" required>
        </div>
`
    }
}
    
    
function fetchRooms() {
    // const roomType = document.querySelector('input[name="roomRadiobtn"]:checked').value;
    const branch = document.querySelector('input[name="branchRadiobtn"]:checked').value;
    

    // Retrieve the token from localStorage
    const token = localStorage.getItem('token');

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
        roomTable.innerHTML = '';
        if(branch=="Dormitory"){
            const thead =  `
            <tr class="text-dark">
                <th scope="col">Name</th>
                <th scope="col">Type</th>
                <th scope="col">Category</th>
                <th scope="col">Number of beds</th>
                <th scope="col">Occupied</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            `;
        roomTable.innerHTML += thead;

        }else{
            const thead =  `
                <tr class="text-dark">
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Floor Number</th>
                    <th scope="col">Bed Type</th>
                    <th scope="col">Price</th>
                    <th scope="col">Pax</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Status</th>

                </tr>
                `;
        roomTable.innerHTML += thead;

        }
        

        // Add new rows based on the fetched 
        if (branch=="Dormitory"){
            data.rooms.forEach(room => {
                const row = `
                    <tr>
                        <!-- Populate your resident data here -->
                        <td>${room.name}</td>
                        <td>${room.type}</td>
                        <td>${room.category}</td>
                        <td>${room.totalBeds}</td>
                        <td>${room.occupiedBeds}</td>

                        <td>${room.status}</td>
                        <td>
                            <button class="btn btn-sm btn-success" onclick="checkRoom(${room.id})">Check</button>
                            <button class="btn btn-sm btn-warning" onclick="updateRoom(${room.id})">Update</button>
                            <button class="btn btn-sm btn-danger" onclick="confirmDelete(${room.id})">Delete</button>
                        </td>
    
                    </tr>
                `;
                roomTableBody.innerHTML += row;
            });
        }else{
            data.rooms.forEach(room => {
                const row = `
                    <tr>
                        <!-- Populate your resident data here -->
                        <td>${room.name}</td>
                        <td>${room.description}</td>
                        <td>${room.floorNum}</td>
                        <td>${room.bedtype}</td>
                        <td>${room.pax}</td>
                        <td>${room.price}</td>
                        <td>${room.rating}</td>

                        <td>${room.status}</td>
                        <td>
                            <button class="btn btn-sm btn-success" onclick="checkRoom(${room.id})">Check</button>
                            <button class="btn btn-sm btn-warning" onclick="updateRoom(${room.id})">Update</button>
                            <button class="btn btn-sm btn-danger" onclick="confirmDelete(${room.id})">Delete</button>
                        </td>
    
                    </tr>
                `;
                roomTableBody.innerHTML += row;
            });
        }
       
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
        status: updateStatus.value
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
        updateStatus,value = '';
      
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
    location.href = "/admin/dorm/beds";
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

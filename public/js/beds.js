// beds.js
function fetchBed(bedId) {
    const token = localStorage.getItem('token');

    fetch(`/api/fetchBed/${bedId}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}`,
        },
        credentials: 'include',
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Bed details not found');
        }
        return response.json();
    })
    .then(data => {
        document.getElementById('updateName').value = data.bed.name;
        document.getElementById('updateType').value = data.bed.type;
        document.getElementById('updateStatus').value = data.bed.status;
        $('#updateBedModal').modal('show');
        document.getElementById('updateBedForm').dataset.bedId = bedId; // Set the bedId in the form dataset
    })
    .catch(error => {
        console.error('Error fetching bed details:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: error.message,
        });
    });
}
document.addEventListener('DOMContentLoaded', function () {
    const bedTableBody = document.querySelector('#bedsTableBody');

 

    // Function to update a bed
    function updateBed(bedId, formData) {
        const token = localStorage.getItem('token');

        fetch(`/api/updateBed/${bedId}`, {
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
            console.log('Bed updated successfully:', data);
            $('#updateBedModal').modal('hide');
            fetchBeds(); // Refresh beds after update
            Swal.fire({
                icon: 'success',
                title: 'Bed Updated',
                text: 'The selected bed has been successfully updated.',
            });
        })
        .catch(error => {
            console.error('Error updating bed:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while updating the bed. Please try again.',
            });
        });
    }

    // Initial fetch of beds
    function fetchBeds() {
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
            bedTableBody.innerHTML = '';
            data.beds.forEach(bed => {
                const residentName = bed.resident_name ? bed.resident_name : 'Unoccupied';
                const row = `
                    <tr>
                        <td>Bed ${bed.name}</td>
                        <td>${bed.type}</td>
                        <td>${residentName}</td>
                        <td>${bed.status}</td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="fetchBed(${bed.id})">Update</button>
                        </td>
                    </tr>
                `;
                bedTableBody.innerHTML += row;
            });
        })
        .catch(error => console.error('Error fetching beds:', error));
    }

    fetchBeds(); // Initial fetch of beds

    // Event listener for form submission
    document.getElementById('updateBedForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const updateName = document.getElementById('updateName').value;
        const updateType = document.getElementById('updateType').value;
        const updateStatus = document.getElementById('updateStatus').value;
        const bedId = this.dataset.bedId; // Retrieve bedId from form dataset

        const updatedFormData = {
            name: updateName,
            type: updateType,
            status: updateStatus
        };

        updateBed(bedId, updatedFormData);
    });
});


function goBack() {
    location.href = "/admin/dorm/rooms";

}

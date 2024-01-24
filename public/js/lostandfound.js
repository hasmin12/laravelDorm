document.addEventListener('DOMContentLoaded', function () {
    fetchLostItems();

});


    const createLostItemForm = $('#createLostItemForm');

    createLostItemForm.submit(function (event) {
        event.preventDefault();

        const itemNameInput = $('#itemName');
        const locationLostInput = $('#locationLost');
        const findersNameInput = $('#findersName');
        const imageInput = $('#img_path')[0].files[0];

        const itemName = itemNameInput.val();
        const locationLost = locationLostInput.val();
        const findersName = findersNameInput.val();

        const formData = new FormData();
        formData.append('itemName', itemName);
        formData.append('locationLost', locationLost);
        formData.append('findersName', findersName);
        formData.append('img_path', imageInput);

        const token = localStorage.getItem('token');

        $.ajax({
            url: '/api/lostitem',
            type: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token,
            },
            data: formData,
            processData: false,  
            contentType: false,
            success: function (data) {
                console.log('Lost item created successfully:', data);

                $('#createLostItemModal').modal('hide');

                itemNameInput.val('');
                locationLostInput.val('');
                findersNameInput.val('');
                $('#img_path').val('');

                fetchLostItems(); // Update the function name to match your lost items

                Swal.fire({
                    icon: 'success',
                    title: 'Lost Item Created',
                    text: 'Your lost item has been successfully created.',
                });
            },
            error: function (error) {
                console.error('Error creating lost item:', error);

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while creating the lost item. Please try again.',
                });
            }
        });
    });




function fetchLostItems() {
    const token = localStorage.getItem('token');

    fetch('/api/getLostitems', {
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
            const lostitemTableBody = document.querySelector('#lostitemTableBody');

            lostitemTableBody.innerHTML = '';

            // Add new rows based on the fetched data
            data.lostitems.forEach(lostItem => {
                const row = `
                    
                        <td>${lostItem.itemName}</td>
                        <td>${lostItem.locationLost}</td>
                        <td>${lostItem.claimedBy}</td>
                        <td>${lostItem.claimedDate}</td>
                        <td>${lostItem.status}</td>
                        <td>${lostItem.dateLost}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" onclick="updateLostItem(${lostItem.id})">Update</button>
                            <button class="btn btn-sm btn-danger" onclick="confirmDeleteLostItem(${lostItem.id})">Delete</button>
                        </td>
           
                `;
                lostitemTableBody.innerHTML += row;
            });

           
        })
        .catch(error => console.error('Error fetching lost items:', error));
}

function showItemDetails(name, imgPath, findersName, status, dateLost, locationLost) {
    // Populate modal with details
    const modalTitle = document.getElementById('itemDetailsModalLabel');
    const modalImage = document.getElementById('itemDetailsModalImage');
    const modalFinders = document.getElementById('findersName');
    const modalStatus = document.getElementById('status');
    const modaldateLost = document.getElementById('dateLost');
    const modallocationLost = document.getElementById('locationLost');

    modalTitle.textContent = name;
    modalImage.src = imgPath;
    modalFinders.innerHTML = "<strong>Finder's Name:</strong> " + findersName;

    // Set the color of status based on its value
    modalStatus.textContent = status;
    modalStatus.style.color = status === 'Unclaimed' ? 'red' : 'green';

    modaldateLost.innerHTML = "<strong>Date found:</strong> " + dateLost;
    modallocationLost.innerHTML = "<strong>Location found:</strong> " + locationLost;

    // Show the modal
    $('#itemDetailsModal').modal('show');
}

const updateLostItemForm = document.getElementById('updateLostItemForm'); 
updateLostItemForm.addEventListener('submit', function (event) {
    event.preventDefault();

    const updateitemName = document.getElementById('updateitemName');
    const updatelocationLost = document.getElementById('updatelocationLost');
    const updatefindersName = document.getElementById('updatefindersName');
    const updateclaimedBy = document.getElementById('updateclaimedBy');
    const updateimg_path = document.getElementById('updateimg_path');

    const lostItemId = updateLostItemForm.dataset.roomId; 

    // Create FormData object
    const formData = new FormData();

    // Append form fields to FormData
    formData.append('itemName', updateitemName.value);
    formData.append('locationLost', updatelocationLost.value);
    formData.append('findersName', updatefindersName.value);
    formData.append('claimedBy', updateclaimedBy.value);

    // Append image file to FormData
    const imageFile = updateimg_path.files[0];
    formData.append('img_path', imageFile);

    const token = localStorage.getItem('token');

    fetch(`/api/updateLostitem/${lostItemId}`, {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${token}`,
        },
        credentials: 'include',
        body: formData, 
    })
    .then(response => response.json())
    .then(data => {
        console.log('Lost item updated successfully:', data);

        $('#updateLostItemModal').modal('hide');

        updateitemName.value = '';
        updatelocationLost.value = '';
        updatefindersName.value = '';
        updateclaimedBy.value = '';
        updateimg_path.value = '';

        fetchLostItems(); // Update the function name to match your lost items

        Swal.fire({
            icon: 'success',
            title: 'Lost Item Updated',
            text: 'Your lost item has been successfully updated.',
        });
    })
    .catch(error => {
        console.error('Error updating lost item:', error);

        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while updating the lost item. Please try again.',
        });
    });
});

function updateLostItem(lostItemId) {
    const updateLostItemForm = document.getElementById('updateLostItemForm'); // Update the ID to match your lost item form
    updateLostItemForm.dataset.roomId = lostItemId; 

    const updateitemName = document.getElementById('updateitemName');
    const updatelocationLost = document.getElementById('updatelocationLost');
    const updatefindersName = document.getElementById('updatefindersName');
    const updateclaimedBy = document.getElementById('updateclaimedBy');
    const updateimg_path = document.getElementById('updateimg_path');
    const updateImgPreview = document.getElementById('updateImgPreview');


    const token = localStorage.getItem('token');

    fetch(`/api/getLostitem/${lostItemId}`, {
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
        updateitemName.value = data.lostitem.itemName;
        updatelocationLost.value = data.lostitem.locationLost;
        updatefindersName.value = data.lostitem.findersName;
        updateclaimedBy.value = data.lostitem.claimedBy;
       
        updateImgPreview.src = data.lostitem.img_path;
        updateImgPreview.style.display = 'block';

        $('#updateLostItemModal').modal('show');
    })
    .catch(error => {
        console.error('Error fetching lost item details:', error);

        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while fetching lost item details. Please try again.',
        });
    });
}

function confirmDeleteLostItem(lostItemId) {
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
            deleteLostItem(lostItemId);
        }
    });
}

function deleteLostItem(lostItemId) {
    const token = localStorage.getItem('token');

    fetch(`/api/deleteLostitem/${lostItemId}`, {
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
        console.log('Lost item deleted successfully:', data);

        fetchLostItems(); // Update the function name to match your lost items

        Swal.fire({
            icon: 'success',
            title: 'Lost Item Deleted',
            text: 'Your lost item has been successfully deleted.',
        });
    })
    .catch(error => {
        console.error('Error deleting lost item:', error);

        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while deleting the lost item. Please try again.',
        });
    });
}

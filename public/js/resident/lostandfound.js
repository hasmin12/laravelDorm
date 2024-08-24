document.addEventListener('DOMContentLoaded', function () {
    fetchLostItems();
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
            const lostItemsContainer = document.getElementById('lost-items-container');
            lostItemsContainer.innerHTML = '';

            data.lostitems.forEach((lostItem, index) => {
                const cardContainer = document.createElement('div');
                cardContainer.classList.add('col-sm-12', 'col-md-4');

                const cardContent = `
                    <div class="card h-100" style="cursor: pointer;" onclick="showItemDetails('${lostItem.itemName}', '${lostItem.img_path}', '${lostItem.findersName}', '${lostItem.status}', '${lostItem.dateLost}', '${lostItem.locationLost}')">
                        <div class="card-body">
                            <h5 class="card-title">${lostItem.itemName}</h5>
                            <img src="${lostItem.img_path}" alt="Lost Item Image" class="card-img-top" style="max-height: 150px;">
                            <!-- Add other fields as needed -->
                          
                        </div>
                    </div>
                `;

                cardContainer.innerHTML = cardContent;
                lostItemsContainer.appendChild(cardContainer);
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


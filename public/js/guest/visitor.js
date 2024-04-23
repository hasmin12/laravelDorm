document.addEventListener('DOMContentLoaded', function () {
    // Access the form element
    const visitorForm = document.getElementById('visitorForm');

    visitorForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        const formData = new FormData(visitorForm);

        // Make an AJAX request to submit the form data
        fetch('/api/visitor', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            visitorForm.reset();
            Swal.fire({
                icon: 'success',
                title: 'Visitor Form Submmited',
                text: 'Your form has been successfully submitted.',
            });
        })
        .catch(error => {
            console.error('Error submitting form:', error);
        });
    });

    // Fetch residents and populate the dropdown
    fetchResidents();
});

function fetchResidents() {
    fetch(`/api/visitor/getResidents`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        credentials: 'include',
    })
   
    .then(response => response.json())
    .then(data => {
        console.log(data);
        const residentDropdown = document.getElementById('residentDropdown');

        // Populate the dropdown with residents
        data.residents.forEach(resident => {
            var option = document.createElement('option');
            option.value = resident.id;
            option.text = resident.name;
            residentDropdown.add(option);
            console.log(resident)
        });
    })
    .catch(error => console.error('Error fetching residents:', error));
}

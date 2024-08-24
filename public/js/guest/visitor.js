document.addEventListener('DOMContentLoaded', function () {
    // Access the form element
    const visitorForm = document.getElementById('visitorForm');

    visitorForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        const formData = new FormData(visitorForm);

        fetch('/api/visitor', {
            method: 'POST',
            headers: {         
                'Accept': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            credentials: 'include',
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
    // fetchResidents();
});

// function fetchResidents() {
//     fetch(`/api/visitor/getResidents`, {
//         method: 'GET',
//         headers: {
//             'Content-Type': 'application/json',
//             'Accept': 'application/json',
//         },
//         credentials: 'include',
//     })
   
//     .then(response => response.json())
//     .then(data => {
//         console.log(data);
//         const residentDropdown = document.getElementById('residentDropdown');
//         resi
//         data.residents.forEach(resident => {
//             var option = document.createElement('option');
//             option.value = resident.id;
//             option.text = resident.name;
//             residentDropdown.add(option);
//             console.log(resident)
//         });
//     })
//     .catch(error => console.error('Error fetching residents:', error));
// }

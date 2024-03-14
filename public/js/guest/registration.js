document.addEventListener('DOMContentLoaded', function () {

    const registrationForm = $('#registrationForm');

    registrationForm.submit(function (event) {
        event.preventDefault();

        const formData = new FormData(this);

        // Check if the electric checkbox is checked
        const electricCheckbox = document.getElementById("electricfan");
        formData.append("electricfan", electricCheckbox.checked ? 1 : 0);

        // Check if the laptop checkbox is checked
        const laptopCheckbox = document.getElementById("laptop");
        formData.append("laptop", laptopCheckbox.checked ? 1 : 0);

        for (const pair of formData.entries()) {
            console.log(pair[0], pair[1]);
        }

        $.ajax({
            url: '/api/createRegistration',
            type: 'POST',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                'Accept': 'application/json',
            },
            credentials: 'include',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log('Registration successful:', data);
                registrationForm[0].reset();
                
                Swal.fire({
                    icon: 'success',
                    title: 'Registration Successful',
                    text: 'Your registration has been successfully submitted.',
                });
            },
            error: function (error) {
                console.error('Error during registration:', error);

                Swal.fire({
                    icon: 'error',
                    title: 'Registration Error',
                    text: 'An error occurred during registration. Please try again.',
                });
            }
        });
    });
});

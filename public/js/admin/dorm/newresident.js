document.addEventListener('DOMContentLoaded', function () {
    const token = localStorage.getItem('token');
    const registrationForm = $('#registrationForm');
   
    registrationForm.submit(function (event) {
        event.preventDefault();

        const formData = new FormData(this);
        console.log(token)
     
        const electricCheckbox = document.getElementById("electricfan");
        formData.append("electricfan", electricCheckbox.checked ? 1 : 0);

    
        const laptopCheckbox = document.getElementById("laptop");
        formData.append("laptop", laptopCheckbox.checked ? 1 : 0);
        

        $.ajax({
            url: '/api/createResident',
            type: 'POST',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`,
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

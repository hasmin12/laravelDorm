$(document).ready(function () {
    var currentStep = 0;
    var steps = $('form fieldset');

    steps.hide().eq(currentStep).show();

    $(".next-step").click(function () {
        steps.eq(currentStep).hide();
        currentStep++;
        steps.eq(currentStep).show();

        if(currentStep==0){
            steps.eq(currentStep).hide();
            currentStep++;
            steps.eq(currentStep).show();
        }
    });

    $(".previous-step").click(function () {
        steps.eq(currentStep).hide();
        currentStep--;
        steps.eq(currentStep).show();
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const registrationForm = $('#registrationForm');

    registrationForm.submit(function (event) {
        event.preventDefault();
    
        const formData = new FormData(this);
    
        const electricCheckbox = document.getElementById("electricfan");
        formData.append("electricfan", electricCheckbox.checked ? 1 : 0);
    
        const laptopCheckbox = document.getElementById("laptop");
        formData.append("laptop", laptopCheckbox.checked ? 1 : 0);
    
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
                    text: 'Please Fill Out the inputs',
                });
            }
        });
    });
});

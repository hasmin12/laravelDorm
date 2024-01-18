$(document).ready(function() {

    $('#loginForm').submit(function (e) {
        e.preventDefault();
        var data = $('#loginForm')[0];
        console.log(data);
        let formData = new FormData(data);

        $.ajax({
            type: 'POST',
            contentType: false,
            processData: false,
            url: '/signin',
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    localStorage.setItem('token', response.token);
                    // localStorage.setItem('authname', response.user.name);

                    // fetchNotifications();
                    Swal.fire({
                        icon: 'success',
                        text: 'Login Successful.',
                    });
                    if (response.user.role === 'Resident') {
                        window.location.href = '/resident/announcements';
                    } else if (response.user.role === 'Admin') {
                        window.location.href = '/admin/dashboard';
                    
                    }
                } else {
                    // Display SweetAlert for wrong credentials
                    Swal.fire({
                        icon: 'error',
                        text: 'Login failed. Please check your credentials.',
                    });
                }
            },
            error: function (error) {
                // Display SweetAlert for other errors
                Swal.fire({
                    icon: 'error',
                    text: 'An error occurred during login. Please try again.',
                });
                console.log(error);
            }
        });
    });

    $("#logoutButton").on("click", function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "/signout",
            data: null,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            
            dataType: "json",
            success: function (data) {
              
                localStorage.removeItem("token");
                Swal.fire({
                    icon: 'success',
                    text: 'Logout Successful.',
                });
                location.href = "/login";
            },
            error: function (error) {
                console.log(error);
            },
        });
    });
});

 
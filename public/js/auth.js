$(document).ready(function() {

    
    $("#googlebtn").on("click", function (e) {
        e.preventDefault();

        $.ajax({
            type: "GET",
            url: "/auth/google",
          
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "text",
            success: function (response) {
                console.log(response);
                // window.location.href = response;
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    

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
                    getAuthUser();

                    Swal.fire({
                        icon: 'success',
                        text: 'Login Successful.',
                    });
                    if (response.user.role === 'Resident') {
                        window.location.href = '/resident/announcements';
                    } else if (response.user.role === 'Admin') {
                        window.location.href = '/admin/dorm/dashboard';
                    
                    }else{
                        window.location.href = '/technician/maintenance';
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: 'Login failed. Please check your credentials.',
                    });
                }
            },
            error: function (error) {
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
        const token = localStorage.getItem('token');
    
        $.ajax({
            type: "GET",
            url: "/api/signout",
            data: null,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                "Authorization": `Bearer ${token}` 
            },
            dataType: "json",
            success: function (data) {
                localStorage.removeItem("token");
                localStorage.removeItem("email");
    
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
    

    function getAuthUser() {
        fetch('/getAuthUser', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            credentials: 'include',
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            localStorage.setItem('token', data.remember_token);
            localStorage.setItem('email', data.email);
        })
        .catch(error => console.error('Error fetching user data:', error));
    }
}
)    

 
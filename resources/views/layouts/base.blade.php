<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.dormstyle')
    <title>DormXtend</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    @yield('content')
    @include('layouts.dormlinks')
    <script>
        function saveUserDataToLocalStorage(token, user) {
            // Check if token and user are not null or undefined
            if (token && user) {
                // Save token and user data to localStorage
                localStorage.setItem('token', token);
                localStorage.setItem('user', JSON.stringify(user));
            } else {
                console.error('Token or user data is null or undefined.');
            }
        }

        // Call the function with the token and user variables passed from the server-side
        // saveUserDataToLocalStorage('{{ $token ?? '' }}', {!! json_encode($user ?? null) !!});
    </script>
</body>
</html>
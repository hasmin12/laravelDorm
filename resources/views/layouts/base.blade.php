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
</body>
</html>
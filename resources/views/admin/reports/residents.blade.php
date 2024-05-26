<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Users Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            padding: 10px;
            text-align: center;
        }

        header img {
            width: 100px;
            height: 40px;
            margin-right: 10px;
            vertical-align: middle;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
            display: inline-block;
            vertical-align: middle;
        }

        main {
            padding: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 2px;
            text-align: left;
        }

        th {
            font-size: 14px;
            background-color: #f2f2f2;
            color: #333;
        }

        /* Set font size to 11 for <td> elements */
        td {
            font-size: 11px;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <img src="{{ public_path('/img/dormnames.png') }}" alt="Logo">

        <h1>Technological University of the Philippines</h1>
    </header>

    <!-- Main content -->
    <main>
        <h2>Residents Report</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Birth Date</th>
                    <th>Sex</th>
                    <th>Phone Number</th>
                    <th>Registered</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->type }}</td>
                        <td>{{ $user->birthdate }}</td>
                        <td>{{ $user->sex }}</td>
                        <td>{{ $user->contactNumber }}</td>
                        <!-- Format the created_at field using Carbon's format() method -->
                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>

    <!-- Footer -->
    <footer>
        &copy; {{ date('Y') }} Technological University of the Philippines
    </footer>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laundry Schedule Report</title>
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

        th,
        td {
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
        <h2>Laundry Schedules Report</h2>
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Laundry Date</th>
                    <th>Laundry Time</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laundryschedules as $schedule)
                    <tr>
                        <td>{{ $schedule->user_id }}</td>
                        <td>{{ $schedule->name }}</td>
                        <td>{{ $schedule->laundrydate }}</td>
                        <td>{{ $schedule->laundrytime }}</td>
                        <td>{{ $schedule->status }}</td>
                        <td>{{ $schedule->created_at }}</td>
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

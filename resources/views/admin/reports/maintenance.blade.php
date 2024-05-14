<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Maintenances Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        header img {
            width: 40px;
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
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
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
        <img src="{{ secure_asset('img/dormnames.png') }}" alt="Logo">
        <h1>Technological University of the Philippines</h1>
    </header>

    <!-- Main content -->
    <main>
        <h2>Maintenances Report</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>

                    <th>Type</th>
                    <th>Room Number</th>
                    <th>Tech Name</th>
                    <th>Resident Name</th>
                    <th>Status</th>

                </tr>
            </thead>
            <tbody>
                @foreach($maintenance as $maintenance)
                    <tr>
                        <td>{{ $maintenance->id }}</td>

                        <td>{{ $maintenance->type }}</td>
                        <td>{{ $maintenance->room_number }}</td>
                        <td>{{ $maintenance->technicianName }}</td>
                        <td>{{ $maintenance->residentName }}</td>
                        <td>{{ $maintenance->status }}</td>
                        
                       
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

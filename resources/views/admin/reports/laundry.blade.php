<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
        <h2>Laundry Schedule Report</h2>
        <table>
            <thead>
                <tr>
                    <th>Visitor Name</th>
                    <th>Contact Number</th>
                    <th>Visit Date</th>

                    <th>Resident Name</th>
                    <th>Relationship</th>
                    <th>Purpose</th>
                 
                </tr>
            </thead>
            <tbody>
                @foreach($visitors as $visitor)
                    <tr>
                        <td>{{ $visitor->name }}</td>
                        <td>{{ $visitor->phone }}</td>
                        <td>{{ \Carbon\Carbon::parse($visitor->visit_date)->format('Y-m-d H:i:s') }}</td>

                        <td>{{ $visitor->residentName }}</td>
                        <td>{{ $visitor->relationship }}</td>
                        <td>{{ $visitor->purpose }}</td>
                        <!-- Format the created_at field using Carbon's format() method -->
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users Report</title>
    <style>
        /* Define your CSS styles here */
        header {
            position: fixed;
            width: 100%;
            height: 50px;
            background-color: #b93c3c;
            color: #fff;
            display: flex;
            align-items: center;
            padding: 20px;
        }

        header img {
            width: 50px;
            margin-right: 20px;
        }

        header h1 {
            margin: 0;
            flex-grow: 1;
        }

        footer {
            position: fixed;
            bottom: -50px;
            left: 0;
            right: 0;
            height: 50px;
            background-color: #333;
            color: #fff;
            text-align: center;
        }

        main {
            margin-top: 80px; /* Adjust margin-top to accommodate the header */
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
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">

        <h1>Technological University of the Philippines</h1>
    </header>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} Technological University of the Philippines</p>
    </footer>

    <!-- Main content -->
    <main>
        <h1>Users Report</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Branch</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->branch }}</td>
                        <td>{{ $user->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>
</html>
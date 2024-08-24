<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
    <header>
        <img src="{{ public_path('/img/dormnames.png') }}" alt="Logo">
        <h1>Technological University of the Philippines</h1>
    </header>

    <main>
        <h2>Hostel Reservations Report</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Room</th>
                    <th>Total Payment</th>
                    <th>Reservation Date</th>
                    <th>Check-In Date</th>
                    <th>Check-In Time</th>
                    <th>Check-Out Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->roomName }}</td>
                        <td>{{ $user->totalPayment }}</td>
                        <td>{{ $user->reservation_date }}</td>
                        <td>{{ \Carbon\Carbon::parse($user->checkin_date)->format('Y-m-d') }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($user->checkin_date)->format('H:i') }}
                        </td>
                        {{-- <td>
                            @if ($user->status == 'Pending')
                                -
                            @else
                                {{ \Carbon\Carbon::parse($user->checkin_date)->format('H:i') }}
                            @endif
                        </td> --}}
                        <td>{{ $user->checkout_date }}</td>
                        <td>{{ $user->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>

    <footer>
        &copy; {{ date('Y') }} Technological University of the Philippines
    </footer>
</body>

</html>

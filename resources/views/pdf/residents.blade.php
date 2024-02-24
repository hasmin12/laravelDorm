<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Residents PDF</title>
</head>
<body>
    <h1>Residents List</h1>

    <!-- Display Residents Data -->
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <!-- Add other relevant columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($residents as $resident)
            <tr>
                <td>{{ $resident->name }}</td>
                <td>{{ $resident->email }}</td>
                <!-- Add other relevant columns as needed -->
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Display Resident Chart -->
    <h2>Resident Chart</h2>
    <div id="residentChart">
        <!-- Chart will be rendered here -->
    </div>

    <!-- Display Resident Type Chart -->
    <h2>Resident Type Chart</h2>
    <div id="residentTypeChart">
        <!-- Chart will be rendered here -->
    </div>

    <!-- Include JavaScript to render the charts -->
    <script>
        // Parse resident chart data
        var residentChartData = {!! json_encode($residentChartData['residentChart']) !!};
        var residentTypeChartData = {!! json_encode($residentChartData['residentTypeChart']) !!};

        // Render charts using the data
        // You need to write JavaScript code here to render charts using residentChartData and residentTypeChartData
        // You can use libraries like Chart.js, Highcharts, or Google Charts to render the charts.
        // Example:
        // You can create a new Chart instance and pass the chart data to it.

        // Example with Chart.js:
        // var ctx = document.getElementById('residentChart').getContext('2d');
        // var residentChart = new Chart(ctx, {
        //     type: 'bar',
        //     data: residentChartData,
        //     options: {
        //         // Add chart options here
        //     }
        // });

        // Similar code can be used to render the resident type chart.
    </script>
</body>
</html>

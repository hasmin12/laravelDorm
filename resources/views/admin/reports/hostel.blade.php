<x-app-layout :assets="$assets ?? []">
    <div class="container mt-5">
        <h2 class="text-xl font-bold mb-4">Hostel Reservations Overview</h2>

        <div class="flex justify-center" style="width: 550px; height: 550px; margin: 0 auto;">
            <canvas id="reservationChart" style="max-width: 100%; max-height: 100%;"></canvas>
        </div>

        <div class="mt-4">
            <p>This pie chart visualizes the status of reservations in the hostel:</p>
            <ul>
                @foreach ($reservations as $status => $count)
                    <li><strong>{{ ucfirst($status) }}:</strong> {{ $count }} reservation(s).</li>
                @endforeach
            </ul>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('reservationChart').getContext('2d');
            const reservationData = @json($reservations);
            const labels = Object.keys(reservationData);
            const data = Object.values(reservationData);

            const reservationChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Reservation Status',
                        data: data,
                        backgroundColor: [
                            '#FF6384',
                            '#36A2EB',
                            '#FFCE56',
                        ],
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Hostel Reservations Status Distribution'
                        }
                    }
                }
            });
        </script>
    </div>
</x-app-layout>

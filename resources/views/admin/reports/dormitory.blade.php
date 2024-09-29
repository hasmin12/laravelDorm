<x-app-layout :assets="$assets ?? []">
    <div class="container mt-5">
        <h2 class="text-xl font-bold mb-4">User Profile Type Distribution</h2>

        <div class="flex justify-center" style="width: 550px; height: 550px; margin: 0 auto;">
            <canvas id="userProfileChart" style="max-width: 100%; max-height: 100%;"></canvas>
        </div>
        <div class="mt-4">
            <p>This pie chart visualizes the distribution of different user types within the dormitory management
                system:</p>
            <ul>
                @foreach ($userTypes as $type => $count)
                    <li><strong>{{ ucfirst($type) }}:</strong> {{ $count }} user(s).</li>
                @endforeach
            </ul>
            {{-- <p>The chart helps identify the proportion of user types, allowing for better resource allocation and
                management insights.</p> --}}
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('userProfileChart').getContext('2d');
            const profileData = @json($userTypes);
            const labels = Object.keys(profileData);
            const data = Object.values(profileData);

            const userProfileChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'User Profile Types',
                        data: data,
                        backgroundColor: [
                            '#FF6384',
                            '#36A2EB',
                            '#FFCE56',
                            '#4BC0C0',
                            '#9966FF',
                            '#FF9F40',
                        ],
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'User Profile Types Distribution'
                        }
                    }
                }
            });
        </script>
    </div>
</x-app-layout>

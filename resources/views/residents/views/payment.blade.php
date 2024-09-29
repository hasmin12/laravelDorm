<x-app-layout :assets="$assets ?? []">

    <div class="container mt-5">
        <h5 class="mb-3">Invoice #: {{ $payment->invoice }}</h5>
        <h5 class="mb-3">Dear {{ Auth::user()->first_name }} {{ Auth::user()->last_name }},</h5>
        <p>Here are your payment details for {{ $payment->current_month }}. Please review them carefully.</p>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Item</th>
                        <th class="text-center" scope="col">Price</th>
                        <th class="text-center" scope="col">Totals</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Room Rent</td>
                        <td class="text-center">PHP 1,000.00</td>
                        <td class="text-center">PHP 1,000.00</td>
                    </tr>
                    @if ($payment->laptop == 1)
                        <tr>
                            <td>Laptop</td>
                            <td class="text-center">PHP 150.00</td>
                            <td class="text-center">PHP 150.00</td>
                        </tr>
                    @endif
                    @if ($payment->electricfan == 1)
                        <tr>
                            <td>Electric Fan</td>
                            <td class="text-center">PHP 150.00</td>
                            <td class="text-center">PHP 150.00</td>
                        </tr>
                    @endif
                    <tr>
                        <td>
                            <h6 class="mb-0">Total</h6>
                        </td>
                        <td class="text-center"></td>
                        <td class="text-center">{{ $payment->amount }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="text-center mt-4">
            @if ($payment->or_image)
                <a href="{{ asset('/storage/' . $payment->or_image) }}" class="btn btn-primary" target="_blank">
                    View Official Receipt (OR) Image
                </a>
            @else
                <p>No Official Receipt image available.</p>
            @endif
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('user.payments') }}" class="btn btn-secondary">
                Back
            </a>
        </div>

        <p class="mb-0 mt-4">Thank you for being a valued member of our community.</p>
    </div>

</x-app-layout>

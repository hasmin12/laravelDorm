@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
<x-app-layout :assets="$assets ?? []">

    <div class="container mt-5">
        <h2>{{ $pageTitle }}</h2>
        @if ($pendingPayments && $pendingPayments->count() > 0)
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Pending Payments</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Total Due:</strong> PHP <span id="total-due">0.00</span></p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Invoice</th>
                                        <th class="text-center">Laptop</th>
                                        <th class="text-center">Electric Fan</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="payment-list">
                                    @foreach ($pendingPayments as $pendingPayment)
                                        <tr>
                                            <td class="text-center">{{ $pendingPayment->invoice }}</td>
                                            <td class="text-center">
                                                @if ($pendingPayment->laptop)
                                                    <span class="text-success">✓</span> <!-- Checkmark for true -->
                                                @else
                                                    <span class="text-danger">X</span> <!-- X for false -->
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($pendingPayment->electricfan)
                                                    <span class="text-success">✓</span> <!-- Checkmark for true -->
                                                @else
                                                    <span class="text-danger">X</span> <!-- X for false -->
                                                @endif
                                            </td>
                                            <td class="text-center">PHP {{ number_format($pendingPayment->amount, 2) }}
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-success pay-now" data-bs-toggle="modal"
                                                    data-bs-target="#paymentModal" data-id="{{ $pendingPayment->id }}"
                                                    data-invoice="{{ $pendingPayment->invoice }}"
                                                    data-amount="PHP {{ number_format($pendingPayment->amount, 2) }}"
                                                    data-laptop="{{ $pendingPayment->laptop }}"
                                                    data-electricfan="{{ $pendingPayment->electricfan }}">
                                                    Pay Now
                                                </button>

                                            </td>


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        @endif



        <div class="row mt-4">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Transaction History</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            {{ $dataTable->table(['class' => 'table text-center table-striped w-100'], true) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>

    <!-- Billing Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-invoice">Invoice #: </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5 class="mb-3">Dear {{ Auth::user()->first_name }} {{ Auth::user()->last_name }},</h5>
                        <p>We would like to take this opportunity to remind you of your payment details for the current
                            month. Ensuring timely payments helps maintain the quality of service and facilities
                            provided to our residents.</p>
                        <p>Below, you will find a detailed breakdown of the charges applicable to your account. Please
                            review the items listed carefully, and do not hesitate to reach out to our office if you
                            have any questions.</p>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Item</th>
                                        <th class="text-center" scope="col">Price</th>
                                        <th class="text-center" scope="col">Totals</th>
                                    </tr>
                                </thead>
                                <tbody id="modal-body-items">
                                    <!-- Dynamic content will be inserted here -->
                                </tbody>
                                <tr>
                                    <td>
                                        <h6 class="mb-0">Total</h6>
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center" id="modal-total-amount"></td>
                                </tr>
                            </table>
                        </div>
                        <input type="hidden" id="payment_id" name="payment_id">
                        <div class="mb-3">
                            <label for="orNumber" class="form-label">Official Receipt (OR) Number</label>
                            <input type="text" class="form-control" id="orNumber" name="or_number"
                                placeholder="Enter OR Number" required>
                        </div>

                        <div class="mb-3">
                            <label for="orImage" class="form-label">Upload Official Receipt Image</label>
                            <input type="file" class="form-control" id="orImage" name="or_image" accept="image/*"
                                required>
                        </div>

                        <div class="text-center mb-3">
                            <img id="previewImage" src="path/to/or-image.png" alt="Official Receipt" class="img-fluid"
                                style="max-width: 100%; height: auto;">
                        </div>

                        <p class="mb-0 mt-4">We appreciate your prompt attention to this matter and thank you for being
                            a valued member of our community.</p>
                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-primary">Submit Payment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>








    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const payNowButtons = document.querySelectorAll('.pay-now');

            payNowButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Get data attributes from the button
                    const invoice = this.getAttribute('data-invoice');
                    const amount = this.getAttribute('data-amount');
                    const laptop = this.getAttribute('data-laptop');
                    const electricfan = this.getAttribute('data-electricfan');
                    const id = this.getAttribute('data-id');

                    // Populate the modal with the invoice data
                    document.getElementById('modal-invoice').innerText = `Invoice #: ${invoice}`;
                    document.getElementById('modal-total-amount').innerText = amount;
                    document.getElementById('payment_id').value = id;



                    // Initialize items HTML with room rent
                    let itemsHtml = `
                <tr>
                    <td>
                        <h6 class="mb-0">Room Rent</h6>
                        <p class="mb-0">Included</p>
                    </td>
                    <td class="text-center">PHP 1,000.00</td>
                    <td class="text-center">PHP 1,000.00</td>
                </tr>
            `;

                    // Add Laptop row if applicable
                    if (laptop === '1') {
                        itemsHtml += `
                    <tr>
                        <td>
                            <h6 class="mb-0">Laptop</h6>
                        </td>
                        <td class="text-center">PHP 150.00</td>
                        <td class="text-center">PHP 150.00</td>
                    </tr>
                `;
                    }

                    // Add Electric Fan row if applicable
                    if (electricfan === '1') {
                        itemsHtml += `
                    <tr>
                        <td>
                            <h6 class="mb-0">Electric Fan</h6>
                        </td>
                        <td class="text-center">PHP 150.00</td>
                        <td class="text-center">PHP 150.00</td>
                    </tr>
                `;
                    }

                    // Populate the table body with the constructed HTML
                    document.getElementById('modal-body-items').innerHTML = itemsHtml;
                });
            });
        });
    </script>

    <script>
        document.getElementById('orImage').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImage').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>



</x-app-layout>

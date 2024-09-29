<x-guest-layout :assets="$assets ?? []">
    <style>
        .d-slider1 .swiper-button {
            width: 50px;
            height: 50px;
            position: absolute;
        }

        .d-slider1 .swiper-button.swiper-button-next {
            right: 12px;
            left: auto;
            top: 135px;
            background-color: black
        }

        .d-slider1 .swiper-button.swiper-button-prev {
            left: 12px;
            right: auto;
            top: 135px;
            background-color: black
        }

        .image-container {
            position: relative;
            display: inline-block;
            /* Allow positioning */
        }

        .image-container img {
            display: block;
            /* Removes bottom space */
            width: 100%;
            /* Make image responsive */
            height: auto;
            /* Maintain aspect ratio */
            filter: brightness(0.7);
            /* Darken the image */
        }

        .view-all-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            /* Center the button */
            padding: 10px 20px;
            background-color: rgba(0, 123, 255, 0.8);
            /* Semi-transparent background */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            z-index: 1;
            /* Ensure the button is above the image */
        }

        .view-all-button:hover {
            background-color: rgba(0, 100, 200, 0.9);
            /* Darker shade on hover */
        }
    </style>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- Include Bootstrap CSS -->

    <!-- Include jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <div class="row m-4">
        <div class="col-md-12 col-lg-12">
            <div class="row row-cols-1">
                <div class="d-slider1 overflow-hidden ">
                    <ul class="swiper-wrapper list-inline m-0 p-0 mb-2">
                        @foreach ($hostelimages->take(4) as $image)
                            <li class="swiper-slide card card-slide" data-aos="fade-up"
                                data-aos-delay="{{ 700 + $loop->index * 100 }}">
                                <div class="card-body">
                                    <img src="{{ asset($image->image_path) }}" alt="" style="width: 100%;">
                                </div>
                            </li>
                        @endforeach
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1200">
                            <div class="card-body">
                                <img src="{{ asset($hostelimages->last()->image_path) }}" alt=""
                                    style="width: 100%;">
                            </div>
                            <div class="view-all-container">
                                <button type="button" class="view-all-button" data-toggle="modal"
                                    data-target="#imageModal">
                                    View All
                                </button>
                            </div>
                        </li>

                    </ul>
                    <div class="swiper-button swiper-button-next"></div>

                    <div class="swiper-button swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row m-4">
        <div class="row">

            <div class="col-md-12 col-lg-12">
                <div class="row">

                    <div class="col-md-8 col-lg-8">
                        <div class="row">
                            <h1>Choose Your Room</h1>
                            <div class="col-lg-12">

                                @forelse ($hostelrooms as $hostelroom)
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex flex-column">
                                                <div class="row">

                                                    <div class="col-lg-8">

                                                        <div class="mb-3">
                                                            <h2>Room {{ $hostelroom->id }}: {{ $hostelroom->name }}</h2>
                                                            {{-- <span class="text-primary">Status</span> --}}
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="row align-items-center price-add-row">
                                                            <div class="col">
                                                                <h4>PHP{{ $hostelroom->price }}</h4>
                                                            </div>
                                                            <div class="col">
                                                                <a href="#"
                                                                    class="btn btn-link btn-soft-light add-to-cart"
                                                                    style="color: black" data-id="{{ $hostelroom->id }}"
                                                                    data-name="{{ $hostelroom->name }}"
                                                                    data-price="PHP{{ $hostelroom->price }}">
                                                                    <svg width="32" viewBox="0 0 24 24"
                                                                        fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M7.33 2H16.66C20.06 2 22 3.92 22 7.33V16.67C22 20.06 20.07 22 16.67 22H7.33C3.92 22 2 20.06 2 16.67V7.33C2 3.92 3.92 2 7.33 2ZM12.82 12.83H15.66C16.12 12.82 16.49 12.45 16.49 11.99C16.49 11.53 16.12 11.16 15.66 11.16H12.82V8.34C12.82 7.88 12.45 7.51 11.99 7.51C11.53 7.51 11.16 7.88 11.16 8.34V11.16H8.33C8.11 11.16 7.9 11.25 7.74 11.4C7.59 11.56 7.5 11.769 7.5 11.99C7.5 12.45 7.87 12.82 8.33 12.83H11.16V15.66C11.16 16.12 11.53 16.49 11.99 16.49C12.45 16.49 12.82 16.12 12.82 15.66V12.83Z"
                                                                            fill="currentColor" />
                                                                    </svg>
                                                                    Add
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    @if ($hostelroom->images->isNotEmpty())
                                                        <div id="carousel-{{ $hostelroom->id }}" class="carousel slide"
                                                            data-bs-ride="carousel">
                                                            <div class="carousel-inner">
                                                                @foreach ($hostelroom->images as $key => $image)
                                                                    <div
                                                                        class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                                        <img src="{{ $image->image_path }}"
                                                                            alt="{{ $hostelroom->name }}"
                                                                            class="d-block w-100"
                                                                            style="height: 400px; object-fit: cover;">
                                                                    </div>
                                                                @endforeach
                                                            </div>

                                                            @if ($hostelroom->images->count() > 1)
                                                                <!-- Show buttons only if more than one image -->
                                                                <button class="carousel-control-prev" type="button"
                                                                    data-bs-target="#carousel-{{ $hostelroom->id }}"
                                                                    data-bs-slide="prev">
                                                                    <span class="carousel-control-prev-icon"
                                                                        aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Previous</span>
                                                                </button>
                                                                <button class="carousel-control-next" type="button"
                                                                    data-bs-target="#carousel-{{ $hostelroom->id }}"
                                                                    data-bs-slide="next">
                                                                    <span class="carousel-control-next-icon"
                                                                        aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Next</span>
                                                                </button>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <p>No images available for this room.</p>
                                                    @endif


                                                    <p>
                                                        {{ $hostelroom->description }}
                                                    </p>
                                                    <p>
                                                        <svg width="32" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M16.1583 8.23285C16.1583 10.5825 14.2851 12.4666 11.949 12.4666C9.61292 12.4666 7.73974 10.5825 7.73974 8.23285C7.73974 5.88227 9.61292 4 11.949 4C14.2851 4 16.1583 5.88227 16.1583 8.23285ZM11.949 20C8.51785 20 5.58809 19.456 5.58809 17.2802C5.58809 15.1034 8.49904 14.5396 11.949 14.5396C15.3802 14.5396 18.31 15.0836 18.31 17.2604C18.31 19.4362 15.399 20 11.949 20ZM17.9571 8.30922C17.9571 9.50703 17.5998 10.6229 16.973 11.5505C16.9086 11.646 16.9659 11.7748 17.0796 11.7946C17.2363 11.8216 17.3984 11.8369 17.5631 11.8414C19.2062 11.8846 20.6809 10.821 21.0883 9.21974C21.6918 6.84123 19.9198 4.7059 17.6634 4.7059C17.4181 4.7059 17.1835 4.73201 16.9551 4.77884C16.9238 4.78605 16.8907 4.80046 16.8728 4.82838C16.8513 4.8626 16.8674 4.90853 16.8889 4.93825C17.5667 5.8938 17.9571 7.05918 17.9571 8.30922ZM20.6782 13.5126C21.7823 13.7296 22.5084 14.1727 22.8093 14.8166C23.0636 15.3453 23.0636 15.9586 22.8093 16.4864C22.349 17.4851 20.8654 17.8058 20.2887 17.8886C20.1696 17.9066 20.0738 17.8031 20.0864 17.6833C20.3809 14.9157 18.0377 13.6035 17.4315 13.3018C17.4055 13.2883 17.4002 13.2676 17.4028 13.255C17.4046 13.246 17.4154 13.2316 17.4351 13.2289C18.7468 13.2046 20.1571 13.3847 20.6782 13.5126ZM6.43711 11.8413C6.60186 11.8368 6.76304 11.8224 6.92063 11.7945C7.03434 11.7747 7.09165 11.6459 7.02718 11.5504C6.4004 10.6228 6.04313 9.50694 6.04313 8.30913C6.04313 7.05909 6.43353 5.89371 7.11135 4.93816C7.13284 4.90844 7.14806 4.86251 7.12746 4.82829C7.10956 4.80127 7.07553 4.78596 7.04509 4.77875C6.81586 4.73192 6.58127 4.70581 6.33593 4.70581C4.07951 4.70581 2.30751 6.84114 2.91191 9.21965C3.31932 10.8209 4.79405 11.8845 6.43711 11.8413ZM6.59694 13.2545C6.59962 13.268 6.59425 13.2878 6.56918 13.3022C5.9621 13.6039 3.61883 14.9161 3.91342 17.6827C3.92595 17.8034 3.83104 17.9061 3.71195 17.889C3.13531 17.8061 1.65163 17.4855 1.19139 16.4867C0.936203 15.9581 0.936203 15.3457 1.19139 14.817C1.49225 14.1731 2.21752 13.73 3.32156 13.512C3.84358 13.385 5.25294 13.2049 6.5656 13.2292C6.5853 13.2319 6.59515 13.2464 6.59694 13.2545Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                        <strong>{{ $hostelroom->pax }} Pax</strong>
                                                    </p>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <h4>No Rooms Yet</h4>
                                @endforelse
                            </div>


                        </div>
                        <hr>
                        <h3>House Rules</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                                            <svg width="60" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M11.8861 2H16.9254C19.445 2 21.5 4 21.5 6.44V17.56C21.5 20.01 19.445 22 16.9047 22H11.8758C9.35611 22 7.29083 20.01 7.29083 17.57V12.77H13.6932L12.041 14.37C11.7312 14.67 11.7312 15.16 12.041 15.46C12.1959 15.61 12.4024 15.68 12.6089 15.68C12.8051 15.68 13.0117 15.61 13.1666 15.46L16.1819 12.55C16.3368 12.41 16.4194 12.21 16.4194 12C16.4194 11.8 16.3368 11.6 16.1819 11.46L13.1666 8.55C12.8568 8.25 12.3508 8.25 12.041 8.55C11.7312 8.85 11.7312 9.34 12.041 9.64L13.6932 11.23H7.29083V6.45C7.29083 4 9.35611 2 11.8861 2ZM2.5 11.9999C2.5 11.5799 2.85523 11.2299 3.2815 11.2299H7.29052V12.7699H3.2815C2.85523 12.7699 2.5 12.4299 2.5 11.9999Z"
                                                    fill="green" />
                                            </svg>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><strong>Check-In</strong></h5>
                                                <p class="card-text">Check-in time is from 2:00 PM to 10:00 PM. Please
                                                    ensure to arrive during this window.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                                            <svg width="60" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M9.89535 11.23C9.45785 11.23 9.11192 11.57 9.11192 12C9.11192 12.42 9.45785 12.77 9.89535 12.77H16V17.55C16 20 13.9753 22 11.4724 22H6.51744C4.02471 22 2 20.01 2 17.56V6.45C2 3.99 4.03488 2 6.52762 2H11.4927C13.9753 2 16 3.99 16 6.44V11.23H9.89535ZM19.6302 8.5402L22.5502 11.4502C22.7002 11.6002 22.7802 11.7902 22.7802 12.0002C22.7802 12.2002 22.7002 12.4002 22.5502 12.5402L19.6302 15.4502C19.4802 15.6002 19.2802 15.6802 19.0902 15.6802C18.8902 15.6802 18.6902 15.6002 18.5402 15.4502C18.2402 15.1502 18.2402 14.6602 18.5402 14.3602L20.1402 12.7702H16.0002V11.2302H20.1402L18.5402 9.6402C18.2402 9.3402 18.2402 8.8502 18.5402 8.5502C18.8402 8.2402 19.3302 8.2402 19.6302 8.5402Z"
                                                    fill="red" />
                                            </svg>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><strong>Check-Out</strong></h5>
                                                <p class="card-text">Check-out time is before 11:00 AM. Please return
                                                    your keys to the front desk.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h3>Reviews</h3>
                        <div class="row">

                        </div>


                    </div>
                    {{-- Cart --}}
                    <div class="col-lg-4">
                        <div class="card sticky-xl-top">
                            <div class="card-header">
                                <div class="form-group">
                                    <input type="text" name="daterange" id="daterange"
                                        class="form-control range_flatpicker" placeholder="Select Date Range">
                                </div>
                            </div>
                            <div class="card-body">
                                <ul id="cart-items" class="list-inline m-0 p-0">
                                </ul>
                                <h4 id="total-price">Total Price: PHP 0.00</h4>
                                <hr>
                                <button id="book-now" class=" form-control btn btn-primary"
                                    style="display: none;">Book
                                    Now</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">All Hostel Images</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @foreach ($hostelimages as $image)
                            <div class="col-md-4 mb-3">
                                <img src="{{ asset($image->image_path) }}" alt="" class="img-fluid">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Details Modal -->
    <div class="modal fade" id="userDetailsModal" tabindex="-1" role="dialog"
        aria-labelledby="userDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userDetailsModalLabel">Enter Your Reservation Details</h5>
                    <button type="button" class="close" aria-label="Close" id="close-modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="check_in_date">Check-in Date</label>
                        <input type="date" class="form-control" id="check_in_date" name="check_in_date" required
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="check_out_date">Check-out Date</label>
                        <input type="date" class="form-control" id="check_out_date" name="check_out_date"
                            required readonly>
                    </div>
                    <div class="form-group">
                        <label for="total_price">Total Price</label>
                        <input type="text" class="form-control" id="total_price" name="total_price" readonly>
                    </div>

                    <h5>Cart Items:</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Room ID</th>
                                <th>Room Name</th>
                                <th>Price</th>
                                <th>Days</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody id="modal-cart-items">
                            <!-- Cart items will be populated here -->
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancel-button">Cancel</button>
                    <button type="button" class="btn btn-primary" id="save-user-details">Submit</button>
                </div>
            </div>
        </div>
    </div>





    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cartItemsContainer = document.getElementById('cart-items');
            const totalPriceElement = document.getElementById('total-price');
            const bookNowButton = document.getElementById('book-now');
            const checkInInput = document.getElementById('check_in_date');
            const checkOutInput = document.getElementById('check_out_date');

            let totalPrice = 0;
            let daysBetween = 0; // Initialize daysBetween outside

            // Initialize the date range picker
            flatpickr("#daterange", {
                mode: "range",
                dateFormat: "Y-m-d",
                onChange: function(selectedDates) {
                    if (selectedDates.length === 2) {
                        checkInInput.value = selectedDates[0].toISOString().split('T')[0];
                        checkOutInput.value = selectedDates[1].toISOString().split('T')[0];
                        const startDate = selectedDates[0].getTime();
                        const endDate = selectedDates[1].getTime();
                        daysBetween = Math.round((endDate - startDate) / (1000 * 60 * 60 * 24)) +
                            1; // Calculate days
                        updateCartItems(
                            daysBetween); // Update the cart items based on the new date range
                    }
                }
            });

            // Add to cart event listeners
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default anchor click behavior

                    const itemName = this.getAttribute('data-name');
                    const itemId = this.getAttribute('data-id');
                    const itemPrice = parseFloat(this.getAttribute('data-price').replace('PHP', '')
                        .replace(',', '').trim());

                    // Create a new list item for the cart
                    const cartItem = document.createElement('li');
                    cartItem.className =
                        'd-flex justify-content-between align-items-center mb-4 position-relative';
                    const itemDetails = document.createElement('div');

                    // Calculate the initial item total price
                    const itemTotalPrice = itemPrice * daysBetween;
                    itemDetails.innerHTML =
                        `<strong>Room ${itemId}: ${itemName}</strong><br>Price: PHP ${itemPrice.toFixed(2)} x ${daysBetween} days = PHP ${itemTotalPrice.toFixed(2)}`;

                    // Create a trash button
                    const trashButton = document.createElement('button');
                    trashButton.innerHTML = '🗑️';
                    trashButton.className =
                        'btn btn-link text-danger position-absolute top-0 end-0';
                    trashButton.style.marginTop = '-10px';
                    trashButton.style.marginRight = '-10px';

                    // Add event listener for the trash button
                    trashButton.addEventListener('click', function() {
                        cartItemsContainer.removeChild(cartItem);
                        updateCartItems(daysBetween);
                        updateTotalPrice();
                    });

                    // Append details and trash button to the cart item
                    cartItem.appendChild(itemDetails);
                    cartItem.appendChild(trashButton);

                    // Append the item to the cart
                    cartItemsContainer.appendChild(cartItem);
                    totalPrice += itemTotalPrice; // Add to total price
                    updateTotalPrice();
                });
            });

            function updateCartItems(daysBetween) {
                totalPrice = 0;
                if (cartItemsContainer.children.length === 0) return;

                // Update each cart item price based on the date range
                cartItemsContainer.querySelectorAll('li').forEach(cartItem => {
                    const itemDetails = cartItem.querySelector('div');
                    if (!itemDetails) return;

                    const priceText = itemDetails.innerHTML.split('<br>')[1];
                    const originalPriceMatch = priceText.match(/Price: PHP (\d+(\.\d+)?)/);
                    if (!originalPriceMatch) return;

                    const originalPrice = parseFloat(originalPriceMatch[1]);
                    const newItemTotalPrice = originalPrice * daysBetween;
                    const itemName = itemDetails.innerHTML.split('<br>')[0];
                    itemDetails.innerHTML =
                        `${itemName}<br>Price: PHP ${originalPrice.toFixed(2)} x ${daysBetween} days = PHP ${newItemTotalPrice.toFixed(2)}`;
                    totalPrice += newItemTotalPrice; // Accumulate the new item total price
                });

                updateTotalPrice();
            }

            function updateTotalPrice() {
                totalPriceElement.textContent = `Total Price: PHP ${totalPrice.toFixed(2)}`;
                bookNowButton.style.display = totalPrice > 0 ? 'block' : 'none';
            }

            bookNowButton.addEventListener('click', function(event) {
                event.preventDefault();

                // Clear previous items in the table
                const modalCartItemsContainer = document.getElementById('modal-cart-items');
                modalCartItemsContainer.innerHTML = '';

                // Populate the cart items in the modal table
                cartItemsContainer.querySelectorAll('li').forEach(cartItem => {
                    const itemDetails = cartItem.querySelector('div');
                    if (itemDetails) {
                        const itemText = itemDetails.innerText;
                        const itemIdMatch = itemText.match(/Room (\d+):/);
                        const itemNameMatch = itemText.match(/Room \d+: (.+)/);
                        const priceMatch = itemText.match(/Price: PHP (\d+(\.\d+)?)/);
                        const daysMatch = itemText.match(/x (\d+) days/);
                        const totalMatch = itemText.match(/= PHP (\d+(\.\d+)?)/);

                        // Create a new table row
                        const listItem = document.createElement('tr');
                        listItem.innerHTML = `
                    <td>${itemIdMatch ? itemIdMatch[1] : 'N/A'}</td>
                    <td>${itemNameMatch ? itemNameMatch[1] : 'N/A'}</td>
                    <td>PHP ${priceMatch ? parseFloat(priceMatch[1]).toFixed(2) : '0.00'}</td>
                    <td>${daysMatch ? daysMatch[1] : '0'} days</td>
                    <td>PHP ${totalMatch ? parseFloat(totalMatch[1]).toFixed(2) : '0.00'}</td>
                `;
                        modalCartItemsContainer.appendChild(listItem);
                    }
                });

                // Set the total price in the modal
                document.getElementById('total_price').value = `PHP ${totalPrice.toFixed(2)}`;

                // Show the modal
                $('#userDetailsModal').modal('show');
            });

            // Reset all data after success
            function resetForm() {
                // Clear cart items
                cartItemsContainer.innerHTML = '';
                totalPrice = 0;
                totalPriceElement.textContent = 'Total Price: PHP 0.00';
                checkInInput.value = '';
                checkOutInput.value = '';
                bookNowButton.style.display = 'none';
            }

            // Save user details and submit the form
            document.getElementById('save-user-details').addEventListener('click', function() {
                const firstname = document.getElementById('firstname').value;
                const lastname = document.getElementById('lastname').value;
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;

                // Gather cart items
                const cartItems = [];
                const modalCartItems = document.getElementById('modal-cart-items');
                modalCartItems.querySelectorAll('tr').forEach(row => {
                    const roomId = row.cells[0].innerText;
                    const roomName = row.cells[1].innerText;
                    const price = row.cells[2].innerText.replace('PHP ', '');
                    const days = row.cells[3].innerText;
                    const total = row.cells[4].innerText.replace('PHP ', '');

                    cartItems.push({
                        roomId,
                        roomName,
                        price,
                        days,
                        total
                    });
                });

                // Get CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Use jQuery AJAX to send data
                $.ajax({
                    url: '/guest/reserve',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        firstname,
                        lastname,
                        email,
                        password,
                        checkInDate: checkInInput.value,
                        checkOutDate: checkOutInput.value,
                        totalPrice: `PHP ${totalPrice.toFixed(2)}`,
                        cartItems
                    }),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(data) {
                        Swal.fire({
                            title: "Success!",
                            text: "Your reservation has been created successfully!",
                            icon: "success"
                        })
                        $('#userDetailsModal').modal('hide');
                        resetForm(); // Call the reset function
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>

    <script>
        document.getElementById('cancel-button').addEventListener('click', function() {
            $('#userDetailsModal').modal('hide');
        });

        document.getElementById('close-modal').addEventListener('click', function() {
            $('#userDetailsModal').modal('hide');
        });
    </script>




</x-guest-layout>

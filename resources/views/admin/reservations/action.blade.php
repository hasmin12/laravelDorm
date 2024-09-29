<div class="flex align-items-center list-user-action">
    <a class="btn btn-sm btn-icon btn-warning" id="fetchUsers" data-bs-toggle="modal"
        data-bs-target="#updateModal{{ $id }}" data-id="{{ $id }}" data-bs-toggle="tooltip"
        title="Update Reservation" href="#">
        <span class="btn-inner">
            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </span>
    </a>
</div>

<!-- Update Reservation Modal -->
<div class="modal fade" id="updateModal{{ $id }}" tabindex="-1" aria-labelledby="updateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Reservation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm" method="POST" action="{{ route('admin.updateReservation', $id) }}"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="check_in_date" class="form-label">Name</label>
                        <input type="text" class="form-control" id="check_in_date" name="check_in_date"
                            value="{{ $user['first_name'] }} {{ $user['last_name'] }}" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="check_in_date" class="form-label">Room</label>
                        <input type="text" class="form-control" id="check_in_date" name="check_in_date"
                            value="{{ $hostel_room['name'] }}" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="check_in_date" class="form-label">Check-In Date</label>
                        <input type="date" class="form-control" id="check_in_date" name="check_in_date"
                            value="{{ $check_in_date }}" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="check_out_date" class="form-label">Check-Out Date</label>
                        <input type="date" class="form-control" id="check_out_date" name="check_out_date"
                            value="{{ $check_out_date }}" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="total_price" class="form-label">Total Price</label>
                        <input type="number" class="form-control" id="total_price" name="total_price"
                            value="{{ $total_price }}" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>

                            <option value="confirmed" {{ $status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="cancelled" {{ $status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>

                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Reservation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

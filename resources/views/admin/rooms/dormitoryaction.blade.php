<div class="flex align-items-center list-user-action">
    <a class="btn btn-sm btn-icon btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal{{ $id }}"
        data-id="{{ $id }}" data-bs-toggle="tooltip" title="Update Room" href="#">
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
    <a class="btn btn-sm btn-icon btn-warning" title="View Room" href="{{ route('dormitory.showbed', $id) }}">
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



<div class="modal fade" id="updateModal{{ $id }}" tabindex="-1" role="dialog"
    aria-labelledby="dormitoryRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dormitoryRoomModalLabel">Update Dormitory Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <form action="{{ route('dormitory.updateRoom', $id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Room Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="totalBed">Total Beds</label>
                        <input type="number" class="form-control" id="totalBed" name="totalBed" min="1"
                            value="{{ $totalBed }}" required>
                    </div>
                    <div class="form-group">
                        <label for="type">Room Type</label>
                        <select class="form-control" id="type" name="type" required>


                            <option value="Student" {{ $type == 'Student' ? 'selected' : '' }}>Student</option>
                            <option value="Faculty Member" {{ $type == 'Faculty Member' ? 'selected' : '' }}>Faculty
                                Member
                            </option>
                            <option value="Staff" {{ $type == 'Staff' ? 'selected' : '' }}>Staff</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="Male" {{ $category == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $category == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>

                            <option value="available" {{ $status == 'available' ? 'selected' : '' }}>Available
                            </option>
                            <option value="unavailable" {{ $status == 'unavailable' ? 'selected' : '' }}>Unavailable
                            </option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Room</button>
                </div>
            </form>
        </div>
    </div>
</div>

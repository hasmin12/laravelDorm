<div class="flex align-items-center list-user-action">
    <a class="btn btn-sm btn-icon btn-warning" id="fetchUsers" data-bs-toggle="modal"
        data-bs-target="#updateModal{{ $id }}" data-id="{{ $id }}" data-bs-toggle="tooltip"
        title="Update Item" href="#">
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

<!-- Update Modal for editing items -->
<div class="modal fade" id="updateModal{{ $id }}" tabindex="-1" aria-labelledby="updateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm" method="POST" action="{{ route('admin.updateItem', $id) }}"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')


                    <div class="mb-3">
                        <label for="update_owner" class="form-label">Owner</label>
                        <input type="text" class="form-control" id="update_owner" name="owner"
                            value="{{ old('owner', $owner) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="update_contact_number" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="update_contact_number" name="contact_number"
                            value="{{ old('contact_number', $contact_number) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="update_item_name" class="form-label">Item Name</label>
                        <input type="text" class="form-control" id="update_item_name" name="item_name"
                            value="{{ old('item_name', $item_name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="update_description" class="form-label">Description</label>
                        <textarea class="form-control" id="update_description" name="description" rows="3">{{ old('description', $description) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="update_status" class="form-label">Status</label>
                        <select class="form-select" id="update_status" name="status" required>
                            <option value="lost" {{ $status == 'lost' ? 'selected' : '' }}>Lost</option>
                            <option value="found" {{ $status == 'found' ? 'selected' : '' }}>Found</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="update_reported_at" class="form-label">Reported At</label>
                        <input type="datetime-local" class="form-control" id="update_reported_at" name="reported_at"
                            value="{{ old('reported_at', \Carbon\Carbon::parse($reported_at)->format('Y-m-d\TH:i')) }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="update_image" class="form-label">Image (optional)</label>
                        <input type="file" class="form-control" id="update_image" name="image">
                        @if ($image_path)
                            <img src="{{ asset('storage/' . $image_path) }}" alt="Current Image" class="mt-2"
                                style="max-width: 100px;">
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

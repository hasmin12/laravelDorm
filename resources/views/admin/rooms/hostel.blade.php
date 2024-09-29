@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{ $pageTitle ?? 'List' }}</h4>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add
                                Room</button>
                        </div>

                    </div>
                    <div class="card-body px-0">
                        <div class="table-responsive">
                            {{ $dataTable->table(['class' => 'table text-center table-striped w-100'], true) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="dormitoryRoomModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dormitoryRoomModalLabel">Add Hostel Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <form action="{{ route('hostel.addRoom') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Room Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="floorNumber">Floor Number</label>
                            <input type="number" class="form-control" id="floorNumber" name="floorNumber" required>
                        </div>
                        <div class="form-group">
                            <label for="beds">Number of Beds</label>
                            <input type="number" class="form-control" id="beds" name="beds" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" step="1" class="form-control" id="price" name="price"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="pax">Pax</label>
                            <input type="number" class="form-control" id="pax" name="pax" required>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="available">Available</option>
                                <option value="unavailable">Unavailable</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Room</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</x-app-layout>

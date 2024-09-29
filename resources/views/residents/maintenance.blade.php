<x-app-layout :assets="$assets ?? []">
    <div class="inner-card-box">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-end">
                    <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#maintenanceModal">
                        Request Maintenance
                    </a>
                </div>
            </div>

            <div class="row">
                @forelse ($maintenance as $maintenanceItem)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset($maintenanceItem->image_path) }}" class="card-img-top"
                                alt="{{ $maintenanceItem->type }}" style="height: 300px">
                            <div class="card-body">
                                <h5 class="card-title">{{ $maintenanceItem->type }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    {{ $maintenanceItem->requested_at->format('F j, Y') }}</h6>
                                <p class="card-text">{{ Str::limit($maintenanceItem->description, 100) }}</p>
                                <p class="card-text"><strong>Room:</strong> {{ $maintenanceItem->room_details }}</p>
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#statusModal{{ $maintenanceItem->id }}"
                                    data-maintenance-id="{{ $maintenanceItem->id }}">View Status</a>
                            </div>
                        </div>
                    </div>

                    <!-- Status Modal -->
                    <div class="modal fade" id="statusModal{{ $maintenanceItem->id }}" tabindex="-1"
                        aria-labelledby="statusModalLabel{{ $maintenanceItem->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="statusModalLabel{{ $maintenanceItem->id }}">Maintenance
                                        Status</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Maintenance Details Section -->
                                    <h5>Maintenance Details</h5>

                                    <div class="row mb-4">
                                        <div class="col-lg-6">
                                            <img src="{{ asset($maintenanceItem->image_path) }}" class="card-img-top"
                                                alt="{{ $maintenanceItem->type }}" style="height: 300px">
                                        </div>
                                        <div class="col-lg-6">
                                            <p><strong>Type:</strong> {{ $maintenanceItem->type }}</p>
                                            <p><strong>Description:</strong> {{ $maintenanceItem->description }}
                                            </p>
                                            <p><strong>Date:</strong>
                                                {{ $maintenanceItem->requested_at->format('F j, Y') }}</p>
                                            <p><strong>Room:</strong> {{ $maintenanceItem->room_details }}</p>
                                        </div>

                                    </div>


                                    <!-- Maintenance Status Timeline -->
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h4 class="card-title">Maintenance Timeline</h4>
                                        </div>
                                        <div class="card-body">
                                            <div
                                                class="iq-timeline0 m-0 d-flex align-items-center justify-content-between position-relative">
                                                <ul class="list-inline p-0 m-0">
                                                    @forelse ($maintenanceItem->maintenanceStatus as $status)
                                                        <li>
                                                            <div
                                                                class="timeline-dots timeline-dot1 border-primary text-primary">
                                                            </div>
                                                            <h6 class="float-left mb-1">{{ $status->title }}</h6>
                                                            <small
                                                                class="float-right mt-1">{{ $status->created_at->format('F j, Y') }}</small>
                                                            <div class="d-inline-block w-100">
                                                                <p>{{ $status->message }}</p>
                                                            </div>
                                                        </li>
                                                    @empty
                                                        <h5>No Status Yet</h5>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="col-12 mt-5">
                        <h1 class="text-center">No Requested Maintenance</h1>
                    </div>
                @endforelse
            </div>


            <!-- Request Modal -->
            <div class="modal fade" id="maintenanceModal" tabindex="-1" aria-labelledby="maintenanceModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="maintenanceModalLabel">Request Maintenance</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('user.requestmaintenance') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="maintenanceType" class="form-label">Choose Maintenance Type</label>
                                    <select class="form-select" id="maintenanceType" name="maintenance_type" required>
                                        <option value="" disabled selected>Select maintenance type</option>
                                        @foreach ($maintenancelist as $item)
                                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Upload Image</label>
                                    <input class="form-control" type="file" id="image" name="image"
                                        accept="image/*" required>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit Request</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
</x-app-layout>

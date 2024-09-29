<x-app-layout layout="boxed" :assets="$assets ?? []">
    <div class="inner-card-box">
        <div class="container">
            <div class="row">
                @forelse ($maintenance as $maintenanceItem)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset($maintenanceItem->image_path) }}" class="card-img-top"
                                alt="{{ $maintenanceItem->type }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $maintenanceItem->type }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    {{ $maintenanceItem->requested_at->format('F j, Y') }}</h6>
                                <p class="card-text">{{ Str::limit($maintenanceItem->description, 100) }}</p>
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
                                    <div class="mb-4">
                                        <h6>Maintenance Details</h6>
                                        <p><strong>Type:</strong> {{ $maintenanceItem->type }}</p>
                                        <p><strong>Description:</strong> {{ $maintenanceItem->description }}</p>
                                        <p><strong>Date:</strong>
                                            {{ $maintenanceItem->requested_at->format('F j, Y') }}</p>
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

                                    @if ($maintenanceItem->status !== 'completed')
                                        <div class="mt-4">
                                            <h6>Add New Status</h6>
                                            <form
                                                action="{{ route('maintenance.status.store', $maintenanceItem->id) }}"
                                                method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label">Select Status (Check all that
                                                        apply):</label>
                                                    <div class="form-check">
                                                        @if ($maintenanceItem->completion_percentage < 10)
                                                            <input type="checkbox" class="form-check-input"
                                                                id="check{{ $maintenanceItem->id }}" name="status[]"
                                                                value="10"
                                                                {{ $maintenanceItem->completion_percentage >= 10 ? 'checked' : '' }}
                                                                {{ $maintenanceItem->completion_percentage === 10 ? 'disabled' : '' }}
                                                                onclick="updateCheckBox(this, ['check{{ $maintenanceItem->id }}'])">
                                                            <label class="form-check-label"
                                                                for="check{{ $maintenanceItem->id }}">Check -
                                                                10%</label>
                                                        @endif
                                                    </div>
                                                    <div class="form-check">
                                                        @if ($maintenanceItem->completion_percentage < 20)
                                                            <input type="checkbox" class="form-check-input"
                                                                id="plan{{ $maintenanceItem->id }}" name="status[]"
                                                                value="10"
                                                                {{ $maintenanceItem->completion_percentage >= 20 ? 'checked' : '' }}
                                                                {{ $maintenanceItem->completion_percentage >= 20 ? 'disabled' : '' }}
                                                                onclick="updateCheckBox(this, ['check{{ $maintenanceItem->id }}', 'plan{{ $maintenanceItem->id }}'])">
                                                            <label class="form-check-label"
                                                                for="plan{{ $maintenanceItem->id }}">Plan - 10%</label>
                                                        @endif
                                                    </div>
                                                    <div class="form-check">
                                                        @if ($maintenanceItem->completion_percentage < 30)
                                                            <input type="checkbox" class="form-check-input"
                                                                id="prepare_tools{{ $maintenanceItem->id }}"
                                                                name="status[]" value="10"
                                                                {{ $maintenanceItem->completion_percentage >= 30 ? 'checked' : '' }}
                                                                {{ $maintenanceItem->completion_percentage >= 30 ? 'disabled' : '' }}
                                                                onclick="updateCheckBox(this, ['check{{ $maintenanceItem->id }}', 'plan{{ $maintenanceItem->id }}', 'prepare_tools{{ $maintenanceItem->id }}'])">
                                                            <label class="form-check-label"
                                                                for="prepare_tools{{ $maintenanceItem->id }}">Prepare
                                                                Tools - 10%</label>
                                                        @endif
                                                    </div>
                                                    <div class="form-check">
                                                        @if ($maintenanceItem->completion_percentage < 80)
                                                            <input type="checkbox" class="form-check-input"
                                                                id="execute{{ $maintenanceItem->id }}" name="status[]"
                                                                value="50"
                                                                {{ $maintenanceItem->completion_percentage >= 80 ? 'checked' : '' }}
                                                                {{ $maintenanceItem->completion_percentage >= 80 ? 'disabled' : '' }}
                                                                onclick="updateCheckBox(this, ['check{{ $maintenanceItem->id }}', 'plan{{ $maintenanceItem->id }}', 'prepare_tools{{ $maintenanceItem->id }}', 'execute{{ $maintenanceItem->id }}'])">
                                                            <label class="form-check-label"
                                                                for="execute{{ $maintenanceItem->id }}">Execute -
                                                                50%</label>
                                                        @endif
                                                    </div>
                                                    <div class="form-check">
                                                        @if ($maintenanceItem->completion_percentage < 100)
                                                            <input type="checkbox" class="form-check-input"
                                                                id="finalize{{ $maintenanceItem->id }}" name="status[]"
                                                                value="20"
                                                                {{ $maintenanceItem->completion_percentage >= 100 ? 'checked' : '' }}
                                                                {{ $maintenanceItem->completion_percentage >= 100 ? 'disabled' : '' }}
                                                                onclick="updateCheckBox(this, ['check{{ $maintenanceItem->id }}', 'plan{{ $maintenanceItem->id }}', 'prepare_tools{{ $maintenanceItem->id }}', 'execute{{ $maintenanceItem->id }}', 'finalize{{ $maintenanceItem->id }}'])">
                                                            <label class="form-check-label"
                                                                for="finalize{{ $maintenanceItem->id }}">Finalize -
                                                                20%</label>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="message{{ $maintenanceItem->id }}"
                                                        class="form-label">Message</label>
                                                    <textarea class="form-control" id="message{{ $maintenanceItem->id }}" name="message" rows="3" required></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit Status</button>
                                            </form>
                                        </div>

                                        <script>
                                            function updateCheckBox(source, dependentCheckboxIds) {
                                                const isChecked = source.checked;
                                                dependentCheckboxIds.forEach(id => {
                                                    const checkbox = document.getElementById(id);
                                                    if (checkbox) {
                                                        checkbox.checked = isChecked;
                                                        if (isChecked) {
                                                            checkbox.disabled = false; // Enable if checked
                                                        }
                                                    }
                                                });
                                            }
                                        </script>
                                    @endif

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
        </div>
    </div>
</x-app-layout>

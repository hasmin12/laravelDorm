@push('scripts')
    {{ $dataTable->scripts() }}
@endpush

<x-app-layout :assets="$assets ?? []">
    <style>
        .message-column {
            max-width: 200px;
            /* Set the max width for the column */
            overflow: hidden;
            /* Hide overflow content */
            text-overflow: ellipsis;
            /* Show ellipsis for overflow */
            white-space: nowrap;
            /* Prevent line breaks */
        }

        .title-column {
            max-width: 200px;
            /* Set the max width for the column */
            overflow: hidden;
            /* Hide overflow content */
            text-overflow: ellipsis;
            /* Show ellipsis for overflow */
            white-space: nowrap;
            /* Prevent line breaks */
        }
    </style>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{ $pageTitle ?? 'List' }}</h4>
                        </div>
                        <div class="card-action">
                            {{-- Button to open modal --}}
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#announcementModal">
                                Create Announcement
                            </button>
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

    {{-- Modal for creating announcement --}}
    <div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="announcementModalLabel">Create Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="announcementCreateForm" method="POST" action="{{ route('announcement.store') }}"
                    enctype="multipart/form-data">
                    @csrf <!-- CSRF token for security -->
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="announcementTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="announcementTitle" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="announcementMessage" class="form-label">Message</label>
                            <textarea class="form-control" id="announcementMessage" name="message" rows="4" required></textarea>
                        </div>
                        {{-- <div class="mb-3">
                            <label for="publishedAt" class="form-label">Publish Date</label>
                            <input type="datetime-local" class="form-control" id="publishedAt" name="published_at"
                                required>
                        </div> --}}
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="" disabled selected>Select status</option>
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Announcement</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</x-app-layout>

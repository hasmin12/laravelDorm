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

    <!-- Modal -->
    <div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignModalLabel">Assign Maintenance User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="assignUserForm" method="POST" action="{{ route('admin.assignUser') }}">
                        @csrf
                        <input type="hidden" name="maintenance_id" id="maintenance_id">
                        <div class="row" id="modalBody"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="assignUserForm" class="btn btn-primary">Assign</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // When the modal is about to be shown
            $('#assignModal').on('show.bs.modal', function(event) {
                // Get the button that triggered the modal
                const button = $(event.relatedTarget); // Button that triggered the modal
                const maintenanceId = button.data('id'); // Extract the maintenance ID from data-* attribute

                // Set the maintenance ID in the hidden input field and modal data-id attribute
                $('#maintenance_id').val(maintenanceId);
                $(this).data('id', maintenanceId);

                console.log('Maintenance ID:', maintenanceId); // Optional logging

                // Fetch users from the server
                $.ajax({
                    url: '/api/maintenanceusers',
                    method: 'GET',
                    success: function(data) {
                        $('#modalBody').empty();

                        $.each(data, function(index, user) {
                            $('#modalBody').append(`
                            <div class="col-lg-4 col-md-6 mb-4">
                                <label class="card h-100 user-card" style="cursor: pointer;">
                                    <input type="radio" name="user_id" value="${user.id}" required style="display: none;">
                                    <img src="${user.image_path}" class="card-img-top" alt="${user.first_name} ${user.last_name}">
                                    <div class="card-body">
                                        <h5 class="card-title">${user.first_name} ${user.last_name}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">${user.last_name}</h6>
                                    </div>
                                </label>
                            </div>
                        `);
                        });

                        // Highlight selected card
                        $('.user-card input[type="radio"]').on('change', function() {
                            $('.user-card').removeClass(
                                'selected'); // Remove highlight from all cards
                            $(this).closest('.user-card').addClass(
                                'selected'); // Highlight the selected card
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching users: ", error);
                    }
                });
            });
        });
    </script>

</x-app-layout>

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
                            {!! $headerAction ?? '' !!}
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

    <!-- Modal Structure -->
    <div class="modal fade" id="assignBedModal" tabindex="-1" aria-labelledby="assignBedModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignBedModalLabel">Assign Bed</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.assignBed') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="user_id" name="user_id" required>

                        <p>Select a bed for the resident.</p>
                        <select class="form-select" name="bed_id" aria-label="Select Bed" required>
                            <option selected disabled>Select Bed</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Assign Resident</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#assignBedModal').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget);
                const userId = button.data('id');
                const sex = button.data('sex'); // 'Male' or 'Female'
                const type = button.data('type'); // 'Student', 'Faculty Member', 'Staff'
                const rooms = @json($rooms); // All rooms passed from the controller

                console.log('Sex:', sex);
                console.log('Type:', type);
                console.log('All Rooms:', rooms);

                // Clear existing options
                const bedSelect = $(this).find('select[name="bed_id"]');
                bedSelect.empty();
                bedSelect.append('<option selected disabled>Select Bed</option>');

                // Filter rooms based on sex and type
                const filteredRooms = rooms.filter(room => {
                    console.log(
                        `Checking room: ${room.category}, ${room.type}`
                    ); // Log each room's category and type
                    return (room.category === sex && room.type === type);
                });

                // Check the filtered results
                console.log('Filtered Rooms:', filteredRooms);

                // Populate the select element with filtered rooms
                filteredRooms.forEach(room => {
                    bedSelect.append(`<option value="${room.id}">${room.name}</option>`);
                });

                // Set the user ID
                $('#user_id').val(userId);
                $(this).data('id', userId);
            });
        });
    </script>



</x-app-layout>

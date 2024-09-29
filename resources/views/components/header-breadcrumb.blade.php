@props(['class', 'role'])
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="card-title mb-0">
                    <h4 class="mb-0">Laundry Calendar</h4>
                </div>
                @if (Auth::user()->user_type == 'user')
                    <div class="card-action">
                        <a href="#" class="btn btn-primary" role="button" data-toggle="modal"
                            data-target="#scheduleLaundryModal">Add Schedule</a>
                    </div>
                @endif



            </div>
        </div>
    </div>
</div>
<!-- Add Schedule Modal -->
<div class="modal fade" id="scheduleLaundryModal" tabindex="-1" role="dialog"
    aria-labelledby="scheduleLaundryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scheduleLaundryModalLabel">Schedule Laundry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.schedule') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="scheduled_at">Select Date</label>
                        <input type="date" class="form-control" id="scheduled_date" name="scheduled_date" required>
                    </div>

                    <div class="form-group">
                        <label for="scheduled_time">Select Time</label>
                        <select class="form-control" id="scheduled_time" name="scheduled_time" required>
                            <option value="">Select Time</option>
                            <option value="07:00">7 AM</option>
                            <option value="09:00">9 AM</option>
                            <option value="13:00">1 PM</option>
                            <option value="15:00">3 PM</option>
                        </select>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save Schedule</button>
            </div>
            </form>
        </div>
    </div>
</div>

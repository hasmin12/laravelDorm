<x-app-layout :assets="$assets ?? []">
    <div class="inner-card-box">
        <div class="container">
            <div class="row">
                @forelse ($announcements as $announcement)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset($announcement->image_path) }}" class="card-img-top"
                                alt="{{ $announcement->title }}" style="height: 300px">
                            <div class="card-body">
                                <h5 class="card-title">{{ $announcement->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    {{ $announcement->created_at->format('F j, Y') }}</h6>

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#announcementModal{{ $announcement->id }}">
                                    Read More
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="announcementModal{{ $announcement->id }}" tabindex="-1"
                        aria-labelledby="announcementModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="announcementModalLabel">{{ $announcement->title }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="{{ asset($announcement->image_path) }}" class="card-img-top"
                                        alt="{{ $announcement->title }}" style="height: 500px">
                                    <p id="announcementMessage">{{ $announcement->message }}</p>
                                    <p class="text-muted">Published on:
                                        {{ $announcement->published_at->format('F j, Y') }}</p>
                                    <!-- Added published_at -->
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
                        <h1 class="text-center">No Announcement</h1>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</x-app-layout>

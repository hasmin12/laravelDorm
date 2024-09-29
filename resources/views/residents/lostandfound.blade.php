<x-app-layout :assets="$assets ?? []">
    <div class="inner-card-box">
        <div class="container">
            <div class="row">
                @forelse ($lostitems as $lostitem)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset($lostitem->image_path) }}" class="card-img-top"
                                alt="{{ $lostitem->itemName }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $lostitem->itemName }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    {{ $lostitem->created_at->format('F j, Y') }}</h6>
                                <p class="card-text">{{ Str::limit($lostitem->description, 100) }}</p>
                                {{-- <a href="{{ route('announcements.show', $announcement->id) }}"
                                    class="btn btn-primary">Read More</a> --}}
                                {{-- <a href="#" class="btn btn-primary">Read More</a> --}}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 mt-5">
                        <h1 class="text-center">No Lost Items</h1>
                    </div>
                @endforelse


            </div>
        </div>
    </div>
</x-app-layout>

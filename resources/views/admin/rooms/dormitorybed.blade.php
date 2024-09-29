<x-app-layout :assets="$assets ?? []">
    <div class="inner-card-box">
        <div class="container">
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    Back
                </a>
            </div>
            <div class="row">
                @forelse ($room->beds as $bed)
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100">
                            <div class="d-flex justify-content-center">
                                <img src="{{ $bed->user ? asset($bed->user->image_path) : asset('/images/img/vacant.png') }}"
                                    class="card-img-top" alt="{{ $bed->id }}"
                                    style="width: 100%; max-width: 500px;">
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">{{ $bed->name }}</h5>
                                <p class="card-text">
                                    {{ $bed->user ? $bed->user->first_name . ' ' . $bed->user->last_name : 'Available' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 mt-5">
                        <h1 class="text-center">No Beds</h1>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

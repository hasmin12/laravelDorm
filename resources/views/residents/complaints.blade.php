@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
<x-app-layout :assets="$assets ?? []">
    <div class="container mt-5">
        <h2>{{ $pageTitle }}</h2>

        <div class="row mt-4">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Complaints</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            {{ $dataTable->table(['class' => 'table text-center table-striped w-100'], true) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>



</x-app-layout>

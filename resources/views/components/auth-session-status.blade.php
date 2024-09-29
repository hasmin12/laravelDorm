@props(['status'])

{{-- @if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600']) }}>
        {{ $status }}
    </div>
@endif --}}


@if ($status)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: "Success!",
                text: "{{ session('status') }}",
                icon: "success"
            })
        });
    </script>
@endif

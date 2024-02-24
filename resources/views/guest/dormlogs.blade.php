@extends('layouts.base')

@section('content')
    <div class="container">
        {{-- <form action="{{ route('scan.process') }}" method="POST"> --}}
        <form action="" method="POST">

            @csrf
            <label for="barcode">Scan Barcode:</label>
            <input type="text" id="barcode" name="barcode">
            <button type="submit">Submit</button>
        </form>
    </div>
@endsection

@section('scripts')
    <!-- Include barcode scanning library -->
    <script src="your-barcode-library.js"></script>
    <script>
        // JavaScript code for scanning barcode
    </script>
@endsection

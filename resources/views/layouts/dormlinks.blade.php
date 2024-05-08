<!-- JavaScript Libraries -->
{{-- <script src="{{ asset('/css/style1/js/jquery-3.3.1.min.js')}} "></script> --}}
@if(auth()->check())

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('/lib/chart/chart.min.js') }}"></script>
<script src="{{ asset('/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('/lib/tempusdominus/js/moment.min.js') }}"></script>
<script src="{{ asset('/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
<script src="{{ asset('/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.11/index.min.js" integrity="sha512-xCMh+IX6X2jqIgak2DBvsP6DNPne/t52lMbAUJSjr3+trFn14zlaryZlBcXbHKw8SbrpS0n3zlqSVmZPITRDSQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js" integrity="sha512-iusSCweltSRVrjOz+4nxOL9OXh2UA0m8KdjsX8/KUUiJz+TCNzalwE0WE6dYTfHDkXuGuHq3W9YIhDLN7UNB0w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script> --}}
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('/js/main.js') }}"></script>
<script src="{{ asset('/js/notification.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

@else
<script src="{{ asset('/css/style1/js/jquery-3.3.1.min.js')}} "></script>
<script src="{{ asset('/css/style1/js/bootstrap.min.js')}} "></script>
<script src="{{ asset('/css/style1/js/jquery.magnific-popup.min.js')}} "></script>
<script src="{{ asset('/css/style1/js/jquery.nice-select.min.js')}} "></script>
<script src="{{ asset('/css/style1/js/jquery-ui.min.js')}} "></script>
<script src="{{ asset('/css/style1/js/jquery.slicknav.js')}} "></script>
<script src="{{ asset('/css/style1/js/owl.carousel.min.js')}} "></script>
<script src="{{ asset('/css/style1/js/main.js')}} "></script>
@endif

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

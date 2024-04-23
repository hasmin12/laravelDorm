<!-- JavaScript Libraries -->
@if(auth()->check())

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('/lib/chart/chart.min.js') }}"></script>
<script src="{{ asset('/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('/lib/tempusdominus/js/moment.min.js') }}"></script>
<script src="{{ asset('/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
<script src="{{ asset('/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js" integrity="sha512-iusSCweltSRVrjOz+4nxOL9OXh2UA0m8KdjsX8/KUUiJz+TCNzalwE0WE6dYTfHDkXuGuHq3W9YIhDLN7UNB0w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="{{ asset('/js/main.js') }}"></script>
<script src="{{ asset('/js/notification.js') }}"></script>

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

@if(auth()->check())
    <!-- Favicon -->
    {{-- <link href="{{ secure_asset('img/favicon.ico') }}" rel="icon"> --}}

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ secure_asset('/lib/owlcarousel/owl.carousel.min.js')}}">
    <link href="{{ secure_asset('/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ secure_asset('/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ secure_asset('/css/bootstrap.min.css') }}" rel="stylesheet">
 
    <!-- Template Stylesheet -->
    <link href="{{ secure_asset('/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" integrity="sha512-liDnOrsa/NzR+4VyWQ3fBzsDBzal338A1VfUpQvAcdt+eL88ePCOd3n9VQpdA0Yxi4yglmLy/AmH+Lrzmn0eMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@else
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">
    
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ secure_asset('/css/style1/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ secure_asset('/css/style1/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ secure_asset('/css/style1/flaticon.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ secure_asset('/css/style1/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ secure_asset('/css/style1/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ secure_asset('/css/style1/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ secure_asset('/css/style1/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ secure_asset('/css/style1/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ secure_asset('/css/style1/style.css') }}" type="text/css">
@endif

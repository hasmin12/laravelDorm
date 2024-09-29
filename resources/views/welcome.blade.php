<x-app-layout layout="simple" :assets="$assets ?? []">
    <span class="uisheet screen-darken"></span>
    <div class="header"
        style="background: url({{ asset('images/dashboard/top-image.jpg') }}); background-size: cover; background-repeat: no-repeat; height: 100vh;position: relative;">
        <div class="main-img">
            <div class="container">
                <svg width="150" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="-0.423828" y="34.5762" width="50" height="7.14286" rx="3.57143"
                        transform="rotate(-45 -0.423828 34.5762)" fill="white" />
                    <rect x="14.7295" y="49.7266" width="50" height="7.14286" rx="3.57143"
                        transform="rotate(-45 14.7295 49.7266)" fill="white" />
                    <rect x="19.7432" y="29.4902" width="28.5714" height="7.14286" rx="3.57143"
                        transform="rotate(45 19.7432 29.4902)" fill="white" />
                    <rect x="19.7783" y="-0.779297" width="50" height="7.14286" rx="3.57143"
                        transform="rotate(45 19.7783 -0.779297)" fill="white" />
                </svg>
                <h1 class="my-4">
                    <span>{{ env('APP_NAME') }}</span>
                </h1>
                <h4 class="text-white mb-5"><b>Dormitory</b> and <b>Hostel</b> for TUP students, faculty members, staff,
                    and
                    visitors of the school.</h4>
                <div class="d-flex justify-content-center align-items-center">
                    <div>
                        <a class="bg-white btn btn-light d-flex" href="/guest/hostel">
                            <svg width="22" height="22" class="me-1" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            Hostel</a>
                    </div>
                    <div class="ms-3">
                        <a class="bg-white btn btn-light d-flex"
                            href="https://github.com/iqonicdesignofficial/hope-ui-laravel-dashboard"><img
                                src="{{ asset('/images/brands/23.png') }}" width="24px"
                                height="24px"><span>DORMITORY</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <nav class="nav navbar navbar-expand-lg navbar-light top-1 rounded">
                <div class="container-fluid">
                    <a class="navbar-brand mx-2" href="#">
                        <svg width="30" class="text-primary" viewBox="0 0 30 30" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2"
                                transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"></rect>
                            <rect x="7.72803" y="27.728" width="28" height="4" rx="2"
                                transform="rotate(-45 7.72803 27.728)" fill="currentColor"></rect>
                            <rect x="10.5366" y="16.3945" width="16" height="4" rx="2"
                                transform="rotate(45 10.5366 16.3945)" fill="currentColor"></rect>
                            <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2"
                                transform="rotate(45 10.5562 -0.556152)" fill="currentColor"></rect>
                        </svg>
                        <h5 class="logo-title">{{ env('APP_NAME') }}</h5>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-2"
                        aria-controls="navbar-2" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar-2">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-start">
                            {{-- <li class="nav-item">
                                <a class="nav-link" aria-current="page"
                                    href="https://templates.iqonic.design/hope-ui/documentation/laravel/dist/main/"
                                    target="_blank">Documentation</a>
                            </li>
                            <li class="nav-item me-3">
                                <a class="nav-link" aria-current="page"
                                    href="https://templates.iqonic.design/hope-ui/documentation/laravel/dist/main/change-log.html"
                                    target="_blank">Change Log</a>
                            </li>
                            <li class="nav-item me-3">
                                <a class="btn btn-secondary d-flex align-items-center" aria-current="page" href="/landing-pages/index" target="_blank">
                                    Landing pages
                                </a>
                            </li>
                            <li class="nav-item me-3">
                                <a class="btn btn-primary d-flex align-items-center" aria-current="page"
                                    href="https://templates.iqonic.design/product/hope-ui/pro/laravel/public/dashboards"
                                    target="_blank">

                                    <svg class="icon-22 me-2" width="22" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M21.4274 2.5783C20.9274 2.0673 20.1874 1.8783 19.4974 2.0783L3.40742 6.7273C2.67942 6.9293 2.16342 7.5063 2.02442 8.2383C1.88242 8.9843 2.37842 9.9323 3.02642 10.3283L8.05742 13.4003C8.57342 13.7163 9.23942 13.6373 9.66642 13.2093L15.4274 7.4483C15.7174 7.1473 16.1974 7.1473 16.4874 7.4483C16.7774 7.7373 16.7774 8.2083 16.4874 8.5083L10.7164 14.2693C10.2884 14.6973 10.2084 15.3613 10.5234 15.8783L13.5974 20.9283C13.9574 21.5273 14.5774 21.8683 15.2574 21.8683C15.3374 21.8683 15.4274 21.8683 15.5074 21.8573C16.2874 21.7583 16.9074 21.2273 17.1374 20.4773L21.9074 4.5083C22.1174 3.8283 21.9274 3.0883 21.4274 2.5783Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.01049 16.8079C2.81849 16.8079 2.62649 16.7349 2.48049 16.5879C2.18749 16.2949 2.18749 15.8209 2.48049 15.5279L3.84549 14.1619C4.13849 13.8699 4.61349 13.8699 4.90649 14.1619C5.19849 14.4549 5.19849 14.9299 4.90649 15.2229L3.54049 16.5879C3.39449 16.7349 3.20249 16.8079 3.01049 16.8079ZM6.77169 18.0003C6.57969 18.0003 6.38769 17.9273 6.24169 17.7803C5.94869 17.4873 5.94869 17.0133 6.24169 16.7203L7.60669 15.3543C7.89969 15.0623 8.37469 15.0623 8.66769 15.3543C8.95969 15.6473 8.95969 16.1223 8.66769 16.4153L7.30169 17.7803C7.15569 17.9273 6.96369 18.0003 6.77169 18.0003ZM7.02539 21.5683C7.17139 21.7153 7.36339 21.7883 7.55539 21.7883C7.74739 21.7883 7.93939 21.7153 8.08539 21.5683L9.45139 20.2033C9.74339 19.9103 9.74339 19.4353 9.45139 19.1423C9.15839 18.8503 8.68339 18.8503 8.39039 19.1423L7.02539 20.5083C6.73239 20.8013 6.73239 21.2753 7.02539 21.5683Z"
                                            fill="currentColor"></path>
                                    </svg>
                                    Go Pro
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="btn btn-success" href="/login">

                                    LOGIN
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="container-fluid">
            <div class="text-center mx-auto mb-5" style="max-width: 600px;">
                <h1 class="display-5 text-uppercase mb-4">Some Of Our <span class="text-primary">Popular</span> Dream
                    Projects</h1>
            </div>
            <div class="row gx-5">
                <div class="col-12 text-center">
                    <div class="d-inline-block bg-dark-radial text-center pt-4 px-5 mb-5">
                        <ul class="list-inline mb-0" id="portfolio-flters">
                            <li class="btn btn-outline-primary bg-white p-2 active mx-2 mb-4" data-filter="*">
                                <img src="/images/img/overlook.jpg" style="width: 150px; height: 100px;">
                                <div class="position-absolute top-0 start-0 end-0 bottom-0 m-2 d-flex align-items-center justify-content-center"
                                    style="background: rgba(4, 15, 40, .3);">
                                    <h6 class="text-white text-uppercase m-0">All</h6>
                                </div>
                            </li>
                            <li class="btn btn-outline-primary bg-white p-2 mx-2 mb-4" data-filter=".first">
                                <img src="/images/img/dormgallery2.jpg" style="width: 150px; height: 100px;">
                                <div class="position-absolute top-0 start-0 end-0 bottom-0 m-2 d-flex align-items-center justify-content-center"
                                    style="background: rgba(4, 15, 40, .3);">
                                    <h6 class="text-white text-uppercase m-0">First Floor</h6>
                                </div>
                            </li>
                            <li class="btn btn-outline-primary bg-white p-2 mx-2 mb-4" data-filter=".second">
                                <img src="/images/img/land.jpg" style="width: 150px; height: 100px;">
                                <div class="position-absolute top-0 start-0 end-0 bottom-0 m-2 d-flex align-items-center justify-content-center"
                                    style="background: rgba(4, 15, 40, .3);">
                                    <h6 class="text-white text-uppercase m-0">Second Floor</h6>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row g-5 portfolio-container">
                <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item first">
                    <div class="position-relative portfolio-box">
                        <img class="img-fluid w-100" src="/images/img/facility1.jpg"
                            style="height: 337px; width: 281px;" alt="">
                        <a class="portfolio-title shadow-sm" href="">
                            <p class="h4 text-center text-uppercase"><i
                                    class="fa fa-map-marker-alt text-primary me-2"></i>Building</p>
                        </a>
                        <a class="portfolio-btn" href="css1" data-lightbox="portfolio">
                            <i class="bi bi-plus text-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item second">
                    <div class="position-relative portfolio-box">
                        <img class="img-fluid w-100" src="/images/img/overlook2.jpg"
                            style="height: 337px; width: 281px;" alt="">
                        <a class="portfolio-title shadow-sm" href="">
                            <p class="h4 text-center text-uppercase"><i
                                    class="fa fa-map-marker-alt text-primary me-2"></i>View</p>
                        </a>
                        <a class="portfolio-btn" href="/images/img/overlook2.jpg"
                            style="height: 337px; width: 281px;" data-lightbox="portfolio">
                            <i class="bi bi-plus text-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item first">
                    <div class="position-relative portfolio-box">
                        <img class="img-fluid w-100" src="/images/img/dorm1.jpg" style="height: 337px; width: 281px;"
                            alt="">
                        <a class="portfolio-title shadow-sm" href="">
                            <p class="h4 text-center text-uppercase"><i
                                    class="fa fa-map-marker-alt text-primary me-2"></i>Hallway</p>

                        </a>
                        <a class="portfolio-btn" href="/images/img/dorm1.jpg" style="height: 337px; width: 281px;"
                            data-lightbox="portfolio">
                            <i class="bi bi-plus text-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item second">
                    <div class="position-relative portfolio-box">
                        <img class="img-fluid w-100" src="/images/img/dorm2.jpg" style="height: 337px; width: 281px;"
                            alt="">
                        <a class="portfolio-title shadow-sm" href="">
                            <p class="h4 text-center text-uppercase"><i
                                    class="fa fa-map-marker-alt text-primary me-2"></i>Study Area</p>
                        </a>
                        <a class="portfolio-btn" href="/images/img/dorm2.jpg" style="height: 337px; width: 281px;"
                            data-lightbox="portfolio">

                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item first">
                    <div class="position-relative portfolio-box">
                        <img class="img-fluid w-100" src="/images/img/kitchen.jpg"
                            style="height: 337px; width: 281px;" alt="">
                        <a class="portfolio-title shadow-sm" href="">
                            <p class="h4 text-center text-uppercase"><i
                                    class="fa fa-map-marker-alt text-primary me-2"></i>Kitchen / Laundry</p>

                        </a>
                        <a class="portfolio-btn" href="/images/img/kitchen.jpg" style="height: 337px; width: 281px;"
                            data-lightbox="portfolio">
                            <i class="bi bi-plus text-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item second">
                    <div class="position-relative portfolio-box">
                        <img class="img-fluid w-100" src="/images/img/dorm2nd.jpg"
                            style="height: 337px; width: 281px;">
                        <a class="portfolio-title shadow-sm" href="">
                            <p class="h4 text-center text-uppercase"><i
                                    class="fa fa-map-marker-alt text-primary me-2"></i>Living Room</p>

                        </a>
                        <a class="portfolio-btn" href="/images/img/dorm2nd.jpg" style="height: 337px; width: 281px;"
                            data-lightbox="portfolio">
                            <i class="bi bi-plus text-white"></i>
                        </a>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div class="container-fluid py-6 px-5">
        <div class="mb-4">
            <h1 class="display-5 text-center text-uppercase mb-4">Dormitory <span class="text-primary">Video</span>
                Tour</h1>
        </div>
        <video autoplay muted loop width="100%" height="auto">
            <source src="/video/DormXtend.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>


    <div class="container-fluid bg-light py-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 text-uppercase mb-4">KNOW MORE ABOUT <span class="text-primary">Hostel</span></h1>
        </div>
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <div class="card bg-white d-flex flex-column align-items-center text-center">
                    <img class="img-fluid" src="/images/img/hostel1.jpg" style="height: 400px; width:200%;"
                        alt="">
                    <div class="service-icon bg-white">
                        <i class="fa fa-3x fa-building text-primary"></i>
                    </div>
                    <div class="px-4 pb-4">
                        <h4 class="text-uppercase mb-3">Facility</h4>
                        <p>Duo dolore et diam sed ipsum stet amet duo diam. Rebum amet ut amet sed erat sed sed amet
                            magna elitr amet kasd diam duo</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card bg-white rounded d-flex flex-column align-items-center text-center">
                    <img class="img-fluid" src="/images/img/booking.jpg" style="height: 400px;" alt="">
                    <div class="service-icon bg-white">
                        <i class="fa fa-3x fa-home text-primary"></i>
                    </div>
                    <div class="px-4 pb-4">
                        <h4 class="text-uppercase mb-3">Booking</h4>
                        <p>Duo dolore et diam sed ipsum stet amet duo diam. Rebum amet ut amet sed erat sed sed amet
                            magna elitr amet kasd diam duo</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card bg-white rounded d-flex flex-column align-items-center text-center">
                    <img class="img-fluid" src="/images/img/comfort.jpg" style="height: 400px;" alt="">
                    <div class="service-icon bg-white">
                        <i class="fa fa-3x fa-drafting-compass text-primary"></i>
                    </div>
                    <div class="px-4 pb-4">
                        <h4 class="text-uppercase mb-3">Comfortability</h4>
                        <p>Duo dolore et diam sed ipsum stet amet duo diam. Rebum amet ut amet sed erat sed sed amet
                            magna elitr amet kasd diam duo</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="back-to-top" style="display: none;">
        <a class="btn btn-primary btn-xs p-0 position-fixed top" id="top" href="#top">
            <svg width="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 15.5L12 8.5L19 15.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round"></path>
            </svg>
        </a>
    </div>
    <div class="middle" style="display: none;">
        <button data-trigger="left-side-bar" class="d-xl-none btn btn-xs mid-menu" type="button">
            <i class="icon">
                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.75 11.7256L4.75 11.7256" stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M13.7002 5.70124L19.7502 11.7252L13.7002 17.7502" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </i>
        </button>
    </div>
</x-app-layout>

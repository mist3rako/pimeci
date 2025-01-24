<!DOCTYPE html>
<html lang="fr">
    <!--begin::Head-->
    <head>
        <base href="">
        <title>Accueil - Plateforme d'Inspection du MCI</title>
        <meta name="description" content="Plateforme d'inspection interne pour les directeurs et inspecteurs du Ministère du Commerce et de l'Industrie." />
        <meta name="keywords" content="MCI, inspection, entreprises, commerce, industrie, plateforme, ministère" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta charset="utf-8" />
        <meta property="og:locale" content="fr_FR" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="Plateforme d'Inspection du MCI" />
        <meta property="og:url" content="#" />
        <meta property="og:site_name" content="MCI - Inspections" />
        <link rel="canonical" href="#" />
        <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.png') }}" />
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->
        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="{{ asset('bcknd/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('bcknd/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->
    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body id="kt_body" style="background-image: url({{ asset('bcknd/assets/media/patterns/header-bg.jpg') }})" data-bs-spy="scroll" data-bs-target="#kt_landing_menu" data-bs-offset="200" class="bg-white position-relative">
        <!--begin::Main-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Header Section-->
            <div class="mb-0" id="home">
                <!--begin::Wrapper-->
                <div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-dark-bg" style="background-image: url({{ asset('bcknd/assets/media/svg/illustrations/landing.svg') }})">
                    <!--begin::Header-->
                    <div class="landing-header" data-kt-sticky="true" data-kt-sticky-name="landing-header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
                        <!--begin::Container-->
                        <div class="container">
                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center justify-content-between">
                                <!--begin::Logo-->
                                <div class="d-flex align-items-center flex-equal">
                                    <!--begin::Mobile menu toggle-->
                                    <button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none" id="kt_landing_menu_toggle">
                                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                                        <span class="svg-icon svg-icon-2hx">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none">
                                                <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
                                                <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </button>
                                    <!--end::Mobile menu toggle-->
                                    <!--begin::Logo image-->
                                    <a href="#">
                                        <img alt="Logo" src="{{ asset('bcknd/assets/media/logos/logo-1-white.svg') }}" class="logo-default h-25px h-lg-30px" />
                                        <img alt="Logo" src="{{ asset('bcknd/assets/media/logos/Logo44.svg') }}" class="logo-sticky h-20px h-lg-25px" />
                                    </a>
                                    <!--end::Logo image-->
                                </div>
                                <!--end::Logo-->
                                <!--begin::Menu wrapper-->
                                <div class="d-lg-block" id="kt_header_nav_wrapper">
                                    <div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true" data-kt-drawer-name="landing-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="200px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_wrapper'}">
                                        <!--begin::Menu-->
                                        <div class="menu menu-column flex-nowrap menu-rounded menu-lg-row menu-title-gray-500 menu-state-title-primary nav nav-flush fs-5 fw-bold" id="kt_landing_menu">
                                            <!--begin::Menu item-->
                                            <div class="menu-item">
                                                <!--begin::Menu link-->
                                                <a class="menu-link nav-link active py-3 px-4 px-xxl-6" href="#kt_body" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Accueil</a>
                                                <!--end::Menu link-->
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item">
                                                <!--begin::Menu link-->
                                                <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#how-it-works" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Comment ça marche</a>
                                                <!--end::Menu link-->
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item">
                                                <!--begin::Menu link-->
                                                <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#achievements" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Réalisations</a>
                                                <!--end::Menu link-->
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item">
                                                <!--begin::Menu link-->
                                                <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#team" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Notre Équipe</a>
                                                <!--end::Menu link-->
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item">
                                                <!--begin::Menu link-->
                                                <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#portfolio" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Nos Projets</a>
                                                <!--end::Menu link-->
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item">
                                                <!--begin::Menu link-->
                                                <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#contact" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Contact</a>
                                                <!--end::Menu link-->
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </div>
                                </div>
                                <!--end::Menu wrapper-->
                                <!--begin::Toolbar-->
                                <div class="flex-equal text-end ms-1">
                                    @if (Route::has('login'))
                                        @auth
                                            <a href="{{ url('/dashboard') }}" class="btn btn-success">Tableau de Bord</a>
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-primary">Connexion</a>
                                        @endauth
                                    @endif
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Landing hero-->
                    <div class="d-flex flex-column flex-center w-100 min-h-350px min-h-lg-500px px-9">
                        <!--begin::Heading-->
                        <div class="text-center mb-5 mb-lg-10 py-10 py-lg-20">
                            <!--begin::Title-->
                            <h1 class="text-white lh-base fw-bolder fs-2x fs-lg-3x mb-15">
                                Plateforme d'inspection interne pour <br>les entreprises commerciales et industrielles
                                 au<br>
                                <span style="background: linear-gradient(to right, #12CE5D 0%, #FFD80C 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                                    <span id="kt_landing_hero_text">Ministère du Commerce et de l'Industrie</span>
                                </span>
                            </h1>
                            <!--end::Title-->
                            
                        </div>
                        <!--end::Heading-->
                    </div>
                    <!--end::Landing hero-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Curve bottom-->
                <div class="landing-curve landing-dark-color mb-10 mb-lg-20">
                    <svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z" fill="currentColor"></path>
                    </svg>
                </div>
                <!--end::Curve bottom-->
            </div>
            <!--end::Header Section-->
            <!--begin::How It Works Section-->
            <div class="mb-n10 mb-lg-n20 z-index-2">
                <!--begin::Container-->
                <div class="container">
                    <!--begin::Heading-->
                    <div class="text-center mb-17">
                        <!--begin::Title-->
                        <h3 class="fs-2hx text-dark mb-5" id="how-it-works" data-kt-scroll-offset="{default: 100, lg: 150}">Comment ça marche</h3>
                        <!--end::Title-->
                        <!--begin::Text-->
                        <div class="fs-5 text-muted fw-bold">Une plateforme interne pour planifier, exécuter et suivre les inspections
                        <br />au sein du Ministère du Commerce et de l'Industrie</div>
                        <!--end::Text-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Row-->
                    <div class="row w-100 gy-10 mb-md-20">
                        <!--begin::Col-->
                        <div class="col-md-4 px-5">
                            <!--begin::Story-->
                            <div class="text-center mb-10 mb-md-0">
                                <!--begin::Illustration-->
                                <img src="{{ asset('bcknd/assets/media/illustrations/sigma-1/8.png') }}" class="mh-125px mb-9" alt="" />
                                <!--end::Illustration-->
                                <!--begin::Heading-->
                                <div class="d-flex flex-center mb-5">
                                    <!--begin::Badge-->
                                    <span class="badge badge-circle badge-light-success fw-bolder p-5 me-3 fs-3">1</span>
                                    <!--end::Badge-->
                                    <!--begin::Title-->
                                    <div class="fs-5 fs-lg-3 fw-bolder text-dark">Planifier une inspection</div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Description-->
                                <div class="fw-bold fs-6 fs-lg-4 text-muted">Les directeurs planifient les inspections
                                <br />en fonction des besoins
                                <br />et des priorités</div>
                                <!--end::Description-->
                            </div>
                            <!--end::Story-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-4 px-5">
                            <!--begin::Story-->
                            <div class="text-center mb-10 mb-md-0">
                                <!--begin::Illustration-->
                                <img src="{{ asset('bcknd/assets/media/illustrations/sigma-1/6.png') }}" class="mh-125px mb-9" alt="" />
                                <!--end::Illustration-->
                                <!--begin::Heading-->
                                <div class="d-flex flex-center mb-5">
                                    <!--begin::Badge-->
                                    <span class="badge badge-circle badge-light-success fw-bolder p-5 me-3 fs-3">2</span>
                                    <!--end::Badge-->
                                    <!--begin::Title-->
                                    <div class="fs-5 fs-lg-3 fw-bolder text-dark">Exécuter une inspection</div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Description-->
                                <div class="fw-bold fs-6 fs-lg-4 text-muted">Les inspecteurs exécutent les inspections
                                <br />selon le planning établi
                                <br />et consignent leurs observations</div>
                                <!--end::Description-->
                            </div>
                            <!--end::Story-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-4 px-5">
                            <!--begin::Story-->
                            <div class="text-center mb-10 mb-md-0">
                                <!--begin::Illustration-->
                                <img src="{{ asset('bcknd/assets/media/illustrations/sigma-1/12.png') }}" class="mh-125px mb-9" alt="" />
                                <!--end::Illustration-->
                                <!--begin::Heading-->
                                <div class="d-flex flex-center mb-5">
                                    <!--begin::Badge-->
                                    <span class="badge badge-circle badge-light-success fw-bolder p-5 me-3 fs-3">3</span>
                                    <!--end::Badge-->
                                    <!--begin::Title-->
                                    <div class="fs-5 fs-lg-3 fw-bolder text-dark">Recevoir les résultats</div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Description-->
                                <div class="fw-bold fs-6 fs-lg-4 text-muted">Les rapports d'inspection sont générés
                                <br />et accessibles aux parties prenantes
                                <br />pour suivi et actions</div>
                                <br />
                                <br />
                                <br />
                                <!--end::Description-->
                            </div>
                            <!--end::Story-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::How It Works Section-->
            <!--begin::Statistics Section-->
            <div class="mt-sm-n10">
                <!--begin::Curve top-->
                <div class="landing-curve landing-dark-color">
                    <svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z" fill="currentColor"></path>
                    </svg>
                </div>
                <!--end::Curve top-->
                <!--begin::Wrapper-->
                <div class="pb-15 pt-18 landing-dark-bg">
                    <!--begin::Container-->
                    <div class="container">
                        <!--begin::Heading-->
                        <div class="text-center mt-15 mb-18" id="achievements" data-kt-scroll-offset="{default: 100, lg: 150}">
                            <!--begin::Title-->
                            <h3 class="fs-2hx text-white fw-bolder mb-5">Nous améliorons les choses</h3>
                            <!--end::Title-->
                            <!--begin::Description-->
                            <div class="fs-5 text-gray-700 fw-bold">Une plateforme efficace pour optimiser les processus internes
                            <br />et assurer la conformité des activités</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Statistics-->
                        <div class="d-flex flex-center">
                            <!--begin::Items-->
                            <div class="d-flex flex-wrap flex-center justify-content-lg-between mb-15 mx-auto w-xl-900px">
                                <!--begin::Item-->
                                <div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain" style="background-image: url('{{ asset('bcknd/assets/media/svg/misc/octagon.svg') }}')">
                                    <!--begin::Symbol-->
                                    <span class="svg-icon svg-icon-2tx svg-icon-white mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none">
                                            <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                            <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                                            <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                                            <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Symbol-->
                                    <!--begin::Info-->
                                    <div class="mb-0">
                                        <!--begin::Value-->
                                        <div class="fs-lg-2hx fs-2x fw-bolder text-white d-flex flex-center">
                                            <div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="150" data-kt-countup-suffix="+">0</div>
                                        </div>
                                        <!--end::Value-->
                                        <!--begin::Label-->
                                        <span class="text-gray-600 fw-bold fs-5 lh-0">Inspections Planifiées</span>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain" style="background-image: url('{{ asset('bcknd/assets/media/svg/misc/octagon.svg') }}')">
                                    <!--begin::Symbol-->
                                    <span class="svg-icon svg-icon-2tx svg-icon-white mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none">
                                            <path d="M13 10.9128V3.01281C13 2.41281 13.5 1.91281 14.1 2.01281C16.1 2.21281 17.9 3.11284 19.3 4.61284C20.7 6.01284 21.6 7.91285 21.9 9.81285C22 10.4129 21.5 10.9128 20.9 10.9128H13Z" fill="black" />
                                            <path opacity="0.3" d="M13 12.9128V20.8129C13 21.4129 13.5 21.9129 14.1 21.8129C16.1 21.6129 17.9 20.7128 19.3 19.2128C20.7 17.8128 21.6 15.9128 21.9 14.0128C22 13.4128 21.5 12.9128 20.9 12.9128H13Z" fill="black" />
                                            <path opacity="0.3" d="M11 19.8129C11 20.4129 10.5 20.9129 9.89999 20.8129C5.49999 20.2129 2 16.5128 2 11.9128C2 7.31283 5.39999 3.51281 9.89999 3.01281C10.5 2.91281 11 3.41281 11 4.01281V19.8129Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Symbol-->
                                    <!--begin::Info-->
                                    <div class="mb-0">
                                        <!--begin::Value-->
                                        <div class="fs-lg-2hx fs-2x fw-bolder text-white d-flex flex-center">
                                            <div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="120" data-kt-countup-suffix="+">0</div>
                                        </div>
                                        <!--end::Value-->
                                        <!--begin::Label-->
                                        <span class="text-gray-600 fw-bold fs-5 lh-0">Rapports Générés</span>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain" style="background-image: url('{{ asset('bcknd/assets/media/svg/misc/octagon.svg') }}')">
                                    <!--begin::Symbol-->
                                    <span class="svg-icon svg-icon-2tx svg-icon-white mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none">
                                            <path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="black" />
                                            <path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="black" />
                                            <path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Symbol-->
                                    <!--begin::Info-->
                                    <div class="mb-0">
                                        <!--begin::Value-->
                                        <div class="fs-lg-2hx fs-2x fw-bolder text-white d-flex flex-center">
                                            <div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="50" data-kt-countup-suffix="+">0</div>
                                        </div>
                                        <!--end::Value-->
                                        <!--begin::Label-->
                                        <span class="text-gray-600 fw-bold fs-5 lh-0">Inspecteurs Mobilisés</span>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Items-->
                        </div>
                        <!--end::Statistics-->
                    </div>
                    <!--end::Container-->
                </div>

                <!--end::Wrapper-->
                <!--begin::Curve bottom-->
                <div class="landing-curve landing-dark-color">
                    <svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z" fill="currentColor"></path>
                    </svg>
                </div>
                <!--end::Curve bottom-->
            </div>
            <!--end::Contact Section-->
            <!--begin::Footer Section-->
            <div class="mb-0">
                <!--begin::Curve top-->
                <div class="landing-curve landing-white-color">
                    <svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z" fill="currentColor"></path>
                    </svg>
                </div>
                <!--end::Curve top-->
                <!--begin::Wrapper-->
                <div class="landing-white-bg pt-20">
                    <!--begin::Container-->
                    <div class="container">
                        <!--begin::Row-->
                        <div class="row py-10 py-lg-20">
                            <!--begin::Col-->
                            <div class="col-lg-6 pe-lg-16 mb-10 mb-lg-0">
                                <!--begin::Block-->
                                <div class="rounded landing-dark-border p-9 mb-10">
                                    <!--begin::Title-->
                                    <h2 class="text-white">Des questions ?</h2>
                                    <!--end::Title-->
                                    <!--begin::Text-->
                                    <span class="fw-normal fs-4 text-gray-700">Envoyez-nous un email à
                                    <a href="mailto:support@mci.gov" class="text-white opacity-50 text-hover-primary">support@mci.gov</a></span>
                                    <!--end::Text-->
                                </div>
                                <!--end::Block-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-lg-6 ps-lg-16">
                                <!--begin::Navs-->
                                <!-- Vous pouvez ajouter des liens ou des informations supplémentaires ici -->
                                <!--end::Navs-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Container-->
                    <!--begin::Separator-->
                    <div class="landing-dark-separator"></div>
                    <!--end::Separator-->
                    <!--begin::Container-->
                    <div class="container">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column flex-md-row flex-stack py-7 py-lg-10">
                            <!--begin::Copyright-->
                            <div class="d-flex align-items-center order-2 order-md-1">
                                <!--begin::Logo-->
                                <a href="#">
                                    <img alt="Logo" src="{{ asset('bcknd/assets/media/logos/logo-1-white.svg') }}" class="h-15px h-md-20px" />
                                </a>
                                <!--end::Logo image-->
                                <!--begin::Logo image-->
                                <span class="mx-5 fs-6 fw-bold text-gray-600 pt-1">© {{ date('Y') }} Ministère du Commerce et de l'Industrie</span>
                                <!--end::Logo image-->
                            </div>
                            <!--end::Copyright-->
                            <!--begin::Menu-->
                            <!-- Vous pouvez ajouter des liens de menu ici -->
                            <!--end::Menu-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Footer Section-->
            <!--begin::Scrolltop-->
            <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                <span class="svg-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none">
                        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
                        <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </div>
            <!--end::Scrolltop-->
        </div>
        <!--end::Main-->
        <script>var hostUrl = "{{ asset('bcknd/assets/') }}";</script>
        <!--begin::Javascript-->
        <!--begin::Global Javascript Bundle(used by all pages)-->
        <script src="{{ asset('bcknd/assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('bcknd/assets/js/scripts.bundle.js') }}"></script>
        <!--end::Global Javascript Bundle-->
        <!--begin::Page Vendors Javascript(used by this page)-->
        <script src="{{ asset('bcknd/assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
        <script src="{{ asset('bcknd/assets/plugins/custom/typedjs/typedjs.bundle.js') }}"></script>
        <!--end::Page Vendors Javascript-->
        <!--begin::Page Custom Javascript(used by this page)-->
        <script src="{{ asset('bcknd/assets/js/custom/landing.js') }}"></script>
        <!--end::Page Custom Javascript-->
        <!--end::Javascript-->
    </body>
    <!--end::Body-->
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Métadonnées -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCI - Inspections Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Thème -->
    <script>
        (function() {
            const currentTheme = localStorage.getItem('theme') || 'dark';
            const themeStylesheet = document.createElement('link');
            themeStylesheet.rel = 'stylesheet';
            themeStylesheet.id = 'themeStylesheet';
            if (currentTheme === 'light') {
                themeStylesheet.href = "{{ asset('backend/assets/css/demo1/style.css') }}";
            } else {
                themeStylesheet.href = "{{ asset('backend/assets/css/demo2/style.css') }}";
            }
            themeStylesheet.onload = function() {
                document.body.style.visibility = 'visible';
                document.body.style.opacity = 1;
            };
            document.head.appendChild(themeStylesheet);
        })();
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Styles supplémentaires -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/core/core.css') }}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/flatpickr/flatpickr.min.css') }}">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">

    <!-- font-awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <!-- Icon Fonts -->
    <link rel="stylesheet" href="{{ asset('backend/assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.png') }}" />

    <!-- Toastr CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <!-- Styles personnalisés -->
    @livewireStyles
    <style>
        body {
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s, opacity 0.3s linear;
        }
    </style>
</head>
<body>
    <div class="main-wrapper">

        <!-- Sidebar -->
        @include('admin.body.sidebar')

        <div class="page-wrapper">

            <!-- Topbar -->
            @include('admin.body.topbar')

            <!-- Contenu principal -->
            @if (isset($slot))
                {{ $slot }}
            @else
                @yield('admin')
            @endif

            <!-- Footer -->
            @include('admin.body.footer')

        </div>
    </div>

    <!-- Scripts Core -->

    <!-- 1. jQuery - Assurez-vous que jQuery est inclus en premier -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- 2. Plugins jQuery -->

    <!-- Core JS -->
    <script src="{{ asset('backend/assets/vendors/core/core.js') }}"></script>

    <!-- Plugin JS pour cette page -->
    <script src="{{ asset('backend/assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

    <!-- DataTables JS -->
    <script src="{{ asset('backend/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>

    <!-- inject:js -->
    <script src="{{ asset('backend/assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/template.js') }}"></script>

    <!-- Custom JS pour cette page -->
    <script src="{{ asset('backend/assets/js/dashboard-dark.js') }}"></script>

    <!-- Toastr JS -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Scripts personnalisés -->
    <script>
        // Charger le thème sélectionné au démarrage
        document.addEventListener('DOMContentLoaded', function () {
            const themeStylesheet = document.getElementById('themeStylesheet');
            const currentTheme = localStorage.getItem('theme') || 'dark';
            setTheme(currentTheme);

            // Gérer le basculement du thème
            const themeToggler = document.querySelector('.settings-sidebar .theme-wrapper');
            if (themeToggler) {
                themeToggler.addEventListener('click', function (event) {
                    if (event.target.closest('.theme-item')) {
                        const selectedTheme = event.target.closest('.theme-item').getAttribute('data-theme');
                        setTheme(selectedTheme);
                    }
                });
            }

            function setTheme(theme) {
                if (theme === 'light') {
                    themeStylesheet.setAttribute('href', "{{ asset('backend/assets/css/demo1/style.css') }}");
                } else {
                    themeStylesheet.setAttribute('href', "{{ asset('backend/assets/css/demo2/style.css') }}");
                }
                localStorage.setItem('theme', theme);
            }
        });

        // Toastr notifications
        @if(Session::has('message'))
            var type = "{{ Session::get('alert-type','info') }}"
            switch(type){
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;
                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;
                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;
                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('backend/assets/js/code/code.js') }}"></script>

    <!-- DataTables Initialization -->
    <script>
        $(document).ready(function() {
            // Vérifier si l'élément existe avant d'initialiser DataTable
            if ($('#dataTableExample').length) {
                if (!$.fn.DataTable.isDataTable('#dataTableExample')) {
                    $('#dataTableExample').DataTable();
                }
            }
        });
    </script>

    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- Inclusion des scripts poussés -->
    @stack('scripts')

</body>
</html>

<nav class="sidebar">
    <div class="sidebar-header">
 <!--begin::Logo-->
 <a href="#" class="sidebar-brand">
            <img alt="Logo" src="{{ asset('bcknd/assets/media/logos/logo-1-white.svg') }}" class="h-12px logo" />
        </a>
        <!--end::Logo-->
     
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Accueil</li>
            <li class="nav-item">
                <a href="{{ route('admin.dashboard')}}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item nav-category">Notifications</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Email</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="emails">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/email/inbox.html" class="nav-link">Inbox</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/email/read.html" class="nav-link">Read</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/email/compose.html" class="nav-link">Compose</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item nav-category">Planification</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#planning" role="button" aria-expanded="false" aria-controls="planning">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">Espace de Planification</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="planning">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('planifications.index') }}" class="nav-link">Planifier une Inspection</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('types.intervention.indextype') }}" class="nav-link">Types d'Intervention</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('champs.inspection.index') }}" class="nav-link">Champs d'Inspection</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item nav-category">Inspection & Rapports</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#inspections" role="button" aria-expanded="false" aria-controls="inspections">
                    <i class="link-icon" data-feather="feather"></i>
                    <span class="link-title">Espace Inspection</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="inspections">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="" class="nav-link">Historique des Inspections</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Historique des Planifications</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Rapports d'Inspection</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item nav-category">Entreprises</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#entreprises" role="button" aria-expanded="false" aria-controls="entreprises">
                    <i class="link-icon" data-feather="briefcase"></i>
                    <span class="link-title">Gestion des Entreprises</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="entreprises">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('entreprises.index') }}" class="nav-link">Liste des Entreprises</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('entreprises.create') }}" class="nav-link">Créer Manuellement</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item nav-category">Utilisateurs</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#users" role="button" aria-expanded="false" aria-controls="users">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Gestion des Utilisateurs</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="users">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">Liste des Utilisateurs</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.create') }}" class="nav-link">Ajouter un Utilisateur</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item nav-category">Docs</li>
            <li class="nav-item">
                <a href="https://www.nobleui.com/html/documentation/docs.html" target="_blank" class="nav-link">
                    <i class="link-icon" data-feather="hash"></i>
                    <span class="link-title">Documentation</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<nav class="settings-sidebar">
    <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
            <i data-feather="settings"></i>
        </a>
        <div class="theme-wrapper">
            <h6 class="text-muted mb-2">Thème Clair :</h6>
            <a class="theme-item" href="javascript:void(0);" data-theme="light">
                <img src="{{ asset('backend/assets/images/screenshots/light.jpg') }}" alt="Thème clair">
            </a>
            <h6 class="text-muted mb-2">Thème Sombre :</h6>
            <a class="theme-item active" href="javascript:void(0);" data-theme="dark">
                <img src="{{ asset('backend/assets/images/screenshots/dark.jpg') }}" alt="Thème sombre">
            </a>
        </div>
    </div>
</nav>

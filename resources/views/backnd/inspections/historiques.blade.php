@extends('inspecteur.inspecteur_dashboard')

@section('inspecteur')

<div class="container">
    <!-- Breadcrumb Navigation -->
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('inspecteur.dashboard') }}">Tableau de Bord</a></li>
            <li class="breadcrumb-item active" aria-current="page">Historiques des Inspections Complètes</li>
        </ol>
    </nav>
</div>
    <!-- Card for Historiques -->
    <div class="card mb-5 mb-xl-8">
        <!-- Card Header -->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Historiques</span>
                <span class="text-muted mt-1 fw-bold fs-7">des Inspections Complètes</span>
            </h3>
            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Click to add a user">
                <a href="#" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
                    <!-- SVG Icon -->
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                        </svg>
                    </span>
                    New Member
                </a>
            </div>
        </div>
        <!-- End Card Header -->

        <!-- Card Body -->
        <div class="card-body py-3">
            <!-- Affichage des messages de succès -->
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Table des Historiques des Inspections Complètes -->
            <div class="table-responsive">
                <table class="table table-bordered table-row-dashed table-row-gray-300 align-middle gs-0 gy-4" id="historiquesTable">
                    <thead>
                        <tr class="fw-bolder text-muted">
                            <th class="min-w-100px">Photo</th>
                            <th class="min-w-100px">Code Inspection</th>
                            <th class="min-w-150px">Entreprise</th>
                            <th class="min-w-150px">Date d'Inspection</th>
                            <th class="min-w-120px">Planificateur</th>
                            <th class="min-w-120px">Chef de Brigade</th>
                            <th class="min-w-150px">Inspecteurs Assignés</th>
                            <th class="min-w-100px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inspections as $inspection)
                            <tr>
                                <!-- Photo -->
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-45px me-5">
                                            <!-- Remplacez l'URL de l'image par la photo réelle de l'entreprise si disponible -->
                                            <img src="{{ !empty(Auth::user()->profile_pic) ? url('upload/admin_images/' . Auth::user()->profile_pic) : url('upload/no_image.jpg') }}" alt="{{ optional($inspection->entreprise)->nom_entreprise }}" />
                                        </div>
                                    </div>
                                </td>
                                <!-- Code Inspection -->
                                <td style="font-size: 12px;">
                                    {{ $inspection->plan_mission_code }}
                                </td>
                                <!-- Entreprise -->
                                <td style="font-size: 12px;">
                                    {{ optional($inspection->entreprise)->nom_entreprise }}
                                </td>
                                <!-- Date d'Inspection -->
                                <td style="font-size: 12px;">
                                    {{ $inspection->date_inspection ? $inspection->date_inspection->translatedFormat('d F Y') : 'N/A' }}<br>
                                    <small>{{ $inspection->date_inspection ? $inspection->date_inspection->translatedFormat('h:i A') : 'N/A' }}</small>
                                </td>
                                <!-- Planificateur -->
                                <td style="font-size: 12px;">
                                    {{ optional($inspection->planificateurUser)->nom . ' ' . optional($inspection->planificateurUser)->prenom ?? 'N/A' }}
                                </td>
                                <!-- Chef de Brigade -->
                                <td style="font-size: 12px;">
                                    {{ optional($inspection->chefDeBrigade)->nom . ' ' . optional($inspection->chefDeBrigade)->prenom ?? 'N/A' }}
                                </td>
                                <!-- Inspecteurs Assignés -->
                                <td style="font-size: 10px;">
                                    <ul class="list-unstyled mb-0">
                                        @php
                                            $inspecteurs = [
                                                $inspection->idUsers2,
                                                $inspection->idUsers3,
                                                $inspection->idUsers4
                                            ];
                                        @endphp
                                        @foreach($inspecteurs as $inspecteur)
                                            @if($inspecteur)
                                                <li>{{ $inspecteur->nom . ' ' . $inspecteur->prenom }}</li>
                                            @endif
                                        @endforeach
                                        @if(empty($inspecteurs[0]) && empty($inspecteurs[1]) && empty($inspecteurs[2]))
                                            <li>Aucun autre inspecteur assigné</li>
                                        @endif
                                    </ul>
                                </td>
                                <!-- Actions -->

                                <td style="font-size: 10px;">
															<a href="{{ route('inspecteur.inspections.show', $inspection->id) }}" class="btn btn-bg-primary btn-color-light btn-active-color-secondary btn-sm px-4 me-2">Rapports</a>
														</td>
                        

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">
                                    Aucune inspection complète trouvée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Fin Table -->

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $inspections->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
        <!-- End Card Body -->
    </div>
    <!-- End Card -->

    <!-- Script de DataTable -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#historiquesTable').DataTable({
                "paging": false,
                "searching": true,
                "info": false,
                "lengthChange": false,
                "language": {
                    "zeroRecords": "Aucune inspection trouvée",
                    "search": "Rechercher:",
                    "paginate": {
                        "first": "Premier",
                        "last": "Dernier",
                        "next": "Suivant",
                        "previous": "Précédent"
                    }
                }
            });
        });
    </script>
</div>

@endsection

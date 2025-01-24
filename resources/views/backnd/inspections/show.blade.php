@extends('inspecteur.inspecteur_dashboard')

@section('inspecteur')

<div class="post d-flex flex-column-fluid" id="kt_post"> 
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
            <!--begin::Card header-->
            <div class="card-header cursor-pointer">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bolder m-0">Details de l'inspection</h3>&nbsp;
                    <h6 class="text-gray-600">
                        @switch($inspection->plan_progress_statut)
                            @case('Complète')
                                <span class="badge bg-success">{{ $inspection->plan_progress_statut }}</span>
                                @break

                            @case('En cours')
                                <span class="badge bg-warning text-dark">{{ $inspection->plan_progress_statut }}</span>
                                @break

                            @case('Expiré')
                                <span class="badge bg-danger">{{ $inspection->plan_progress_statut }}</span>
                                @break

                            @case('Planifié')
                                <span class="badge bg-primary">{{ $inspection->plan_progress_statut }}</span>
                                @break

                            @default
                                <span class="badge bg-secondary">{{ $inspection->plan_progress_statut }}</span>
                        @endswitch
                    </h6>
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Card body-->
            <div class="card-body p-9">
                <!--begin::Row-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Code Inspection:</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ $inspection->plan_mission_code }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Type d'Intervention:</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold text-gray-800 fs-6">{{ optional($inspection->typeIntervention)->nom_type_intervention ?? 'N/A' }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Champs d'Inspection:</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 d-flex align-items-center">
                        <span class="fw-bolder fs-6 text-gray-800 me-2">{{ optional($inspection->champsInspection)->nom_champs ?? 'N/A' }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Nom Entreprise:</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <a href="#" class="fw-bold fs-6 text-gray-800 text-hover-primary">{{ optional($inspection->entreprise)->nom_entreprise ?? 'N/A' }}</a>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Lieu d'Inspection:</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ optional($inspection->entreprise)->rue ?? 'Adresse inconnue' }}, {{ optional($inspection->entreprise)->adresse->commune ?? 'Inconnue' }}, {{ optional($inspection->entreprise)->adresse->departement ?? 'Inconnu' }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-10">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">Date et Heure de l'Inspection:</label>
                    <!--begin::Label-->
                    <!--begin::Label-->
                    <div class="col-lg-8">
                        <span class="fw-bold fs-6 text-gray-800">{{ $inspection->date_inspection ? $inspection->date_inspection->format('d/m/Y h:i A') : 'N/A' }}</span>
                    </div>
                    <!--begin::Label-->
                </div>
                <!--end::Input group-->
                <!--begin::Notice-->
                <div class="notice d-flex bg-light-primary rounded border-warning border border-dashed p-6">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                    <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
                            <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black" />
                            <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <!--end::Icon-->
                   <!--begin::Wrapper-->
<div class="d-flex flex-stack flex-grow-1">
    <!--begin::Content gauche-->
    <div class="fw-bold me-10">
        <h4 class="text-gray-900 fw-bolder">Chef de Brigade:</h4>
        <div class="fs-6 text-gray-700">{{ optional($inspection->chefDeBrigade)->nom . ' ' . optional($inspection->chefDeBrigade)->prenom ?? 'N/A' }}</div>
    </div>
    <!--end::Content gauche-->

    <!--begin::Content droite-->
    <div class="fw-bold">
        <h4 class="text-gray-900 fw-bolder">Inspecteurs Assignés:</h4>
        <div class="fs-6 text-gray-700">
            <ul class="list-unstyled">
                @if($inspection->idUsers2 || $inspection->idUsers3 || $inspection->idUsers4)
                    @if($inspection->idUsers2)
                        <li>{{ optional($inspection->idUsers2)->nom }} {{ optional($inspection->idUsers2)->prenom }}</li>
                    @endif
                    @if($inspection->idUsers3)
                        <li>{{ optional($inspection->idUsers3)->nom }} {{ optional($inspection->idUsers3)->prenom }}</li>
                    @endif
                    @if($inspection->idUsers4)
                        <li>{{ optional($inspection->idUsers4)->nom }} {{ optional($inspection->idUsers4)->prenom }}</li>
                    @endif
                @else
                    <li>Aucun autre inspecteur assigné</li>
                @endif
            </ul>
        </div>
    </div>
    <!--end::Content droite-->
</div>
<!--end::Wrapper-->
                </div>
                <!--end::Notice-->
                <div class="text-center mt-10">
                    @if($inspection->plan_progress_statut !== 'Expiré' && $inspection->plan_progress_statut !== 'Complète' && $inspection->chefDeBrigade->id === Auth::id())
                        <a href="{{ route('inspecteur.inspections.start', $inspection->id) }}" class="btn btn-primary">Commencer</a>
                    @endif
                    <a href="{{ route('inspecteur.inspections.index') }}" class="btn btn-secondary">Retour à la liste des inspections</a>
                </div>
            </div>
            <!--end::Card body-->
        </div>
    </div>
    <!--end::Container-->
</div>
@endsection
@extends('inspecteur.inspecteur_dashboard')
@section('inspecteur')

<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Profile Overview-->
        <div class="card mb-5 mb-xl-8">
            <div class="card-body pt-9 pb-0">
                <div class="row">
                    <!--begin::Profile Details-->
                    <div class="col-12 col-md-4 col-lg-3 mb-5">
                        <!--begin::Details-->
                        <div class="d-flex flex-column align-items-center text-center">
                            <!--begin::Photo-->
                            <div class="mb-4">
                                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                    <img src="{{ !empty(Auth::user()->profile_pic) ? url('upload/admin_images/' . Auth::user()->profile_pic) : url('upload/no_image.jpg') }}" alt="image" class="img-fluid rounded-circle" style="width: 125px; height: 125px; object-fit: cover;" />
                                    <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px"></div>
                                </div>
                            </div>
                            <!--end::Photo-->
                            <!--begin::Info-->
                            <div class="mt-3">
                                <!--begin::Name-->
                                <h4 class="text-gray-900 text-hover-primary fw-bolder">{{ ucfirst(strtolower(Auth::user()->prenom)) }} {{ strtoupper(Auth::user()->nom) }}</h4>
                                <p class="text-muted">{{ Auth::user()->role_as }}</p>
                                <p class="text-muted">{{ Auth::user()->affectation }}</p>
                                <a href="#" class="btn btn-sm btn-light-success fw-bolder mt-2">En ligne</a>
                                <!--end::Name-->
                                <!--begin::Additional Info-->
                                <div class="mt-3">
                                    <a href="mailto:{{ Auth::user()->email }}" class="text-gray-400 text-hover-primary">{{ Auth::user()->email }}</a>
                                </div>
                                <!--end::Additional Info-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Details-->
                    </div>
                    <!--end::Profile Details-->

                    <!--begin::Profile Update Form-->
                    <div class="col-12 col-md-8 col-lg-9">
                        <!--begin::Card-->
                        <div class="card">
                            <!--begin::Card header-->
                            <div class="card-header border-0">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h3 class="fw-bolder">Mise à jour du mot de passe</h3>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Content-->
                            <div class="card-body">
                                <!-- Affichage des notifications -->
                                @if (session('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif

                                <!-- Affichage des erreurs de validation -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!--begin::Form-->
                                <form id="kt_account_password_details_form" class="form" method="POST" action="{{ route('inspecteur.update.password') }}">
                                    @csrf
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Ancien mot de passe</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input type="password" name="old_password" class="form-control form-control-lg form-control-solid" placeholder="Ancien mot de passe" />
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Nouveau mot de passe</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input type="password" name="new_password" class="form-control form-control-lg form-control-solid" placeholder="Nouveau mot de passe" />
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Confirmer le nouveau mot de passe</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input type="password" name="new_password_confirmation" class="form-control form-control-lg form-control-solid" placeholder="Confirmer le nouveau mot de passe" />
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Mettre à jour le mot de passe</button>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Profile Update Form-->
                </div>
            </div>
        </div>
        <!--end::Profile Overview-->
    </div>
    <!--end::Container-->
</div>

@endsection

@extends('analyste.analyste_dashboard')
@section('analyste')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
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
                                    <h3 class="fw-bolder">Mise à jour du profil</h3>
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
                                <form id="kt_account_profile_details_form" class="form" method="POST" action="{{ route('analyste.profile.update') }}" enctype="multipart/form-data">
                                    @csrf
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-bold fs-6">Photo</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <!--begin::Image input-->
                                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('{{ asset('assets/media/avatars/blank.png') }}')">
                                                <!--begin::Preview existing avatar-->
                                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ !empty(Auth::user()->profile_pic) ? url('upload/admin_images/' . Auth::user()->profile_pic) : url('upload/no_image.jpg') }}')"></div>
                                                <!--end::Preview existing avatar-->
                                                <!--begin::Label-->
                                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Changer l'avatar">
                                                    <i class="bi bi-pencil-fill fs-7"></i>
                                                    <!--begin::Inputs-->
                                                    <input type="file" name="profile_pic" accept=".png, .jpg, .jpeg" />
                                                    <input type="hidden" name="avatar_remove" />
                                                    <!--end::Inputs-->
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Cancel-->
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Annuler l'avatar">
                                                    <i class="bi bi-x fs-2"></i>
                                                </span>
                                                <!--end::Cancel-->
                                                <!--begin::Remove-->
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Supprimer l'avatar">
                                                    <i class="bi bi-x fs-2"></i>
                                                </span>
                                                <!--end::Remove-->
                                            </div>
                                            <!--end::Image input-->
                                            <!--begin::Hint-->
                                            <div class="form-text">Types de fichiers autorisés : png, jpg, jpeg.</div>
                                            <!--end::Hint-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Nom complet</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-6 fv-row">
                                                    <input type="text" name="prenom" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Prénom" value="{{ Auth::user()->prenom }}" />
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-lg-6 fv-row">
                                                    <input type="text" name="nom" class="form-control form-control-lg form-control-solid" placeholder="Nom" value="{{ Auth::user()->nom }}" />
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Nom d'utilisateur</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input type="text" name="user_name" class="form-control form-control-lg form-control-solid" placeholder="Nom d'utilisateur" value="{{ Auth::user()->user_name }}" />
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-bold fs-6">
                                            <span class="required">Téléphone</span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input type="tel" name="phone" class="form-control form-control-lg form-control-solid" placeholder="Votre téléphone" value="{{ Auth::user()->phone }}" />
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-bold fs-6">Email</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="Votre email" value="{{ Auth::user()->email }}" />
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-light me-3" onclick="window.history.back();">Annuler</button>
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
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

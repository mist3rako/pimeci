@extends('admin.admin_dashboard')
@section('admin') 
<div class="page-content">
    <div class="row profile-body">
        <!-- left wrapper start -->
        <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
            <div class="card rounded">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div>
                            <img class="wd-100 rounded-circle" 
                                 src="{{ !empty($profileData->profile_pic) ? url('upload/admin_images/'.$profileData->profile_pic) : url('upload/no_image.jpg') }}" 
                                 alt="profile"
                                 style="width: 100px; height: 100px; object-fit: cover;">
                            <span class="h4 ms-3">{{ $profileData->user_name }}</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Nom:</label>
                        <p class="text-muted">{{ ucfirst(strtolower($profileData->prenom)) }} {{ strtoupper($profileData->nom) }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Téléphone:</label>
                        <p class="text-muted">{{ $profileData->phone }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                        <p class="text-muted">{{ $profileData->email }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Affectation:</label>
                        <p class="text-muted">{{ $profileData->affectation }}</p>
                    </div>
                    <div class="mt-3 d-flex social-links">
                        <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                            <i data-feather="github"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                            <i data-feather="twitter"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                            <i data-feather="instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- left wrapper end -->
        
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Mise à jour du profil</h6>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form class="forms-sample" action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="mb-3">
                                <label for="user_name" class="form-label">Nom d'utilisateur</label>
                                <input type="text" class="form-control" name="user_name" id="user_name" autocomplete="off" value="{{ $profileData->user_name }}">
                            </div>
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" name="nom" id="nom" autocomplete="off" value="{{ $profileData->nom }}">
                            </div>
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" name="prenom" id="prenom" autocomplete="off" value="{{ $profileData->prenom }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" autocomplete="off" value="{{ $profileData->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Téléphone</label>
                                <input type="tel" class="form-control" name="phone" id="phone" autocomplete="off" value="{{ $profileData->phone }}">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Photo</label>
                                <input class="form-control" name="profile_pic" type="file" id="image">
                            </div>
                            <div class="mb-3">
                                <img id="showImage" class="wd-80 rounded-circle" 
                                     src="{{ !empty($profileData->profile_pic) ? url('upload/admin_images/'.$profileData->profile_pic) : url('upload/no_image.jpg') }}" 
                                     alt="profile"
                                     style="width: 80px; height: 80px; object-fit: cover;">
                            </div>
                         
                            <button type="submit" class="btn btn-primary me-2">Mise à jour</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- middle wrapper end -->
    </div>
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image');
        const showImage = document.getElementById('showImage');

        imageInput.addEventListener('change', function(event) {
            if (event.target.files && event.target.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    showImage.src = e.target.result;
                };

                reader.readAsDataURL(event.target.files[0]);
            }
        });
    });
</script>
@endsection

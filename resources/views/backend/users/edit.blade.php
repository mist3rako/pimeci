@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">

    <!-- Breadcrumb -->
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de Bord</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Gestion des Utilisateurs</a></li>
            <li class="breadcrumb-item active" aria-current="page">Modifier un Utilisateur</li>
        </ol>
    </nav>

    <!-- Page Content -->
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Modifier un Utilisateur</h6>
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Formulaire en deux colonnes -->
                        <div class="row">
                            <!-- Colonne de gauche -->
                            <div class="col-md-6">

                                <!-- Code Employé -->
                                <div class="form-group">
                                    <label for="code_employe">Code Employé</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="hash"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="code_employe" name="code_employe" value="{{ $user->code_employe }}" required>
                                    </div>
                                    @error('code_employe') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Nom -->
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="nom" name="nom" value="{{ $user->nom }}" required>
                                    </div>
                                    @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Prénom -->
                                <div class="form-group">
                                    <label for="prenom">Prénom</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $user->prenom }}" required>
                                    </div>
                                    @error('prenom') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Nom d'Utilisateur -->
                                <div class="form-group">
                                    <label for="user_name">Nom d'Utilisateur</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="at-sign"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="user_name" name="user_name" value="{{ $user->user_name }}" required>
                                    </div>
                                    @error('user_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Adresse Email -->
                                <div class="form-group">
                                    <label for="email">Adresse Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="mail"></i></span>
                                        </div>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                    </div>
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Rôle -->
                                <div class="form-group">
                                    <label for="role_as">Rôle</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="shield"></i></span>
                                        </div>
                                        <select class="form-control" id="role_as" name="role_as" required>
                                            <option value="">Sélectionnez un rôle</option>
                                            @foreach($roles as $key => $role)
                                                <option value="{{ $key }}" {{ $user->role_as == $key ? 'selected' : '' }}>{{ $role }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('role_as') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Statut -->
                                <div class="form-group">
                                    <label for="statut">Statut</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="toggle-left"></i></span>
                                        </div>
                                        <select class="form-control" id="statut" name="statut" required>
                                            <option value="activé" {{ $user->statut == 'activé' ? 'selected' : '' }}>Activé</option>
                                            <option value="désactivé" {{ $user->statut == 'désactivé' ? 'selected' : '' }}>Désactivé</option>
                                        </select>
                                    </div>
                                    @error('statut') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                            </div> <!-- Fin colonne de gauche -->

                            <!-- Colonne de droite -->
                            <div class="col-md-6">

                                <!-- Sexe -->
                                <div class="form-group">
                                    <label for="sexe">Sexe</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="user"></i></span>
                                        </div>
                                        <select class="form-control" id="sexe" name="sexe">
                                            <option value="">Sélectionnez le sexe</option>
                                            <option value="M" {{ $user->sexe == 'M' ? 'selected' : '' }}>Masculin</option>
                                            <option value="F" {{ $user->sexe == 'F' ? 'selected' : '' }}>Féminin</option>
                                        </select>
                                    </div>
                                    @error('sexe') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Affectation -->
                                <div class="form-group">
                                    <label for="affectation">Affectation</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="map-pin"></i></span>
                                        </div>
                                        <select class="form-control" id="affectation" name="affectation">
                                            <option value="">Sélectionnez l'affectation</option>
                                            <option value="Chef de Service" {{ $user->affectation == 'Chef de Service' ? 'selected' : '' }}>Chef de Service</option>
                                            <option value="Inspecteur" {{ $user->affectation == 'Inspecteur' ? 'selected' : '' }}>Inspecteur</option>
                                            <option value="Technicien Junior" {{ $user->affectation == 'Technicien Junior' ? 'selected' : '' }}>Technicien Junior</option>
                                            <option value="Technicien Senior" {{ $user->affectation == 'Technicien Senior' ? 'selected' : '' }}>Technicien Senior</option>
                                            <option value="Assistant Directeur" {{ $user->affectation == 'Assistant Directeur' ? 'selected' : '' }}>Assistant Directeur</option>
                                            <option value="Directeur" {{ $user->affectation == 'Directeur' ? 'selected' : '' }}>Directeur</option>
                                        </select>
                                    </div>
                                    @error('affectation') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Numéro de Plaque -->
                                <div class="form-group">
                                    <label for="no_plaque">Numéro de Plaque</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="key"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="no_plaque" name="no_plaque" value="{{ $user->no_plaque }}">
                                    </div>
                                    @error('no_plaque') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Téléphone -->
                                <div class="form-group">
                                    <label for="phone">Téléphone</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                                    </div>
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Mot de Passe -->
                                <div class="form-group">
                                    <label for="password">Mot de Passe (Laisser vide si inchangé)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Entrez un nouveau mot de passe">
                                    </div>
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Confirmation Mot de Passe -->
                                <div class="form-group">
                                    <label for="password_confirmation">Confirmez le Mot de Passe</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmez le mot de passe">
                                    </div>
                                    @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Photo de Profil -->
                                <div class="form-group">
                                    <label for="profile_pic">Photo de Profil</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="profile_pic" name="profile_pic" onchange="previewImage(event)">
                                    </div>
                                    @error('profile_pic') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <!-- Aperçu de la Photo -->
                                <div class="form-group">
                                    <label>Aperçu de la Photo</label>
                                    <div>
                                        <img id="currentImage" src="{{ $user->profile_pic ? asset('upload/admin_images/' . $user->profile_pic) : asset('upload/admin_images/no_image.jpg') }}" alt="Pas d'image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                                    </div>
                                </div>
                            </div> <!-- Fin colonne de droite -->
                        </div>

                        <!-- Boutons -->
                        <button type="submit" class="btn btn-primary mr-2">Mettre à jour</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Annuler</a>

                    </form>
                </div> <!-- Fin du corps de la carte -->
            </div> <!-- Fin de la carte -->
        </div> <!-- Fin de la colonne -->
    </div> <!-- Fin de la rangée -->

</div> <!-- Fin du contenu de la page -->

<!-- JavaScript pour l'aperçu de l'image -->
<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
        document.getElementById('currentImage').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

@endsection

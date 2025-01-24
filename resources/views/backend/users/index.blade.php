@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">

    <!-- Breadcrumb -->
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de Bord</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gestion des Utilisateurs</li>
        </ol>
    </nav>

    <!-- Page Content -->
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- Card Title -->
                    <h6 class="card-title">Gestion des Utilisateurs</h6>
                    <p class="text-muted mb-3">La gestion des utilisateurs permet d'ajouter, de mettre à jour, et de supprimer les comptes d'utilisateurs existants. Utilisez la barre de recherche pour trouver des utilisateurs par nom, prénom, email ou code employé.</p>

                    <!-- Success and Error Messages -->
                    @if (session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif


                    <!-- Add User Button -->
                    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Ajouter un Utilisateur</a>

                    <!-- Data Table -->
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Photo</th>
                                    <th>Code Employé</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Nom d'Utilisateur</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <!-- Affichage de l'image de profil -->
                                        <td>
                                            @if($user->profile_pic)
                                                <img src="{{ asset('upload/admin_images/' . $user->profile_pic) }}" alt="Photo de {{ $user->nom }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                            @else
                                                <img src="{{ asset('upload/admin_images/no_image.jpg') }}" alt="Pas d'image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                            @endif
                                        </td>
                                        <td>{{ $user->code_employe }}</td>
                                        <td>{{ $user->nom }}</td>
                                        <td>{{ $user->prenom }}</td>
                                        <td>{{ $user->user_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $user->role_as)) }}</td>
                                        <!-- Statut avec coloration de fond -->
                                        <td>
                                            @if($user->statut == 'activé')
                                                <span class="badge badge-success">Activé</span>
                                            @else
                                                <span class="badge badge-danger">Désactivé</span>
                                            @endif
                                        </td>
                                        <!-- Actions -->
                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- End Table Responsive -->

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $users->links('pagination::bootstrap-4') }}
                    </div>

                </div> <!-- End Card Body -->
            </div> <!-- End Card -->
        </div> <!-- End Col -->
    </div> <!-- End Row -->

</div> <!-- End Page Content -->

@endsection

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe</title>
    <!-- Inclure les styles de votre application ici -->
</head>
<body>
    <div>
        <h1>Réinitialiser le mot de passe</h1>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}" required autofocus>
                @error('email')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password">Nouveau mot de passe</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
                @error('password_confirmation')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <button type="submit">Réinitialiser le mot de passe</button>
        </form>
    </div>
</body>
</html>

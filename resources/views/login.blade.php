<!doctype html>
<html lang="fr-FR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        @vite(["resources/css/app.css", "resources/js/app.js"])
        <title>Connexion - rOrtho</title>
    </head>

    <body class="d-flex justify-content-center align-items-center vh-100 bg-light">
        <div class="card p-4 shadow-sm" style="width: 20rem;">
            <h2 class="text-center mb-4">Connexion</h2>
            <form method="POST" action="{{ route("login.post") }}">
                @method("POST")
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Entrez votre email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="password" placeholder="Entrez votre mot de passe" required>
                </div>

                <a href="./register">
                    <p class="small">Pas inscrit ? Inscrivez-vous</p>
                </a>

                <button type="submit" class="btn btn-primary w-100">Se connecter</button>
            </form>
        </div>
    </body>
</html>

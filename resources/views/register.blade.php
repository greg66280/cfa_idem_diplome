<!doctype html>
<html lang="fr-FR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        @vite(["resources/css/app.css", "resources/js/app.js"])
        <title>Inscription - rOrtho</title>
    </head>

    <body class="d-flex justify-content-center align-items-center vh-100 bg-light">
        <div class="card p-4 shadow-sm" style="width: 20rem;">
            <h2 class="text-center mb-4">Inscription</h2>
            <form method="POST" action="{{ route("register.post") }}">
                @method("POST")
                @csrf
                
                <div class="mb-3">
                    <label for="name" class="form-label">Identité</label>
                    <input type="text" class="form-control" name="name" placeholder="Entrez votre nom" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Entrez votre email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="password" placeholder="Entrez votre mot de passe" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Confirmer le mot de passe</label>
                    <input type="password" class="form-control" name="conf_password" placeholder="Entrez votre mot de passe" required>
                </div>

                <a href="./login">
                    <p class="small">Déjà inscrit ? Connectez-vous</p>
                </a>

                <button type="submit" class="btn btn-primary w-100">Se connecter</button>
            </form>
        </div>
    </body>
</html>

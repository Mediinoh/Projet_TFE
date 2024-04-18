<div class="container">
    <h2><span class="bi bi-person-check" aria-hidden="true"></span> Connexion</h2>
    <p class="text-danger"><?= $message; ?></p>

    <form action="?action=login" method="post">
        <div class="form-group mb-3">
            <label for="pseudo" class="form-label"><span class="bi bi-person-circle"></span> Nom d'utilisateur:</label>
            <input type="text" name="pseudo" id="pseudo" required class="form-control">
        </div>
        
        <div class="form-group mb-3">
            <label for="mot_de_passe" class="form-label"><span class="bi bi-lock" aria-hidden="true"></span> Mot de passe:</label>
            <input type="password" name="mot_de_passe" id="mot_de_passe" required class="form-control">
        </div>

        <input type="submit" value="Se connecter" name="login_button" class="btn btn-primary">
    </form>
</div>
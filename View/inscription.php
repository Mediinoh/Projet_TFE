<div class="container">
    <h2><span class="bi bi-person-add" aria-hidden="true"></span> Inscription</h2>
    <p class="text-danger"><?= $message; ?></p>
    
    <form action="?action=inscription" method="post" enctype="multipart/form-data">
        <!-- MAX_FILE_SIZE -->
        <input type="hidden" name="MAX_FILE_SIZE" value="100000">

        <div class="form-group mb-3">
            <label for="nom" class="form-label">Nom:</label>
            <input type="text" name="nom" required id="nom" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="prenom" class="form-label">Prénom:</label>
            <input type="text" name="prenom" required id="prenom" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="adresse" class="form-label"><span class="bi bi-geo-alt" aria-hidden="true"></span> Adresse:</label>
            <input type="text" name="adresse" required id="adresse" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="code_postal" class="form-label"><span class="bi bi-geo" aria-hidden="true"></span> Code Postal:</label>
            <input type="text" name="code_postal" required id="code_postal" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="date_naissance" class="form-label"><span class="bi bi-cake2"></span> Date de Naissance:</label>
            <input type="date" name="date_naissance" required id="date_naissance" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="email" class="form-label"><span class="bi bi-at" aria-hidden="true"></span> Adresse email:</label>
            <input type="email" name="email" required id="email" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="pseudo" class="form-label"><span class="bi bi-person-circle" aria-hidden="true"></span> Pseudo/Login:</label>
            <input type="text" name="pseudo" required id="pseudo" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="mot_de_passe" class="form-group mb-3"><span class="bi bi-lock" aria-hidden="true"></span> Mot de passe:</label>
            <input type="password" name="mot_de_passe" required id="mot_de_passe" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="confirmation_mot_de_passe" class="form-label"><span class="bi bi-lock" aria-hidden="true"></span> Confirmation de mot de passe:</label>
            <input type="password" name="confirmation_mot_de_passe" id="confirmation_mot_de_passe" required class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="photo_profil" class="form-label"><span class="bi bi-file-image" aria-hidden="true"></span> Photo de profil:</label>
            <input type="file" class="form-control" id="photo_profil" name="photo_profil">
        </div>

        <button type="submit" name="inscription_button" class="btn btn-primary">
            <span class="bi bi-person-add" aria-hidden="true"></span> S'inscrire
        </button>
    </form>
</div>
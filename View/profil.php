<h2>Votre profil </h2>
<p class="text-danger"><?= $message; ?></p>
<form action="?action=profil" method="post">
    <div class="form-group mb-3">
        <label for="nom" class="form-label">Nom:</label>
        <input type="text" value="<?= $utilisateur['nom']; ?>" id="nom" name="nom" readonly>
    </div>

    <div class="form-group mb-3">
        <label for="prenom" class="form-label">Prénom:</label>
        <input type="text" value="<?= $utilisateur['prenom']; ?>" id="prenom" name="prenom" readonly>
    </div>

    <div class="form-group mb-3">
        <label for="adresse" class="form-label"><span class="bi bi-geo-alt" aria-hidden="true"></span> Adresse: <span class="text-danger" aria-hidden="true">*</span></label>
        <input type="text" value="<?= $utilisateur['adresse']; ?>" id="adresse" name="adresse" required>
    </div>

    <div class="form-group mb-3">
        <label for="code_postal" class="form-label"><span class="bi bi-geo" aria-hidden="true"></span> Code postal: <span class="text-danger" aria-hidden="true">*</span></label>
        <input type="text" value="<?= $utilisateur['code_postal']; ?>" id="code_postal" name="code_postal" required>
    </div>

    <div class="form-group mb-3">
        <label for="date_naissance" class="form-label"><span class="bi bi-cake2" aria-hidden="true"></span> Date de naissance:</label>
        <input type="date" value="<?= $utilisateur['date_naissance']; ?>" id="date_naissance" name="date_naissance" readonly>
    </div>

    <div class="form-group mb-3">
        <label for="email" class="form-label"><span class="bi bi-at" aria-hidden="true"></span> Email: <span class="text-danger" aria-hidden="true">*</span></label>
        <input type="email" value="<?= $utilisateur['email']; ?>" id="email" name="email" required>
    </div>

    <div class="form-group mb-3">
        <label for="pseudo" class="form-label"><span class="bi bi-person-circle" aria-hidden="true"></span> Pseudo:</label>
        <input type="text" value="<?= $utilisateur['pseudo']; ?>" id="pseudo" name="pseudo" readonly>
    </div>
    <p class="text-danger">**Introduisez un nouveau mot de passe uniquement en cas de changement !**</p>
    <div class="form-group mb-3">
        <label for="mot_de_passe" class="form-label"><span class="bi bi-lock" aria-hidden="true"></span> Mot de passe: <span class="text-danger" aria-hidden="true">*</span></label>
        <input type="password" id="mot_de_passe" name="mot_de_passe">
    </div>

    <div class="form-group mb-3">
        <label for="confirmation_mot_de_passe" class="form-label"><span class="bi bi-lock" aria-hidden="true"></span> Confirmation du mot de passe: <span class="text-danger" aria-hidden="true">*</span></label>
        <input type="password" id="confirmation_mot_de_passe" name="confirmation_mot_de_passe">
    </div>

    <input type="submit" value="Modifier le profil" name="profil_button" class="btn btn-primary">
</form>
<?php $utilisateurConnecte = empty($_SESSION['authentifie']) ? null : unserialize($_SESSION['utilisateur']); ?>
<!-- Navigation-->
<nav role="navigation" class="navbar navbar-expand-lg navbar-light bg-light fixed-top" aria-label="Menu principal de la page">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="?action=login">Mehdi Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="?action=home">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="?action=propos">À propos de nous</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Nos Produits</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item"  href="?action=produits">Tous les produits</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="?action=meilleures_ventes">Meilleures ventes</a></li>
                        <li><a class="dropdown-item" href="?action=nouveautes">Nouveautés</a></li>
                    </ul>
                    <li class="nav-item"><a class="nav-link" href="?action=chat">Chat</a></li>
                <li class="nav-item dropdown">
                </li>
                <li class="nav-item"><a class="nav-link" href="?action=blog">Blog/Newletters</a></li>
                <?php if (!empty($_SESSION['authentifie']) && $utilisateurConnecte['admin_privilege']) : ?>
                    <li class="nav-item">
                        <a href="?action=admin_utilisateurs" class="nav-link">Gestion des utilisateurs</a>
                    </li>
                    <li class="nav-item">
                        <a href="?action=admin_articles" class="nav-link">Gestion des articles</a>
                    </li>
                <?php endif; ?>
            </ul>
            <?php if (!empty($_SESSION['authentifie'])) : ?>
                <div class="d-flex">
                    <a href="?action=panier" class="btn btn-primary"><span class="bi bi-cart" aria-hidden="true"></span> Mon panier</a>
                    <a href="?action=profil" class="btn btn-primary ms-2 d-flex align-items-center">
                        <?php if (is_null($utilisateurConnecte['photo_profil'])) : ?>
                            <span class="bi bi-person-vcard" aria-hidden="true"></span>
                        <?php else : ?>
                            <img src="<?= $utilisateurConnecte['photo_profil']; ?>" alt="" class="rounded-circle img-fluid me-2" width="40" height="40">
                        <?php endif; ?>
                        Modifier le profil de <?= $utilisateurConnecte['pseudo']; ?>
                    </a>
                    <a href="?action=logout" class="btn btn-primary ms-2">Se déconnecter</a>
                </div>
            <?php else : ?>
                <div class="d-flex">
                    <a href="?action=login" class="btn btn-primary me-2">Se connecter</a>
                    <a href="?action=inscription" class="btn btn-primary">S'inscrire</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>
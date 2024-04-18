<header role="header" class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Commentaires de l'utilisateur</h1>
            <p class="lead fw-normal text-white-50 mb-0">Ce que vous pensez.</p>
        </div>
    </div>
</header>

<!-- Section Commentaires -->
<section class="py-5 container-fluid">
    <p class="text-danger"><?= $message; ?></p>
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php if (empty($commentaires_utilisateur)) : ?>
                <p class="text-center">Aucun commentaire pour cet utilisateur dans la base de données.</p>
            <?php else : ?>
                <?php foreach($commentaires_utilisateur as $commentaire) : ?>
                    <div class="col mb-5">
                        <div class="card text-center">
                            <img src="<?= $commentaire['photo_article']; ?>" alt="<?= $commentaire['titre']; ?>" class="card-img-top img-fluid">
                            <div class="card-header d-flex justify-content-between">
                                <p><?= $commentaire['titre']; ?></p>
                                <p><?= date_format(date_create($commentaire['date_commentaire']), 'd/m/Y H:i'); ?></p>
                            </div>
                            <div class="card-body p-4">
                                <div class="card-text">
                                    <p><?= $commentaire['commentaire']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="?action=admin_utilisateurs">Liste des utilisateurs</a></div>
</div>

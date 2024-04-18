<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Parceque vous l'avez décidé !</h1>
            <p class="lead fw-normal text-white-50 mb-0">Touts nos meilleurs ventes regroupées ici</p>
        </div>
    </div>
</header>

 <!-- Section-->
 <section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php if (empty($meilleures_ventes)) : ?>
                <p>Aucun article dans la base de données.</p>
            <?php else : ?>
                <?php foreach($meilleures_ventes as $article) : ?>
                    <div class="col mb-5">
                        <div class="card h-100 text-center">
                            <img src="<?= $article['photo_article']; ?>" alt="<?= $article['titre']; ?>" class="card-img-top">
                            <div class="card-body p-4">
                                <h5 class="card-title"><?= $article['titre']; ?></h5>
                                <div class="card-text">
                                    <p><?= $article['nom_categorie']; ?></p>
                                    <p><?= $article['prix_unitaire']; ?>&euro;</p>
                                    <p><?= $article['description']; ?></p>
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <p>Il a été vendu en <?= $article['total_ventes'] ?? 0; ?> exemplaires.</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
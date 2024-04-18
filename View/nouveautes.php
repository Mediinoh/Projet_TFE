<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Toutes les nouveautés</h1>
            <p class="lead fw-normal text-white-50 mb-0">Certaines exlusivitées uniquement sur Mehdi Shop</p>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php if (empty($nouveautes)) : ?>
                <p>Aucun article dans la base de données.</p>
            <?php else : ?>
                <?php foreach($nouveautes as $article) : ?>
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
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

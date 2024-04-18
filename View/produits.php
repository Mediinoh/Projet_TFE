<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">La folie de la technologie </h1>
            <p class="lead fw-normal text-white-50 mb-0">C'est ici que ça se passe.</p>
        </div>
    </div>
</header>

<section class="py-5 container">
    <div class="row">
        <form action="?action=produits" method="get" class="d-flex align-items-center justify-content-end">
            <input type="hidden" name="action" value="<?= $_GET['action']; ?>">
            <div class="form-group mb-3 me-3 d-flex align-items-center">
                <label for="categorie_id" class="form-label me-3 d-flex align-items-center"><span class="bi bi-tag" aria-hidden="true"></span> Catégorie:</label>
                <select name="categorie_id" id="categorie_id" class="form-select">
                    <option value="">Toutes</option>
                    <?php foreach ($categories as $categorie) : ?>
                        <option <?= ($categorie_id == $categorie['id']) ? 'selected' : ''; ?> value="<?= $categorie['id']; ?>"><?= $categorie['nom_categorie']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group mb-3 me-3">
                <label for="mot_cle" class="form-label"><span class="bi bi-fonts" aria-hidden="true"></span> Mot(s) clé(s):</label>
                <input type="text" id="mot_cle" name="mot_cle" value="<?= $mot_cle; ?>">
            </div>
            <div class="form-group mb-3 me-3">
                <button type="submit" class="btn btn-primary">
                    <span class="bi bi-search-heart" aria-hidden="true"></span> Rechercher
                </button>
            </div>
        </form>
    </div>
</section>
<section class="py-5">
    <p class="alert alert-success text-center"><?= $message; ?></p>
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php if (empty($articles)) : ?>
                <p>Aucun article dans la base de données.</p>
            <?php else : ?>
                <?php foreach($articles as $article) : ?>
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
                                <form action="?action=produits" method="post">
                                    <input type="hidden" name="article_id" value="<?= $article['id']; ?>">
                                    <div class="form-group mb-3">
                                        <label for="quantite" class="form-label">Quantité:</label>
                                        <select class="form-select" name="quantite" id="quantite" required>
                                            <?php for($i = 1; $i <= NB_MAX_ACHATS; $i++) : ?>
                                                <option value="<?= $i; ?>"><?= $i; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="panier_button">
                                            <span class="bi bi-cart-plus" aria-hidden="true"></span> Ajouter au panier
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

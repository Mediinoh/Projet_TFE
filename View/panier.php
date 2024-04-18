<header role="header" class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Mon panier</h1>
            <p class="lead fw-normal text-white-50 mb-0">Ce que vous commandez.</p>
        </div>
    </div>
</header>
<section class="py-5">
    <div class="container">
        <?php if (empty($_SESSION['panier'])) : ?>
            <p class="text-center">Votre panier est vide</p>
        <?php else : ?>
            <table id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">Photo de l'article</th>
                        <th scope="col">Nom de l'article</th>
                        <td scope="col">Prix unitaire</td>
                        <th scope="col">Quantité</th>
                        <th scope="col">Prix total</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; foreach($_SESSION['panier'] as $article_id => $quantite) : $article = $db->recupererArticle($article_id); $prix_total_article = floatval($article['prix_unitaire'] * $quantite); $total += $prix_total_article; ?>
                        <tr>
                            <td><img src="<?= $article['photo_article']; ?>" alt="<?= $article['titre']; ?>" class="img-thumbnail"></td>
                            <td><?= $article['titre']; ?></td>
                            <td><?= $article['prix_unitaire']; ?></td>
                            <td><?= $quantite; ?></td>
                            <td>$<?= $prix_total_article; ?></td>
                            <td>
                                <form action="?action=panier" method="post">
                                    <input type="hidden" name="article_id" value="<?= $article['id']; ?>">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger" name="suppression_button">
                                            <span class="bi bi-trash" aria-hidden="true"></span> Supprimer
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Total</td>
                        <td><?= array_sum($_SESSION['panier']); ?></td>
                        <td>$<?= $total; ?></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <div class="d-flex justify-content-end">
                <form action="?action=panier" method="post">
                    <div class="form-group">
                        <button type="submit" name="payer_button" class="btn btn-primary">
                            <span class="bi bi-cart-fill" aria-hidden="true"></span> Payer
                        </button>
                    </div>
                </form>
            </div>

        <?php endif; ?>
    </div>
</section>

<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="?action=produits">Liste des produits</a></div>
</div>
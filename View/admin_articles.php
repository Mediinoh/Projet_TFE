<header role="header" class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Liste des articles</h1>
            <p class="lead fw-normal text-white-50 mb-0">Ce que vous avez créé.</p>
        </div>
    </div>
</header>
<section class="py-5">
    <p><a href="?action=admin_categories" class="btn btn-warning"><span class="bi bi-tags" aria-hidden="true"></span> Ajouter une nouvelle catégorie d'articles</a></p>

    <?php if (empty($articles)) : ?>
        <p class="text-center">Aucun article dans la base de données</p>
    <?php else : ?>
        <table id="dataTable">
            <thead>
                <tr>
                    <th scope="col"># Id</th>
                    <th scope="col">Photo de l'article</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Nom de la catégorie</th>
                    <th scope="col">Prix unitaire</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($articles as $article) : ?>
                    <tr>
                        <td col="row"><?= $article['id']; ?></td>
                        <td><img src="<?= $article['photo_article']; ?>" alt="<?= $article['titre'] ?>"></td>
                        <td><?= $article['titre']; ?></td>
                        <td><?= $article['nom_categorie']; ?></td>
                        <td><?= $article['prix_unitaire']; ?></td>
                        <td><?= $article['description']; ?></td>
                        <td>
                            <?php if (!$article['supprime']) : ?>
                                <form action="?action=admin_articles" method="post">
                                    <input type="hidden" name="article_id" value="<?= $article['id']; ?>">
                                    <div class="form-group">
                                        <button type="submit" name="suppression_article_button" class="btn btn-danger">
                                            <span class="bi bi-trash" aria-hidden="true"></span> Supprimer
                                        </button>
                                    </div>
                                </form>
                            <?php else : ?>
                                <p class="text-center">Cet article a déjà été supprimé !</p>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>
<section class="py-5 container-fluid">
    <h2>Formulaire d'ajout d'un article :</h2>
    <form action="?action=admin_articles" method="post" enctype="multipart/form-data">
        <div class="form-group mb-3">
            <label for="titre" class="form-label">Titre:</label>
            <input type="text" name="titre" class="form-control" id="titre" required>
        </div>
        <div class="form-group mb-3">
            <label for="prix_unitaire" class="form-label">Prix unitaire:</label>
            <input type="number" name="prix_unitaire" class="form-control" id="prix_unitaire" required step="0.01" min="0.00">
        </div>
        <div class="form-group mb-3">
            <label for="categorie_id" class="form-label d-flex align-items-center"><span class="bi bi-tag" aria-hidden="true"></span> Catégorie:</label>
            <select name="categorie_id" id="categorie_id" class="form-select">
                <option value="">Toutes</option>
                <?php foreach ($categories as $categorie) : ?>
                    <option value="<?= $categorie['id']; ?>"><?= $categorie['nom_categorie']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control" required></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="photo_article" class="form-label">Photo de l'article:</label>
            <input type="file" class="form-control" id="photo_article" name="photo_article" required>
        </div>
        <div class="form-group">
            <button type="submit" name="ajout_article_button" class="btn btn-primary">
                <span class="bi bi-plus-circle" aria-hidden="true"></span> Ajout d'un article
            </button>
        </div>
    </form>
</section>
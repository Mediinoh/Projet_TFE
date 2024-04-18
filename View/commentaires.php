    <header role="header" class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Commentaires de l'article</h1>
                <p class="lead fw-normal text-white-50 mb-0">Ce que vous pensez.</p>
            </div>
        </div>
    </header>

    <!-- Section Commentaires -->
    <section class="py-5">
        <p class="text-danger"><?= $message; ?></p>
        <table>
            <thead>
                <tr>
                    <th scope="col">Utilisateur</th>
                    <th scope="col">Commentaire</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($commentaires)) : ?>
                    <tr>
                        <td colspan="3" class="text-center">Aucun commentaire</td>
                    </tr>
                <?php else : ?>
                    <?php foreach($commentaires as $commentaire) : ?>
                        <tr>
                            <td><?= $commentaire['pseudo']; ?></td>
                            <td><?= $commentaire['commentaire']; ?></td>
                            <td><?= date_format(date_create($commentaire['date_commentaire']), 'd/m/Y H:i'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if (!empty($_SESSION['pseudo'])) : ?>
            <form action="?action=commentaires&article_id=<?= $article_id; ?>" method="post">
                <div class="form-group mb-3">
                    <label for="" class="form-label">Commentaire:</label>
                    <textarea name="commentaire" id="commentaire" cols="30" rows="10" class="form-control" required></textarea>
                </div>
                <div class="form-group mb-3">
                    <input type="submit" value="Ajouter un nouveau commentaire" class="btn btn-primary" name="commentaires_button">
                </div>
            </form>
        <?php endif; ?>
    </section>

    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="?action=home">Accueil</a></div>
    </div>

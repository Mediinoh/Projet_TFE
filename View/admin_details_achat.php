<header role="header" class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Liste des détails de l'achat</h1>
            <p class="lead fw-normal text-white-50 mb-0">Ce que vous avez acheté.</p>
        </div>
    </div>
</header>

<section class="py-5">
    
</section>

<section class="py-5 container-fluid">
    <p class="text-danger"><?= $message; ?></p>
    <?php if (empty($details_achat)) : ?>
        <p class="text-center">Aucun détail de l'achat</p>
    <?php else : ?>
        <table id="dataTable">
            <thead>
                <tr>
                    <th scope="col">Photo de l'article</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Prix</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($details_achat as $achat_detail) : ?>
                    <tr>
                        <td><img src="<?= $achat_detail['photo_article']; ?>" alt="<?= $achat_detail['titre']; ?>" class="img-thumbnail"></td>
                        <td><?= $achat_detail['titre']; ?></td>
                        <td><?= $achat_detail['quantite']; ?></td>
                        <td><?= $achat_detail['prix']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>

<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="?action=admin_utilisateurs">Liste des utilisateurs</a></div>
</div>
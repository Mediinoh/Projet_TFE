<header role="header" class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Achats de l'utilisateur</h1>
            <p class="lead fw-normal text-white-50 mb-0">Ce que vous achetez.</p>
        </div>
    </div>
</header>

<!-- Section Commentaires -->
<section class="py-5">
    <p class="text-danger"><?= $message; ?></p>
    <?php if (empty($achats_utilisateur)) : ?>
        <p class="text-center">Aucun achat pour cet utilisateur dans la base de données</p>
    <?php else : ?>
        <table>
            <thead>
                <tr>
                    <th scope="col">Utilisateur</th>
                    <th scope="col">Date d'achat</th>
                    <th scope="col">Montant total</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($achats_utilisateur as $achat) : ?>
                    <tr>
                        <td><?= $achat['pseudo']; ?></td>
                        <td><?= date_format(date_create($achat['date_achat']), 'd/m/Y H:i'); ?></td>
                        <td><?= $achat['montant_total']; ?>&euro;</td>
                        <td>
                            <a href="?action=admin_details_achat&achat_id=<?= $achat['id']; ?>" class="btn btn-primary">
                                <span class="bi bi-eye" aria-hidden="true"></span> Voir les détails
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>

<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="?action=admin_utilisateurs">Liste des utilisateurs</a></div>
</div>

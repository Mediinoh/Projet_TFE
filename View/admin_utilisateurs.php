<header role="header" class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Liste des utilisateurs</h1>
            <p class="lead fw-normal text-white-50 mb-0">Ce que vous pensez.</p>
        </div>
    </div>
</header>

<!-- Section Commentaires -->
<section class="py-5">
    <p class="text-danger"><?= $message; ?></p>
    <?php if (empty($utilisateurs)) : ?>
        <p class="text-center">Aucun utilisateur dans la base de données</p>
    <?php else : ?>
        <table>
            <thead>
                <tr>
                    <th scope="col"><span class="bi bi-key" aria-hidden="true"></span> Id</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col"><span class="bi bi-geo-alt" aria-hidden="true"></span> Adresse</th>
                    <th scope="col"><span class="bi bi-geo" aria-hidden="true"></span> Code postal</th>
                    <th scope="col"><span class="bi bi-at" aria-hidden="true"></span> Email</th>
                    <th scope="col"><span class="bi bi-cake2" aria-hidden="true"></span> Date de naissance</th>
                    <th scope="col"><span class="bi bi-person-circle" aria-hidden="true"></span> Pseudo</th>
                    <th scope="col"><span class="bi bi-person-fill-lock" aria-hidden="true"></span> Bloque</th>
                    <th scope="col"><span class="bi bi-shield-lock-fill" aria-hidden="true"></span> Admin</th>
                    <th scole="col"><span class="bi bi-calendar-day" aria-hidden="true"></span> Nombre de connexions du jour</th>
                    <th scole="col"><span class="bi bi-calendar-week" aria-hidden="true"></span> Nombre de connexions des 7 derniers jours</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilisateurs as $utilisateur) : ?>
                    <tr>
                        <td scope="row"><?= $utilisateur['id']; ?></td>
                        <td><?= $utilisateur['nom']; ?></td>
                        <td><?= $utilisateur['prenom']; ?></td>
                        <td><?= $utilisateur['adresse']; ?></td>
                        <td><?= $utilisateur['code_postal']; ?></td>
                        <td><?= $utilisateur['email']; ?></td>
                        <td><?= date_format(date_create($utilisateur['date_naissance']), 'd/m/Y'); ?></td>
                        <td><?= $utilisateur['pseudo']; ?></td>
                        <td><?= $utilisateur['bloque']; ?></td>
                        <td><?= $utilisateur['admin_privilege']; ?></td>
                        <td><?= $db->recupererNbConnexions($utilisateur['id'])['Nombre de connexions']; ?></td>
                        <td><?= $db->recupererNbConnexions($utilisateur['id'], true)['Nombre de connexions']; ?></td>
                        <td>
                            <div class="btn-group">
                                <a class="btn text-primary" href="?action=admin_commentaires_utilisateur&utilisateur_id=<?= $utilisateur['id']; ?>">
                                    <span class="bi bi-eye" aria-hidden="true"></span> Voir commentaires
                                </a>
                                <a class="btn text-secundary" href="?action=admin_achats_utilisateur&utilisateur_id=<?= $utilisateur['id']; ?>">
                                    <span class="bi bi-eye" aria-hidden="true"></span> Voir achats
                                </a>
                                <?php if ($utilisateur['id'] !== $utilisateurConnecte['id']) : ?>
                                    <form action="?action=admin_utilisateurs" method="post">
                                        <input type="hidden" name="utilisateur_id" value="<?= $utilisateur['id']; ?>">
                                        <input type="hidden" name="bloque" value="<?= !$utilisateur['bloque']; ?>">
                                        <button class="btn text-danger p-0 m-0" type="submit" name="bloque_button[<?= $utilisateur['id']; ?>]">
                                            <span class="bi bi-lock" aria-hidden="true"></span> Bloquer/Débloquer
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>
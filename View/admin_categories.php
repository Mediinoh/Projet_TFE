<header role="header" class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Liste des catégories</h1>
            <p class="lead fw-normal text-white-50 mb-0">Ce que vous avez classé.</p>
        </div>
    </div>
</header>

<section class="py-5">
    
</section>

<section class="py-5 container-fluid">
    <p class="text-danger"><?= $message; ?></p>
    <?php if (empty($categories)) : ?>
        <p class="text-center">Aucune catégorie dans la base de données</p>
    <?php else : ?>
        <table id="dataTable">
            <thead>
                <tr>
                    <th scope="col"># Id</th>
                    <th scope="col">Nom</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($categories as $categorie) : ?>
                    <tr>
                        <td scope="row"><?= $categorie['id']; ?></td>
                        <td><?= $categorie['nom_categorie']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>

<section class="py-5 container-fluid">
    <form action="?action=admin_categories" method="post">
        <div class="form-group mb-3">
            <label for="nom_categorie" class="form-label">Nom:</label>
            <input type="text" class="form-control" id="nom_categorie" name="nom_categorie">
        </div>
        <div class="form-group">
            <button type="submit" name="ajout_categorie_button" class="btn btn-primary">
                <span class="bi bi-plus-circle" aria-hidden="true"></span> Ajout d'une catégorie
            </button>
        </div>
    </form>
</section>


<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="?action=admin_articles">Liste des articles</a></div>
</div>
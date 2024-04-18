    <header role="header" class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Blog / Newletters.</h1>
                <p class="lead fw-normal text-white-50 mb-0">Toute l'actualités en direct uniquement pour vous !</p>
            </div>
        </div>
    </header>
    <section class="py-5">
            <div class="container">
                <h2>Bienvenue dans la page Actualités réservé uniquement aux membres. </h2>
                <p>Salut à tous ! </p>
                <p><span style="color: red;">Ici le respect est primordial.</span></p>

                <p> L'échange d'information est l'arme la plus puissante d'aujourd'hui. Merci de l'utiliser à bonne escient.</p>
                
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php foreach($articles as $article) : ?>
                        <div class="col mb-5">
                            <div class="card h-100">
                                <!-- Product image-->
                                <img src="<?= $article['photo_article']; ?>" alt="">
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!--  Product categorie -->
                                        <h4><?= $article['nom_categorie']; ?></h4>
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?= $article['titre']; ?></h5>
                                        <!-- Product price-->
                                        <?= $article['prix_unitaire']; ?>&euro;
                                        <!-- Product description-->
                                        <p><?= $article['description']; ?></p>
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="?action=commentaires&article_id=<?= $article['id']; ?>">Voir commentaires</a></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </section>
    

    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="?action=chat">Mini-chat</a></div>
    </div>

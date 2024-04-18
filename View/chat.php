    <header role="header" class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Nous aimons l'échange et l'entre-aide.</h1>
                <p class="lead fw-normal text-white-50 mb-0">Faite preuve d'imagination et laissez parlez votre esprit.</p>
            </div>
        </div>
    </header>

    <!-- Section Chat -->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <p class="text-danger"><?= $message_erreur; ?></p>
            <div id="chat-container">
                <div id="chat-messages">
                    <?php if(empty($messages)) : ?>
                        <p>Aucun message à afficher</p>
                    <?php else : ?>
                        <?php foreach ($messages as $message) : ?>
                            <div class="card mb-3">
                                <div class="card-header d-flex justify-content-between">
                                    <p><?= $message['pseudo']; ?></p>
                                    <p><?= date_format(date_create($message['date_message']), 'd/m/Y H:i'); ?></p>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?= $message['message']; ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <form action="?action=chat" method="post">
                <div class="form-group mb-3">
                    <label for="message" class="form-label">Message:</label>
                    <textarea name="message" id="message" cols="30" rows="10" class="form-control" required></textarea>
                </div>
                <div class="form-group mb-3">
                    <input type="submit" value="Ajouter un nouveau message" name="chat_button" class="btn btn-primary">
                </div>
            </form>
        </div>
    </section>

    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="?action=home">Accueil</a></div>
    </div>

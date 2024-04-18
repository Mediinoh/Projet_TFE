<?php class AdminArticlesController {

    public function __construct(private $action)
    {
        
    }

    public function run() {
        if (empty($_SESSION['authentifie'])) {
            header('Location: ?action=login');
            die();
        }

        if (!$_SESSION['admin_privilege']) {
            header('Location: ?action=produits');
            die();
        }

        $message = '';

        $db = Db::getInstance();

        $utilisateurConnecte = $db->recupererUtilisateur($_SESSION['pseudo']);

        if (isset($_POST['suppression_article_button'])) {
            if ($db->supprimerArticle($_POST['article_id']) === false) {
                $message = 'Suppression de l\'article a échouée !';
            }
        }

        if (isset($_POST['ajout_article_button'])) {
            if (isset($_FILES['photo_article']) && !empty($_FILES['photo_article']['name'])) {
                $photo_article = CHEMIN_IMAGES . basename($_FILES['photo_article']['name']);
                $liste_extensions = array('image/jpeg', 'image/png');
                if (!in_array($_FILES['photo_article']['type'], $liste_extensions)) {
                    $message = 'Le fichier doit être de type jpeg ou png !';
                } else {
                    move_uploaded_file($_FILES['photo_article']['tmp_name'], $photo_article);
                    if ($db->insererArticle($_POST['titre'], $_POST['prix_unitaire'], $_POST['description'], $_POST['categorie_id'], $photo_article) === false) {
                        $message = 'L\'insertion de l\'article a échouée !';
                    }
                }
            }
        }

        $articles = $db->recupererArticles();
        $categories = $db->recupererCategories();

        $title = 'Liste des articles';
        require_once(CHEMIN_VUES . 'view_template.php');
    }

} ?>
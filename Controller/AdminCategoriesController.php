<?php class AdminCategoriesController {

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

        if (isset($_POST['ajout_categorie_button'])) {
            if (!is_null($db->recupererCategorie($_POST['nom_categorie'])) || $db->insererCategorie($_POST['nom_categorie']) === false) {
                $message = 'L\'insertion de la catégorie a échouée car déjà existante !';
            }
        }

        $categories = $db->recupererCategories();

        $title = 'Liste des catégories';
        require_once(CHEMIN_VUES . 'view_template.php');
    }

} ?>
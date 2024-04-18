<?php class AdminCommentairesUtilisateurController {

    public function __construct(private $action) {

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
        $utilisateur_id = $_GET['utilisateur_id'];

        $commentaires_utilisateur = $db->recupererCommentairesUtilisateur($utilisateur_id);

        $title = 'Liste des commentaires de l\'utilisateur';
        require_once(CHEMIN_VUES . 'view_template.php');
    }

} ?>
<?php class AdminUtilisateursController {

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

        if (!empty($_POST['bloque_button'])) {
            if ($_POST['utilisateur_id'] === $utilisateurConnecte['id'] || $db->changerBloqueUtilisateur($_POST['utilisateur_id'], $_POST['bloque']) === false) {
                $message = 'Changement d\'état de blocage de l\'utilisateur impossible !';
            }
        }

        $utilisateurs = $db->recupererUtilisateurs();

        $title = 'Liste des utilisateurs';
        require_once(CHEMIN_VUES . 'view_template.php');
    }

} ?>
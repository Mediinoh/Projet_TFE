<?php class AdminDetailsAchatController {

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

        $details_achat = $db->recupererDetailsAchat($_GET['achat_id']);

        $title = 'Détails de l\'achat';
        require_once(CHEMIN_VUES . 'view_template.php');
    }

} ?>
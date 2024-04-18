<?php class AdminAchatsUtilisateurController {

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

        $utilisateur_id = $_GET['utilisateur_id'];

        $achats_utilisateur = $db->recupererHistoriqueAchats($utilisateur_id);

        $title = 'Liste des achats';
        require_once(CHEMIN_VUES . 'view_template.php');
    }

} ?>
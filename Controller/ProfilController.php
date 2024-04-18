<?php class ProfilController {

    public function __construct(private $action) {

    }
    
    public function run() {
        if (empty($_SESSION['authentifie'])) {
            header('Location: ?action=login');
            die();
        }
        
        $message = '';

        $db = Db::getInstance();
       
        if (!empty($_POST['profil_button'])) {
            if (empty($_POST['adresse']) || empty($_POST['code_postal']) || empty($_POST['email'])) {
                $message = 'Veuillez entrer une adresse, un code postal et une adresse email !';
            } elseif ($_POST['mot_de_passe'] !== $_POST['confirmation_mot_de_passe']) {
                $message = 'Les mots de passe ne correspondent pas !';
            } else {
                if ($db->modifierProfil($_SESSION['pseudo'], $_POST['adresse'], $_POST['code_postal'], $_POST['email'], $_POST['mot_de_passe'])) {
                    $message = 'Modification du profil réussie !';
                } else {
                    $message = 'Modification du profil ratée !';
                }
            }
        }

        $utilisateur = $db->recupererUtilisateur($_SESSION['pseudo']);
        $title = 'Profil';
        require_once(CHEMIN_VUES . 'view_template.php');
    }

} ?>
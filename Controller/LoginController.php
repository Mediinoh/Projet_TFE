<?php class LoginController {
	
	public function __construct(private $action) {		
	}
	
	public function run() {
		$message = "";
		
		if (!empty($_SESSION['authentifie'])) {
			header('Location: ?action=home');
			die();
		}

		if (!empty($_POST['login_button'])) {
			$db = Db::getInstance();
			if (empty($_POST['pseudo']) && empty($_POST['mot_de_passe'])) {
				$message = 'Veuillez entrer un pseudo et un mot de passe !';
			} elseif (empty($_POST['pseudo'])) {
				$message = 'Veuillez entrer un pseudo !';
			} elseif (empty($_POST['mot_de_passe'])) {
				$message = 'Veuillez entrer un mot de passe !';
			} else {
				if (($utilisateur = $db->connecter($_POST['pseudo'], $_POST['mot_de_passe'])) !== null && $db->ajouterConnexion($utilisateur['id']) !== false) {
					$_SESSION['pseudo'] = $_POST['pseudo'];
					$_SESSION['authentifie'] = true;
					$_SESSION['admin_privilege'] = $utilisateur['admin_privilege'];
					$_SESSION['utilisateur'] = serialize($utilisateur);
					header('Location: ?action=home');
					die();
				} else { 
					$message = 'Identifiant inconnu';
				}
			}
		}

		$title = 'Connexion';
		require_once(CHEMIN_VUES . 'view_template.php');
	}
	
} ?>
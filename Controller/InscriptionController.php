<?php class InscriptionController {
	
	public function __construct(private $action) {		
	}
	
	public function run() {
		$message = "";

		if (!empty($_SESSION['authentifie'])) {
			header('Location: ?action=home');
			die();
		}
		
		var_dump($_POST);
		if (isset($_POST['inscription_button'])) {
            $db = Db::getInstance();
			if(empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['adresse']) || empty($_POST['code_postal']) || empty($_POST['date_naissance']) || empty($_POST['email']) || empty($_POST['pseudo']) || empty($_POST['mot_de_passe']) || empty($_POST['confirmation_mot_de_passe'])) {
				$message = 'Veuillez entrer un nom, un prénom, une adresse, un code postal, une date de naissance, une adresse email, un pseudo et un mot de passe ! Confirmer également ce dernier !';
			} elseif ($_POST['mot_de_passe'] !== $_POST['confirmation_mot_de_passe']) {
				$message = 'Les mots de passe ne correspondent pas !'; 
			} else {
				$photo_profil = null;
				if (isset($_FILES['photo_profil']) && !empty($_FILES['photo_profil']['name'])) {
					$photo_profil = CHEMIN_IMAGES . basename($_FILES['photo_profil']['name']);
					$liste_extensions = array('image/jpeg', 'image/png');
					if (!in_array($_FILES['photo_profil']['type'], $liste_extensions)) {
						$message = 'Le fichier doit être de type jpeg ou png !';
					} else {
						move_uploaded_file($_FILES['photo_profil']['tmp_name'], $photo_profil);
					}
				}
				if (empty($message)) {
					if ($db->inscrire($_POST['nom'], $_POST['prenom'], $_POST['adresse'], $_POST['code_postal'], $_POST['date_naissance'], $_POST['email'], $_POST['pseudo'], $_POST['mot_de_passe'], $photo_profil) === false) {
						$message = 'Inscription incorrecte';
					} else {
						header('Location: ?action=login');
						die();
					}
				}
			}

        }
		
		$title = 'Inscription';
		require_once(CHEMIN_VUES . 'view_template.php');
	}
	
} ?>
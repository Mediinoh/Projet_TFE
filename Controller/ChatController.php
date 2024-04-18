<?php class ChatController {
	
	public function __construct(private $action) {		
	}
	
	public function run() {
		if (empty($_SESSION['authentifie'])) {
			header('Location: ?action=login');
			die();
		}

		$db = Db::getInstance();

		$message_erreur = '';

		$utilisateur = $db->recupererUtilisateur($_SESSION['pseudo']);

		if (!empty($_POST['chat_button'])) {
			if ($db->insererMessage(nl2br($_POST['message']), $utilisateur['id']) === false) {
				$message_erreur = 'Insertion d\'un message dans le chat non effectuée !';
			}
		}

		$messages = $db->recupererMessages();

		$title = 'Chat';
		require_once(CHEMIN_VUES . 'view_template.php');
	}
	
} ?>
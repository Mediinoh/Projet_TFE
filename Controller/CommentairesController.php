<?php class CommentairesController {
	
	public function __construct(private $action) {
	}
	
	public function run() {

        $message = '';
        
        $article_id = $_GET['article_id'];
        $db = Db::getInstance();
             
        if (!empty($_POST['commentaires_button'])) {
            if (empty($_SESSION['pseudo'])) {
                header('Location: ?action=login');
                die();
            }
            $utilisateur = $db->recupererUtilisateur($_SESSION['pseudo']);
            if ($db->insererCommentaire($utilisateur['id'], $article_id, nl2br($_POST['commentaire'])) === false) {
                $message = 'Insertion du commentaire impossible !';
            }
        }

        $commentaires = $db->recupererCommentaires($article_id);

        $title = 'Commentaires';
		require_once(CHEMIN_VUES . 'view_template.php');
	}
	
} ?>
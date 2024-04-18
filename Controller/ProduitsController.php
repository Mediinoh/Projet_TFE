<?php class ProduitsController {
	
	public function __construct(private $action) {
	}
	
	public function run() {

		$message = '';

		$db = Db::getInstance();

		$categorie_id = isset($_GET['categorie_id']) ? $_GET['categorie_id'] : '';
		$mot_cle = isset($_GET['mot_cle']) ? $_GET['mot_cle'] : '';

		if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
        }

		if (isset($_POST['panier_button'])) {
			$article = $db->recupererArticle($_POST['article_id']);
			if (isset($_SESSION['panier'][$article['id']])) {
				$_SESSION['panier'][$article['id']] += $_POST['quantite'];
			} else {
				$_SESSION['panier'][$article['id']] = $_POST['quantite'];
			}
			$message = 'Cet article a été ajouté dans votre panier !';
		}

		$categories = $db->recupererCategories();
		$articles = $db->recupererArticlesParCategorieEtParTitre($categorie_id, $mot_cle);

		$title = 'Liste des produits';
		require_once(CHEMIN_VUES . 'view_template.php');
	}
	
} ?>
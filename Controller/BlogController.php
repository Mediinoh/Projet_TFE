<?php class BlogController {
	
	public function __construct(private $action) {		
	}
	
	public function run() {
		$db = Db::getInstance();
		$articles = $db->recupererArticles();

		$title = 'Blog/News';
		require_once(CHEMIN_VUES . 'view_template.php');
	}
	
} ?>
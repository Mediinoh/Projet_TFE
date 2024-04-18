<?php class HomeController {
	
	public function __construct(private $action) {		
	}
	
	public function run() {

		$title = 'Accueil';
		require_once(CHEMIN_VUES . 'view_template.php');
	}
	
} ?>
<?php class MeilleuresVentesController {
	
	public function __construct(private $action) {		
	}
	
	public function run() {
		$message = '';

		$db = Db::getInstance();

		$meilleures_ventes = $db->recupererMeilleuresVentes();

		$title = 'Meilleures ventes';
		require_once(CHEMIN_VUES . 'view_template.php');
	}
	
} ?>
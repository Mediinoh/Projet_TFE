<?php class NouveautesController {
	
	public function __construct(private $action) {	
	}
	
	public function run() {
		$message = '';

		$db = Db::getInstance();

		$nouveautes = $db->recupererNouveautes();

		$title = 'Nouveautés';
		require_once(CHEMIN_VUES . 'view_template.php');
	}
	
} ?>
<?php class ProposController {
	
	public function __construct(private $action) {		
	}
	
	public function run() {
		
		$title = 'À propos';
		require_once(CHEMIN_VUES . 'view_template.php');
	}
	
} ?>
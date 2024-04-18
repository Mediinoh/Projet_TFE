<?php class LogoutController {
	
	public function __construct(private $action) {		
	}
	
	public function run() {
        $_SESSION = array();
        header('Location: ?action=login');
		die();
	}
	
} ?>
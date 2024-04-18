<?php
    ob_start();
    require_once(CHEMIN_VUES . $this->action . '.php');
    $content = ob_get_clean();
    require_once(CHEMIN_VUES . 'template.php');
?>
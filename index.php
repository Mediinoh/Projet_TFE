<?php

    session_start();

    // date_default_timezone_set('Europe/Brussels');

    define('CHEMIN_VUES','./View/');
    define('CHEMIN_STYLES', CHEMIN_VUES . 'css/');
    define('CHEMIN_SCRIPTS', CHEMIN_VUES . 'js/');
    define('CHEMIN_CONTROLLERS', './Controller/');
    define('CHEMIN_MODELS', './Model/');
    define('CHEMIN_IMAGES', CHEMIN_VUES . 'img/');

    define('NB_MAX_ACHATS', 10);

    function my_autoloader($class) {
        require_once(CHEMIN_MODELS . $class . '.class.php');
    }

    // Enregistrer la fonction d'autoloading
    spl_autoload_register('my_autoloader');

    require_once(CHEMIN_VUES . 'header.php');

    $action = (isset($_GET['action'])) ? htmlspecialchars($_GET['action']) : 'home';
    switch ($action) {
        case 'login':
            require_once(CHEMIN_CONTROLLERS . 'LoginController.php');
            $controller = new LoginController($action);
            break;
        case 'inscription':
            require_once(CHEMIN_CONTROLLERS . 'InscriptionController.php');
            $controller = new InscriptionController($action);
            break;
        case 'logout':
            require_once(CHEMIN_CONTROLLERS . 'LogoutController.php');
            $controller = new LogoutController($action);
            break;
        case 'profil':
            require_once(CHEMIN_CONTROLLERS . 'ProfilController.php');
            $controller = new ProfilController($action);
            break;
        case 'propos':
            require_once(CHEMIN_CONTROLLERS . 'ProposController.php');
            $controller = new ProposController($action);
            break;
        case 'meilleures_ventes':
            require_once(CHEMIN_CONTROLLERS . 'MeilleuresVentesController.php');
            $controller = new MeilleuresVentesController($action);
            break;
        case 'chat':
            require_once(CHEMIN_CONTROLLERS . 'ChatController.php');
            $controller = new ChatController($action);
            break;
        case 'blog':
             require_once(CHEMIN_CONTROLLERS . 'BlogController.php');
             $controller = new BlogController($action);
             break;
        case 'nouveautes':
            require_once(CHEMIN_CONTROLLERS . 'NouveautesController.php');
            $controller = new NouveautesController($action);
            break;
        case 'produits':
            require_once(CHEMIN_CONTROLLERS . 'ProduitsController.php');
            $controller = new ProduitsController($action);
            break;
        case 'commentaires':
            require_once(CHEMIN_CONTROLLERS . 'CommentairesController.php');
             $controller = new CommentairesController($action);
             break;
        case 'admin_utilisateurs':
            require_once(CHEMIN_CONTROLLERS . 'AdminUtilisateursController.php');
            $controller = new AdminUtilisateursController($action);
            break;
        case 'admin_commentaires_utilisateur':
            require_once(CHEMIN_CONTROLLERS . 'AdminCommentairesUtilisateurController.php');
            $controller = new AdminCommentairesUtilisateurController($action);
            break;
        case 'admin_achats_utilisateur':
            require_once(CHEMIN_CONTROLLERS . 'AdminAchatsUtilisateurController.php');
            $controller = new AdminAchatsUtilisateurController($action);
            break;
        case 'admin_articles':
            require_once(CHEMIN_CONTROLLERS . 'AdminArticlesController.php');
            $controller = new AdminArticlesController($action);
            break;
        case 'admin_categories':
            require_once(CHEMIN_CONTROLLERS . 'AdminCategoriesController.php');
            $controller = new AdminCategoriesController($action);
            break;
        case 'admin_details_achat':
            require_once(CHEMIN_CONTROLLERS . 'AdminDetailsAchatController.php');
            $controller = new AdminDetailsAchatController($action);
            break;
        case 'panier':
            require_once(CHEMIN_CONTROLLERS . 'PanierController.php');
            $controller = new PanierController($action);
            break;
        case 'home':
        default:
            $action = 'home';
            require_once(CHEMIN_CONTROLLERS . 'HomeController.php');
            $controller = new HomeController($action);
            break;
    }
    $controller->run();
    
    require_once(CHEMIN_VUES . 'footer.php');

?>
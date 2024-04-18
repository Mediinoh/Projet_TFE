<?php class PanierController {

    public function __construct(private $action) {

    }

    public function run() {
        if (empty($_SESSION['authentifie'])) {
            header('Location: ?action=login');
            die();
        }
        
        $message = '';

        $db = Db::getInstance();

        $utilisateurConnecte = $db->recupererUtilisateur($_SESSION['pseudo']);

        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }

        if (isset($_POST['suppression_button'])) {
            unset($_SESSION['panier'][$_POST['article_id']]);
        }

        if (isset($_POST['payer_button'])) {
            $date_achat = date('Y-m-d H:i:s');
            $total = 0;
            $ligne_commandes = [];
            foreach($_SESSION['panier'] as $article_id => $quantite) {
                $article = $db->recupererArticle($article_id);
                $prix_total_article = floatval($article['prix_unitaire'] * $quantite);
                $ligne_commandes[] = ['utilisateur_id' => $utilisateurConnecte['id'],
                                            'article_id' => $article_id,
                                            'quantite' => $quantite,
                                            'prix' => $prix_total_article
                                        ];
                $total += $prix_total_article;
            }
            if (($panier_id = $db->insererPanier($utilisateurConnecte['id'], $date_achat, $total)) === false) {
                $message = 'L\'insertion du panier a échouée !';
            } else {
                foreach($ligne_commandes as $ligne_commande) {
                    if ($db->insererLigneCommande($panier_id, $ligne_commande['article_id'], $ligne_commande['quantite'], $ligne_commande['prix']) === false) {
                        $message = 'L\insertion de la ligne de commande a échouée !';
                        break;
                    }
                }
                if ($db->insererHistoriqueAchat($utilisateurConnecte['id'], $date_achat, $total, $panier_id) === false) {
                    $message = 'L\'insertion de l\'historique d\'achats a échouée !';
                } else {
                    $_SESSION['panier'] = [];
                }
            }
        }

        $title = 'Mon panier';
        require_once(CHEMIN_VUES . 'view_template.php');
    }

} ?>
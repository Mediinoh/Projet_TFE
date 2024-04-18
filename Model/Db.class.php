<?php class Db {
	
	private $_db;
	private static $instance = null;
	
	private function __construct() {
		try {
			$this->_db = new PDO('mysql:host=localhost;dbname=MehdiShop;charset=utf8', 'root', '');
			$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			die('Erreur de connexion à la base de données : ' . $e->getMessage());
		}
	}

	public static function getInstance() {
		if (is_null(self::$instance)) {
			self::$instance = new Db();
		}
		return self::$instance;
	}

	
	public function inscrire($nom, $prenom, $adresse, $code_postal, $date_naissance, $email, $pseudo, $mot_de_passe, $photo_profil) {
		$query = 'INSERT INTO utilisateurs (nom, prenom, adresse, code_postal, date_naissance, email, pseudo, mot_de_passe, photo_profil) VALUES(:nom, :prenom, :adresse, :code_postal, :date_naissance, :email, :pseudo, :mot_de_passe, :photo_profil);';
		// Prépare la requête d'insertion
		$result = $this->_db->prepare($query);
		$result->bindValue(':nom', $nom);
		$result->bindValue(':prenom', $prenom);
		$result->bindValue(':adresse', $adresse);
		$result->bindValue(':code_postal', $code_postal);
		$result->bindValue(':date_naissance', $date_naissance);
		$result->bindValue(':email', $email);
		$result->bindValue(':pseudo', $pseudo);
		$result->bindValue(':mot_de_passe', password_hash($mot_de_passe, PASSWORD_BCRYPT));
		$result->bindValue(':photo_profil', $photo_profil, PDO::PARAM_STR);
		// Exécute la requête d'insertion
		$result->execute();
		// Vérifie si l'insertion a réussi
		if ($result) {
			// Retourne l'ID de l'utilisateur nouvellement inscrit
			return $this->_db->lastInsertId();
		}
		// Retourne false en cas d'échec
		return false;
	}

	public function connecter($pseudo, $mot_de_passe) {
		$query = 'SELECT u.* FROM utilisateurs u WHERE u.pseudo = :pseudo;';
		$result = $this->_db->prepare($query);
		$result->bindValue(':pseudo', $pseudo);
		$result->execute();
		if ($result->rowCount() == 1) {
			// Récupère les données de l'utilisateur
			$utilisateur = $result->fetch();
			if (password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
				return $utilisateur;
			}
		}
		// Aucune correspondance ou mot de passe incorrect, retourne null
		return null;
	}

	public function recupererUtilisateurs() {
		$query = 'SELECT u.* FROM utilisateurs u;';
		$result = $this->_db->prepare($query);
		$result->execute();
		return $result->fetchAll();
	}

	public function recupererUtilisateur($pseudo) {
		$query = 'SELECT * FROM utilisateurs u WHERE u.pseudo = :pseudo;';
		$result = $this->_db->prepare($query);
		$result->bindValue(':pseudo', $pseudo);
		$result->execute();
		if ($result->rowCount() == 1) {
			// Récupère les données de l'utilisateur
			return $result->fetch();
		}
		// Aucune correspondance ou mot de passe incorrect, retourne null
		return null;
	}

	public function recupererArticles() {
		$query = 'SELECT a.*, c.nom_categorie FROM articles a, categories c WHERE c.id = a.categorie_id;';
		$result = $this->_db->prepare($query);
		$result->execute();
		return $result->fetchAll();
	}

	public function recupererNouveautes() {
		$query = 'SELECT a.*, c.nom_categorie FROM articles a, categories c WHERE c.id = a.categorie_id ORDER BY a.id DESC LIMIT 15;';
		$result = $this->_db->prepare($query);
		$result->execute();
		return $result->fetchAll();
	}

	public function recupererMeilleuresVentes() {
		$query = 'SELECT a.*, c.nom_categorie, SUM(lc.quantite) AS total_ventes FROM articles a
					LEFT JOIN categories c on a.categorie_id = c.id
					LEFT JOIN ligne_commandes lc ON a.id = lc.article_id
					LEFT JOIN paniers p ON lc.panier_id = p.id
					LEFT JOIN historique_achats ha ON ha.panier_id = p.id
					GROUP BY a.id, a.titre, a.prix_unitaire, a.description, a.categorie_id, a.photo_article
					HAVING total_ventes >= 5
					ORDER BY total_ventes DESC;';
		$result = $this->_db->prepare($query);
		$result->execute();
		return $result->fetchAll();
	}

	public function recupererArticle($article_id) {
		$query = 'SELECT a.*, c.nom_categorie FROM articles a, categories c WHERE c.id = a.categorie_id AND a.id = :article_id;';
		$result = $this->_db->prepare($query);
		$result->bindValue(':article_id', $article_id);
		$result->execute();
		$article = null;
		if ($result->rowCount() === 1) {
			$article = $result->fetch();
		}
		return $article;
	}

	public function insererArticle($titre, $prix_unitaire, $description, $categorie_id, $photo_article) {
		$query = 'INSERT INTO articles VALUES (DEFAULT, :titre, :prix_unitaire, :description, :categorie_id, :photo_article);';
		$result = $this->_db->prepare($query);
		$result->bindValue(':titre', $titre);
		$result->bindValue(':prix_unitaire', $prix_unitaire);
		$result->bindValue(':description', $description);
		$result->bindValue(':categorie_id', $categorie_id);
		$result->bindValue(':photo_article', $photo_article);
		$result->execute();
		return $this->_db->lastInsertId();
	}

	public function recupererCommentaires($article_id) {
		$query = 'SELECT c.*, u.pseudo FROM commentaires c, utilisateurs u WHERE c.utilisateur_id = u.id AND c.article_id = :article_id;';
		$result = $this->_db->prepare($query);
		$result->bindValue(':article_id', $article_id);
		$result->execute();
		return $result->fetchAll();
	}

	public function recupererCommentairesUtilisateur($utilisateur_id) {
		$query = 'SELECT c.*, a.photo_article, a.titre FROM commentaires c, articles a WHERE c.article_id = a.id AND c.utilisateur_id = :utilisateur_id LIMIT 5;';
		$result = $this->_db->prepare($query);
		$result->bindValue(':utilisateur_id', $utilisateur_id);
		$result->execute();
		return $result->fetchAll();
	}

	public function insererCommentaire($utilisateur_id, $article_id, $commentaire) {
		$query = 'INSERT INTO commentaires VALUES (DEFAULT, :utilisateur_id, :article_id, :commentaire, DEFAULT);';
		$result = $this->_db->prepare($query);
		$result->bindValue(':utilisateur_id', $utilisateur_id);
		$result->bindValue(':article_id', $article_id);
		$result->bindValue(':commentaire', $commentaire);
		$result->execute();
		return $this->_db->lastInsertId();
	} 

	public function recupererMessages() {
		$query = 'SELECT m.*, u.pseudo FROM messages m, utilisateurs u WHERE m.utilisateur_id = u.id ORDER BY m.date_message DESC LIMIT 10;';
		$result = $this->_db->prepare($query);
		$result->execute();
		return $result->fetchAll();
	}

	public function insererMessage($message, $utilisateur_id) {
		var_dump($message, $utilisateur_id);
		$query = 'INSERT INTO messages VALUES (DEFAULT, :message, DEFAULT, :utilisateur_id);';
		$result = $this->_db->prepare($query);
		$result->bindValue(':message', $message);
		$result->bindValue(':utilisateur_id', $utilisateur_id);
		$result->execute();
		return $this->_db->lastInsertId();
	}

	public function recupererCategories() {
		$query = 'SELECT c.* FROM categories c;';
		$result = $this->_db->prepare($query);
		$result->execute();
		return $result->fetchAll();
	}

	public function insererCategorie($nom_categorie) {
		$query = 'INSERT INTO categories VALUES (DEFAULT, :nom_categorie);';
		$result = $this->_db->prepare($query);
		$result->bindValue(':nom_categorie', $nom_categorie);
		$result->execute();
		return $this->_db->lastInsertId();
	}

	public function recupererCategorie($nom_categorie) {
		$query = 'SELECT c.* FROM categories c WHERE c.nom_categorie = :nom_categorie;';
		$result = $this->_db->prepare($query);
		$result->bindValue(':nom_categorie', $nom_categorie);
		$result->execute();
		$categorie = null;
		if ($result->rowCount() == 1) {
			$categorie = $result->fetch();
		}
		return $categorie;
	}

	public function recupererArticlesParCategorie($categorie_id) {
		$query = 'SELECT a.*, c.nom_categorie FROM articles a, categories c WHERE a.categorie_id = c.id';
		if (!empty($categorie_id)) {
			$query .= ' AND a.categorie_id = :categorie_id';
		}
		$query .= ' ORDER BY a.categorie_id;';
		$result = $this->_db->prepare($query);
		if (!empty($categorie_id)) {
			$result->bindValue(':categorie_id', $categorie_id);
		}
		$result->execute();
		return $result->fetchAll();
	}

	public function rechercherArticlesParTitre($mot_cle) {
		$query = 'SELECT a.*, c.nom_categorie FROM articles a, categories c WHERE a.titre LIKE :mot_cle AND c.id = a.categorie_id = c.id ORDER BY c.categorie_id;';
		$result = $this->_db->prepare($query);
		$result->bindValue(':mot_cle', '%' . $mot_cle . '%', PDO::PARAM_STR);
		$result->execute();
		return $result->fetchAll();
	}

	public function recupererArticlesParCategorieEtParTitre($categorie_id, $mot_cle) {
		$query = 'SELECT a.*, c.nom_categorie FROM articles a, categories c WHERE a.titre LIKE :mot_cle AND a.categorie_id = c.id AND a.supprime = 0';
		if (!empty($categorie_id)) {
			$query .= ' AND a.categorie_id = :categorie_id';
		}
		$query .= ' ORDER BY a.categorie_id;';
		$result = $this->_db->prepare($query);
		$result->bindValue(':mot_cle', '%' . $mot_cle . '%', PDO::PARAM_STR);
		if (!empty($categorie_id)) {
			$result->bindValue(':categorie_id', $categorie_id);
		}
		$result->execute();
		return $result->fetchAll();
	}

	public function supprimerArticle($article_id) {
		$query = 'UPDATE articles a SET a.supprime = 1 WHERE a.id = :article_id;';
		$result = $this->_db->prepare($query);
		$result->bindValue(':article_id', $article_id);
		return $result->execute();
	}

	public function  recupererNbConnexions($utilisateur_id, $week = false) {
		$query = 'SELECT COUNT(*) AS "Nombre de connexions" FROM historique_connexions hc WHERE ';
		if (!$week) {
			$query .= 'DATE(hc.date_connexion) = CURRENT_DATE()';
		} else {
			$query .= 'DATEDIFF(CURDATE(), DATE(hc.date_connexion)) <= 7';
		}
		$query .= ' AND hc.utilisateur_id = :utilisateur_id;';
		$result = $this->_db->prepare($query);
		$result->bindValue(':utilisateur_id', $utilisateur_id);
		$result->execute();
		return $result->fetch();
	}

	public function ajouterConnexion($utilisateur_id) {
		$query = 'INSERT INTO historique_connexions VALUES (DEFAULT, :utilisateur_id, DEFAULT);';
		$result = $this->_db->prepare($query);
		$result->bindValue(':utilisateur_id', $utilisateur_id);
		$result->execute();
		return $this->_db->lastInsertId();
	}

	public function modifierProfil($pseudo, $adresse, $code_postal, $email, $mot_de_passe = '') {
		$query = 'UPDATE utilisateurs u SET u.adresse = :adresse, u.code_postal = :code_postal, u.email = :email';
		if (!empty($mot_de_passe)) {
			$query .= ', u.mot_de_passe = :mot_de_passe';
		}
		$query .= ' WHERE u.pseudo = :pseudo;';
		$result = $this->_db->prepare($query);
		$result->bindValue(':pseudo', $pseudo);
		$result->bindValue(':adresse', $adresse);
		$result->bindValue(':code_postal', $code_postal);
		$result->bindValue(':email', $email);
		if (!empty($mot_de_passe)) {
			$result->bindValue(':mot_de_passe', $mot_de_passe);
		}
		return $result->execute();
	}

	public function changerBloqueUtilisateur($utilisateur_id, $bloque) {
		$query = 'UPDATE utilisateurs u SET u.bloque = :bloque WHERE u.id = :utilisateur_id;';
		$result = $this->_db->prepare($query);
		$result->bindValue(':utilisateur_id', $utilisateur_id);
		$result->bindValue(':bloque', $bloque, PDO::PARAM_INT);
		return $result->execute();
	}

	public function recupererHistoriqueAchats($utilisateur_id) {
		$query = 'SELECT ha.*, u.pseudo FROM historique_achats ha, utilisateurs u WHERE ha.utilisateur_id = u.id AND ha.utilisateur_id = :utilisateur_id;';
		$result = $this->_db->prepare($query);
		$result->bindValue(':utilisateur_id', $utilisateur_id);
		$result->execute();
		return $result->fetchAll();
	}

	public function insererPanier($utilisateur_id, $date_achat, $montant_total) {
		$query = 'INSERT INTO paniers VALUES (DEFAULT, :utilisateur_id, :date_achat, :montant_total);';
		$result = $this->_db->prepare($query);
		$result->bindValue(':utilisateur_id', $utilisateur_id);
		$result->bindValue(':date_achat', $date_achat);
		$result->bindValue(':montant_total', $montant_total);
		$result->execute();
		return $this->_db->lastInsertId();
	}

	public function insererLigneCommande($panier_id, $article_id, $quantite, $prix) {
		$query = 'INSERT INTO ligne_commandes VALUES (DEFAULT, :panier_id, :article_id, :quantite, :prix);';
		$result = $this->_db->prepare($query);
		$result->bindValue(':panier_id', $panier_id);
		$result->bindValue(':article_id', $article_id);
		$result->bindValue(':quantite', $quantite);
		$result->bindValue(':prix', $prix);
		$result->execute();
		return $this->_db->lastInsertId();
	}

	public function insererHistoriqueAchat($utilisateur_id, $date_achat, $montant_total, $panier_id) {
		$query = 'INSERT INTO historique_achats VALUES (DEFAULT, :utilisateur_id, :date_achat, :montant_total, :panier_id);';
		$result = $this->_db->prepare($query);
		$result->bindValue(':utilisateur_id', $utilisateur_id);
		$result->bindValue(':date_achat', $date_achat);
		$result->bindValue(':montant_total', $montant_total);
		$result->bindValue(':panier_id', $panier_id);
		$result->execute();
		return $this->_db->lastInsertId();
	}

	public function recupererDetailsAchat($achat_id) {
		$query = 'SELECT a.photo_article, a.titre, lc.quantite, lc.prix FROM articles a, ligne_commandes lc, historique_achats ha, paniers p
					WHERE a.id = lc.article_id AND lc.panier_id = p.id AND p.id = ha.panier_id AND ha.id = :achat_id;';
		$result = $this->_db->prepare($query);
		$result->bindValue(':achat_id', $achat_id);
		$result->execute();
		return $result->fetchAll();
	}

} ?>
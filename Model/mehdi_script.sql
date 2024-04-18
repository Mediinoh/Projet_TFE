DROP DATABASE IF EXISTS `mehdishop`;
CREATE DATABASE IF NOT EXISTS `mehdishop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mehdishop`;

CREATE TABLE IF NOT EXISTS utilisateurs
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    code_postal VARCHAR(10) NOT NULL,
    email VARCHAR(255) NOT NULL,
    date_naissance DATE NOT NULL,
    pseudo VARCHAR(50) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    photo_profil VARCHAR(255),
    bloque TINYINT(1) DEFAULT 0 NOT NULL,
    admin_privilege TINYINT(1) DEFAULT 0 NOT NULL
);

CREATE TABLE IF NOT EXISTS historique_connexions
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    date_connexion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs (id)
);

CREATE TABLE IF NOT EXISTS messages
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    message TEXT NOT NULL,
    date_message TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    utilisateur_id INT NOT NULL,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs (id)
);

CREATE TABLE IF NOT EXISTS paniers
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    date_achat TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    montant_total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs (id)
);

CREATE TABLE IF NOT EXISTS historique_achats
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    date_achat TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    montant_total DECIMAL(10, 2) NOT NULL,
    panier_id INT NOT NULL,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs (id),
    FOREIGN KEY (panier_id) REFERENCES paniers (id)
);

CREATE TABLE IF NOT EXISTS categories
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE IF NOT EXISTS articles
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    prix_unitaire DECIMAL(10, 2) NOT NULL,
    description TEXT,
    categorie_id INT NOT NULL,
    photo_article VARCHAR(255),
    supprime TINYINT(1) NOT NULL DEFAULT 0,
    FOREIGN KEY (categorie_id) REFERENCES categories (id)
);

CREATE TABLE IF NOT EXISTS commentaires
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    article_id INT NOT NULL,
    commentaire TEXT NOT NULL,
    date_commentaire TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs (id),
    FOREIGN KEY (article_id) REFERENCES articles (id)
);

CREATE TABLE IF NOT EXISTS ligne_commandes
(
    num_ligne INT AUTO_INCREMENT PRIMARY KEY,
    panier_id INT NOT NULL,
    article_id INT NOT NULL,
    quantite INT NOT NULL,
    prix DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (panier_id) REFERENCES paniers (id),
    FOREIGN KEY (article_id) REFERENCES articles (id)
);

INSERT INTO categories (nom_categorie) VALUES
('informatique'),
('livre'),
('hi-fi'),
('Ordinateur'),
('Téléphone'),
('Accessoire'),
('Jeux'),
('Console');

INSERT INTO articles (titre, prix_unitaire, description, categorie_id, photo_article) VALUES
('Illusions perdues', 12.75, 'Livre intitulée \"Illusions perdues\" de Honoré de Balzac', 2, './View/img/41pqcmRAH1L._SL500_.jpg'),
('Ordinateur portable HP', 599.00, 'Ordinateur Portable HP Laptop 15S-FQ5045NB 15.6\'\' Intel Core i5 8 Go DDR4 512 Go SSD', 4, './View/img/HP-LAPTOP-15S-FQ5045NB-15-6-512-8-I5-1235U-INTEGRATED.jpg'),
('MICROSYSTÈME HI-FI', 250.00, 'MICROSYSTÈME HI-FI\r\nXL-B517D(BK)', 3, './View/img/microsysteme-hi-fi.jpeg'),
('Casque Sans fil Steelplay', 29.99, 'Steelplay Impulse Camo Bluetooth pour PS4/PS5', 6, './View/img/Casque-sans-fil-Steelplay-Impulse-Camo-Bluetooth-pour-PS5-PS4-Xbox-Series-XS-Xbox-One-Nintendo-Switch-PC-ordinateur-portable-et-Mac-Noir-et-Blanc.jpg'),
('Casque filaire Xbox', 19.99, 'Casque gaming filaire Xbox',6, './View/img/Casque-Gaming-Filaire-Xbox.jpg'),
('Nitendo Switch ', 299.99, 'Console de jeu vidéo Nitendo Switch', 8, './View/img/téléchargement.jpg'),
('HP Laptop Zbook', 789.89, 'HP Zbook 16 GB de ram SSD 512 GB ', 4, './View/img/HP-LAPTOP-15S-FQ5045NB-15-6-512-8-I5-1235U-INTEGRATED.jpg'),
('Jeux PC Minecraft', 28.78, 'Jeu PC Minecraft licence.', 7, './View/img/images (1).jpg'),
('Pack pc gaming', 580.00, 'Pack pc gaming complet avec clavier et souris', 1, './View/img/images (2).jpg'),
('jeux vidéo XBOX 360', 35.89, 'Jeux XBOX ', 7, './View/img/images (4).jpg'),
('Fifa 23 Xbox One', 38.99, 'Jeux pour Xbox One Fifa 23', 7, './View/img/images (3).jpg'),
('Station d\'acceuil USB', 68.99, 'Docking Station HP', 6, './View/img/images.jpg'),
('Manette Xbox', 69.98, 'Manette Xbox', 6, './View/img/Manette-sans-fil-Microsoft-Xbox-Noir.jpg'),
('Xbox Manette lite', 48.75, 'Manette XBOX Lite exclu Med-Shop ', 6, './View/img/Manette-Xbox-sans-fil-Elite-Series-2-Noir.jpg'),
('Chargeur USB', 15.99, 'Chargeur USB-c', 6, './View/img/téléchargement (1).jpg'),
('Chargeur iPhone', 19.99, 'Chargeur iPhone original', 6, './View/img/téléchargement (2).jpg'),
('Docking Station Dell', 89.65, 'Docking station de marque DELL', 6, './View/img/téléchargement (3).jpg'),
('Jeux PS4', 39.99, 'FC24 pour PS4', 7, './View/img/téléchargement (13).jpg'),
('Tomb Raider', 49.50, 'Jeux PS4 tomb raider', 7, './View/img/téléchargement (14).jpg'),
('Ecran gaming AOC ', 139.00, 'Ecran 27\' AOC', 4, './View/img/téléchargement (17).jpg'),
('Ecran gaming TUF', 119.00, 'Ecran 27\' TUF', 4, './View/img/téléchargement (18).jpg'),
('Ecran Gaming MSI', 149.00, 'Ecran gaming MSI curved 27\' (240 fps)', 4, './View/img/téléchargement (19).jpg'),
('Livre \"Pourquoi j\'ai mangé mon père\"', 9.99, 'Livre de Roy Lewis', 2, './View/img/téléchargement (22).jpg'),
('Livre \"Survivre avec mon père\"', 8.99, 'Livre de Eva Ruth', 2, './View/img/téléchargement (21).jpg'),
('Livre \" Pablo Escobar mon père\"', 12.99, 'Livre de Juan Pablo Escobar', 2, './View/img/images (5).jpg'),
('Ecran HP 32\"', 285.00, 'Ecran curved de 32 pouces HP', 4, './View/img/téléchargement (20).jpg'),
('Jeux PS4 \"CyberPunk\"', 26.98, 'Jeux CyberPunk PS4', 7, './View/img/téléchargement (15).jpg');

-- mot de passe admin : admin
INSERT INTO utilisateurs (nom, prenom, adresse, code_postal, email, date_naissance, pseudo, mot_de_passe, photo_profil, bloque, admin_privilege) VALUES
('Admin', 'Admin', 'Admin', 'Admin', 'admin@admin.admin', '2005-02-20', 'admin', '$2y$10$nYK2TmnIBvsPIQ9.jLxINeJWytTUK0JapBm6xiMt..dX.0EvmBN2y', NULL, 0, 1);

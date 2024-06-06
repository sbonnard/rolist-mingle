-- DATABASE

CREATE DATABASE rolist_mingle;


-- TABLES

CREATE TABLE localisation (
    id_localisation SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name_localisation VARCHAR(100) NOT NULL,
    PRIMARY KEY (id_localisation)
);

CREATE TABLE chat (
    id_chat SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    txt_chat VARCHAR(255),
    name_contact VARCHAR(30) NOT NULL,
    date_chat DATETIME NOT NULL,
    id_user SMALLINT UNSIGNED NOT NULL,
    PRIMARY KEY (id_chat),
    FOREIGN KEY (id_user) REFERENCES users(id_user) -- Contact
);

CREATE TABLE infos (
    id_infos SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name_infos VARCHAR(100) NOT NULL,
    description_infos VARCHAR(255) NOT NULL,
    image_infos VARBINARY NOT NULL,
    PRIMARY KEY (id_infos)
);

CREATE TABLE larp_type (
    id_larp_type SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name_larp_type VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_larp_type)
);

CREATE TABLE role_type (
    id_role_type SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name_role VARCHAR(50) NOT NULL,
    icone_role VARBINARY NOT NULL,
    PRIMARY KEY (id_role_type)
);

CREATE TABLE universe_genre (
    id_universe_genre SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    genre VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_universe_genre)
);

CREATE TABLE universe (
    id_universe SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name_universe VARCHAR(100) NOT NULL,
    id_universe_genre SMALLINT UNSIGNED NOT NULL,
    PRIMARY KEY (id_universe),
    FOREIGN KEY (id_universe_genre) REFERENCES universe_genre(id_universe_genre)
);

CREATE TABLE users (
    id_user SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name_user VARCHAR(30) NOT NULL,
    email_user VARCHAR(50) NOT NULL,
    admin_user BOOLEAN DEFAULT NULL,
    id_role_type SMALLINT UNSIGNED NOT NULL,
    id_localisation SMALLINT UNSIGNED NOT NULL,
    PRIMARY KEY (id_user),
    FOREIGN KEY (id_role_type) REFERENCES role_type(id_role_type),
    FOREIGN KEY (id_localisation) REFERENCES localisation(id_localisation)
);

CREATE TABLE party (
    id_party SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    number_players SMALLINT UNSIGNED NOT NULL,
    id_infos SMALLINT UNSIGNED NOT NULL,
    id_role_type SMALLINT UNSIGNED NOT NULL,
    id_localisation SMALLINT UNSIGNED NOT NULL,
    id_user SMALLINT UNSIGNED NOT NULL, -- GAME_MASTER
    id_universe SMALLINT UNSIGNED NOT NULL,
    PRIMARY KEY (id_party),
    FOREIGN KEY (id_infos) REFERENCES infos(id_infos),
    FOREIGN KEY (id_role_type) REFERENCES role_type(id_role_type),
    FOREIGN KEY (id_localisation) REFERENCES localisation(id_localisation),
    FOREIGN KEY (id_user) REFERENCES users(id_user), -- GAME_MASTER
    FOREIGN KEY (id_universe) REFERENCES universe(id_universe)
);

CREATE TABLE larp (
    id_larp SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    date_start DATE NOT NULL,
    date_end DATE NOT NULL,
    id_infos SMALLINT UNSIGNED NOT NULL,
    id_universe SMALLINT UNSIGNED NOT NULL,
    id_localisation SMALLINT UNSIGNED NOT NULL,
    id_larp_type SMALLINT UNSIGNED NOT NULL,
    PRIMARY KEY (id_larp),
    FOREIGN KEY (id_infos) REFERENCES infos(id_infos),
    FOREIGN KEY (id_universe) REFERENCES universe(id_universe),
    FOREIGN KEY (id_localisation) REFERENCES localisation(id_localisation),
    FOREIGN KEY (id_larp_type) REFERENCES larp_type(id_larp_type)
);

CREATE TABLE selected_universe (
    id_universe SMALLINT UNSIGNED NOT NULL,
    id_user SMALLINT UNSIGNED NOT NULL,
    FOREIGN KEY (id_universe) REFERENCES universe(id_universe),
    FOREIGN KEY (id_user) REFERENCES users(id_user)
);

CREATE TABLE block (
    id_user SMALLINT UNSIGNED NOT NULL, -- Blocked
    FOREIGN KEY (id_user) REFERENCES users(id_user),
);

CREATE TABLE friend (
    id_user SMALLINT UNSIGNED NOT NULL, -- User A
    FOREIGN KEY (id_user) REFERENCES users(id_user)
);

-- INSERT INTO

-- larp_type

INSERT INTO larp_type (name_larp_type)
VALUES ("Mass LARP");

INSERT INTO larp_type (name_larp_type)
VALUES ("Small LARP");

INSERT INTO larp_type (name_larp_type)
VALUES ("Private LARP");

-- role_type

INSERT INTO role_type (name_role)
VALUES ("MAÎTRE DU JEU | Dé 100");

INSERT INTO role_type (name_role)
VALUES ("SÉRIEUX | Dé 20");

INSERT INTO role_type (name_role)
VALUES ("RÉGULIER | Dé 12");

INSERT INTO role_type (name_role)
VALUES ("AFFINITÉ | Dé 8");

INSERT INTO role_type (name_role)
VALUES ("ONE-SHOT | Dé 4");


-- universe_genre

INSERT INTO universe_genre (genre)
VALUES ("Medieval Fantasy"),
("Post-Apocalyptique"),
("Horreur"),
("Western"),
("Science-Fiction"),
("Space Opera"),
("Steampunk"),
("Historique"),
("Mythologique"),
("Humoristique"),
("Cyberpunk"),
("Historique/Fantastique"),
("Gothique/punk"),
("Pirate"),
("Action"),
("Absurde"),
("Historico-fantastique");

-- universe

INSERT INTO universe (name_universe, id_universe_genre)
VALUES 
("Medieval Fantasy", 1),
("Post-Apocalyptique", 2),
("Horreur", 3),
("Western", 4),
("Science-Fiction", 5),
("Space Opera", 6),
("Steampunk", 7),
("Historique", 8),
("Mythologique", 9),
("L'Oeil noir, le livre des règles", 1),
("Donjons et Dragons 1", 1),
("Donjons et Dragons 2", 1),
("Donjons et Dragons 3", 1),
("Donjons et Dragons 4", 1),
("Donjons et Dragons 5", 1),
("JDR personnalisé", 1),
("Star Wars D6", 5),
("Star Wars D20", 5),
("Star Wars FFG", 5),
("Star Wars aux confins de l'empire", 5),
("Runequest", 1),
("L'Appel de Cthulhu : 6ème Édition", 3),
("Achtung! Cthulhu: le guide de l'investigateur", 3),
("In Nomine Satanis / Magna Veritas - 3ème Édition", 10),
("Shadowrun", 11),
("Warhammer", 1),
("Warhammer 40K", 5),
("Paranoïa", 5),
("Pendragon (1985)", 12),
("Vampire : La Mascarade", 13),
("Stormbringer (1981)", 1),
("C.O.P.S.", 11),
("Rêve de Dragon", 1),
("Pavillon Noir : La Révolte", 14),
("Animonde", 1),
("Ars Magica", 1),
("Château Falkenstein", 7),
("Château Bitume", 2),
("Feng Shui", 15),
("Dark Heresy", 5),
("Ambre", 1),
("La méthode du docteur Chestel", 16),
("Maléfices", 17),
("Cyberpunk 2020", 11),
("Terres du Milieu", 1)
;
CREATE DATABASE rolist_mingle;

CREATE TABLE localisation (
    id_localisation SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name_localisation VARCHAR(100) NOT NULL,
    PRIMARY KEY (id_localisation)
);

CREATE TABLE chat (
    id_chat SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    message VARCHAR(255),
    name_contact VARCHAR(30) NOT NULL,
    date_message DATETIME NOT NULL,
    PRIMARY KEY (id_chat)
);

CREATE TABLE infos (
    id_infos SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name_infos VARCHAR(100) NOT NULL,
    description_infos VARCHAR(255) NOT NULL,
    image_infos IMAGE,
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
    icone_role IMAGE NOT NULL,
    PRIMARY KEY (id_role_type)
);

CREATE TABLE universe (
    id_universe SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name_universe VARCHAR(100) NOT NULL,
    PRIMARY KEY (id_universe)
);

CREATE TABLE user (
    id_user SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name_user VARCHAR(30) NOT NULL,
    email_user VARCHAR(50) NOT NULL,
    admin_user BOOLEAN DEFAULT false,
    id_role_type SMALLINT UNSIGNED NOT NULL,
    id_localisation SMALLINT UNSIGNED NOT NULL,
    PRIMARY KEY (id_user),
    FOREIGN KEY (id_role_type) REFERENCES role_type(id_role_type),
    FOREIGN KEY (id_localisation) REFERENCES localisation(id_localisation)
);

CREATE TABLE party (
    id_party SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    number_players SMALLINT UNSIGNED NOT NULL,
    game_master BOOLEAN DEFAULT false,
    id_infos SMALLINT UNSIGNED NOT NULL,
    id_role_type SMALLINT UNSIGNED NOT NULL,
    id_localisation SMALLINT UNSIGNED NOT NULL,
    id_user SMALLINT UNSIGNED NOT NULL, -- GAME_MASTER
    id_universe SMALLINT UNSIGNED NOT NULL,
    id_user SMALLINT UNSIGNED NOT NULL, -- PARTY_CREATOR
    PRIMARY KEY (id_party),
    FOREIGN KEY (id_infos) REFERENCES infos(id_infos),
    FOREIGN KEY (id_role_type) REFERENCES role_type(id_role_type),
    FOREIGN KEY (id_localisation) REFERENCES localisation(id_localisation),
    FOREIGN KEY (id_user) REFERENCES id_user(id_user), -- GAME_MASTER
    FOREIGN KEY (id_universe) REFERENCES id_universe(id_universe),
    FOREIGN KEY (id_user) REFERENCES id_user(id_user), -- PARTY_CREATOR
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
    FOREIGN KEY (id_universe) REFERENCES id_universe(id_universe),
    FOREIGN KEY (id_localisation) REFERENCES localisation(id_localisation),
    FOREIGN KEY (id_larp_type) REFERENCES laid_larp_type(id_larp_type)
);
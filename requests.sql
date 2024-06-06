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
)
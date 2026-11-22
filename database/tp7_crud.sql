CREATE DATABASE IF NOT EXISTS tp7_crud;
USE tp7_crud;
DROP TABLE IF EXISTS module;
DROP TABLE IF EXISTS Etudiant;
DROP TABLE IF EXISTS formation;
CREATE TABLE formation(
    id_formation INT AUTO_INCREMENT PRIMARY KEY,
    nom_formation VARCHAR(50) NOT NULL,
    duree INT NOT NULL
)ENGINE=InnoDB;

CREATE TABLE Etudiant(
    id_etudiant INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50),
    email VARCHAR(70) NOT NULL,
    id_formation INT NOT NULL,
    FOREIGN KEY(id_formation) REFERENCES formation(id_formation)
)ENGINE=InnoDB;

CREATE TABLE module(
    id_module INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(100) NOT NULL,
    horaire INT NOT NULL,
    id_formation INT NOT NULL,
    FOREIGN KEY(id_formation) REFERENCES formation(id_formation)
)ENGINE=InnoDB;

INSERT INTO formation(nom_formation,duree) VALUES 
('Développement Web', 12),
('Réseaux et Systèmes', 10),
('Data Science', 14);

INSERT INTO Etudiant (nom, prenom, email, id_formation) VALUES
('Dupont', 'Sara', 'saradupont@entreprise.ma', 1),
('Bonaventure', 'Maria', 'mariabonaventure@entreprise.ma', 1),
('Idrich', 'Michel', 'michelindrich@entreprise.ma', 2);

INSERT INTO module (titre,horaire, id_formation) VALUES
('PHP et MySQL', 40, 1),
('JavaScript', 35, 1),
('Administration Linux', 30, 2),
('Machine Learning', 45, 3);
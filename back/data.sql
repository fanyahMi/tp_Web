create database nba;
use nba;


CREATE TABLE equipe (
    id_equipe INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(50) NOT NULL
);

CREATE TABLE joueur (
    id_joueur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    dtn DATE NOT NULL,
    equipe_id INT,
    FOREIGN KEY (equipe_id) REFERENCES equipe(id_equipe)
);



create table matchs(
    id_match int AUTO_INCREMENT PRIMARY key,
    equipe_1 int, 
    equipe_2 int,
    date_match date not null,
    FOREIGN KEY (equipe_1) REFERENCES equipe(id_equipe),
    FOREIGN KEY (equipe_2) REFERENCES equipe(id_equipe)
);

create table type_points(
    id_type_points int AUTO_INCREMENT PRIMARY key,
    types_points VARCHAR(50) not null,
    sigle VARCHAR(5) not null
);


create table statistique_joueur(
    id_statistique_joueur int AUTO_INCREMENT PRIMARY key,
    match_id int,
    joueur_id int,
    type_points_id int,
    points double not null,
    FOREIGN KEY (match_id) REFERENCES matchs(id_match),
    FOREIGN KEY (type_points_id) REFERENCES type_points(id_type_points)
);


select joueur_id, type_points_id, 
sum(match_id) as nbmatch,   
sum(points),
joueur.* 
from statistique_joueur 
joueur  on joueur.id_joueur = statistique_joueur.joueur_id
group by joueur_id;




INSERT INTO equipe (libelle) VALUES ('Lakers');
INSERT INTO equipe (libelle) VALUES ('Warriors');
INSERT INTO equipe (libelle) VALUES ('Raptors');


-- Équipe 1
INSERT INTO joueur (nom, prenom, dtn, equipe_id) VALUES
  ('James', 'LeBron', '1984-12-30', 1),   -- LeBron James
  ('Davis', 'Anthony', '1993-03-11', 1),  -- Anthony Davis
  ('Schroder', 'Dennis', '1993-09-15', 1),-- Dennis Schroder
  ('Caldwell-Pope', 'Kentavious', '1993-02-18', 1),
  ('Gasol', 'Marc', '1985-01-29', 1),
  ('Caruso', 'Alex', '1994-02-28', 1),
  ('Kuzma', 'Kyle', '1995-07-24', 1),
  ('Harrell', 'Montrezl', '1994-01-26', 1);

-- Équipe 2
INSERT INTO joueur (nom, prenom, dtn, equipe_id) VALUES
  ('Curry', 'Stephen', '1988-03-14', 2),  -- Stephen Curry
  ('Thompson', 'Klay', '1990-02-08', 2),  -- Klay Thompson
  ('Green', 'Draymond', '1990-03-04', 2),-- Draymond Green
  ('Wiggins', 'Andrew', '1995-02-23', 2),
  ('Oubre Jr.', 'Kelly', '1995-12-09', 2),
  ('Wiseman', 'James', '2001-03-31', 2),
  ('Bazemore', 'Kent', '1989-07-01', 2),
  ('Looney', 'Kevon', '1996-02-06', 2);

-- Équipe 3
INSERT INTO joueur (nom, prenom, dtn, equipe_id) VALUES
  ('Antetokounmpo', 'Giannis', '1994-12-06', 3),  -- Giannis Antetokounmpo
  ('Middleton', 'Khris', '1991-08-12', 3),        -- Khris Middleton
  ('Holiday', 'Jrue', '1990-06-12', 3),            -- Jrue Holiday
  ('Portis', 'Bobby', '1995-02-10', 3),
  ('Lopez', 'Brook', '1988-04-01', 3),
  ('DiVincenzo', 'Donte', '1997-01-31', 3),
  ('Forbes', 'Bryn', '1993-07-23', 3),
  ('Connaughton', 'Pat', '1993-01-06', 3);



INSERT INTO type_points (types_points, sigle) VALUES
    ('Minutes par Match', 'M'),
    ('Matches Joués', 'MJ'),
    ('Points par Match', 'PPM'),
    ('Rebonds par Match', 'RPM'),
    ('Passes Décisives par Match', 'PDPM'),
    ('Minutes par Match', 'MPM'),
    ('Efficacité', 'EFF');



INSERT INTO matchs (equipe_1, equipe_2, date_match) VALUES
    (1, 2, '2023-01-15'), -- Lakers vs. Warriors le 15 janvier 2023
    (3, 1, '2023-01-18'), -- Raptors vs. Lakers le 18 janvier 2023
    (2, 3, '2023-01-22'); -- Warriors vs. Raptors le 22 janvier 2023


-- Ajouter des statistiques de joueur pour tous les joueurs par équipe
-- Match 1
INSERT INTO statistique_joueur (match_id, joueur_id, type_points_id, points) 
SELECT 1, id_joueur, 1, ROUND(RAND() * 30, 2) -- Points aléatoires entre 0 et 30
FROM joueur WHERE equipe_id = 1; -- Pour l'équipe 1

INSERT INTO statistique_joueur (match_id, joueur_id, type_points_id, points) 
SELECT 1, id_joueur, 1, ROUND(RAND() * 30, 2)
FROM joueur WHERE equipe_id = 2; -- Pour l'équipe 2

-- Match 2
INSERT INTO statistique_joueur (match_id, joueur_id, type_points_id, points) 
SELECT 2, id_joueur, 2, ROUND(RAND() * 15, 2) -- Rebonds aléatoires entre 0 et 15
FROM joueur WHERE equipe_id = 1;

INSERT INTO statistique_joueur (match_id, joueur_id, type_points_id, points) 
SELECT 2, id_joueur, 2, ROUND(RAND() * 15, 2)
FROM joueur WHERE equipe_id = 2;

-- Match 3
INSERT INTO statistique_joueur (match_id, joueur_id, type_points_id, points) 
SELECT 3, id_joueur, 3, ROUND(RAND() * 10, 2) -- Passes décisives aléatoires entre 0 et 10
FROM joueur WHERE equipe_id = 1;

INSERT INTO statistique_joueur (match_id, joueur_id, type_points_id, points) 
SELECT 3, id_joueur, 3, ROUND(RAND() * 10, 2)
FROM joueur WHERE equipe_id = 2;


SELECT joueur_id, type_points_id, 
    COUNT(DISTINCT match_id) AS nbmatch,   
    SUM(points) AS total_points,
    joueur.* 
FROM statistique_joueur 
JOIN joueur ON joueur.id_joueur = statistique_joueur.joueur_id
GROUP BY joueur_id, type_points_id, joueur.id_joueur, joueur.nom, joueur.prenom, joueur.dtn, joueur.equipe_id;


SELECT joueur_id, type_points_id, 
    COUNT(DISTINCT match_id) AS nbmatch,   
    SUM(points) AS total_points,
    joueur.* 
FROM statistique_joueur 
JOIN joueur ON joueur.id_joueur = statistique_joueur.joueur_id
GROUP BY joueur_id, joueur.id_joueur, joueur.nom, joueur.prenom, joueur.dtn, joueur.equipe_id;

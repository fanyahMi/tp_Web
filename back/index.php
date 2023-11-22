<?php

require 'flight/Flight.php';

Flight::register('db', 'PDO', array("mysql:host=localhost;dbname=nba;options='-c client_encoding=utf8'",'root',''));


/**** Equipe ****/

Flight::route('GET /equipes', function () {
    try {
        $db = Flight::db();
        $sql = "SELECT * FROM equipe";
        $query = $db->query($sql);
        $equipes = $query->fetchAll(PDO::FETCH_ASSOC);

        Flight::json(['status' => true, 'error' => '', 'data' => $equipes]);
    } catch (PDOException $e) {
        Flight::halt(500, json_encode(['status' => false, 'error' => 'Erreur de lecture des équipes: ' . $e->getMessage(), 'data' => null]));
    }
});

Flight::route('GET /equipes/@id', function ($id) {
    try {
        $db = Flight::db();
        $sql = "SELECT * FROM equipe WHERE id_equipe = ?";
        $query = $db->prepare($sql);
        $query->execute([$id]);
        $equipe = $query->fetch(PDO::FETCH_ASSOC);

        Flight::json(['status' => true, 'error' => '', 'data' => $equipe]);
    } catch (PDOException $e) {
        Flight::halt(500, json_encode(['status' => false, 'error' => 'Erreur de lecture d\'une équipe: ' . $e->getMessage(), 'data' => null]));
    }
});

Flight::route('POST /equipes', function () {
    try {
        $db = Flight::db();
        $data = Flight::request()->data;
        $libelle = $data['libelle'];

        $sql = "INSERT INTO equipe (libelle) VALUES (?)";
        $query = $db->prepare($sql);
        $query->execute([$libelle]);

        $status_code = $query->rowCount();
        Flight::json(['status' => true, 'error' => '', 'data' => ['status_code' => $status_code]]);
    } catch (PDOException $e) {
        Flight::halt(500, json_encode(['status' => false, 'error' => 'Erreur d\'ajout d\'une équipe: ' . $e->getMessage(), 'data' => null]));
    }
});

Flight::route('PUT /equipes/@id', function ($id) {
    try {
        $db = Flight::db();
        $data = Flight::request()->data;
        $libelle = $data['libelle'];

        $sql = "UPDATE equipe SET libelle = ? WHERE id_equipe = ?";
        $query = $db->prepare($sql);
        $query->execute([$libelle, $id]);

        $status_code = $query->rowCount();
        Flight::json(['status' => true, 'error' => '', 'data' => ['status_code' => $status_code]]);
    } catch (PDOException $e) {
        Flight::halt(500, json_encode(['status' => false, 'error' => 'Erreur de modification d\'une équipe: ' . $e->getMessage(), 'data' => null]));
    }
});

Flight::route('DELETE /equipes/@id', function ($id) {
    try {
        $db = Flight::db();

        $sql = "DELETE FROM equipe WHERE id_equipe = ?";
        $query = $db->prepare($sql);
        $query->execute([$id]);

        $status_code = $query->rowCount();
        Flight::json(['status' => true, 'error' => '', 'data' => ['status_code' => $status_code]]);
    } catch (PDOException $e) {
        Flight::halt(500, json_encode(['status' => false, 'error' => 'Erreur de suppression d\'une équipe: ' . $e->getMessage(), 'data' => null]));
    }
});

/****** Liste joueur par equipe  ****/
Flight::route('GET /equipe_joueurs/@id_equipe', function ($id_equipe) {
    $db = Flight::db();
    $sql = "select * from joueur join equipe on equipe.id_equipe =  joueur.equipe_id where id_equipe = ?";
    $query = $db->prepare($sql);
    $query->execute([$id_equipe]);
    $joueurs = $query->fetchAll(PDO::FETCH_ASSOC);
    Flight::json(['status' => true,"error" => "" ,'data' => $joueurs ]);
});
/******** Joueur  ******/


Flight::route('GET /joueurs', function () {
    try {
        $db = Flight::db();
        $sql = "SELECT * FROM joueur";
        $query = $db->query($sql);
        $joueurs = $query->fetchAll(PDO::FETCH_ASSOC);

        Flight::json(['status' => true, 'error' => '', 'data' => $joueurs]);
    } catch (PDOException $e) {
        Flight::halt(500, json_encode(['status' => false, 'error' => 'Erreur de lecture des joueurs: ' . $e->getMessage(), 'data' => null]));
    }
});

Flight::route('GET /joueurs/@id', function ($id) {
    try {
        $db = Flight::db();
        $sql = "SELECT * FROM joueur WHERE id_joueur = ?";
        $query = $db->prepare($sql);
        $query->execute([$id]);
        $joueur = $query->fetch(PDO::FETCH_ASSOC);

        Flight::json(['status' => true, 'error' => '', 'data' => $joueur]);
    } catch (PDOException $e) {
        Flight::halt(500, json_encode(['status' => false, 'error' => 'Erreur de lecture d\'un joueur: ' . $e->getMessage(), 'data' => null]));
    }
});

Flight::route('POST /joueurs', function () {
    try {
        $db = Flight::db();
        $data = Flight::request()->data;
        $nom = $data['nom'];
        $prenom = $data['prenom'];
        $dtn = $data['dtn'];
        $equipe_id = $data['equipe_id'];

        $sql = "INSERT INTO joueur (nom, prenom, dtn, equipe_id) VALUES (?, ?, ?, ?)";
        $query = $db->prepare($sql);
        $query->execute([$nom, $prenom, $dtn, $equipe_id]);

        $status_code = $query->rowCount();
        Flight::json(['status' => true, 'error' => '', 'data' => ['status_code' => $status_code]]);
    } catch (PDOException $e) {
        Flight::halt(500, json_encode(['status' => false, 'error' => 'Erreur d\'ajout d\'un joueur: ' . $e->getMessage(), 'data' => null]));
    }
});

Flight::route('PUT /joueurs/@id', function ($id) {
    try {
        $db = Flight::db();
        $data = Flight::request()->data;
        $nom = $data['nom'];
        $prenom = $data['prenom'];
        $dtn = $data['dtn'];
        $equipe_id = $data['equipe_id'];

        $sql = "UPDATE joueur SET nom = ?, prenom = ?, dtn = ?, equipe_id = ? WHERE id_joueur = ?";
        $query = $db->prepare($sql);
        $query->execute([$nom, $prenom, $dtn, $equipe_id, $id]);

        $status_code = $query->rowCount();
        Flight::json(['status' => true, 'error' => '', 'data' => ['status_code' => $status_code]]);
    } catch (PDOException $e) {
        Flight::halt(500, json_encode(['status' => false, 'error' => 'Erreur de modification d\'un joueur: ' . $e->getMessage(), 'data' => null]));
    }
});

Flight::route('DELETE /joueurs/@id', function ($id) {
    try {
        $db = Flight::db();

        $sql = "DELETE FROM joueur WHERE id_joueur = ?";
        $query = $db->prepare($sql);
        $query->execute([$id]);

        $status_code = $query->rowCount();
        Flight::json(['status' => true, 'error' => '', 'data' => ['status_code' => $status_code]]);
    } catch (PDOException $e) {
        Flight::halt(500, json_encode(['status' => false, 'error' => 'Erreur de suppression d\'un joueur: ' . $e->getMessage(), 'data' => null]));
    }
});


/****************/

/**** Match ****/


Flight::route('GET /matches', function () {
    try {
        $db = Flight::db();
        $sql = "SELECT * FROM `matchs`";
        $query = $db->query($sql);
        $matches = $query->fetchAll(PDO::FETCH_ASSOC);

        Flight::json(['status' => true, 'error' => '', 'data' => $matches]);
    } catch (PDOException $e) {
        Flight::halt(500, json_encode(['status' => false, 'error' => 'Erreur de lecture des matchs: ' . $e->getMessage(), 'data' => null]));
    }
});

Flight::route('GET /matches/@id', function ($id) {
    try {
        $db = Flight::db();
        $sql = "SELECT * FROM `matchs` WHERE id_match = ?";
        $query = $db->prepare($sql);
        $query->execute([$id]);
        $match = $query->fetch(PDO::FETCH_ASSOC);

        Flight::json(['status' => true, 'error' => '', 'data' => $match]);
    } catch (PDOException $e) {
        Flight::halt(500, json_encode(['status' => false, 'error' => 'Erreur de lecture d\'un match: ' . $e->getMessage(), 'data' => null]));
    }
});

Flight::route('POST /matches', function () {
    try {
        $db = Flight::db();
        $data = Flight::request()->data;
        $equipe_1 = $data['equipe_1'];
        $equipe_2 = $data['equipe_2'];
        $date_match = $data['date_match'];

        $sql = "INSERT INTO `match` (equipe_1, equipe_2, date_match) VALUES (?, ?, ?)";
        $query = $db->prepare($sql);
        $query->execute([$equipe_1, $equipe_2, $date_match]);

        $status_code = $query->rowCount();
        Flight::json(['status' => true, 'error' => '', 'data' => ['status_code' => $status_code]]);
    } catch (PDOException $e) {
        Flight::halt(500, json_encode(['status' => false, 'error' => 'Erreur d\'ajout d\'un match: ' . $e->getMessage(), 'data' => null]));
    }
});

Flight::route('PUT /matches/@id', function ($id) {
    try {
        $db = Flight::db();
        $data = Flight::request()->data;
        $equipe_1 = $data['equipe_1'];
        $equipe_2 = $data['equipe_2'];
        $date_match = $data['date_match'];

        $sql = "UPDATE `match` SET equipe_1 = ?, equipe_2 = ?, date_match = ? WHERE id_match = ?";
        $query = $db->prepare($sql);
        $query->execute([$equipe_1, $equipe_2, $date_match, $id]);

        $status_code = $query->rowCount();
        Flight::json(['status' => true, 'error' => '', 'data' => ['status_code' => $status_code]]);
    } catch (PDOException $e) {
        Flight::halt(500, json_encode(['status' => false, 'error' => 'Erreur de modification d\'un match: ' . $e->getMessage(), 'data' => null]));
    }
});

Flight::route('DELETE /matches/@id', function ($id) {
    try {
        $db = Flight::db();

        $sql = "DELETE FROM `match` WHERE id_match = ?";
        $query = $db->prepare($sql);
        $query->execute([$id]);

        $status_code = $query->rowCount();
        Flight::json(['status' => true, 'error' => '', 'data' => ['status_code' => $status_code]]);
    } catch (PDOException $e) {
        Flight::halt(500, json_encode(['status' => false, 'error' => 'Erreur de suppression d\'un match: ' . $e->getMessage(), 'data' => null]));
    }
});


/***************/


Flight::start();

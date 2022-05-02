<?php
require_once 'connexion.php';
session_start();
$titre = $_POST['titre'];
$date = $_POST['date'];
$duree = $_POST['duree'];
$synopsis = $_POST['synopsis'];
$genre = $_POST['genre'];
$realisateurN = $_POST['realisateurN'];
$realisateurP = $_POST['realisateurP'];
$budget = $_POST['budget'];
$box_office = $_POST['box_office'];
$note = $_POST['note'];
$new_genre = $_POST['new_genre'];

                    



if (!isset($titre) || empty($titre)) {
    echo "Le champs titre est obligatoire.";
    die;
}
if (!isset($date) || empty($date)) {
    echo "Le champs date est obligatoire.";
    die;
}
if (!isset($duree) || empty($duree)) {
    echo "Le champ duree est obligatoire.";
    die;
}
if (!isset($synopsis) || empty($synopsis)) {
    echo "Le champ synopsis est obligatoire.";
    die;
}
if (!isset($genre) || empty($genre)) {
    echo "Le champ genre est obligatoire.";
    die;
}
if (!isset($realisateurN) || empty($realisateurN)) {
    echo "Le champ nom de réalisateur est obligatoire.";
    die;
}
if (!isset($realisateurP) || empty($realisateurP)) {
    echo "Le champ prenom de réalisateur est obligatoire.";
    die;
}


if (empty($new_genre)) {
    try {
        //On récupère les valeurs saisies par l'utilisateur
        $titre = filtreChaine($_POST['titre']);
        $synopsis = filtreChaine($_POST['synopsis']);
        $date = filtreChaine($_POST['date']);
        $duree = filtreChaine($_POST['duree']);
        $genre = filtreChaine($_POST['genre']);
        $realisateurN = filtreChaine($_POST['realisateurN']);
        $realisateurP = filtreChaine($_POST['realisateurP']);
        $budget = filtreChaine($_POST['budget']);
        $box_office = filtreChaine($_POST['box_office']);
        $note = filtreChaine($_POST['note']);

        //Traitement pour faire ajouter ou récupérer le id du realisateur.
        //Si le realisateur existe on récupère seulement l'id
        //Si le realisateur n'existe pas on ajoute le genre à la base de données et on récupère l'id.
        $id_real=0;
        $verif_real = $db->query("SELECT nom, prenom FROM realisateur");
        foreach ($verif_real as $info_real) {
            if ($realisateurN == $info_real['nom'] and $realisateurP == $info_real['prenom']) {
                //On récupèr le ID du réalisateur
                $real_id = $db->query("SELECT id FROM realisateur WHERE nom='$realisateurN' AND prenom='$realisateurP'");
                foreach ($real_id as $unId) {
                    $id_real = $unId['id'];
                }
            }
            
        }
        if($id_real==null)
            {
                $sql2 = "INSERT INTO realisateur(nom,prenom) VALUES(?,?)";
            $sth2 = $db->prepare($sql2);
            $sth2->bindParam(1, $realisateurN, PDO::PARAM_STR, 10);
            $sth2->bindParam(2, $realisateurP, PDO::PARAM_STR, 50);
            $sth2->execute();
            }
        

        $real_id = $db->query("SELECT id FROM realisateur WHERE nom='$realisateurN'");
        foreach ($real_id as $unId) {
            $id_real = $unId['id'];
        }


        $genre_new = $db->query("SELECT id FROM genre WHERE libelle='$genre'");
        foreach ($genre_new as $unGenre) {
            $genre_id = $unGenre['id'];
        }


        //On récupère le ID de l'utilisateur
        $user_id = $_SESSION['nom'];
        $id_utilisateur = $db->query("SELECT id FROM utilisateur WHERE nom ='$user_id'");
        foreach ($id_utilisateur as $id_user) {
            $id = $id_user['id'];
        }

        
        //Insert pour la table Film
        $sql = "INSERT INTO film(titre,synopsis,duree,date_sortie,budget,box_office,note,id_realisateur,id_utilisateur,id_genre) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sth = $db->prepare($sql);
        $sth->bindParam(1, $titre, PDO::PARAM_STR, 45);
        $sth->bindParam(2, $synopsis, PDO::PARAM_STR, 65000);
        $sth->bindParam(3, $duree, PDO::PARAM_STR, 10);
        $sth->bindParam(4, $date, PDO::PARAM_STR, 45);
        $sth->bindParam(5, $budget, PDO::PARAM_STR, 45);
        $sth->bindParam(6, $box_office, PDO::PARAM_STR, 50);
        $sth->bindParam(7, $note, PDO::PARAM_STR, 45);
        $sth->bindParam(8, $id_real, PDO::PARAM_STR, 45);
        $sth->bindParam(9, $id, PDO::PARAM_STR, 45);
        $sth->bindParam(10, $genre_id, PDO::PARAM_STR, 50);
        $sth->execute();
        $id_film = $db->query("SELECT id FROM film WHERE titre='$titre'");
        foreach ($id_film as $unFilm) {
            $id_film_img = $unFilm['id'];
        }
        /**
         * Gestion de l'image qu'il faudrait externaliser
         */
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["image"]) .  $id_film_img . ".jpg";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $ImageNameDB = ($_FILES["image"]["name"]) ? $_FILES["image"]["name"] : "";
        // Check if image file is a actual image or fake image
        if (isset($_FILES["image"]) && !empty($ImageNameDB)) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);

            //   var_dump($_FILES["image"]);die;
            // si le check est = à false on peut décider de ne pas enregistrer en BDD par exemple
            if ($check !== false) {
                echo "Image OK - " . $check["mime"] . ".";
                $uploadOk = true;
                // de meme si l'image n'a pas été téléchargé sur le serveur
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    echo "Le fichier est valide, et a été téléchargé avec succès. Voici plus d'informations :\n";
                } else {
                    // cf doc de move_uploaded_file
                    echo "Attaque potentielle par téléchargement de fichiers. Voici plus d'informations :\n";
                }
            } else {
                echo "L'image est incorrect.";
                $uploadOk = false;
            }
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        die;
    }
    header("location: ./index.php?page=Ajouter");




} elseif (!empty($new_genre)) {
    try {
        //On récupère les valeurs saisies par l'utilisateur
        $titre = filtreChaine($_POST['titre']);
        $synopsis = filtreChaine($_POST['synopsis']);
        $date = filtreChaine($_POST['date']);
        $duree = filtreChaine($_POST['duree']);
        $budget = filtreChaine($_POST['budget']);
        $realisateurN = $_POST['realisateurN'];
        $realisateurP = $_POST['realisateurP'];
        $box_office = filtreChaine($_POST['box_office']);
        $note = filtreChaine($_POST['note']);
        $new_genre = filtreChaine($_POST['new_genre']);


        //Traitement pour faire ajouter ou récupérer le id du realisateur.
        //Si le realisateur existe on récupère seulement l'id
        //Si le realisateur n'existe pas on ajoute le genre à la base de données et on récupère l'id.
        $verif_real = $db->query("SELECT nom, prenom FROM realisateur");
        foreach ($verif_real as $info_real) {
            if ($realisateurN == $info_real['nom'] and $realisateurP == $info_real['prenom']) {
                //On récupèr le ID du réalisateur
                $real_id = $db->query("SELECT id FROM realisateur WHERE nom='$realisateurN'");
                foreach ($real_id as $unId) {
                    $id_real = $unId['id'];
                }
            }
            
        }
        if($id_real==null)
            {
                $sql2 = "INSERT INTO realisateur(nom,prenom) VALUES(?,?)";
            $sth2 = $db->prepare($sql2);
            $sth2->bindParam(1, $realisateurN, PDO::PARAM_STR, 10);
            $sth2->bindParam(2, $realisateurP, PDO::PARAM_STR, 50);
            $sth2->execute();
            }
        

        $real_id = $db->query("SELECT id FROM realisateur WHERE nom='$realisateurN'");
        foreach ($real_id as $unId) {
            $id_real = $unId['id'];
        }

        //Traitement pour faire ajouter ou récupérer le id du genre.
        //Si le genre existe on récupère seulement l'id
        //Si le genre n'existe pas on ajoute le genre à la base de données et on récupère le id.
        $verif_genre = $db->query("SELECT libelle FROM genre");
        foreach ($verif_genre as $info_genre) {
            if ($new_genre == $info_genre['libelle']) {
                $genre_new = $db->query("SELECT id FROM genre WHERE libelle='$new_genre'");
                foreach ($genre_new as $unGenre) {
                    $genre_id = $unGenre['id'];
                }
            }
        }

        if ($genre_id == null) {
            //Ajout de genre
            $add_genre = "INSERT INTO genre(libelle) VALUES(?)";
            $sth2 = $db->prepare($add_genre);
            $sth2->bindParam(1, $new_genre, PDO::PARAM_STR, 10);
            $sth2->execute();
        }

        $genre_new = $db->query("SELECT id FROM genre WHERE libelle='$new_genre'");
        foreach ($genre_new as $unGenre) {
            $genre_id = $unGenre['id'];
        }
        
                
        //On récupère le ID de l'utilisateur
        $user_id = $_SESSION['nom'];
        $id_utilisateur = $db->query("SELECT id FROM utilisateur WHERE nom ='$user_id'");
        foreach ($id_utilisateur as $id_user) {
            $id = $id_user['id'];
        }
        //Insert pour la table Film
        $sql = "INSERT INTO film(titre,synopsis,duree,date_sortie,budget,box_office,note,id_realisateur,id_utilisateur,id_genre) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sth = $db->prepare($sql);
        $sth->bindParam(1, $titre, PDO::PARAM_STR, 45);
        $sth->bindParam(2, $synopsis, PDO::PARAM_STR, 65000);
        $sth->bindParam(3, $duree, PDO::PARAM_STR, 10);
        $sth->bindParam(4, $date, PDO::PARAM_STR, 45);
        $sth->bindParam(5, $budget, PDO::PARAM_STR, 45);
        $sth->bindParam(6, $box_office, PDO::PARAM_STR, 50);
        $sth->bindParam(7, $note, PDO::PARAM_STR, 45);
        $sth->bindParam(8, $id_real, PDO::PARAM_STR, 45);
        $sth->bindParam(9, $id, PDO::PARAM_STR, 45);
        $sth->bindParam(10, $genre_id, PDO::PARAM_INT, 50);
        $sth->execute();

        $id_film = $db->query("SELECT id FROM film WHERE titre='$titre'");
        foreach ($id_film as $unFilm) {
            $id_film_img = $unFilm['id'];
        }
        
        /**
         * Gestion de l'image qu'il faudrait externaliser
         */
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["image"]) . $id_film_img . ".jpg";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $ImageNameDB = ($_FILES["image"]["name"]) ? $_FILES["image"]["name"] : "";
        // Check if image file is a actual image or fake image
        if (isset($_FILES["image"]) && !empty($ImageNameDB)) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);

            //   var_dump($_FILES["image"]);die;
            // si le check est = à false on peut décider de ne pas enregistrer en BDD par exemple
            if ($check !== false) {
                echo "Image OK - " . $check["mime"] . ".";
                $uploadOk = true;
                // de meme si l'image n'a pas été téléchargé sur le serveur
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    echo "Le fichier est valide, et a été téléchargé avec succès. Voici plus d'informations :\n";
                } else {
                    // cf doc de move_uploaded_file
                    echo "Attaque potentielle par téléchargement de fichiers. Voici plus d'informations :\n";
                }
            } else {
                echo "L'image est incorrect.";
                $uploadOk = false;
            }
        }


        
    } catch (Exception $e) {
        echo $e->getMessage();
        die;
    }
    header("location: ./index.php?page=Ajouter");
}

function filtreChaine(string $chaine)
{
    return filter_var(trim($chaine), FILTER_SANITIZE_STRING);
}

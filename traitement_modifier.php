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
$note = $_POST['note'];
$budget = $_POST['budget'];
$box_office = $_POST['box_office'];

if(!isset($titre) || empty($titre)){
    echo "Le champ titre est obligatoire."; die;
}
if(!isset($date) || empty($date)){
    echo "Le champ date est obligatoire."; die;
}
if(!isset($duree) || empty($duree)){
    echo "Le champ duree est obligatoire."; die;
}
if(!isset($synopsis) || empty($synopsis)){
    echo "Le champ synopsis est obligatoire."; die;
}
if(!isset($genre) || empty($genre)){
    echo "Le champ genre est obligatoire."; die;
}
if(!isset($realisateurN) || empty($realisateurN)){
    echo "Le champ nom du réalisateur est obligatoire."; die;
}
if(!isset($realisateurP) || empty($realisateurP)){
    echo "Le champ prenom du réalisateur est obligatoire."; die;
}
if(!isset($note) || empty($note)){
    echo "Le champ note est obligatoire."; die;
}
if(!isset($budget) || empty($budget)){
    echo "Le champ budget est obligatoire."; die;
}
if(!isset($box_office) || empty($box_office)){
    echo "Le champ box_office est obligatoire."; die;
}
try{
    

$titre = filtreChaine($_POST['titre']);
$synopsis = filtreChaine($_POST['synopsis']);
$date = filtreChaine($_POST['date']);
$duree = filtreChaine($_POST['duree']);
$genre = filtreChaine($_POST['genre']);
$budget = filtreChaine($_POST['budget']);
$note= filtreChaine($_POST['note']);
$box_office = filtreChaine($_POST['box_office']);

//On récupère l'id du genre
$id_genre = $db->query("SELECT id FROM genre WHERE libelle='$genre'");
foreach ($id_genre as $unGenre)
{
    $genre = $unGenre['id'];
}

//On récupère l'id du rélaisateur
$id_realisateur = $db->query("SELECT id FROM realisateur WHERE nom='$realisateurN' AND prenom='$realisateurP'");
foreach($id_realisateur as $id_real)
{
    $id_reali = $id_real['id'];
}

//On récupère le ID de l'utilisateur
$user_id = $_SESSION['nom'];
$id_utilisateur = $db->query("SELECT id FROM utilisateur WHERE nom ='$user_id'");
foreach ($id_utilisateur as $id_user) {
    $id = $id_user['id'];
}

$choix = $_GET['id'];
$sql3 = "UPDATE film SET id = ?, titre = ?, synopsis = ?, duree = ?, date_sortie = ?, budget = ?, box_office = ?, note = ?, id_genre = ?, id_utilisateur = ? WHERE id =".$choix;
$sql4 = "UPDATE film SET id_realisateur = ? WHERE id = '$choix'";


$sth = $db->prepare($sql3);
$sth2 = $db->prepare($sql4);
$sth->bindParam(1, $choix, PDO::PARAM_STR, 45  );
$sth->bindParam(2, $titre, PDO::PARAM_STR, 45  );
$sth->bindParam(3, $synopsis, PDO::PARAM_STR, 65000  );
$sth->bindParam(4, $duree, PDO::PARAM_STR, 10  );
$sth->bindParam(5, $date, PDO::PARAM_STR, 10  );
$sth->bindParam(6, $budget, PDO::PARAM_STR, 65000  );
$sth->bindParam(7, $box_office, PDO::PARAM_STR, 10  );
$sth->bindParam(8, $note, PDO::PARAM_STR, 10  );
$sth->bindParam(9, $genre, PDO::PARAM_STR, 50  );
$sth->bindParam(10, $id, PDO::PARAM_STR, 50  );
$sth->execute();
$sth2->bindParam(1, $id_reali, PDO::PARAM_STR, 10  );
$sth2->execute();
$sth->debugDumpParams();
echo 'Produit ajouté';
header("location: ./index.php?page=Admin");

}catch(Exception $e){
    echo $e->getMessage();
    die;
}


function filtreChaine(string $chaine){
    return filter_var(trim($chaine), FILTER_SANITIZE_STRING);
}
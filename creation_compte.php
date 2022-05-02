<?php
include_once 'connexion.php';

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$adresse_mail = $_POST['adresse_mail'];
$mdp1 = $_POST['mdp1'];
$mdp2 = $_POST['mdp2'];

echo $nom.'<br>';
echo $prenom.'<br>';
echo $adresse_mail.'<br>';
echo $mpd1.'<br>';

if(!isset($nom) || empty($nom)){
    echo "Le champs nom est obligatoire."; die;
}
if(!isset($prenom) || empty($prenom)){
    echo "Le champs prenom est obligatoire."; die;
}
if(!isset($adresse_mail) || empty($adresse_mail)){
    echo "Le champs adresse mail est obligatoire."; die;
}
if(!isset($mdp1) || empty($mdp1)){
    echo "Le champs mot de passe est obligatoire."; die;
}

try{
    $nom = filtreChaine($_POST['nom']);
    $prenom = filtreChaine($_POST['prenom']);
    $adresse_mail = filtreChaine($_POST['adresse_mail']);
    $mdp1 = filtreChaine($_POST['mdp1']);
    $mdp2 = filtreChaine($_POST['mdp2']);
    $sql = "INSERT INTO utilisateur (nom,prenom,mail,mdp) VALUES('$nom', '$prenom', '$adresse_mail','$mdp1')";
    var_dump($sql);
    $sth = $db->prepare($sql);
    $sth->bindParam(1, $nom, PDO::PARAM_STR, 45  );
    $sth->bindParam(2, $prenom, PDO::PARAM_STR, 65000  );
    $sth->bindParam(3, $adresse_mail, PDO::PARAM_STR, 1000  );
    $sth->bindParam(4, $mdp1, PDO::PARAM_STR, 50  );
    $sth->execute();
    $sth->debugDumpParams();
     header("location: ./index.php?page=Accueil");
    
    }catch(Exception $e){
        echo $e->getMessage();
        die;
    }
    
    
    function filtreChaine(string $chaine){
        return filter_var(trim($chaine), FILTER_SANITIZE_STRING);
    }
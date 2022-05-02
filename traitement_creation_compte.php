<?php
include_once 'connexion.php';

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$adresse_mail = $_POST['adresse_mail'];
$mdp1 = $_POST['mdp1'];
$mdp2 = $_POST['mdp2'];

if(!isset($nom) || empty($nom)){
    echo "Le champ nom est obligatoire."; die;
}
if(!isset($prenom) || empty($prenom)){
    echo "Le champ prenom est obligatoire."; die;
}
if(!isset($adresse_mail) || empty($adresse_mail)){
    echo "Le champ adresse mail est obligatoire."; die;
}
if(!isset($mdp1) || empty($mdp1)){
    echo "Le champ mot de passe est obligatoire."; die;
}

if(!isset($mdp2) || empty($mdp2)){
    echo "Le champ mot de passe est obligatoire."; die;
}


try{
    $nom = filtreChaine($_POST['nom']);
    $prenom = filtreChaine($_POST['prenom']);
    $adresse_mail = filtreChaine($_POST['adresse_mail']);
    $mdp1 = filtreChaine($_POST['mdp1']);
    $mdp2 = filtreChaine($_POST['mdp2']);
    $mdp_hash = password_hash($mdp1, PASSWORD_DEFAULT);
    $role = 0;
    
    if($mdp1 == $mdp2)
    {
    $sql = "INSERT INTO utilisateur (nom,prenom,mail,mdp,id_role) VALUES(?,?,?,?,?)";
    $sth = $db->prepare($sql);
    $sth->bindParam(1, $nom, PDO::PARAM_STR, 45  );
    $sth->bindParam(2, $prenom, PDO::PARAM_STR, 1000  );
    $sth->bindParam(3, $adresse_mail, PDO::PARAM_STR, 1000  );
    $sth->bindParam(4, $mdp_hash, PDO::PARAM_STR, 1000 );
    $sth->bindParam(5, $role, PDO::PARAM_STR, 1000 );
    $sth->execute();
    $sth->debugDumpParams();
    header("location: ./index.php?page=Login");
    }
    else
    {
        echo 'ERREUR';
        die;
    }

    
    
    }catch(Exception $e){
        echo $e->getMessage();
        die;
    }
    
    
    function filtreChaine(string $chaine){
        return filter_var(trim($chaine), FILTER_SANITIZE_STRING);
    }
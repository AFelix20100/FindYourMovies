<?php
include "connexion.php";

$login = $_POST['login'];
$mdp = $_POST['mot_de_passe'];

if(!isset($login) || empty($login)){
    echo "<h1>Oops...</h1>"."<label>Une adresse mail est obligatoire</label>"; die;
}
if(!isset($mdp) || empty($mdp)){
    echo "<h1>Oops...</h1>"."<label>Le mot de passe est obligatoire</label>"; die;
}


try{
    $login = filtreChaine($_POST['login']);
    $mdp = filtreChaine($_POST['mot_de_passe']);
    $requete="SELECT mail, mdp, id_role FROM utilisateur WHERE mail=".$db->quote($login);



    $info="SELECT nom, prenom FROM utilisateur WHERE mail=".$db->quote($login);
    $log = $db->query($info);
    foreach($log as $unLog)
    {
        $nom = $unLog['nom'];
        $prenom = $unLog['prenom'];
    };



    $resultat = $db->query($requete);
    foreach ($resultat as $donne) {
        $mail = $donne['mail'];
        $mdp_serveur = $donne['mdp'];
        $role = $donne['id_role'];
    }
    if(password_verify($mdp,$mdp_serveur) and $role == 1)
    {
        session_start();
        $_SESSION['nom'] = $nom;
        $_SESSION['prenom'] = $prenom;
        $_SESSION['role'] = $role;
        header("location: ./index.php?page=Admin");

    }
    else if(password_verify($mdp,$mdp_serveur) and $role == 0)
    {
        session_start();
        $_SESSION['nom'] = $nom;
        $_SESSION['prenom'] = $prenom;
        $_SESSION['role'] = $role;
        header("location: ./index.php?page=Accueil");

    }
    else
    {
        echo 'Erreur de connexion';
        die;
    }

    
    
    }catch(Exception $e){
        echo $e->getMessage();
        die;
    }
    
    
    function filtreChaine(string $chaine){
        return filter_var(trim($chaine), FILTER_SANITIZE_STRING);
    }
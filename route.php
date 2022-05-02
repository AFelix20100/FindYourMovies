<?php
$pages=[
    'Accueil'=>'accueil.php',
    'Ajouter'=>'ajout.php',
    'Admin'=>'admin.php',
    'Traitement_ajout'=>'traitement_ajout.php',
	'Traitement_modifier'=>'traitement_modifier.php',
    'Register'=>'register.php',
    'Creation'=>'traitement_creation_compte.php',
	''=>'login.php',
    'Contacter'=>'contact.php',
	'Modifier'=>'modifier.php',
    'Login'=>'login.php',
    'Connexion'=>'traitement_login.php',
    'Connexion_Invite'=>'traitement_login_invite.php',
	'Traitement_modifier'=>'traitement_modifier.php',
    '404'=>'404.php'
];
$page ='';
if(isset($_GET['page'])) {
    $page = $_GET['page'];
    if(!isset($pages[$page])){
        $page="404";
    }    
} 
include($pages[$page]);
die();
?>
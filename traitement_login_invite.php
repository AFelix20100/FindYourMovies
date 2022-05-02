<?php
include "connexion.php";
session_start();
$_SESSION['nom'] = "";
$_SESSION['prenom'] = "";
$_SESSION['role'] = 3;
header("location: ./index.php?page=Accueil");
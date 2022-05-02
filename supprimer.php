<?php
include "connexion.php";
$choix = $_GET['numero'];
$sql2 = "DELETE FROM film WHERE id = $choix";
$sql3 = "DELETE FROM realisateur WHERE id_film = $choix";
$sth = $db->prepare($sql2);$sth->execute();
$sth2 = $db->prepare($sql3);$sth2->execute();
header("location: ./index.php?page=Admin");
//$count = $sth->rowCount();
//echo 'Effacement de ' .$count. ' entrées.';
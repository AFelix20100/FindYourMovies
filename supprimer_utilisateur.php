<?php
include "connexion.php";
$choisi = $_GET['numero'];
$sql2 = "DELETE FROM utilisateur WHERE id = $choisi";
$sth = $db->prepare($sql2);$sth->execute();
//$count = $sth->rowCount();
//echo 'Effacement de ' .$count. ' entrées.';

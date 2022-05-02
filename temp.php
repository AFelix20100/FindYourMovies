<?php
include 'connexion.php';


$resultat = $db->query("SELECT id FROM genre WHERE libelle = 'Action'");
foreach($resultat as $unResultat)
{
  $unResultat['id'];
}

<?php
include "connexion.php";
?>

<?php
  $host = 'localhost';
  $dbname = 'projet';
  $username = 'root';
  $password = '';
    
  $dsn = "mysql:host=$host;dbname=$dbname"; 
  $sql = "SELECT F.*,R.*,G.* FROM film as F INNER JOIN realisateur as R ON F.id_realisateur = R.id INNER JOIN genre as G on G.id = F.id_genre WHERE F.id=".$_GET['id'];
?>

<div class="container-fluid">
                    <h1>Modifier votre film :</h1>
                   
                    <!-- Page Heading -->
                    <form class="row g-3" method="POST" action='./index.php?page=Traitement_modifier&id=<?= $_GET['id']?>'>
					
                        <?php 
					  try{
						$pdo = new PDO($dsn, $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
						$stmt = $pdo->query($sql,PDO::FETCH_ASSOC) ;
						foreach($stmt as $row ){?>
						
						
						<div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Id</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?= $_GET['id']?>">
                        </div>
						<div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Titre du film :</label>
                            <input type="text" class="form-control" id="titre" name="titre" value="<?php echo htmlspecialchars($row['titre']); ?>"> 
                        </div>
                        <div class="col-md-6">
                            <label for="inputAddress" class="form-label">Durée :</label>
                            <input type="text" class="form-control" id="duree" placeholder="XXh XXm" name="duree" value="<?php echo htmlspecialchars($row['duree']); ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="inputAddress" class="form-label"> Nom du réalisateur :</label>
                            <input type="text" class="form-control" id="realisateurN" placeholder="Nom" name="realisateurN" value="<?php echo htmlspecialchars($row['nom']); ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Date de sortie :</label>
                            <input type="text" class="form-control" id="date" placeholder="DD/MM/YYYY" name="date" value="<?php echo htmlspecialchars($row['date_sortie']); ?>"> 
                        </div>
                        <div class="col-md-6">
                        <label for="inputAddress" class="form-label"> Prénom du réalisateur :</label>
                            <input type="text" class="form-control" id="realisateurP" placeholder="Prenom" name="realisateurP" value="<?php echo htmlspecialchars($row['prenom']); ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="inputAddress" class="form-label">Note :</label>
                            <input type="text" class="form-control" id="note" placeholder="XXh XXm" name="note" value="<?php echo htmlspecialchars($row['note']); ?>">
                        </div>

                        <div class="col-md-6">
                            <label for="inputAddress" class="form-label">Budget :</label>
                            <input type="text" class="form-control" id="budget" placeholder="XXh XXm" name="budget" value="<?php echo htmlspecialchars($row['budget']); ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="inputAddress" class="form-label">Box-office :</label>
                            <input type="text" class="form-control" id="box_office" placeholder="XXh XXm" name="box_office" value="<?php echo htmlspecialchars($row['box_office']); ?>">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Synopsis :</label>
                            <input type="text" class="form-control" id="synopsis" placeholder="Écrire quelque chose..." name="synopsis" value="<?php echo ($row['synopsis']); ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Genre :</label>
                            <select id="inputState" id ="genre" name="genre" class="form-select">
                                <option selected id="genre"><?php echo htmlspecialchars($row['libelle']); ?></option>
                                <option>Action</option>
                                <option>Comédie</option>
                                <option>Drama</option>
                                <option>Guerre</option>
                                <option>Thriller</option>
                                <option>Fantaisie</option>
                                <option>Histoire</option>
                                <option>Horreurs</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Ajouter le film</button>
                        </div>
						
						<?php }; 
						
					   }catch (PDOException $e){
						 echo $e->getMessage();
					   }
				?>
                    </form>
					
<?php
session_start();
include 'header.php'
?>

<?php
  $host = 'localhost';//10.50.0.2
  $dbname = 'projet';
  $username = 'root';//Felix
  $password = '';//Felix
    
  $dsn = "mysql:host=$host;dbname=$dbname"; 
  // récupérer tous les utilisateurs
  $sql = "SELECT * FROM film";
   

?>

<body id="page-top">
	<!-- Page Wrapper -->
	<div id="wrapper">
		<!-- Sidebar -->
		
		<?php
		include "navbar_gauche.php"
		?>

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">
				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light topbar mb-4 static-top">
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>
					<!-- Profile -->
					<?php
					include_once "profil.php";
					?>
	</nav>
				<!-- End of Topbar -->


				<!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->
					<h1 class="h3 mb-2 text-gray-800">Accueil</h1>
					<p class="mb-4">Vous trouverez ci-dessous la liste des films : </p>
					<!-- DataTales Example -->
					<nav class="navbar navbar-light bg-light">
						<form class="form-inline">
							<input class="form-control mr-sm-2" type="search" placeholder="Rechercher un film..." aria-label="Search">
							<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Valider</button>
						</form>
					</nav>
					<div class="genre">
						<select class="form-select" aria-label="Default select example">
							<option selected>Sélectionner un genre</option>
							<option value="1">Action</option>
							<option value="2">Comédie</option>
							<option value="3">Drama</option>
							<option value="3">Guerre</option>
							<option value="3">Thriller</option>
							<option value="3">Fantaisie</option>
							<option value="3">Histoire</option>
							<option value="3">Horreurs</option>
						</select>
					</div>
				</div>

				<!-- Tableau -->
				<table class="table">
					<thead>
						<tr class="table-warning titre">
							<th scope="col">#</th>
							<th scope="col">Nom du film</th>
							<th scope="col">Durée</th>
							<th scope="col">Date de sortie</th>
							<th scope="col">Synospis</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					  try{
						$pdo = new PDO($dsn, $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
						//$stmt = $pdo->query($sql);
						foreach($pdo->query($sql,PDO::FETCH_ASSOC) as $row ){?>
							<tr>
								
								<th scope="row"><?php echo htmlspecialchars($row['id']); ?></th>
								<td><?php echo htmlspecialchars($row['titre']); ?></td>
								<td><?php echo htmlspecialchars($row['duree']); ?></td>
								<td><?php echo htmlspecialchars($row['date_sortie']); ?></td>
								<td><?php echo htmlspecialchars($row['synopsis']); ?></td>
							</tr>
						<?php }; 
						
					   }catch (PDOException $e){
						 echo $e->getMessage();
					   }
				?>
					</tbody>
				</table>
				
				<nav aria-label="Page navigation example">
					<ul class="pagination">
						<li class="page-item"><a class="page-link" href="#">Précedent</a></li>
						<li class="page-item"><a class="page-link" href="#">1</a></li>
						<li class="page-item"><a class="page-link" href="#">2</a></li>
						<li class="page-item"><a class="page-link" href="#">3</a></li>
						<li class="page-item"><a class="page-link" href="#">Suivant</a></li>
					</ul>
				</nav>
				<!-- Fin tableau -->

				<!-- Footer -->
				<?php
				include "footer.php"
				?>
</body>

</html>
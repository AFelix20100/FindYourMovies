<?php
session_start();
include 'header.php';
include 'connexion.php';
?>

<?php

$host = 'localhost'; //10.50.0.2
$dbname = 'projet';
$username = 'root'; //Felix
$password = ''; //Felix

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
					<h1>Accueil :</h1>
					<p class="mb-4">Vous trouverez ci-dessous la liste des films : </p>
					<!-- DataTales Example -->
					<nav class="navbar navbar-light bg-light">
						<form class="form-inline">
							<input class="form-control mr-sm-2" type="search" placeholder="Rechercher un film..." aria-label="Search">
							<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Valider</button>
						</form>
					</nav>
					<div class="genre" style="text-align:center;">
						<label for="inputState" class="form-label">Genre :</label>
						<select id="genre" name="genre" class="form-select">
							<option selected id="genre" name="genre">Choisir...</option>
							<?php
							$liste_genre = $db->query("SELECT libelle FROM genre");
							foreach ($liste_genre as $unGenre) {
								echo '<option>' . $unGenre['libelle'] . '</option>';
							}
							?>
						</select>
					</div>
				</div>



				<?php
				// On détermine sur quelle page on se trouve
				if (isset($_GET['pages']) && !empty($_GET['pages'])) {
					$currentPage = (int) strip_tags($_GET['pages']);
				} else {
					$currentPage = 1;
				}
				// On se connecte à là base de données

				// On détermine le nombre total d'film
				$sql = 'SELECT COUNT(*) AS nb_film FROM `film`;';

				// On prépare la requête
				$query = $db->prepare($sql);

				// On exécute
				$query->execute();

				// On récupère le nombre d'film$films
				$result = $query->fetch();

				$nbFilm = (int) $result['nb_film'];

				// On détermine le nombre d'film$films par page
				$parPage = 5;

				// On calcule le nombre de pages total
				$pages = ceil($nbFilm / $parPage);

				// Calcul du 1er film$film de la page
				$premier = ($currentPage * $parPage) - $parPage;

				$sql2 = 'SELECT * FROM `film` ORDER BY `id` ASC LIMIT :premier, :parpage;';

				// On prépare la requête
				$query2 = $db->prepare($sql2);

				$query2->bindValue(':premier', $premier, PDO::PARAM_INT);
				$query2->bindValue(':parpage', $parPage, PDO::PARAM_INT);

				// On exécute
				$query2->execute();

				// On récupère les valeurs dans un tableau associatif
				$films = $query2->fetchAll(PDO::FETCH_ASSOC);

				?>

				<div class="row">

					<?php

					$id_film = $db->query("SELECT id, titre FROM film");
					foreach ($id_film as $unFilm) {
						$id_film_img = $unFilm['id'];
						$titre = $unFilm['titre']
						
					?>
						<div class="card col-lg-3 col-sm-2" style="margin:20px; padding:0px;">
							<img src="img/<?= $id_film_img ?>.jpg" class="card-img-top" alt="...">
							<div class="card-body">
								<p class="card-text"><?= $titre ?></p>
							</div>
						</div>
					<?php
					}
					?>
					

				</div>

				

				<section class="col-12">
					<nav>
						<ul class="pagination">
							<!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
							<li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
								<a href="./index.php?page=Accueil&pages=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
							</li>
							<?php for ($page = 1; $page <= $pages; $page++) : ?>
								<!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
								<li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
									<a href="./index.php?page=Accueil&pages=<?= $page ?>" class="page-link"><?= $page ?></a>
								</li>
							<?php endfor ?>
							<!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
							<li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
								<a href="./index.php?page=Accueil&pages=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
							</li>
						</ul>
					</nav>
				</section>


</body>

</html>

<!-- Footer -->
<?php
include "footer.php"
?>
</body>

</html>
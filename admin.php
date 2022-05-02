<?php
session_start();
include 'header.php';
include_once 'connexion.php';
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
					<h1>Administrateur</h1>
					<style>
						* {
							box-sizing: border-box;

						}

						/* Create two equal columns that floats next to each other */
						.column {
							float: left;
							width: 50%;
							padding: 10px;

							/* Should be removed. Only for demonstration */
						}

						/* Clear floats after the columns */
						.row:after {
							content: "";
							display: table;
							clear: both;

						}
					</style>
					</head>

					<body>

						<div class="row" style="padding : 10px;">
							<div class="table-responsive col-auto" style="border: 1rem solid; color:#FD7272;">
								<h2>Liste des films</h2>
									<table class="table table-bordered">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Titre</th>
												<th scope="col">Duree</th>
												<th scope="col">Date de sortie</th>
												<th scope="col">Supprimer</th>
												<th scope="col">Modifier</th>
											</tr>
										</thead>
										<tbody>
											<?php
											try {

												$sql = "SELECT * FROM film";

												//$stmt = $pdo->query($sql);
												foreach ($db->query($sql, PDO::FETCH_ASSOC) as $row) { ?>
													<tr>

														<th scope="row"><?php echo htmlspecialchars($row['id']); ?></th>
														<td><?php echo htmlspecialchars($row['titre']); ?></td>
														<td><?php echo htmlspecialchars($row['duree']); ?></td>
														<td><?php echo htmlspecialchars($row['date_sortie']); ?></td>
														<td><form action="supprimer.php" method="GET">
														<input type = "hidden" name="numero" value=<?= $row['id']?>>
        												<button type="submit" class="btn btn-danger">Supprimer</button>
														</form>
														</td>
														<!--<a class="nav-link" <?= ($page=="Modifier")?"active":"";?> href="index.php?page=Modifier&id=numero"></a> -->
														<input type = "hidden" name="numero" value=<?= $row['id']?>>
														<input type = "hidden" name="titre" value=<?= $row['titre']?>>
														<input type = "hidden" name="duree" value=<?= $row['duree']?>>
														<input type = "hidden" name="datesortie" value=<?= $row['date_sortie']?>>
														<td>
														<a class="btn btn-info" href="index.php?page=Modifier&id=<?= $row['id'] ?>">Modifier</a>
														</td>
														
													</tr>
											<?php };
											} catch (PDOException $e) {
												echo $e->getMessage();
											}
											?>
											
										</tbody>
									</table>
							</div>
							
						</div>
						<div class="table-responsive col-auto" style="border: 1rem solid;color:#FD7272;">
								<h2>Liste des utilisateurs</h2>
								<table class="table table-bordered" >
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">Nom</th>
											<th scope="col">Prénom</th>
											<th scope="col">Adresse mail</th>
											<th scope="col">Privilèges</th>
											<th scope="col">Opération</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql_utilisateur = "SELECT * FROM `utilisateur`";
										$sql_utilisateur2 = "SELECT * FROM `utilisateur`";

										//$stmt = $pdo->query($sql);
										foreach ($db->query($sql_utilisateur, PDO::FETCH_ASSOC) as $row) { ?>
											<tr>

												<th scope="row"><?php echo htmlspecialchars($row['id']); ?></th>
												<td><?php echo htmlspecialchars($row['nom']); ?></td>
												<td><?php echo htmlspecialchars($row['prenom']); ?></td>
												<td><?php echo htmlspecialchars($row['mail']); ?></td>
												<td><?php 
												if ($row['id_role']==1)
												{
													echo htmlspecialchars('Administrateur'); 
												}else
												{
													echo htmlspecialchars('Invité'); 
												};?>
												</td>
												<td>
													<form action="supprimer_utilisateur.php" method="GET">
														<input type="hidden" name="numero" value=<?= $row['id'] ?>>
														<button type="submit" class="btn btn-danger">Supprimer</button>
													</form>
												</td>
											<?php
										}
											?>




									</tbody>
								</table>
							</div>

						<!-- Fin tableau -->

						<!-- Footer -->
						<?php
						include "footer.php"
						?>
					</body>

					</html>
<?php
session_start();
include "header.php";
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
				<h1>Nous contacter :</h1>
					<div class="card text-center">
						<div class="card-header">
							FindYourMovie !
						</div>
						<div class="card-body">
							<h5 class="card-title">Contactez-nous !</h5>
							<p class="card-text">Une question ? Des suggestions ? De l'aide ? N'hésitez pas à nous contacter !</p>
							<a href="mailto:admin@contact.fr" class="btn btn-primary">Contacter</a>
						</div>
						
					</div>
				</div>

				<!-- Tableau -->
				<!-- Fin tableau -->

				<!-- Footer -->
				<?php
				include "footer.php"
				?>
</body>

</html>
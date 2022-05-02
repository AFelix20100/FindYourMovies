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
                    <!DOCTYPE html>
                    <html lang="fr">

                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Document</title>

                        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
                    </head>

                    <body>
                        <main class="container">
                            <div class="row">
                                <section class="col-12">
                                    <h1>Liste des films</h1>
                                    <table class="table">
                                        <thead>
                                            <th>ID</th>
                                            <th>Titre</th>
                                            <th>Synopsis</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($films as $film) {
                                            ?>
                                                <tr>
                                                    <td><?= $film['id'] ?></td>
                                                    <td><?= $film['titre'] ?></td>
                                                    <td><?= $film['synopsis'] ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <nav>
                                        <ul class="pagination">
                                            <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                                            <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                                                <a href="./index.php?page=Pagination&pages=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
                                            </li>
                                            <?php for ($page = 1; $page <= $pages; $page++) : ?>
                                                <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                                                <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                                                    <a href="./index.php?page=Pagination&pages=<?= $page ?>" class="page-link"><?= $page ?></a>
                                                </li>
                                            <?php endfor ?>
                                            <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                                            <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                                                <a href="./index.php?page=Pagination&pages=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </section>
                            </div>
                        </main>
                    </body>

                    </html>
                </div>


                <!-- Fin tableau -->

                <!-- Footer -->
                <?php
                include "footer.php"
                ?>
</body>

</html>
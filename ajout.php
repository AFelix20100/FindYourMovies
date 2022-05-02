<?php
session_start();
include "header.php";
include_once "connexion.php";
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        include "navbar_gauche.php"
        ?>
        <!-- End of Sidebar -->

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
                    <h1>Ajouter un film :</h1>

                    <!-- Page Heading -->
                    <form id="formAjout" name="formAjout" class="row g-3" method="POST" action='./index.php?page=Traitement_ajout' enctype="multipart/form-data">
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Titre du film :</label>
                            <input type="text" class="form-control" id="titre" placeholder="Titanic" name="titre">
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Date de sortie :</label>
                            <input type="text" class="form-control" id="date" placeholder="DD/MM/YYYY" name="date">
                        </div>


                        <div class="col-md-6">
                            <label for="inputAddress" class="form-label">Nom réalisateur :</label>
                            <input type="text" class="form-control" id="realisateurN" placeholder="Nom" name="realisateurN">
                        </div>
                        <div class="col-md-6">
                            <label for="inputAddress" class="form-label">Prénom réalisateur :</label>
                            <input type="text" class="form-control" id="realisateurP" placeholder="Prenom" name="realisateurP">
                        </div>

                        <div class="col-md-6">
                            <label for="inputAddress" class="form-label">Durée :</label>
                            <input type="text" class="form-control" id="duree" placeholder="XXh XXm" name="duree">
                        </div>
                        <div class="col-md-6">
                            <label for="inputAddress" class="form-label">Note :</label>
                            <input type="text" class="form-control" id="note" placeholder="XXh XXm" name="note">
                        </div>

                        <div class="col-md-6">
                            <label for="inputAddress" class="form-label">Budget :</label>
                            <input type="text" class="form-control" id="budget" placeholder="XXh XXm" name="budget">
                        </div>
                        <div class="col-md-6">
                            <label for="inputAddress" class="form-label">Box-office :</label>
                            <input type="text" class="form-control" id="box_office" placeholder="XXh XXm" name="box_office">
                        </div>

                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Synopsis :</label>
                            <input type="text" class="form-control" id="synopsis" placeholder="Écrire quelque chose..." name="synopsis">
                        </div>

                        <div class="col-md-12" style="text-align:center;">
                            <label for="inputState" class="form-label">Genre :</label><br>
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
                        <div class="col-md-12" style="text-align:center;">
                            <h3>Vous ne trouvez pas votre genre ? Écrivez le genre :</h3>
                        </div>
                        <div class="col-md-2" style="text-align:center;">
                            <label for="inputAddress" class="form-label">Saisisez le genre</label>
                            <input type="text" class="form-control" id="new_genre" placeholder="Action" name="new_genre">
                        </div>
                        <br>
                        <div class="col-12" style="justify-content: center;">
                        <input type="file" class="form-control" id="image" name="image" accept="image/png, image/jpeg" />
                        </div>
                        
                        
                        <div class="col-12" style="text-align:center;">
                            <br>
                            <button type="submit" class="btn btn-primary" style="width: 200px;">Ajouter le film</button>
                        </div>
                        

            
                    </form>
                    
                    
                    
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            include_once 'footer.php'
            ?>

</body>

</html>
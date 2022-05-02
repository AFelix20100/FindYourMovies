<?php
include "header.php";
include_once "connexion.php";
?>

<body class="bg-gradient-primary">

    <div class="container">
    <div class="row justify-content-center">
    <img src="logo.png">
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Créer un compte !</h1>
                            </div>
                            <form method ="POST" action="./index.php?page=Creation" class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="nom" name="nom" placeholder="Nom">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="prenom" name="prenom" placeholder="Prénom">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="adresse_mail"  name="adresse_mail" placeholder="Adresse mail">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="mdp1" name="mdp1" placeholder="Mot de passe">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="mdp2" name="mdp2" placeholder="Saisisez à nouveau votre mot de passe">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Créer un compte</a></button>
                            </form>

                            <div class="text-center">
                                <a class="small" href="forgot-password.html" style = "color:#4e73df;">Mot de passe oublié</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="./index.php?page=Login" style = "color:#4e73df;">Vous avez un compte ? Connectez-vous !</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
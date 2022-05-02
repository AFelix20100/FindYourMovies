<?php
include "header.php";
include_once "connexion.php";
?>

<body class="bg-gradient-primary">

    <div class="container">
        
        <!-- Outer Row -->
        <div class="row justify-content-center">
            
            <img src="logo.png">
            <div class="col-xl-10 col-lg-12 col-md-9">
            
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bienvenue !</h1>
                                    </div>
                                    <form method="POST" action="./index.php?page=Connexion" class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="login" name="login" aria-describedby="emailHelp"
                                                placeholder="Entrez votre identifiant...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="mot_de_passe" name="mot_de_passe" placeholder="Entrez votre mot de passe...">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Se connecter automatiquement</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block" style="color:white">Se connecter</button>
                                        
                                    </form>
                                    <form method="POST" action="./index.php?page=Connexion_Invite" class="user" style="padding-top: 10px;">
                                            <button type="submit" class="btn btn-primary btn-user btn-block" style="color:white">Aller en invité</button>
                                        </form>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php" style = "color:#4e73df;">Mot de passe oublié ?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="index.php?page=Register" style = "color:#4e73df;">Créer un compte !</a>
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
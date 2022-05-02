<?php
include "header.php"
?>

<body class="bg-gradient-primary">

    <div class="container">
    <h1 style="color:white; font-size:100px; text-align: center; margin-left:auto; margin-right:auto;"><img src="logo.png">FindYourMovie
        </h1>

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Mot de passe oublié ?</h1>
                                        <p class="mb-4">Pas de panique ! Saisisez votre identifiant ci-dessous :</p>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Entrez un identifiant !">
                                        </div>
                                        <a href="login.html" class="btn btn-primary btn-user btn-block">
                                            Réinitialiser le mot de passe
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Créer un compte</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="login.html">Vous avez dejà un compte ? Connectez-vous  </a>
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
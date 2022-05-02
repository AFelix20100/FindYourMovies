<?php
if (empty($_SESSION['nom'])) 
{?>
<div class="navbar-nav ml-auto">
    <button class="btn btn-primary btn-user btn-block" style="color:white"><a href="./index.php?page=Login" style="color:white;text-decoration:none;">Créer un compte / Se connecter</a></button>
</div>
<?php 
}
else { ?>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['nom'] . "\n" . $_SESSION['prenom'] ?></span>
                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Paramètres
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="./index.php?page=Deconnexion" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Se déconnecter
                </a>
            </div>
        </li>
    </ul>


<?php } ?>
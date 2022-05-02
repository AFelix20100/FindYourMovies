<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <img src="logo.png">

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" <?= ($page=="accueil")?"active":"";?> href="index.php?page=Accueil">
            <i class="fa fa-home" aria-hidden="true"></i>
            <span>Accueil</span></a>
    </li>
    <?php
    if($_SESSION['role'] == 0 or $_SESSION['role']==1)
    { ?>
        <li class="nav-item"><a class="nav-link" <?= ($page=="ajouter")?"active":"";?> href="index.php?page=Ajouter"><i class="fa fa-film" aria-hidden="true"></i><span>Ajouter un film</span></a></li>
   <?php } ?> 
    
    <li class="nav-item">
        <a class="nav-link" <?= ($page=="contacter")?"active":"";?> href="index.php?page=Contacter">
            <i class="fa fa-phone" aria-hidden="true"></i>
            <span>Nous contacter</span></a>
    </li>
    
        
        <?php 
        if($_SESSION['role']==1)
        {
            echo '<li class="nav-item"><a class="nav-link" href="index.php?page=Admin"><i class="fa fa-lock" aria-hidden="true"></i><span>Administration</span></a></li>';
        }
        ?>

            
    
    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
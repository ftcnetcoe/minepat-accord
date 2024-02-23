<?php 
include("libraries/autoload.php");
$database = include('database.php');
$config = include('config.php');
include_once("db.php"); //pour les acc�s direct � la base de donn�es
?>


<!-- ======= Debut Header Desktop ======= -->

<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="#">
                    <img class="img-header" src="new_assets/assets_dashboard/img/logo-white.png" alt="logo-white" />
                </a>
            </div>
            <div class="header__navbar">
                <ul class="list-unstyled">
                    <li class="has-sub">
                            <h3  style="color:white;" class="h3"  >
                            SYSTEME DE GESTION DU SIGMAP -94
                            </h3>
                            <span class="bot-line"></span>
                        
                    </li>
                    
                </ul>
            </div>

            <div class="header__tool">
                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                       <div class="image">
                            <img class="img-header" src="new_assets/assets_dashboard/img/avatar.png" alt="avatar" />
                        </div>
                        <div class="content">
                            <a class="js-acc-btn" href="#">
                                <?PHP
                                    if ($_SESSION['nom']) {
                                        echo "Bienvenue (";
                                        echo $_SESSION['nom'];
                                        echo ")";
                                    }
                                ?>
                            </a>
                        </div>
                        <div class="account-dropdown js-dropdown">
                            <div class="account-dropdown__body">
                            <?php if ($_SESSION['droit'] != $_SESSION['droit_pere']) {
                            	?>
                            	<div class="account-dropdown__item">
                           	 <a href="connexion_choix.php">
                                	<i class="bi bi-arrow-repeat"></i>
                           		     Changer de Profil
                           		 </a>
                      		  </div>
                       		<?php } 
                       		?>
                                <div class="account-dropdown__item">
                                    <a href="./resetpass.php">
                                        <i class="bi bi-arrow-clockwise"></i>
                                        Changer de Mot de Passe
                                    </a>
                                </div>
                            </div>
                            <div class="account-dropdown__footer">
                                <a href="./deconnexion.php">
                                    <i class="bi bi-power"></i>
                                    Déconnexion
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- ======= Fin Header Desktop ======= -->


<!-- ======= Debut Header Mobile ======= -->
<header class="header-mobile header-mobile-2 d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="rh_dashboard.php">
                    <img class="img-header" src="new_assets/assets_dashboard/img/logo-white.png" alt="logo-white" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li class="has-sub">
                    <a class="js-arrow" class="js-arrow" href="admin_dashboard.php">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                    
                </li>                
                
                
            </ul>
        </div>
    </nav>
</header>

<div class="sub-header-mobile-2 d-block d-lg-none">
    <div class="header__tool">
        <div class="account-wrap">
            <div class="account-item account-item--style2 clearfix js-item-menu">
                <div class="image">
                    <img class="img-header" src="new_assets/assets_dashboard/img/avatar.png" alt="avatar" />
                </div>
                <div class="content">
                    <a class="js-acc-btn" href="#">
                        <?PHP
                            if ($_SESSION['nom']) {
                                echo $_SESSION['nom'];
                            }
                        ?>
                    </a>
                </div>
                <div class="account-dropdown js-dropdown">
                    <div class="account-dropdown__body">
                    <?php if ($_SESSION['droit'] != $_SESSION['droit_pere']) {
                            	?>
                            	<div class="account-dropdown__item">
                           	 <a href="connexion_choix.php">
                                	<i class="bi bi-arrow-repeat"></i>
                           		     Changer de Profil
                           		 </a>
                      		  </div>
                       		<?php } 
                       		?>
                        <div class="account-dropdown__item">
                            <a href="resetpass.php">
                                <i class="bi bi-arrow-clockwise"></i>
                                Changer de Mot de Passe
                            </a>
                        </div>
                    </div>
                    <div class="account-dropdown__footer">
                        <a href="deconnexion.php">
                            <i class="bi bi-power"></i>
                            Déconnexion
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ======= Fin Header Mobile ======= -->
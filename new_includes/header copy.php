<?php 
include("libraries/autoload.php");
$database = include('database.php');
$config = include('config.php');
include_once("db.php"); //pour les acc�s direct � la base de donn�es
?>


<!-- ======= Debut Header Desktop ======= -->
<?php if ( $_SESSION['droit']== "RH"){ ?>

<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="rh_dashboard.php">
                    <img class="img-header" src="new_assets/assets_dashboard/img/logo-white.png" alt="logo-white" />
                </a>
            </div>
            <div class="header__navbar">
                <ul class="list-unstyled">
                    <li class="has-sub <?php if (isset($namePagePrincipalRH ) && $namePagePrincipalRH == 'rh_dashboard') { echo "active"; } ?>">
                        <a href="rh_dashboard.php">
                            <i class="bi bi-person-fill-slash"></i>
                            Dashboard
                            <span class="bot-line"></span>
                        </a>
                        <ul class="header3-sub-list list-unstyled">
                            <li>
                                <a href="personnel_dashboard.php">Mon Dashboard</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li class="has-sub <?php if (isset($namePrincipalRH) && $namePrincipalRH == 'discipline') { echo "active"; } ?>">
                        <a href="rh_performance_dashboard.php">
                            <i class="bi bi-person-fill-slash"></i>
                            RH
                            <span class="bot-line"></span>
                        </a>
                        <ul class="header3-sub-list list-unstyled">
                            <li>
                                <a href="rh_sanction.php"> Discipline</a>
                            </li>
                            <li>
                                <a href="rh_discipline_journaliere.php"> Evaluation Journalière</a>
                            </li>
                             <li>
                                <a href="rh_discipline_mensuelle.php"> Evaluation Mensuel</a>
                            </li>
                            <li>
                                <a href="etat_rapport_discipline.php">Rapport</a>
                            </li>
                            
                        </ul>
                    </li>
                    
                    <li class="has-sub <?php if (isset($namePrincipalAd ) && $namePrincipalAd == 'ges_documents') { echo "active"; } ?>">
                        <a href="#">
                            <i class="bi bi-person-video2"></i>
                            Gestion
                            <span class="bot-line"></span>
                        </a>
                        <ul class="header3-sub-list list-unstyled">
                           <li>
                                <a href="ges_courrier.php">Courriers</a>
                            </li>
                            <li>
                                <a href="ges_documents.php">Barbillard - Communication Interne</a>
                            </li>
                            <li>
                                <a href="ges_recomm_annuelle.php">Recommandations Annuelles Générales</a>
                            </li>
                        </ul>
                    </li>

                    <li class="has-sub <?php if (isset($namePrincipalAd ) && $namePrincipalAd == 'reunion') { echo "active"; } ?>">
                        <a href="rh_dashboard_reunion_dg.php">
                            <i class="bi bi-people-fill"></i>
                            Reunion
                            <span class="bot-line"></span>
                        </a>
                        <ul class="header3-sub-list list-unstyled">
                            <li>
                                <a href="rh_dashboard_reunion_a.php">mon Dashbord</a>
                            </li>
                            <li>
                                <a href="rh_progra_reunion.php">Programmation</a>
                            </li>
                            <li>
                                <a href="rh_execution_reunion_a.php">Execution</a>
                            </li>
                            <li>
                                <a href="rh_reunion_type.php">Liste des Réunions</a>
                            </li>
                            <li>
                                <a href="rapport_reunion.php" target="_blank">Rapport</a>
                            </li>
                        </ul>
                    </li>
                    
                    
                    <li class="<?php if (isset($namePageRH) && $namePageRH == 'ca_Dashboard') { echo "active"; } ?>">
                        <a href="budget_fonctionnement.php">
                            <i class="bi bi-currency-dollar"></i>
                            COMPTABILITE
                            <span class="bot-line"></span>
                        </a>
                       
                    </li>
                    
                    
                    
                      <li class="has-sub <?php if (isset($namePrincipalAd ) && $namePrincipalAd == 'suivi') { echo "active"; } ?>">
                        <a href="#">
                            <i class="bi bi-card-checklist"></i>
                            suivi et évaluation
                            <span class="bot-line"></span>
                        </a>
                        <ul class="header3-sub-list list-unstyled">
                            <li>
                                <a href="param_objectif2.php">OBJECTIFS ANNUELS</a>
                            </li>
                           <li>
                                <a href="devisfournisseurs.php">Facture Fournisseur</a>
                           </li>
                            <li>
                                <a href="gac_contrats2.php">GA CONTRATS</a>
                            </li>
                        </ul>
                    </li>
                    <li class="has-sub <?php if (isset($namePrincipalAd ) && $namePrincipalAd == 'tiers') { echo "active"; } ?>">
                        <a href="#">
                            <i class="bi bi-person-video2"></i>
                            Tiers
                            <span class="bot-line"></span>
                        </a>
                        <ul class="header3-sub-list list-unstyled">
                           
                            <li>
                                <a href="fourniss.php">Fournisseurs</a>
                            </li>
                            <li>
                                <a href="clients.php">Clients</a>
                            </li>
                            <li>
                                <a href="financier.php">Financiers</a>
                            </li>
                            <li>
                            	<a href="partenaire.php">Partenaires Groupement</a>
                           </li>
                        </ul>
                    </li>
                    <li class="has-sub <?php if (isset($namePrincipalAd ) && $namePrincipalAd == 'paramettrage') { echo "active"; } ?>">
                        <a href="#">
                            <i class="bi bi-person-video2"></i>
                            Paramettrage
                            <span class="bot-line"></span>
                        </a>
                        <ul class="header3-sub-list list-unstyled">
                           
                            <li>
                                <a href="gl_projet_fonctionnement.php">Projet</a>
                            </li>
                            <li>
                                <a href="param_programme.php">Programme</a>
                            </li>
                            <li>
                                <a href="gl_personnel.php">Personnels</a>
                            </li>
                            <li>
                            	<a href="rh_organigramme.php">Organigramme</a>
                           </li>
                        </ul>
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
                    <a class="js-arrow" class="js-arrow" href="rh_dashboard.php">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="personnel_dashboard.php">mon dashboard</a>
                        </li>
                    </ul>
                </li>                
                <li class="has-sub">
                    <a class="js-arrow" class="js-arrow" href="rh_performance_dashboard.php">
                        <i class="bi bi-speedometer2"></i>
                        RH
                    </a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                            <li>
                                <a href="rh_sanction.php"> Discipline</a>
                            </li>
                            <li>
                                <a href="rh_discipline_journaliere.php"> Evaluation Journalière</a>
                            </li>
                             <li>
                                <a href="rh_discipline_mensuelle.php"> Evaluation Mensuel</a>
                            </li>
                            <li>
                                <a href="etat_rapport_discipline.php">Rapport</a>
                            </li>
                    </ul>
                </li> 
                <li class="has-sub">
                    <a class="js-arrow" class="js-arrow" href="#">
                        <i class="bi bi-speedometer2"></i>
                        Gestion
                    </a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                            <li>
                                <a href="ges_courrier.php">Courriers</a>
                            </li>
                            <li>
                                <a href="ges_documents.php">Barbillard - Communication Interne</a>
                            </li>
                            <li>
                                <a href="ges_recomm_annuelle.php">Recommandations Annuelles Générales</a>
                            </li>
                    </ul>
                </li> 
                <li class="has-sub">
                    <a class="js-arrow" class="js-arrow" href="rh_dashboard_reunion_dg.php">
                        <i class="bi bi-speedometer2"></i>
                        Reunion
                    </a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                            <li>
                                <a href="rh_dashboard_reunion_a.php">mon Dashbord</a>
                            </li>
                            <li>
                                <a href="rh_progra_reunion.php">Programmation</a>
                            </li>
                            <li>
                                <a href="rh_execution_reunion_a.php">Execution</a>
                            </li>
                            <li>
                                <a href="rh_reunion_type.php">Liste des Réunions</a>
                            </li>
                            <li>
                                <a href="rapport_reunion.php" target="_blank">Rapport</a>
                            </li>
                    </ul>
                </li>
                
                <li>
                    <a href="budget_fonctionnement.php">
                        <i class="bi bi-speedometer2"></i>
                        Comptabilité
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



<?php }

 
 
 if ( $_SESSION['droit']== "adrde"){ ?>
 <!-- ======= Debut Header Desktop ======= -->

<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="rh_dashboard_reunion_drde.php">
                    <img class="img-header" src="new_assets/assets_dashboard/img/logo-white.png" alt="logo-white" />
                </a>
            </div>
            <div class="header__navbar">
                <ul class="list-unstyled">
                    <li class="<?php if (isset($namePage) && $namePage == 'rh_dashboard_reunion_drde') { echo "active"; } ?>">
                        <a href="rh_dashboard_reunion_drde.php">
                            <i class="bi bi-speedometer2"></i>
                            Dashboard
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    
                    <li class="<?php if (isset($namePage) && $namePage== 'personnel_dashboard') { echo "active"; } ?>">
                        <a href="personnel_dashboard.php">
                            <i class="bi bi-speedometer2"></i>
                            Mon Dashboard
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="has-sub <?php if (isset($namePrincipalAd ) && $namePrincipalAd == 'reunion') { echo "active"; } ?>">
                        <a href="rh_dashboard_reunion_a.php">
                            <i class="bi bi-people-fill"></i>
                            Reunion
                            <span class="bot-line"></span>
                        </a>
                        <ul class="header3-sub-list list-unstyled">
                            <li>
                                <a href="rh_execution_reunion_a.php">Execution</a>
                            </li>
                        </ul>
                    </li>
                    
                   <li class="has-sub <?php if (isset($namePage) && $namePrincipale == 'prod') { echo "active"; } ?>">
                        <a href="prod_tout_sprint.php">
                            <i class="bi bi-airplane-engines"></i>
                            PRODUCTION
                            <span class="bot-line"></span>
                        </a> 
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
                <a class="logo" href="rh_dashboard_reunion_drde.php">
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
                    <a class="js-arrow" class="js-arrow" href="rh_dashboard_reunion_a.php">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="personnel_dashboard.php">mon dashboard</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="rh_dashboard_reunion_a.php">
                        <i class="bi bi-speedometer2"></i>
                        Gestion des Réunions
                    </a>
                </li>
                <li class="has-sub">
                    <a   href="prod_tout_sprint.php">
                        <i class="bi bi-graph-up-arrow"></i>
                        Production
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
<?php }

 
 
 if ( $_SESSION['droit']== "uee"){ ?>
 
 
 <!-- ======= Debut Header Desktop ======= -->

<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="ekio_dashboard.php">
                    <img class="img-header" src="new_assets/assets_dashboard/img/logo-white.png" alt="logo-white" />
                </a>
            </div>
            <div class="header__navbar">
                <ul class="list-unstyled">
                    <li class="<?php if (isset($namePage) && $namePage == 'ekio_dashboard') { echo "active"; } ?>">
                        <a href="ekio_dashboard.php">
                            <i class="bi bi-speedometer2"></i>
                            Dashboard
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    
                    <li class="<?php if (isset($namePage) && $namePage== 'personnel_dashboard') { echo "active"; } ?>">
                        <a href="personnel_dashboard.php">
                            <i class="bi bi-speedometer2"></i>
                            Mon Dashboard
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="has-sub <?php if (isset($namePage) && $namePage == 'ekio_editeur') { echo "active"; } ?>">
                        <a href="ekio_editeur.php">
                            <i class="bi bi-pencil-square"></i>
                            Gestion des editeurs
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="has-sub <?php if (isset($namePage) && $namePage == 'ekio_abo') { echo "active"; } ?>">
                        <a href="ekio_abo.php">
                            <i class="bi bi-people-fill"></i>
                            gestion des Abonements
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="has-sub <?php if (isset($namePage) && $namePage == 'ekio_vente') { echo "active"; } ?>">
                        <a href="ekio_vente.php">
                            <i class="bi bi-shop"></i>
                            gestion des Ventes
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="has-sub <?php if (isset($namePrincipal) && $namePrincipal == 'ekio') { echo "active"; } ?>">
                        <a href="#">
                            <i class="bi bi-piggy-bank"></i>
                            Commercialisation
                            <span class="bot-line"></span>
                        </a>
                         <ul class="header3-sub-list list-unstyled">
                             <li><a href="cooporate.php"> <span class="ms-4">Cooparate </span></a></li>
                             <li><a href="cooporate_analitics.php"> <span class="ms-4">Cooporate Analitics </span></a></li>
                             <li><a href="cooporate_cibles.php"> <span class="ms-4">Cooporate Cibles </span></a></li>
                             <li><a href="cooporate_clients.php"> <span class="ms-4">Cooporate Clients</span></a></li>
                             <li><a href="cooporate_prospects.php"> <span class="ms-4">Cooporate prospects </span></a></li>
                        </ul>
                        
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
                <a class="logo" href="rh_dashboard_reunion_drde.php">
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
                    <a class="js-arrow" class="js-arrow" href="ekio_dashboard.php">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="personnel_dashboard.php">mon dashboard</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="ekio_editeur.php">
                        <i class="bi bi-speedometer2"></i>
                        gestion des editeurs
                    </a>
                </li>
                <li class="has-sub">
                    <a  href="ekio_abo.php">
                        <i class="bi bi-people-fill"></i>
                        gestion des abonnements
                    </a>
                </li>
                <li class="has-sub">
                    <a   href="cooporate.php">
                        <i class="bi bi-diagram-3-fill"></i>
                       Cooporate
                    </a>
                </li> 
                <li class="has-sub">
                    <a   href="cooporate_analitics.php">
                        <i class="bi bi-graph-up-arrow"></i>
                        Cooporate Analitics
                    </a>
                </li> 
                <li class="has-sub">
                    <a   href="cooporate_clients.php">
                        <i class="bi bi-graph-up-arrow"></i>
                        Cooporate Clients
                    </a>
                </li> 
                <li class="has-sub">
                    <a   href="cooporate_cible.php">
                        <i class="bi bi-graph-up-arrow"></i>
                        Cooporate Cibles
                    </a>
                </li>
                <li class="has-sub">
                    <a   href="cooporate_prospects.php">
                        <i class="bi bi-graph-up-arrow"></i>
                        Cooporate Prospects
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
<?php }

 
 
 if ( $_SESSION['droit']== "gestionnaire"){ ?>
 
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
                
                    <li class="<?php if (isset($namePage) && $namePage== 'personnel_dashboard') { echo "active"; } ?>">
                        <a href="personnel_dashboard.php">
                            <i class="bi bi-speedometer2"></i>
                            Dashboard
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="has-sub <?php if (isset($namePage) && $namePage == 'clients') { echo "active"; } ?>">
                        <a href="clients.php">
                            <i class="bi bi-people-fill"></i>
                            Clients
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="has-sub <?php if (isset($namePage) && $namePage == 'prod_execution') { echo "active"; } ?>">
                        <a href="prod_execution.php">
                            <i class="bi bi-diagram-3-fill"></i>
                            Execution des Projets
                            <span class="bot-line"></span>
                        </a>
                    </li>
                     <li class="has-sub <?php if (isset($namePrincipal ) && $namePrincipal == 'devis') { echo "active"; } ?>">
                        <a href="#">
                            <i class="bi bi-speedometer2"></i>
                           Fournisseurs
                            <span class="bot-line"></span>
                        </a>
                        <ul class="header3-sub-list list-unstyled">
                            
                          
                            <li>
                            	<a href="fourniss.php">Fournisseurs</a>
                           </li>
                           <li>
                                <a href="devisfournisseurs.php">Facture Fournisseur</a>
                           </li>
                        </ul>
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
                <a class="logo" href="rh_dashboard_reunion_drde.php">
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
            <li >
                    <a href="personnel_dashboard.php">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="devisfournisseurs.php">
                        <i class="bi bi-speedometer2"></i>
                        Devis Fournisseurs
                    </a>
                </li>
                <li>
                    <a href="clients.php">
                        <i class="bi bi-speedometer2"></i>
                       Clients
                    </a>
                </li>
                <li class="has-sub">
                    <a href="fourniss.php">
                        <i class="bi bi-people-fill"></i>
                        Fournisseurs
                    </a>
                </li>
                <li class="has-sub">
                    <a   href="prod_execution.php">
                        <i class="bi bi-diagram-3-fill"></i>
                        Execution des Projet
                    </a>
                </li> 
                <li class="has-sub">
                    <a   href="mesprojets.php">
                        <i class="bi bi-graph-up-arrow"></i>
                        MES Projets
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
<?php }

 
 
 if ( $_SESSION['droit']== "superviseur"){ ?>
 
 
 <!-- ======= Debut Header Desktop ======= -->

<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="prod_dashboard.php">
                    <img class="img-header" src="new_assets/assets_dashboard/img/logo-white.png" alt="logo-white" />
                </a>
            </div>
            <div class="header__navbar">
                <ul class="list-unstyled">
                
                    <li class="has-sub">
                    <a class="js-arrow" class="js-arrow" href="prod_dashboard.php">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="personnel_dashboard.php">mon dashboard</a>
                        </li>
                    </ul>
                </li>
                    
                    
                    <li class="has-sub <?php if (isset($namePage) && $namePage == 'clients') { echo "active"; } ?>">
                        <a href="clients.php">
                            <i class="bi bi-people-fill"></i>
                            Clients
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="has-sub <?php if (isset($namePage) && $namePage == 'param_objectif') { echo "active"; } ?>">
                        <a href="param_objectif.php">
                            <i class="bi bi-diagram-3-fill"></i>
                            Objectifs Annuels
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="has-sub <?php if (isset($namePrincipal ) && $namePrincipal == 'devis') { echo "active"; } ?>">
                        <a href="#">
                            <i class="bi bi-speedometer2"></i>
                           Fournisseurs
                            <span class="bot-line"></span>
                        </a>
                        <ul class="header3-sub-list list-unstyled">
                         
                            <li>
                            	<a href="fourniss.php">Fournisseurs</a>
                           </li>
                           <li>
                                <a href="devisfournisseurs.php">Facture Fournisseur</a>
                           </li>
                        </ul>
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
                <a class="logo" href="rh_dashboard_reunion_drde.php">
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
                    <a class="js-arrow" class="js-arrow" href="prod_dashboard.php">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="personnel_dashboard.php">mon dashboard</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a   href="clients.php">
                        <i class="bi bi-people-fill"></i>
                        Clients
                    </a>
                </li>
                <li class="has-sub">
                    <a   href="param_objectif.php">
                        <i class="bi bi-people-fill"></i>
                        Objectif Annuels
                    </a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" class="js-arrow" href="#">
                        <i class="bi bi-speedometer2"></i>
                        Fournisseurs
                    </a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="fourniss.php">Fournisseurs</a>
                        </li>
                        <li>
                            <a href="devisfournisseurs.php">Facture Fournisseur</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a   href="prod_dashboard.php">
                        <i class="bi bi-graph-up-arrow"></i>
                        Production
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
<?php }

 
 
 if ( $_SESSION['droit']== "planification"){ ?>
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
                
                    <li class="<?php if (isset($namePage) && $namePage== 'personnel_dashboard') { echo "active"; } ?>">
                        <a href="personnel_dashboard.php">
                            <i class="bi bi-speedometer2"></i>
                            Dashboard
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="<?php if (isset($namePage) && $namePage == 'prod_planification') { echo "active"; } ?>">
                        <a href="prod_planification.php">
                            <i class="bi bi-speedometer2"></i>
                            Planification des Projets
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="has-sub <?php if (isset($namePage) && $namePage == 'dao_attribution') { echo "active"; } ?>">
                        <a href="dao_attribution.php">
                            <i class="bi bi-people-fill"></i>
                            Attribution des Marchés
                            <span class="bot-line"></span>
                        </a>
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
                <a class="logo" href="rh_dashboard_reunion_drde.php">
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
                    <a   href="personnel_dashboard.php">
                        <i class="bi bi-people-fill"></i>
                        Mon Dashboard
                    </a>
                </li>
                <li class="has-sub">
                    <a   href="prod_planification.php">
                        <i class="bi bi-people-fill"></i>
                        Planification des Projets
                    </a>
                </li>
                <li class="has-sub">
                    <a   href="dao_attribution.php">
                        <i class="bi bi-diagram-3-fill"></i>
                        Attribution des Marchés
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
<?php }

 
 
 if ( $_SESSION['droit']== "sdcao"){ ?>
  <!-- ======= Debut Header Desktop ======= -->

<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="rh_dashboard_reunion_dcao.php">
                    <img class="img-header" src="new_assets/assets_dashboard/img/logo-white.png" alt="logo-white" />
                </a>
            </div>
            <div class="header__navbar">
                <ul class="list-unstyled">
                    <li class="has-sub <?php if (isset($namePrincipalAd ) && $namePrincipalAd == 'reunion') { echo "active"; } ?>">
                        <a href="rh_dashboard_reunion_a.php">
                            <i class="bi bi-people-fill"></i>
                            Reunion
                            <span class="bot-line"></span>
                        </a>
                        <ul class="header3-sub-list list-unstyled">
                            <li>
                                <a href="rh_execution_reunion_a.php">Execution</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="<?php if (isset($namePage) && $namePage== 'personnel_dashboard') { echo "active"; } ?>">
                        <a href="personnel_dashboard.php">
                            <i class="bi bi-speedometer2"></i>
                            Mon Dashboard
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="<?php if (isset($namePage) && $namePage == 'marche_valide') { echo "active"; } ?>">
                        <a href="dao_marche_valide.php">
                            <i class="bi bi-speedometer2"></i>
                            Marchés Validés
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="has-sub <?php if (isset($namePage) && $namePage == 'dao_attribution') { echo "active"; } ?>">
                        <a href="dao_attribution.php">
                            <i class="bi bi-people-fill"></i>
                            Attribution des Marchés
                            <span class="bot-line"></span>
                        </a>
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
                                <?php
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
                <a class="logo" href="rh_dashboard_reunion_dcao.php">
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
                <li>
                    <a href="rh_dashboard_reunion_a.php">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="has-sub">
                    <a   href="rh_execution_reunion_a.php">
                        <i class="bi bi-people-fill"></i>
                        GEstion des Reunions
                    </a>
                </li>
                <li class="has-sub">
                    <a   href="dao_marche_valide.php">
                        <i class="bi bi-diagram-3-fill"></i>
                        Marchés Validés
                    </a>
                </li> 
                <li class="has-sub">
                    <a   href="dao_attribution.php">
                        <i class="bi bi-graph-up-arrow"></i>
                       Attribution des Marchés
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
<?php }

 
 
 if ( $_SESSION['droit']== "sdao"){ ?>
  <!-- ======= Debut Header Desktop ======= -->
 
<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="personnel_dashboard.php">
                    <img class="img-header" src="new_assets/assets_dashboard/img/logo-white.png" alt="logo-white" />
                </a>
            </div>
            <div class="header__navbar">
                <ul class="list-unstyled">
                
                    <li class="<?php if (isset($namePage) && $namePage== 'personnel_dashboard') { echo "active"; } ?>">
                        <a href="personnel_dashboard.php">
                            <i class="bi bi-speedometer2"></i>
                            Mon Dashboard
                            <span class="bot-line"></span>
                        </a>
                    </li>
                
                <li class="has-sub <?php if (isset($namePrincipalSdao) && $namePrincipalSdao == 'expert') { echo "active"; } ?>">
                        <a href="#">
                            <i class="bi bi-speedometer2"></i>
                            Gestions des Experts
                            <span class="bot-line"></span>
                        </a>
                        <ul class="header3-sub-list list-unstyled">
                            <li>
                                <a href="com_expert.php">Experts</a>
                            </li>
                            <li>
                                <a href="expert_diplome.php">Diplomes</a>
                            </li>
                            <li>
                                <a href="expert_cv.php">Les CV</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="<?php if (isset($namePage) && $namePage == 'montage') { echo "active"; } ?>">
                        <a href="dao_montage.php">
                            <i class="bi bi-speedometer2"></i>
                            Montages des Marchés
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="has-sub <?php if (isset($namePage) && $namePage == 'com_ref') { echo "active"; } ?>">
                        <a href="com_ref.php">
                            <i class="bi bi-people-fill"></i>
                            Réferences
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    
                    <li class="has-sub <?php if (isset($namePrincipalAd ) && $namePrincipalAd == 'reunion') { echo "active"; } ?>">
                        <a href="rh_dashboard_reunion_a.php">
                            <i class="bi bi-people-fill"></i>
                            Reunion
                            <span class="bot-line"></span>
                        </a>
                        <ul class="header3-sub-list list-unstyled">
                            <li>
                                <a href="rh_execution_reunion_a.php">Execution</a>
                            </li>
                        </ul>
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
                                <?php
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
                <a class="logo" href="dashboard.php">
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
                <li>
                    <a href="#">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="has-sub">
                    <a   href="dao_montage.php">
                        <i class="bi bi-diagram-3-fill"></i>
                        Montages des Marchés
                    </a>
                </li>
                <li class="has-sub">
                    <a   href="com_expert.php">
                        <i class="bi bi-people-fill"></i>
                        Experts
                    </a>
                </li>
                <li class="has-sub">
                    <a   href="expert_diplome.php">
                        <i class="bi bi-diagram-3-fill"></i>
                        Diplomes
                    </a>
                </li> 
                <li class="has-sub">
                    <a   href="expert_cv.php">
                        <i class="bi bi-diagram-3-fill"></i>
                        Les CV
                    </a>
                </li> 
                <li class="has-sub">
                    <a   href="com_ref.php.php">
                        <i class="bi bi-graph-up-arrow"></i>
                       References
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
<?php }

 
 if ( $_SESSION['droit']== "dcao"){ ?>
  <!-- ======= Debut Header Desktop ======= -->
  
  
<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="dao_dashboard.php">
                    <img class="img-header" src="new_assets/assets_dashboard/img/logo-white.png" alt="logo-white" />
                </a>
            </div>
            <div class="header__navbar">
                <ul class="list-unstyled">
                    <li class="<?php if (isset($namePage) && $namePage == 'dao_dashboard') { echo "active"; } ?>">
                        <a href="dao_dashboard.php">
                            <i class="bi bi-speedometer2"></i>
                            DASHBOARD
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="<?php if (isset($namePage) && $namePage== 'personnel_dashboard') { echo "active"; } ?>">
                        <a href="personnel_dashboard.php">
                            <i class="bi bi-speedometer2"></i>
                            Mon Dashboard
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="<?php if (isset($namePage) && $namePage == 'soumissionaire') { echo "active"; } ?>">
                        <a href="dao_soumissionnaire.php">
                            <i class="bi bi-speedometer2"></i>
                            Soumissionaires
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="has-sub <?php if (isset($namePage) && $namePage == 'depouillement') { echo "active"; } ?>">
                        <a href="dao_depouillement.php">
                            <i class="bi bi-people-fill"></i>
                            Dépouillement
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="<?php if (isset($namePage) && $namePage == 'marche_valide') { echo "active"; } ?>">
                        <a href="dao_marche_valide.php">
                            <i class="bi bi-speedometer2"></i>
                            Marchés Validés
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="<?php if (isset($namePage) && $namePage == 'dao_attribution.php') { echo "active"; } ?>">
                        <a href="dao_attribution.php">
                            <i class="bi bi-speedometer2"></i>
                            Attributions des Marchés
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="<?php if (isset($namePage) && $namePage == 'montage') { echo "active"; } ?>">
                        <a href="dao_montage.php">
                            <i class="bi bi-speedometer2"></i>
                            Montages des Marchés
                            <span class="bot-line"></span>
                        </a>
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
                                <?php
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
                <a class="logo" href="dashboard.php">
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
                <li>
                    <a href="dao_dashboard.php">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="has-sub">
                    <a   href="dao_attribution.php">
                        <i class="bi bi-people-fill"></i>
                        Attributions des Marchés
                    </a>
                </li>
                <li class="has-sub">
                    <a   href="dao_soumissionnaire.php">
                        <i class="bi bi-diagram-3-fill"></i>
                        Soumissionaires
                    </a>
                </li> 
                <li class="has-sub">
                    <a   href="dao_marche_valide.php">
                        <i class="bi bi-graph-up-arrow"></i>
                       Marchés Validés
                    </a>
                <li class="has-sub">
                    <a   href="dao_montage.php">
                        <i class="bi bi-diagram-3-fill"></i>
                        Montages des Marchés
                    </a>
                </li> 
                <li class="has-sub">
                    <a   href="dao_depouillement.php">
                        <i class="bi bi-graph-up-arrow"></i>
                       Dépouillement des Marchés
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
<?php }

 
 
 if ( $_SESSION['droit']== "tresorerie"){ ?>
  <!-- ======= Debut Header Desktop ======= -->

<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="rh_dashboard_reunion_daaf.php">
                    <img class="img-header" src="new_assets/assets_dashboard/img/logo-white.png" alt="logo-white" />
                </a>
            </div>
            <div class="header__navbar">
                <ul class="list-unstyled">
                    <li class="<?php if (isset($namePage) && $namePage == 'rh_dashboard_reunion_daaf') { echo "active"; } ?>">
                        <a href="rh_dashboard_reunion_daaf.php">
                            <i class="bi bi-speedometer2"></i>
                            Dashboard
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="<?php if (isset($namePage) && $namePage== 'personnel_dashboard') { echo "active"; } ?>">
                        <a href="personnel_dashboard.php">
                            <i class="bi bi-speedometer2"></i>
                            Mon Dashboard
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    
                    <li class="has-sub <?php if (isset($namePagePrincipal) && $namePagePrincipal == 'rh_resolution_reunion_daaf') { echo "active"; } ?>">
                        <a href="rh_dashboard_reunion_daaf.php">
                            <i class="bi bi-people-fill"></i>
                            Réunions
                            <span class="bot-line"></span>
                        </a>
                         <ul class="header3-sub-list list-unstyled">
                              <li> <a href="rh_execution_reunion_daaf.php"> Execution de reunion</a>   </li>
                        </ul>     
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
                                <?php
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
                <a class="logo" href="dashboard.php">
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
                <li>
                    <a href="rh_dashboard_reunion_daaf.php">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="has-sub">
                    <a   href="rh_progra_reunion_daaf.php#">
                        <i class="bi bi-people-fill"></i>
                        Programmation de reunion
                    </a>
                </li>
                <li class="has-sub">
                    <a   href="rh_exe_reunion_daaf.php">
                        <i class="bi bi-diagram-3-fill"></i>
                        Execution de réunion
                    </a>
                </li> 
                <li class="has-sub">
                    <a   href="rh_resolution_reunion_daaf.php">
                        <i class="bi bi-graph-up-arrow"></i>
                        Suivi de recommendation
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

<?php }
 
 
 if ( $_SESSION['droit']== "admin"){ ?>
 
 
<!-- ======= Debut Header Desktop ======= -->

<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="admin_dashboard.php">
                    <img class="img-header" src="new_assets/assets_dashboard/img/logo-white.png" alt="logo-white" />
                </a>
            </div>
            <div class="header__navbar"> 
                 <ul class="list-unstyled">
                 <li class="<?php if (isset($namePage) && $namePage== 'personnel_dashboard') { echo "active"; } ?>">
                        <a href="personnel_dashboard.php">
                            <i class="bi bi-speedometer2"></i>
                            Mon Dashboard
                            <span class="bot-line"></span>
                        </a>
                    </li>
                     <li class="has-sub <?php if (isset($namePage) && $namePrincipal == 'gestion') { echo "active"; } ?>">
                        <a href="ges_dashboard.php">
                            <i class="bi bi-dpad-fill"></i>
                            GESTION
                            <span class="bot-line"></span>
                        </a>
                        <ul class="header3-sub-list list-unstyled">
                            <li><a href="ges_courriers_dashboard.php">Gestion des Courriers</a></li>
                               <li><a href="ges_courrier.php"> <span class="ms-4">Gestion des Courriers </span></a></li>
                            <li>
                              <a href="rh_dashboard_reunion_dg.php">GESTION des Réunions</a>
                                 <li><a href="rh_progra_reunion.php"> <span class="ms-4">Programmation </span></a></li>
                                 <li><a href="rh_execution_reunion.php"><span class="ms-4">Exécution </span></a></li>
                                <li><a href="rapport_reunion.php" target="_blank"><span class="ms-4">Rapport</span></a></li>
                                 
                            </li>
                            
                            <li><a href="ges_documents.php">Barbillard - Communication Interne</span></a></li>
                            <li><a href="ges_recomm_annuelle.php">Recommandations Annuelles Générales</span></a></li>
                            <li><a href="404_ges.php"> Gestion des objectifs </a></li>
                            <li><a href="404_ges.php"> Gestion du Calendrier </a></li>
                        </ul>
                        
                    </li>
                   
                    <li class="has-sub <?php if (isset($namePage) && $namePrincipal == 'RH') { echo "active"; } ?>">
                        <a href="rh_performance_dashboard.php">
                            <i class="bi bi-person-bounding-box"></i>
                            RH
                            <span class="bot-line"></span>
                        </a>
                         <ul class="header3-sub-list list-unstyled">
                              	
                             <li><a href="rh_sanction.php"> Discipline</a></li>  
                             <li><a href="rh_discipline_journaliere.php"> Evaluation Journalière</a></li>
                             <li><a href="rh_discipline_mensuelle.php">Evaluation Mensuel</a></li>
                             <li><a href="etat_rapport_discipline.php"> Rapport</a></li>
                                
                              </li>
                        </ul>     
                    </li>
      
                    <li class="<?php if (isset($namePage) && $namePage == 'ca_Dashboard') { echo "active"; } ?>">
                        <a href="ca_dashboard.php">
                            <i class="bi bi-currency-dollar"></i>
                            COMPTABILITE
                            <span class="bot-line"></span>
                        </a>
                       
                    </li>
                  
                     <li class="has-sub  <?php if (isset($namePage) && $namePrincipalAdmin == 'dao') { echo "active"; } ?>">
                        <a href="dao_dashboard.php">
                            <i class="bi bi-shop-window"></i>
                            DCAO
                            <span class="bot-line"></span>
                        </a>
                           <ul class="header3-sub-list list-unstyled">
                            <li> <a href="dao_soumissionnaire.php">Soumissionnaires</a></li>
                            <li><a href="dao_depouillement.php">Depouillement du marché</a></li>
                            <li><a href="dao_marche_valide.php">Marchés validés</a></li>
                            <li><a href="dao_attribution.php">Atribution des Marchés</a></li>
                            <li><a href="dao_montage.php">Montages des Marchés</a> </li>
                            <li><a href="dao_reference.php"> Reférences</a> </li> 
                            <li><a href="com_expert.php">Gestion des experts</a></li>
                            <li> <a href="com_agreement.php">Gestion des Agreement</a></li>
                        </ul>
                    </li>
                    
                     
                    
                     <li class="has-sub <?php if (isset($namePage) && $namePrincipale == 'prod') { echo "active"; } ?>">
                        <a href="prod_dashboard.php">
                            <i class="bi bi-airplane-engines"></i>
                            PRODUCTION
                            <span class="bot-line"></span>
                        </a> 
                    </li>
                     
                    
                    
                    <li class="has-sub <?php if (isset($namePrincipalA ) && $namePrincipalA == 'tiers') { echo "active"; } ?>">
                        <a href="#">
                            <i class="bi bi-newspaper"></i>
                            TIERS
                            <span class="bot-line"></span>
                        </a>
                         <ul class="header3-sub-list list-unstyled">
                            
                            <li><a href="fourniss.php">Fournisseurs</a></li>
                            <li><a href="clients.php">Clients</a></li>
                            <li><a href="financier.php">Financiers</a></li>
                             <li><a href="404.php">Partenaires Groupement</a></li>
                        </ul>
                        
                    </li>
                   
                    <li class="has-sub <?php if (isset($namePrincipal
                    ) && $namePrincipalAdmin == 'ekio') { echo "active"; } ?>">
                        <a href="ekio_dashboard.php">
                            <i class="bi bi-newspaper"></i>
                            EKIOSQUE
                            <span class="bot-line"></span>
                        </a>
                         <ul class="header3-sub-list list-unstyled">
                            <li><a href="ekio_abo.php">Gestion Abonnements</a></li>
                            <li><a href="ekio_editeur.php">Gestion Editeurs</a></li>
                            <li><a href="ekio_vente.php">Gestion des Ventes</a></li>
                            <li><a href="#">Gestion Commercialisation</a></li>
                             <li><a href="cooporate.php"> <span class="ms-4">Cooporate </span></a></li>
                             <li><a href="cooporate_analitics.php"> <span class="ms-4">Cooporate Analitics </span></a></li>
                             <li><a href="cooporate_cibles.php"> <span class="ms-4">Cooporate Cibles </span></a></li>
                             <li><a href="cooporate_clients.php"> <span class="ms-4">Cooporate Clients</span></a></li>
                             <li><a href="cooporate_prospects.php"> <span class="ms-4">Cooporate prospects </span></a></li>
                        </ul>
                        
                    </li>
                    
                     <li class="has-sub <?php if (isset($namePrincipalAdmin) && $namePrincipalAdmin == 'param') { echo "active"; } ?>">
                        <a href="admin_dashboard.php">
                            <i class="bi bi-wrench-adjustable-circle-fill"></i>
                            PARAMETRAGE
                            <span class="bot-line"></span>
                        </a>
                          <ul class="header3-sub-list list-unstyled">
                            <li><a href="gl_projet_fonctionnement.php">Projets</a></li>
                            <li><a href="param_programme.php">Programmes</a></li>
                            <li> <a href="gl_personnel.php"> Personnels  </a>   </li>
                            <li><a href="rh_organigramme.php"> Organigramme </a>   </li>
                            <li><a href="param_objectif2.php">Objectifs Annuels</a></li>
                            <li><a href="ca_journal.php">Jounaux</a></li>
                            <li><a href="ca_comptes.php">Plan Comptable</a></li>
                            <li><a href="ca_solde_ini.php">Soldes Initiaux</a></li>
                            
                        </ul>
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
                                <?php
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

<!-- ======= Debut Header Mobile ======= -->
<header class="header-mobile header-mobile-2 d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="admin_dashboard.php">
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
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="personnel_dashboard.php">mon dashboard</a>
                        </li>
                    </ul>
                </li>
            <li class="has-sub">
                        <a href="#">
                            <i class="bi bi-dpad-fill"></i>
                            Gestion
                            <span class="bot-line"></span>
                        </a>
                        <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                            <li>
                                <a href="ges_courriers_dashboard.php">Courriers</a>
                            
	                            <li>
	                                <a href="ges_courrier.php"><span class="ms-4">Gestion des Courriers</span></a>
	                            </li>
                            </li>
                            <li>
                              <a href="rh_dashboard_reunion_dg.php">GESTION des Réunions</a>
                                 <li><a href="rh_progra_reunion.php"> <span class="ms-4">Programmation </span></a></li>
                                 <li><a href="rh_execution_reunion.php"><span class="ms-4">Exécution </span></a></li>
                                <li><a href="rapport_reunion.php" target="_blank"><span class="ms-4">Rapport</span></a></li>
                                 
                            </li>
                            
                            <li><a href="ges_documents.php">Barbillard - Communication Interne</span></a></li>
                            <li><a href="ges_recomm_annuelle.php">Recommandations Annuelles Générales</span></a></li>
                            <li><a href="404_ges.php"> Gestion du Calendrier </a></li>
                        </ul>
                    </li>
                    <li class="has-sub <?php if (isset($namePrincipal) && $namePrincipal == 'RH') { echo "active"; } ?>">
                        <a class="js-arrow"  href="rh_performance_dashboard.php">
                            <i class="bi bi-people-fill"></i>
                            RH
                            <span class="bot-line"></span>
                        </a>
                        <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                           
                             <li><a href="rh_sanction.php"> Discipline</a></li>  
                             <li><a href="rh_discipline_journaliere.php"> Evaluation Journalière</a></li>
                             <li><a href="rh_discipline_mensuelle.php">Evaluation Mensuel</a></li>
                             <li><a href="etat_rapport_discipline.php"> Rapport</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="ca_dashboard.php">
                            <i class="bi bi-diagram-3-fill"></i>
                            COMPTABILITE
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="has-sub <?php if (isset($namePrincipalAdmin) && $namePrincipalAdmin == 'dao') { echo "active"; } ?>">
                        <a class="js-arrow"  href="dao_dashboard.php">
                            <i class="bi bi-shop-window"></i>
                            DCAO
                            <span class="bot-line"></span>
                        </a>
                        <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                            
                            <li> <a href="dao_soumissionnaire.php">Soumissionnaires</a></li>
                            <li><a href="dao_depouillement.php">Depouillement du marché</a></li>
                            <li><a href="dao_marche_valide.php">Marchés validés</a></li>
                            <li><a href="dao_attribution.php">Atribution des Marchés</a></li>
                            <li><a href="dao_montage.php">Montages des Marchés</a> </li>
                            <li><a href="dao_reference.php"> Reférences</a> </li> 
                            <li><a href="com_expert.php">Gestion des experts</a></li>
                            <li> <a href="com_agreement.php">Gestion des Agreement</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="prod_dashboard.php">
                            <i class="bi bi-diagram-3-fill"></i>
                            PRODUCTION
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="has-sub <?php if (isset($namePrincipalAdmin) && $namePrincipalAdmin == 'param') { echo "active"; } ?>">
                        <a class="js-arrow"  href="param_dashboard.php">
                            <i class="bi bi-wrench-adjustable-circle-fill"></i>
                            PARAMETRAGE
                            <span class="bot-line"></span>
                        </a>
                        <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                            <li><a href="gl_projet_fonctionnement.php">Projets</a></li>
                            <li><a href="param_programme.php">Programmes</a></li>
                            <li> <a href="gl_personnel.php"> Personnels  </a>   </li>
                            <li><a href="rh_organigramme.php"> Organigramme </a>   </li>
                            <li><a href="param_objectif2.php">Objectifs Annuels</a></li>
                            <li><a href="ca_journal.php">Jounaux</a></li>
                            <li><a href="ca_comptes.php">Plan Comptable</a></li>
                            <li><a href="ca_solde_ini.php">Soldes Initiaux</a></li>
                        </ul>
                    </li>
                    <li class="has-sub ">
                        <a  class="js-arrow" href="#">
                            <i class="bi bi-graph-up-arrow"></i>
                            TIERS
                            <span class="bot-line"></span>
                        </a>
                        <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                            <li><a href="fourniss.php">Fournisseurs</a></li>
                            <li><a href="clients.php">Clients</a></li>
                            <li><a href="financier.php">Financiers</a></li>
                             <li><a href="404.php">Partenaires Groupement</a></li>
                        </ul>
                    </li>
                    <li class="has-sub <?php if (isset($namePrincipalAdmin) && $namePrincipalAdmin == 'ekio') { echo "active"; } ?>">
                        <a  class="js-arrow" href="ekio_dashboard.php">
                            <i class="bi bi-newspaper"></i>
                            EKIOSQUE
                            <span class="bot-line"></span>
                        </a>
                        <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                            <li>
                                <a href="ekio_dashboard.php">Dashboard</a>
                            </li>
                             <li>
                                <a href="ekio_abo.php">Gestion des abonnements</a>
                            </li>
                            <li>
                                <a href="ekio_editeur.php">Gestion des Editeurs</a>
                            </li>
                            <li>
                                <a href="ekio_ventes.php">Gestion de la Ventes</a>
                            </li>
                            <li>
                                <a href="cooporate.php">Cooporate</a>
                            </li>
                            <li>
                                <a href="cooporate_analitics.php">Cooporate Analitics</a>
                            </li>
                            <li>
                                <a href="cooporate_cibles.php">Cooporate Cibles</a>
                            </li>
                            <li>
                                <a href="cooporate_prospects.php">Cooporate Prospects</a>
                            </li>
                        </ul>
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
<?php }  

if ( $_SESSION['droit']== "daaf"){ ?>
 
 
<!-- ======= Debut Header Desktop ======= -->

<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="ca_dashboard.php">
                    <img class="img-header" src="new_assets/assets_dashboard/img/logo-white.png" alt="logo-white" />
                </a>
            </div>
            <div class="header__navbar"> 
                 <ul class="list-unstyled">
                 
                    <li class="<?php if (isset($namePage) && $namePage== 'personnel_dashboard') { echo "active"; } ?>">
                        <a href="personnel_dashboard.php">
                            <i class="bi bi-speedometer2"></i>
                            Mon Dashboard
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="has-sub <?php if (isset($namePrincipalAd ) && $namePrincipalAd == 'tiers') { echo "active"; } ?>">
                        <a href="#">
                            <i class="bi bi-newspaper"></i>
                            TIERS
                            <span class="bot-line"></span>
                        </a>
                         <ul class="header3-sub-list list-unstyled">
                            
                            <li><a href="fourniss.php">Fournisseurs</a></li>
                            <li><a href="clients.php">Clients</a></li>
                            <li><a href="financier.php">Financiers</a></li>
                             <li><a href="404.php">Partenaires Groupement</a></li>
                             <li><a href="gl_personnel.php">Personnel</a></li>
                        </ul>
                        
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
                                <?php
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

<!-- ======= Debut Header Mobile ======= -->
<header class="header-mobile header-mobile-2 d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="dashboard.php">
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
         
                
                    <li class="has-sub <?php if (isset($namePage) && $namePage == 'comptabilite') { echo "active"; } ?>">
                        <a  class="js-arrow" href="ca_dashboard.php">
                            <i class="bi bi-diagram-3-fill"></i>
                            COMPTABILITE
                            <span class="bot-line"></span>
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

<?php }  

if ( $_SESSION['droit']== "budget"){ ?>
 
 
<!-- ======= Debut Header Desktop ======= -->

<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="dashboard.php">
                    <img class="img-header" src="new_assets/assets_dashboard/img/logo-white.png" alt="logo-white" />
                </a>
            </div>
            <div class="header__navbar"> 
                 <ul class="list-unstyled">
                 <li class="<?php if (isset($namePage) && $namePage== 'personnel_dashboard') { echo "active"; } ?>">
                        <a href="personnel_dashboard.php">
                            <i class="bi bi-speedometer2"></i>
                            Mon Dashboard
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    
                    <li class="has-sub <?php if (isset($namePrincipalAd ) && $namePrincipalAd == 'tiers') { echo "active"; } ?>">
                        <a href="#">
                            <i class="bi bi-newspaper"></i>
                            TIERS
                            <span class="bot-line"></span>
                        </a>
                         <ul class="header3-sub-list list-unstyled">
                            
                            <li><a href="fourniss.php">Fournisseurs</a></li>
                            <li><a href="clients.php">Clients</a></li>
                            <li><a href="financier.php">Financiers</a></li>
                             <li><a href="404.php">Partenaires Groupement</a></li>
                             <li><a href="gl_personnel.php">Personnel</a></li>
                        </ul>
                        
                    </li>
                   
                     <li class="has-sub <?php if (isset($namePrincipalAd ) && $namePrincipalAd == 'reunion') { echo "active"; } ?>">
                        <a href="rh_dashboard_reunion_a.php">
                            <i class="bi bi-people-fill"></i>
                            Reunion
                            <span class="bot-line"></span>
                        </a>
                        <ul class="header3-sub-list list-unstyled">
                            <li>
                                <a href="rh_execution_reunion_a.php">Execution</a>
                            </li>
                        </ul>
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
                                <?php
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

<!-- ======= Debut Header Mobile ======= -->
<header class="header-mobile header-mobile-2 d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="dashboard.php">
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
         
                
                    <li class="has-sub <?php if (isset($namePage) && $namePage == 'gac_contrats') { echo "active"; } ?>">
                        <a  class="js-arrow" href="gac_contrats.php">
                            <i class="bi bi-diagram-3-fill"></i>
                            COMPTABILITE
                            <span class="bot-line"></span>
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
                           // if ($_SESSION['droit']!=($_SESSION['droit_pere']) {
                            <a href="connexion_choix.php">
                                <i class="bi bi-arrow-clockwise"></i>
                                Changer de Profil
                            </a>
                        </div>
                       // }
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
<?php }  

	 if ( $_SESSION['droit']== "soca"){?>

<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="ges_courriers_dashboard.php">
                    <img class="img-header" src="new_assets/assets_dashboard/img/logo-white.png" alt="logo-white" />
                </a>
                
            </div>
            <div class="header__navbar">
                <ul class="list-unstyled">
                
                <li class="has-sub <?php if (isset($namePagePrincipalsoca) && $namePagePrincipalsoca == 'rh_dashboard') { echo "active"; } ?>">
                        <a href="ges_courriers_dashboard.php">
                            <i class="bi bi-person-fill-slash"></i>
                            Dashboard
                            <span class="bot-line"></span>
                        </a>
                        <ul class="header3-sub-list list-unstyled">
                            <li>
                                <a href="personnel_dashboard.php">Mon Dashboard</a>
                            </li>
                            
                        </ul>
                    </li>
                
                    <li class="<?php if (isset($namePage) && $namePage == 'gestion_courriers') { echo "active"; } ?>">
                        <a href="ges_courrier.php">
                            <i class="bi bi-filetype-pdf"></i>
                            Gestion des Courriers Entrant et Sortant
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    
                    <li class="<?php if (isset($namePage) && $namePageSOCA == 'Compta') { echo "active"; } ?>">
                        <a href="gac_achat_fonctionnement.php">
                            <i class="bi bi-cart4"></i>
                            Comptabilité
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    
                    <li class="has-sub <?php if (isset($namePage) && $namePrincipale == 'prod') { echo "active"; } ?>">
                        <a href="prod_tout_sprint.php">
                            <i class="bi bi-airplane-engines"></i>
                            PRODUCTION
                            <span class="bot-line"></span>
                        </a> 
                    </li>
                    
                     <li class="has-sub <?php if (isset($namePrincipalAd ) && $namePrincipalAd == 'reunion') { echo "active"; } ?>">
                        <a href="rh_dashboard_reunion_a.php">
                            <i class="bi bi-people-fill"></i>
                            Reunion
                            <span class="bot-line"></span>
                        </a>
                        <ul class="header3-sub-list list-unstyled">
                            <li>
                                <a href="rh_execution_reunion_a.php">Execution</a>
                            </li>
                            <li>
                                <a href="rapport_reunion.php"  target="_blank">Rapport</a>
                            </li>
                        </ul>
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
                <a class="logo" href="dashboard.php">
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
                <li>
                    <a href="ges_courrier_dashboard.php">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="has-sub">
                    <a   href="ges_courrier.php#">
                        <i class="bi bi-people-fill"></i>
                        Courriers Entrants et Sortants
                    </a>
                </li>
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
<?php }  

	 if ( $_SESSION['droit']== "utilisateur"){?>

<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="ges_courriers_dashboard.php">
                    <img class="img-header" src="new_assets/assets_dashboard/img/logo-white.png" alt="logo-white" />
                </a>
                
            </div>
            <div class="header__navbar">
                <ul class="list-unstyled">
                                        <li class="<?php if (isset($namePage) && $namePage== 'personnel_dashboard') { echo "active"; } ?>">
                        <a href="personnel_dashboard.php">
                            <i class="bi bi-speedometer2"></i>
                            Mon Dashboard
                            <span class="bot-line"></span>
                        </a>
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
                <a class="logo" href="personnel_dashboard.php">
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
                <li>
                    <a href="personnel_dashboard.php">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                </li>
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
<?php }  

	 if ( $_SESSION['droit']== "consultant_daaf"){?>

<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="ca_dashboard.php">
                    <img class="img-header" src="new_assets/assets_dashboard/img/logo-white.png" alt="logo-white" />
                </a>
                
            </div>
            <div class="header__navbar">
                <ul class="list-unstyled">
                    
                    
                     <li class="has-sub <?php if (isset($namePrincipalAdmin) && $namePrincipalAdmin == 'param') { echo "active"; } ?>">
                        <a href="#">
                            <i class="bi bi-wrench-adjustable-circle-fill"></i>
                            PARAMETRAGE
                            <span class="bot-line"></span>
                        </a>
                          <ul class="header3-sub-list list-unstyled">
                            <li><a href="ca_journal.php">Jounaux</a></li>
                            <li><a href="ca_comptes.php">Plan Comptable</a></li>
                            <li><a href="ca_solde_ini.php">Soldes Initiaux</a></li>
                            <li><a href="gl_projet_fonctionnement.php">Projets</a></li>
                            <li><a href="param_programme.php">Programmes</a></li>
                            
                        </ul>
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
                <a class="logo" href="personnel_dashboard.php">
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
                <li>
                    <a href="ca_dashboard.php">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                </li>
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
<?php }  

	 if ( $_SESSION['droit']== "production"){?>

<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="prod_dashboard.php">
                    <img class="img-header" src="new_assets/assets_dashboard/img/logo-white.png" alt="logo-white" />
                </a>
                
            </div>
            <div class="header__navbar">
                <ul class="list-unstyled">
                                        <li class="<?php if (isset($namePage) && $namePage== 'personnel_dashboard') { echo "active"; } ?>">
                        <a href="personnel_dashboard.php">
                            <i class="bi bi-speedometer2"></i>
                            Mon Dashboard
                            <span class="bot-line"></span>
                        </a>
                    </li>
                     <li class="has-sub <?php if (isset($namePage) && $namePrincipale == 'prod') { echo "active"; } ?>">
                        <a href="prod_dashboard.php">
                            <i class="bi bi-airplane-engines"></i>
                            PRODUCTION
                            <span class="bot-line"></span>
                        </a> 
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
                <a class="logo" href="personnel_dashboard.php">
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
                <li>
                    <a href="personnel_dashboard.php">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard personnel
                    </a>
                </li>
                 <li>
                    <a href="prod_dashboard.php">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard production
                    </a>
                </li>
                 <li>
                    <a href="prod_planification.php">
                        <i class="bi bi-speedometer2"></i>
                        planification
                    </a>
                </li>
                 <li>
                    <a href="prod_execution.php">
                        <i class="bi bi-speedometer2"></i>
                        Execution
                    </a>
                </li>
                 <li>
                    <a href="prod_supervision.php">
                        <i class="bi bi-speedometer2"></i>
                        Supervision
                    </a>
                </li>
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
<?php }  

	 if ( $_SESSION['droit']== "auee"){?>

<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="prod_dashboard.php">
                    <img class="img-header" src="new_assets/assets_dashboard/img/logo-white.png" alt="logo-white" />
                </a>
                
            </div>
            <div class="header__navbar">
                <ul class="list-unstyled">
                                        <li class="<?php if (isset($namePage) && $namePage== 'personnel_dashboard') { echo "active"; } ?>">
                        <a href="personnel_dashboard.php">
                            <i class="bi bi-speedometer2"></i>
                            Mon Dashboard
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="has-sub <?php if (isset($namePage) && $namePage == 'rh_execution_reunion_daaf') { echo "active"; } ?>">
                        <a href="rh_execution_reunion_a.php">
                            <i class="bi bi-wrench-adjustable-circle-fill"></i>
                            Execution de reunion
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    
                      <li class="has-sub <?php if (isset($namePrincipal
                    ) && $namePrincipalAdmin == 'ekio') { echo "active"; } ?>">
                        <a href="ekio_dashboard.php">
                            <i class="bi bi-newspaper"></i>
                            EKIOSQUE
                            <span class="bot-line"></span>
                        </a>
                         <ul class="header3-sub-list list-unstyled">
                            <li><a href="ekio_abo.php">Gestion Abonnements</a></li>
                            <li><a href="ekio_editeur.php">Gestion Editeurs</a></li>
                            <li><a href="ekio_vente.php">Gestion des Ventes</a></li>
                            <li><a href="#">Gestion Commercialisation</a></li>
                             <li><a href="cooporate_analitics.php"> <span class="ms-4">Cooporate Analitics </span></a></li>
                             <li><a href="cooporate_cibles.php"> <span class="ms-4">Cooporate Cibles </span></a></li>
                             <li><a href="cooporate_clients.php"> <span class="ms-4">Cooporate Clients</span></a></li>
                             <li><a href="cooporate_prospects.php"> <span class="ms-4">Cooporate prospects </span></a></li>
                        </ul>
                        
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
                <a class="logo" href="personnel_dashboard.php">
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
                <li>
                    <a href="personnel_dashboard.php">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard personnel
                    </a>
                </li>
                
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

    <?php } ?>
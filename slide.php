<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <?php
    include("libraries/autoload.php");
    $database = include('database.php');
    $config = include('config.php');
    include_once("db.php"); //pour les acc�s direct � la base de donn�es
    ?>

    <!-- ======= Debut Header Desktop ======= -->
    <?php if ($_SESSION['droit'] == "admin") { ?>

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link <?php if ($namePage != 'admin_dashboard') { echo 'collapsed'; } ?>" href="admin_dashboard.php">
                    <i class="bi bi-grid"></i>
                    <span>DASHBAORD</span>
                </a>
            </li>

      
                
              <li class="nav-item">
                <a class="nav-link <?php if ($namePrincipalAd != 'Projet') { echo 'collapsed'; } ?>" data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#">
                   <i class="bi bi-boxes"></i><span>PROJETS</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav1" class="nav-content collapse show <?php // if ($namePrincipalAd == 'Projet') { echo 'show'; } ?>" data-bs-parent="#sidebar-nav">
                    
                    <li><a class="<?php if ($namePage == 'pro_financement') { echo 'active'; } ?>" href="pro_financement.php"><i class="bi bi-circle"></i><span>Demande de Financement</span></a></li>
                    <li><a class="<?php if ($namePage == 'pro_avis_financement') { echo 'active'; } ?>" href="pro_avis_financement.php"><i class="bi bi-circle"></i><span>Avis de Financement</span></a></li>
                    <li><a class="<?php if ($namePage == 'pro_projet_valide') { echo 'active'; } ?>" href="pro_projet_valide.php"><i class="bi bi-circle"></i><span>Projets Validés</span></a></li>
                 
                </ul>
            </li> <!--End Projet Nav -->
            <li class="nav-item">
                <a class="nav-link <?php if ($namePrincipalAd != 'Offre') { echo 'collapsed'; } ?>" data-bs-target="#components-nav2" data-bs-toggle="collapse" href="#">
                   <i class="bi bi-vector-pen"></i><span>APPELS D'OFFRES</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav2" class="nav-content collapse show <?php // if ($namePrincipalAd == 'Offre') { echo 'show'; } ?>" data-bs-parent="#sidebar-nav">
                    
                    <li><a class="<?php if ($namePage == 'off_avis') { echo 'active'; } ?>" href="off_avis.php"><i class="bi bi-circle"></i><span>Avis d'appel des Offres</span></a></li>
                    <li><a class="<?php if ($namePage == 'off_depot') { echo 'active'; } ?>" href="off_depot.php"><i class="bi bi-circle"></i><span>dépôt des Offres</span></a></li>
                    <li><a class="<?php if ($namePage == 'off_eval') { echo 'active'; } ?>" href="off_eval.php"><i class="bi bi-circle"></i><span>Evaluation des Offres</span></a></li>
                    <li><a class="<?php if ($namePage == 'off_attrib_marche') { echo 'active'; } ?>" href="off_attrib_marche.php"><i class="bi bi-circle"></i><span>Attribution du marchés</span></a></li>
                    <li><a class="<?php if ($namePage == 'off_recour') { echo 'active'; } ?>" href="off_recour.php"><i class="bi bi-circle"></i><span>Les Recours</span></a></li>   
                  
                </ul>
            </li> <!--End Offre Nav -->

            <li class="nav-item">
                <a class="nav-link <?php if ($namePrincipalAd != 'contrat') { echo 'collapsed'; } ?>" data-bs-target="#afb-nav2" data-bs-toggle="collapse" href="#">
                   <i class="bi bi-journal-medical"></i><span>CONTRATUALISATION</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="afb-nav2" class="nav-content collapse show <?php // if ($namePrincipalAd == 'contrat') { echo 'show'; } ?>" data-bs-parent="#sidebar-nav">
                 
                    <li><a class="<?php if ($namePage == 'con_contrat') { echo 'active'; } ?>" href="con_contrat.php"><i class="bi bi-circle"></i><span>Contrats</span></a></li>
                    <li><a class="<?php if ($namePage == 'con_enregistrement') { echo 'active'; } ?>" href="con_enregistrement.php"><i class="bi bi-circle"></i><span>Enregistrement</span></a></li>
                    <li><a class="<?php if ($namePage == 'con_avenant') { echo 'active'; } ?>" href="con_avenant.php"><i class="bi bi-circle"></i><span>Avenants</span></a></li>
                 
                </ul>
            </li> <!--End Contrat Nav -->
           <li class="nav-item">
                <a class="nav-link <?php if ($namePrincipalAd != 'descompte') { echo 'collapsed'; } ?>" data-bs-target="#components-nav3" data-bs-toggle="collapse" href="#">
                   <i class="bi bi-piggy-bank"></i><span>GESTION DES DESCOMPTES</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav3" class="nav-content collapse show <?php // if ($namePrincipalAd  == 'descompte') { echo 'show'; } ?>" data-bs-parent="#sidebar-nav">
                  
                    <li><a class="<?php if ($namePage == 'des_demande_paiement') { echo 'active'; } ?>" href="des_demande_paiement.php"><i class="bi bi-circle"></i><span>Demande de Paiement</span></a></li>
                    <li><a class="<?php if ($namePage == 'des_Avis_Paiement') { echo 'active'; } ?>" href="des_Avis_Paiement.php"><i class="bi bi-circle"></i><span>Avis sur la Demande</span></a></li>
                    <li><a class="<?php if ($namePage == 'des_demmarrage') { echo 'active'; } ?>" href="des_demmarrage.php"><i class="bi bi-circle"></i><span>Décompte Avance Démarrage</span></a></li>
                    <li><a class="<?php if ($namePage == 'des_service') { echo 'active'; } ?>" href="des_service.php"><i class="bi bi-circle"></i><span>Décompte Service faits</span></a></li>
                    <li><a class="<?php if ($namePage == 'des_descompte') { echo 'active'; } ?>" href="des_descompte.php"><i class="bi bi-circle"></i><span>Tout les Décomptes</span></a></li>
                      
                        
                </ul>
            </li> <!--End Descompte Nav -->
            
            <li class="nav-item">
                <a class="nav-link <?php if ($namePrincipalAd != 'archives') { echo 'collapsed'; } ?>" data-bs-target="#components-nav4" data-bs-toggle="collapse" href="#">
                   <i class="bi bi-archive"></i><span>GESTION DES ARCHIVES</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav4" class="nav-content collapse show <?php // if ($namePrincipalAd == 'archives') { echo 'show'; } ?>" data-bs-parent="#sidebar-nav">
                     
                     <li><a class="<?php if ($namePage == 'archi_MP') { echo 'active'; } ?>" href="archi_MP.php"><i class="bi bi-circle"></i><span>Passation Marchés Publics</span></a></li>
                    <li><a class="<?php if ($namePage == 'archi_contrat') { echo 'active'; } ?>" href="archi_contrat.php"><i class="bi bi-circle"></i><span>Phase Contractualisation</span></a></li>
                    <li><a class="<?php if ($namePage == 'archi_execution') { echo 'active'; } ?>" href="archi_execution.php"><i class="bi bi-circle"></i><span>Phase Exécution</span></a></li>
                </ul>
            </li> <!--End Archive Nav -->
            
             
            
            <li class="nav-item">
                <a class="nav-link <?php if ($namePrincipalAd != 'administration') { echo 'collapsed'; } ?>" data-bs-target="#components-nav5" data-bs-toggle="collapse" href="#">
                   <i class="bi bi-sliders2-vertical"></i><span>ADMINISTRATION</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav5" class="nav-content collapse show <?php // if ($namePrincipalAd == 'administration') { echo 'show'; } ?>" data-bs-parent="#sidebar-nav">
                     <li><a class="<?php if ($namePage == 'admin_soumissio') { echo 'active'; } ?>" href="admin_soumissio.php"><i class="bi bi-circle"></i><span>Soumissionaire</span></a></li>
                    <li><a class="<?php if ($namePage == 'admin_user') { echo 'active'; } ?>" href="admin_user.php"><i class="bi bi-circle"></i><span>Utilisateur</span></a></li>
                    <li><a class="<?php if ($namePage == 'admin_log') { echo 'active'; } ?>" href="admin_log.php"><i class="bi bi-circle"></i><span>Logs</span></a></li>
                </ul>
            </li> <!--End Archive Nav -->
           
        </ul>
    <?php }

    elseif ($_SESSION['droit'] == "courrier") { ?>
        <ul class="sidebar-nav" id="sidebar-nav">
               
       
            <li class="nav-item">
                <a class="nav-link <?php if ($namePage != 'courrier_dashboard') { echo 'collapsed'; } ?>" href="courrier_dashboard.php">
                    <i class="bi bi-grid"></i>
                    <span>DASHBAORD</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php if ($namePrincipalAd != 'Projet') { echo 'collapsed'; } ?>" data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#">
                   <i class="bi bi-boxes"></i><span>PROJETS</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav1" class="nav-content collapse show <?php // if ($namePrincipalAd == 'Projet') { echo 'show'; } ?>" data-bs-parent="#sidebar-nav">
                    
                    <li><a class="<?php if ($namePage == 'pro_financement') { echo 'active'; } ?>" href="pro_financement.php"><i class="bi bi-circle"></i><span>Demande de Financement</span></a></li>
                    <li><a class="<?php if ($namePage == 'pro_projet_valide') { echo 'active'; } ?>" href="pro_projet_valide.php"><i class="bi bi-circle"></i><span>Projets Validés</span></a></li>
                   
                </ul>
            </li> <!--End Projet Nav -->

            <li class="nav-item">
                <a class="nav-link <?php if ($namePrincipalAd != 'descompte') { echo 'collapsed'; } ?>" data-bs-target="#components-nav3" data-bs-toggle="collapse" href="#">
                   <i class="bi bi-piggy-bank"></i><span>GESTION DES DESCOMPTES</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav3" class="nav-content collapse show <?php // if ($namePrincipalAd  == 'descompte') { echo 'show'; } ?>" data-bs-parent="#sidebar-nav">
                  
                    <li><a class="<?php if ($namePage == 'des_demande_paiement') { echo 'active'; } ?>" href="des_demande_paiement.php"><i class="bi bi-circle"></i><span>Demande de Paiement</span></a></li>
                     
                        
                </ul>
            </li> <!--End Descompte Nav -->
        </ul>

<?php }

elseif ($_SESSION['droit'] == "DPI") { ?>
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?php if ($namePage != 'ordonateur_dashboard') { echo 'collapsed'; } ?>" href="ordonateur_dashboard.php">
                <i class="bi bi-grid"></i>
                <span>DASHBAORD</span>
            </a>
        </li>


            
        <li class="nav-item">
            <a class="nav-link <?php if ($namePrincipalAd != 'Projet') { echo 'collapsed'; } ?>" data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#">
            <i class="bi bi-boxes"></i><span>PROJETS</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav1" class="nav-content collapse show <?php // if ($namePrincipalAd == 'Projet') { echo 'show'; } ?>" data-bs-parent="#sidebar-nav">
                <li><a class="<?php if ($namePage == 'pro_financement') { echo 'active'; } ?>" href="pro_financement.php"><i class="bi bi-circle"></i><span>Demande de Financement</span></a></li>
                <li><a class="<?php if ($namePage == 'pro_projet_valide') { echo 'active'; } ?>" href="pro_projet_valide.php"><i class="bi bi-circle"></i><span>Projets Validés</span></a></li>
                   
            </ul>
        </li> <!--End Projet Nav -->
    </ul>
    <?php }

elseif ($_SESSION['droit'] == "Controleur_Financier") { ?>
    <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
            <a class="nav-link <?php if ($namePage != 'contrat_dashboard') { echo 'collapsed'; } ?>" href="contrat_dashboard.php">
                <i class="bi bi-grid"></i>
                <span>DASHBAORD</span>
            </a>
        </li>


        <li class="nav-item">
                <a class="nav-link <?php if ($namePrincipalAd != 'Projet') { echo 'collapsed'; } ?>" data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#">
                   <i class="bi bi-boxes"></i><span>PROJETS</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav1" class="nav-content collapse show <?php //if ($namePrincipalAd == 'Projet') { echo 'show'; } ?>" data-bs-parent="#sidebar-nav">
                    
                    <li><a class="<?php if ($namePage == 'pro_projet_valide') { echo 'active'; } ?>" href="pro_projet_valide.php"><i class="bi bi-circle"></i><span>Projets Validés</span></a></li>
                    
                </ul>
        </li> <!--End Projet Nav -->

        <li class="nav-item">
                <a class="nav-link <?php if ($namePrincipalAd != 'contrat') { echo 'collapsed'; } ?>" data-bs-target="#afb-nav2" data-bs-toggle="collapse" href="#">
                   <i class="bi bi-journal-medical"></i><span>CONTRATUALISATION</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="afb-nav2" class="nav-content collapse show <?php // if ($namePrincipalAd == 'contrat') { echo 'show'; } ?>" data-bs-parent="#sidebar-nav">
                 
                    <li><a class="<?php if ($namePage == 'con_contrat') { echo 'active'; } ?>" href="con_contrat.php"><i class="bi bi-circle"></i><span>Contrats</span></a></li>
                    <li><a class="<?php if ($namePage == 'con_enregistrement') { echo 'active'; } ?>" href="con_enregistrement.php"><i class="bi bi-circle"></i><span>Enregistrement</span></a></li>
                    <li><a class="<?php if ($namePage == 'con_OS') { echo 'active'; } ?>" href="con_OS.php"><i class="bi bi-circle"></i><span>Ordre de Service</span></a></li>
                    <li><a class="<?php if ($namePage == 'con_Control') { echo 'active'; } ?>" href="con_Control.php"><i class="bi bi-circle"></i><span>contrôle Budgétaire</span></a></li>
                    <li><a class="<?php if ($namePage == 'con_avenant') { echo 'active'; } ?>" href="con_avenant.php"><i class="bi bi-circle"></i><span>Avenants</span></a></li>
                    
                </ul>
            </li> <!--End Contrat Nav -->
    </ul>
    <?php }

elseif ($_SESSION['droit'] == "Ordonateur") { ?>
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?php if ($namePage != 'ordonateur_dashboard') { echo 'collapsed'; } ?>" href="ordonateur_dashboard.php">
                <i class="bi bi-grid"></i>
                <span>DASHBAORD</span>
            </a>
        </li>


            
        <li class="nav-item">
            <a class="nav-link <?php if ($namePrincipalAd != 'Projet') { echo 'collapsed'; } ?>" data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#">
            <i class="bi bi-boxes"></i><span>PROJETS</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav1" class="nav-content collapse show <?php // if ($namePrincipalAd == 'Projet') { echo 'show'; } ?>" data-bs-parent="#sidebar-nav">
                
                <li><a class="<?php if ($namePage == 'pro_financement') { echo 'active'; } ?>" href="pro_financement.php"><i class="bi bi-circle"></i><span>Demande de Financement</span></a></li>
                <li><a class="<?php if ($namePage == 'pro_avis_financement') { echo 'active'; } ?>" href="pro_avis_financement.php"><i class="bi bi-circle"></i><span>Avis de Financement</span></a></li>
                <li><a class="<?php if ($namePage == 'pro_projet_valide') { echo 'active'; } ?>" href="pro_projet_valide.php"><i class="bi bi-circle"></i><span>Projets Validés</span></a></li>
            
            </ul>
        </li> <!--End Projet Nav -->
    </ul>
<?php }

elseif ($_SESSION['droit'] == "UGAO") { ?>
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?php if ($namePage != 'Offre_dashboard') { echo 'collapsed'; } ?>" href="Offre_dashboard.php">
                <i class="bi bi-grid"></i>
                <span>DASHBAORD</span>
            </a>
        </li>

        <li class="nav-item">
                <a class="nav-link <?php if ($namePrincipalAd != 'Projet') { echo 'collapsed'; } ?>" data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#">
                   <i class="bi bi-boxes"></i><span>PROJETS</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav1" class="nav-content collapse show <?php // if ($namePrincipalAd == 'Projet') { echo 'show'; } ?>" data-bs-parent="#sidebar-nav">
                    
                    <li><a class="<?php if ($namePage == 'pro_projet_valide') { echo 'active'; } ?>" href="pro_projet_valide.php"><i class="bi bi-circle"></i><span>Projets Validés</span></a></li>
                    
                </ul>
        </li> <!--End Projet Nav -->
            
        <li class="nav-item">
                <a class="nav-link <?php if ($namePrincipalAd != 'Offre') { echo 'collapsed'; } ?>" data-bs-target="#components-nav2" data-bs-toggle="collapse" href="#">
                   <i class="bi bi-vector-pen"></i><span>APPELS D'OFFRES</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav2" class="nav-content collapse show <?php // if ($namePrincipalAd == 'Offre') { echo 'show'; } ?>" data-bs-parent="#sidebar-nav">
                    
                    <li><a class="<?php if ($namePage == 'off_avis') { echo 'active'; } ?>" href="off_avis.php"><i class="bi bi-circle"></i><span>Avis d'appel des Offres</span></a></li>
                    <li><a class="<?php if ($namePage == 'off_depot') { echo 'active'; } ?>" href="off_depot.php"><i class="bi bi-circle"></i><span>dépôt des Offres</span></a></li>
                    <li><a class="<?php if ($namePage == 'off_eval') { echo 'active'; } ?>" href="off_eval.php"><i class="bi bi-circle"></i><span>Evaluation des Offres</span></a></li>
                    <li><a class="<?php if ($namePage == 'off_attrib_marche') { echo 'active'; } ?>" href="off_attrib_marche.php"><i class="bi bi-circle"></i><span>Attribution du marchés</span></a></li>
                    <li><a class="<?php if ($namePage == 'off_recour') { echo 'active'; } ?>" href="off_recour.php"><i class="bi bi-circle"></i><span>Les Recours</span></a></li>   
                  
                </ul>
            </li> <!--End Offre Nav -->
    </ul>
    <?php }

elseif ($_SESSION['droit'] == "Archivage") { ?>
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?php if ($namePage != 'archive_dashboard') { echo 'collapsed'; } ?>" href="archive_dashboard.php">
                <i class="bi bi-grid"></i>
                <span>DASHBAORD</span>
            </a>
        </li>

        <li class="nav-item">
                <a class="nav-link <?php if ($namePrincipalAd != 'Projet') { echo 'collapsed'; } ?>" data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#">
                   <i class="bi bi-boxes"></i><span>PROJETS</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav1" class="nav-content collapse show <?php // if ($namePrincipalAd == 'Projet') { echo 'show'; } ?>" data-bs-parent="#sidebar-nav">
                    
                    <li><a class="<?php if ($namePage == 'pro_projet_valide') { echo 'active'; } ?>" href="pro_projet_valide.php"><i class="bi bi-circle"></i><span>Projets Validés</span></a></li>
                    
                </ul>
        </li> <!--End Projet Nav -->
        <li class="nav-item">
                <a class="nav-link <?php if ($namePrincipalAd != 'archives') { echo 'collapsed'; } ?>" data-bs-target="#components-nav4" data-bs-toggle="collapse" href="#">
                   <i class="bi bi-archive"></i><span>GESTION DES ARCHIVES</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav4" class="nav-content collapse show <?php // if ($namePrincipalAd == 'archives') { echo 'show'; } ?>" data-bs-parent="#sidebar-nav">
                     
                     <li><a class="<?php if ($namePage == 'archi_MP') { echo 'active'; } ?>" href="archi_MP.php"><i class="bi bi-circle"></i><span>Passation Marchés Publics</span></a></li>
                    <li><a class="<?php if ($namePage == 'archi_contrat') { echo 'active'; } ?>" href="archi_contrat.php"><i class="bi bi-circle"></i><span>Phase Contractualisation</span></a></li>
                    <li><a class="<?php if ($namePage == 'archi_execution') { echo 'active'; } ?>" href="archi_execution.php"><i class="bi bi-circle"></i><span>Phase Exécution</span></a></li>
                </ul>
            </li> <!--End Archive Nav -->
    </ul>
    <?php }

elseif ($_SESSION['droit'] == "UGAC") { ?>
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?php if ($namePage != 'contrat_dashboard') { echo 'collapsed'; } ?>" href="contrat_dashboard.php">
                <i class="bi bi-grid"></i>
                <span>DASHBAORD</span>
            </a>
        </li>


        <li class="nav-item">
                <a class="nav-link <?php if ($namePrincipalAd != 'Projet') { echo 'collapsed'; } ?>" data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#">
                   <i class="bi bi-boxes"></i><span>PROJETS</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav1" class="nav-content collapse show <?php //if ($namePrincipalAd == 'Projet') { echo 'show'; } ?>" data-bs-parent="#sidebar-nav">
                    
                    <li><a class="<?php if ($namePage == 'pro_projet_valide') { echo 'active'; } ?>" href="pro_projet_valide.php"><i class="bi bi-circle"></i><span>Projets Validés</span></a></li>
                    
                </ul>
        </li> <!--End Projet Nav -->

        <li class="nav-item">
                <a class="nav-link <?php if ($namePrincipalAd != 'contrat') { echo 'collapsed'; } ?>" data-bs-target="#afb-nav2" data-bs-toggle="collapse" href="#">
                   <i class="bi bi-journal-medical"></i><span>CONTRATUALISATION</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="afb-nav2" class="nav-content collapse show <?php // if ($namePrincipalAd == 'contrat') { echo 'show'; } ?>" data-bs-parent="#sidebar-nav">
                 
                    <li><a class="<?php if ($namePage == 'con_contrat') { echo 'active'; } ?>" href="con_contrat.php"><i class="bi bi-circle"></i><span>Contrats</span></a></li>
                    <li><a class="<?php if ($namePage == 'con_enregistrement') { echo 'active'; } ?>" href="con_enregistrement.php"><i class="bi bi-circle"></i><span>Enregistrement</span></a></li>
                    <li><a class="<?php if ($namePage == 'con_OS') { echo 'active'; } ?>" href="con_OS.php"><i class="bi bi-circle"></i><span>Ordre de Service</span></a></li>
                    <li><a class="<?php if ($namePage == 'con_avenant') { echo 'active'; } ?>" href="con_avenant.php"><i class="bi bi-circle"></i><span>Avenants</span></a></li>
                 
                </ul>
            </li> <!--End Contrat Nav -->
    </ul>

    <?php }

elseif ($_SESSION['droit'] == "UGAD") { ?>
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?php if ($namePage != 'Decompte_dashboard') { echo 'collapsed'; } ?>" href="Decompte_dashboard.php">
                <i class="bi bi-grid"></i>
                <span>DASHBAORD</span>
            </a>
        </li>


        <li class="nav-item">
                <a class="nav-link <?php if ($namePrincipalAd != 'Projet') { echo 'collapsed'; } ?>" data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#">
                   <i class="bi bi-boxes"></i><span>PROJETS</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav1" class="nav-content collapse show <?php // if ($namePrincipalAd == 'Projet') { echo 'show'; } ?>" data-bs-parent="#sidebar-nav">
                    
                    <li><a class="<?php if ($namePage == 'pro_projet_valide') { echo 'active'; } ?>" href="pro_projet_valide.php"><i class="bi bi-circle"></i><span>Projets Validés</span></a></li>
                    
                </ul>
        </li> <!--End Projet Nav -->

        <li class="nav-item">
                <a class="nav-link <?php if ($namePrincipalAd != 'descompte') { echo 'collapsed'; } ?>" data-bs-target="#components-nav3" data-bs-toggle="collapse" href="#">
                   <i class="bi bi-piggy-bank"></i><span>GESTION DES DESCOMPTES</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav3" class="nav-content collapse show <?php //if ($namePrincipalAd  == 'descompte') { echo 'show'; } ?>" data-bs-parent="#sidebar-nav">
                  
                    <li><a class="<?php if ($namePage == 'des_demande_paiement') { echo 'active'; } ?>" href="des_demande_paiement.php"><i class="bi bi-circle"></i><span>Demande de Paiement</span></a></li>
                    <li><a class="<?php if ($namePage == 'des_Avis_Paiement') { echo 'active'; } ?>" href="des_Avis_Paiement.php"><i class="bi bi-circle"></i><span>Avis sur la Demande</span></a></li>
                    <li><a class="<?php if ($namePage == 'des_demmarrage') { echo 'active'; } ?>" href="des_demmarrage.php"><i class="bi bi-circle"></i><span>Décompte Avance Démarrage</span></a></li>
                    <li><a class="<?php if ($namePage == 'des_service') { echo 'active'; } ?>" href="des_service.php"><i class="bi bi-circle"></i><span>Décompte Service faits</span></a></li>
                    <li><a class="<?php if ($namePage == 'des_descompte') { echo 'active'; } ?>" href="des_descompte.php"><i class="bi bi-circle"></i><span>Tout les Décomptes</span></a></li>
                      
                        
                </ul>
        </li> <!--End Descompte Nav -->

    </ul>
    <?php }

elseif ($_SESSION['droit'] == "CSM") { ?>
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?php if ($namePage != 'CSM_dashboard') { echo 'collapsed'; } ?>" href="CSM_dashboard.php">
                <i class="bi bi-grid"></i>
                <span>DASHBAORD</span>
            </a>
        </li>


            
        <li class="nav-item">
            <a class="nav-link <?php if ($namePrincipalAd != 'Projet') { echo 'collapsed'; } ?>" data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#">
            <i class="bi bi-boxes"></i><span>PROJETS</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav1" class="nav-content collapse show <?php // if ($namePrincipalAd == 'Projet') { echo 'show'; } ?>" data-bs-parent="#sidebar-nav">
                
                <li><a class="<?php if ($namePage == 'pro_projet_valide') { echo 'active'; } ?>" href="pro_projet_valide.php"><i class="bi bi-circle"></i><span>Projets Validés</span></a></li>
            
            </ul>
        </li> <!--End Projet Nav -->
        <li class="nav-item">
                <a class="nav-link <?php if ($namePrincipalAd != 'descompte') { echo 'collapsed'; } ?>" data-bs-target="#components-nav3" data-bs-toggle="collapse" href="#">
                   <i class="bi bi-piggy-bank"></i><span>GESTION DES DESCOMPTES</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav3" class="nav-content collapse show <?php // if ($namePrincipalAd  == 'descompte') { echo 'show'; } ?>" data-bs-parent="#sidebar-nav">
                  
                    <li><a class="<?php if ($namePage == 'des_demande_paiement') { echo 'active'; } ?>" href="des_demande_paiement.php"><i class="bi bi-circle"></i><span>Demande de Paiement</span></a></li>
                    <li><a class="<?php if ($namePage == 'des_Avis_Paiement') { echo 'active'; } ?>" href="des_Avis_Paiement.php"><i class="bi bi-circle"></i><span>Avis sur la Demande</span></a></li>
                      
                        
                </ul>
            </li> <!--End Descompte Nav -->
    </ul>

    <?php } ?>

</aside>
<!-- End Sidebar-->
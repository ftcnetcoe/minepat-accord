<?php
    session_start(); // ouverture de la session
    include("libraries/autoload.php");
    use GroceryCrud\Core\GroceryCrud;

    $namePage = 'archive_dashboard';


error_reporting(E_ALL);
ini_set("display_errors", 1);

    $database = include('database.php');
    $config = include('config.php');
    $crud = new GroceryCrud($config, $database);
    include_once("db.php"); //pour les accès direct à la base de données
?>

<?php
    // gestion des droits sur l'affichage
    if (isset($_SESSION['idu'])&& ( $_SESSION['droit']== "Archivage")){ // si paramètres correct.
?>

<?php
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Variables
    $yearNow = date('Y');
    $monthNow = date('m');

    if (isset($_GET['annee']) && !empty($_GET['annee'])) {
        $annee = $_GET['annee'];
    } else {
        $annee =  $yearNow;
    }

    if (isset($_GET['moi']) && !empty($_GET['moi'])) { 
        $moi = $_GET['moi'];
    } else {
        $moi =  $monthNow;
    }

    $nbrJours = cal_days_in_month(CAL_GREGORIAN, $moi, $annee);

    //Mois de l'année
    switch ($moi) {
        case 1:
            $month = 'Janvier';
            break;
        case 2:
            $month = 'Février';
            break;
        case 3:
            $month = 'Mars';
            break;
        case 4:
            $month = 'Avril';
            break;
        case 5:
            $month = 'Mai';
            break;
        case 6:
            $month = 'Juin';
            break;
        case 7:
            $month = 'Juillet';
            break;
        case 8:
            $month = 'Août';
            break;
        case 9:
            $month = 'Septembre';
            break;
        case 10:
            $month = 'Octobre';
            break;
        case 11:
            $month = 'Novembre';
            break;
        case 12:
            $month = 'Décembre';
            break;
    }

   

    $sql = "SELECT COUNT(PJ_Lancement) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $PJ_Lancement = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(PJ_RegistreRetrait) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $PJ_RegistreRetrait = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(PJ_RegistrePlis) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $PJ_RegistrePlis = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(PJ_PV_ComOuverture) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $PJ_PV_ComOuverture = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(PJ_TabBordAnalyOffres) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $PJ_TabBordAnalyOffres = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(PJ_RapportPres) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $PJ_RapportPres = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(PJ_ConvocatComisAttrib) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $PJ_ConvocatComisAttrib = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(PJ_PVComisAttrib) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $PJ_PVComisAttrib = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(PJ_VisaBudgetaire) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $PJ_VisaBudgetaire = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(PJ_NotifRejet) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $PJ_NotifRejet = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(PJ_NotifAttrib) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $PJ_NotifAttrib = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(PJ_DecisNfruc) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $PJ_DecisNfruc = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(PJ_DecisSansSuite) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $PJ_DecisSansSuite = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(PJ_AvisAttrib) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $PJ_AvisAttrib = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(PJ_JnalSignatureElec) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $PJ_JnalSignatureElec = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(Contrat_Acte) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $Contrat_Acte = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(PJ_OS_Demarage) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $PJ_OS_Demarage = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(PJ_Avenant_MarchesAddi) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $PJ_Avenant_MarchesAddi = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(PJ_CCAP_CCAG) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $PJ_CCAP_CCAG = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(PJ_CCTP_CCTG) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $PJ_CCTP_CCTG = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(PJ_Offre) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $PJ_Offre = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(PJ_Contrat_Acte) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $PJ_Contrat_Acte = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(PJ_OSDEMARAGE) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $PJ_OSDEMARAGE = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(OS_Demarage) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $OS_Demarage = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(Rapport_Avancement) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $Rapport_Avancement = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(Liquidation_Dcpte) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $Liquidation_Dcpte = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(Dcptes_Prestation) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $Dcptes_Prestation = $nbr1->fetchColumn();
    $sql = "SELECT COUNT(Ordres_Paiement) as NBRES FROM archive  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $Ordres_Paiement = $nbr1->fetchColumn();


 
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <!-- ======= Meta ======= -->
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <!-- ======= Title ======= -->
        <title>Dashboard - Archives| SIGAMP-94</title>

        <!-- ======= Favicons ======= -->
        <link href="new_assets/assets_dashboard/img/favicon.png" rel="icon">
        <link href="new_assets/assets_dashboard/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- ======= Google Fonts ======= -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- ======= Vendor CSS Files Header ======= -->
        <link href="new_assets/assets_dashboard/vendor/header/animsition/animsition.min.css" rel="stylesheet" media="all">
        <link href="new_assets/assets_dashboard/vendor/header/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">

        <!-- ======= Vendor CSS Files ======= -->
        <link href="new_assets/assets_dashboard/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="new_assets/assets_dashboard/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="new_assets/assets_dashboard/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="new_assets/assets_dashboard/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="new_assets/assets_dashboard/vendor/simple-datatables/style.css" rel="stylesheet">

        <!-- ======= Template Main CSS File Header ======= -->
        <link href="new_assets/assets_dashboard/css/header/style.css" rel="stylesheet" media="all">

         <!-- ======= Template Main CSS File Dashboard ======= -->
                <?php if ($_SESSION['droit'] != "admin" && $_SESSION['droit']!= "Ordonateur" && $_SESSION['droit']!= "Archivage" && $_SESSION['droit']!= "UGAO" && $_SESSION['droit']!= "UGAC" && $_SESSION['droit']!= "UGAD" && $_SESSION['droit']!= "CSM") {
       echo' <link href="new_assets/assets_dashboard/css/style2.css" rel="stylesheet">';
        }else{
        echo' <link href="new_assets/assets_dashboard/css/style.css" rel="stylesheet">';}?>
  
</head>
<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="54">

    	 <?php include 'new_includes/header.php' ?>
    	  <?php if ($_SESSION['droit'] == "admin" || $_SESSION['droit'] == "Ordonateur" || $_SESSION['droit'] == "Archivage" || $_SESSION['droit'] == "UGAO" || $_SESSION['droit'] == "UGAC" || $_SESSION['droit'] == "UGAD"  || $_SESSION['droit'] == "CSM") {
      		 include 'slide.php';
        }
        ?>

        <main id="main" class="main">

            <div class="card recent-sales">
                <h1 class="card-title text-center fw-bold"> DASHBOARD ARCHIVAGE: <?php echo($month . ' ' .$annee);?></h1>
                <div class="text-center mb-2">
                    <button type="button" class="btn btn-info" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" data-bs-toggle="modal" data-bs-target="#basicModal">
                        Filtrer
                    </button>
                </div>
            </div>

            <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Filtrer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="contrat_dashboard.php" method="GET">
                            <div class="modal-body">
                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        <label for="annee" class="form-label">Année</label>
                                        <select class="form-select" aria-label="Default select example" name="annee">
                                            <option value="<?php echo $yearNow ; ?>" selected><?php echo $yearNow ; ?></option>
                                            <?php for ($l= 1; $l < 5; $l++) { $an = $yearNow - $l; ?>
                                            <?php echo $an ; ?>
                                            <option value="<?php echo $an ; ?>"><?php echo $an ; ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary">Filtrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <section class="section dashboard">
                <div class="row">

                    

                     <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Lancement de la Consultation</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $PJ_Lancement; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $PJ_Lancement ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Registre de Retrait</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $PJ_RegistreRetrait; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $PJ_RegistreRetrait ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Registre de Dépot des Plis</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $PJ_RegistrePlis; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $PJ_RegistrePlis ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">PV de la Commission d'ouverture</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $PJ_PV_ComOuverture; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $PJ_PV_ComOuverture ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Tableau d'analyse des Offres</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $PJ_TabBordAnalyOffres; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $PJ_TabBordAnalyOffres ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Rapport de Presentation</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $PJ_RapportPres; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $PJ_RapportPres ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Convocation a la Commission d'attribution</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $PJ_ConvocatComisAttrib; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $PJ_ConvocatComisAttrib ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">PV de la Commission d'attribution</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $PJ_PVComisAttrib; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $PJ_PVComisAttrib ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Visa Budgetaire</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $PJ_VisaBudgetaire; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $PJ_VisaBudgetaire ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Notification de Rejet</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $PJ_NotifRejet; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $PJ_NotifRejet ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Nottification d'attribution</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $PJ_NotifAttrib; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $PJ_NotifAttrib ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Notification Infructuosité</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $PJ_DecisNfruc; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $PJ_DecisNfruc ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Decision dde Sans Suite</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $PJ_DecisSansSuite; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $PJ_DecisSansSuite ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Avis d'attribution</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $PJ_AvisAttrib; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $PJ_AvisAttrib ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Journal des Signatures</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $PJ_JnalSignatureElec; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $PJ_JnalSignatureElec ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Contrat D'engagement</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $Contrat_Acte; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $Contrat_Acte ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">OS de Démarrage</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $PJ_OS_Demarage; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $PJ_OS_Demarage ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Lancement de la Consultation</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $PJ_Lancement; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $PJ_Lancement ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Avenants et Marchés Additionnels</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $PJ_Avenant_MarchesAddi; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $PJ_Avenant_MarchesAddi ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">CCAP/CCAG</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $PJ_CCAP_CCAG; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $PJ_CCAP_CCAG ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">CCTP/CCTG</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $PJ_CCTP_CCTG; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $PJ_CCTP_CCTG ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Offres (T/F)</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $PJ_Offre; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $PJ_Offre ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Ordre de Service de Démarage</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $PJ_OSDEMARAGE; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $PJ_OSDEMARAGE ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Contrat</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $PJ_Contrat_Acte; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $PJ_Contrat_Acte ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Rapport d'avancement</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $Rapport_Avancement; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $Rapport_Avancement ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Liquidation des décomptes</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $Liquidation_Dcpte; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $Liquidation_Dcpte ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Décompte des Prestations</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $Dcptes_Prestation; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $Dcptes_Prestation ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->
                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Ordre de Paiement</h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $Ordres_Paiement; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $Ordres_Paiement ?></span> <span class="text-muted small pt-2 ps-1">Archives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->

                    
                    
                    

                </div>
            </section>

        </main>

        <!-- ======= Debut Footer ======= -->
        <?php include 'new_includes/footer.php'?>
        <!-- ======= Fin Footer ======= -->

    </body>

</html>

<?php     
    }else{
        header('Location: index.php' );  
    }
?>
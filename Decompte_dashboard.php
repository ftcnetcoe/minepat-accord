<?php
    session_start(); // ouverture de la session
    include("libraries/autoload.php");
    use GroceryCrud\Core\GroceryCrud;

    $namePage = 'Decompte_dashboard';


error_reporting(E_ALL);
ini_set("display_errors", 1);

    $database = include('database.php');
    $config = include('config.php');
    $crud = new GroceryCrud($config, $database);
    include_once("db.php"); //pour les accès direct à la base de données
?>

<?php
    // gestion des droits sur l'affichage
    if (isset($_SESSION['idu'])&& ( $_SESSION['droit']== "admin" || $_SESSION['droit']== "UGAD")){ // si paramètres correct.
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

   

    $sql = "SELECT COUNT(IDProjet) as NBRES FROM Projet  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $nbrfinancement = $nbr1->fetchColumn();


    $sql = "SELECT COUNT(IDProjet) as NBRES FROM Projet  WHERE (Libelle_avis = 'Favorable' && YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr2 = $pdo->query($sql);
    $nbrfinancementAccorde = $nbr2->fetchColumn();

    $sql = "SELECT COUNT(IDDmdePD) as NBRES FROM DemandePaiement  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr3 = $pdo->query($sql);
    $nbrdemandepaie = $nbr3->fetchColumn();


    $sql = "SELECT COUNT(IDDmdePD) as NBRES FROM DemandePaiement  WHERE (Avis = 'Approuvé' && YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr4 = $pdo->query($sql);
    $nbrdemandepaieAccor = $nbr4->fetchColumn();

    $sql = "SELECT COUNT(IDDecpte) as NBRES FROM descompte  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr5 = $pdo->query($sql);
    $nbrDecompte = $nbr5->fetchColumn();
    
    
    $sql = "SELECT * FROM Projet WHERE (Libelle_avis = 'Favorable' && YEAR(date_creation) = $annee && is_delete = 1)";
    $listing = $pdo->query($sql);
    
    
    if($listing === false){
        die("Erreur");
    }

    $sql = "SELECT * FROM Projet WHERE (Libelle_avis = ' ' && YEAR(date_creation) = $annee && is_delete = 1)";
    $listingEncours = $pdo->query($sql);
    
    
    if($listingEncours === false){
        die("Erreur");
    }
 
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <!-- ======= Meta ======= -->
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <!-- ======= Title ======= -->
        <title>Dashboard - Décompte| SIGAMP-94</title>

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
                <?php if ($_SESSION['droit'] != "admin" && $_SESSION['droit']!= "Ordonateur" && $_SESSION['droit']!= "courrier" && $_SESSION['droit']!= "UGAO" && $_SESSION['droit']!= "UGAC" && $_SESSION['droit']!= "UGAD" && $_SESSION['droit']!= "CSM") {
       echo' <link href="new_assets/assets_dashboard/css/style2.css" rel="stylesheet">';
        }else{
        echo' <link href="new_assets/assets_dashboard/css/style.css" rel="stylesheet">';}?>
  
</head>
<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="54">

    	 <?php include 'new_includes/header.php' ?>
    	  <?php if ($_SESSION['droit'] == "admin" || $_SESSION['droit'] == "Ordonateur" || $_SESSION['droit'] == "courrier" || $_SESSION['droit'] == "UGAO" || $_SESSION['droit'] == "UGAC" || $_SESSION['droit'] == "UGAD"  || $_SESSION['droit'] == "CSM") {
      		 include 'slide.php';
        }
        ?>

        <main id="main" class="main">

            <div class="card recent-sales">
                <h1 class="card-title text-center fw-bold"> DASHBOARD UGAD : <?php echo($month . ' ' .$annee);?></h1>
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
                        <form action="Decompte_dashboard.php" method="GET">
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

                    <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= >
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Demande de Financement <span>| Proposé</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $nbrfinancement; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $nbrfinancement ?></span> <span class="text-muted small pt-2 ps-1">Demande Proposés</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    < ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->

                    <!-- ======= Debut Récupérer le cumul du nombre de reunions executees ======= >
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Demande de Financement    <span>| Approuvé</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $nbrfinancementAccorde; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $nbrfinancementAccorde ?></span> <span class="text-muted small pt-2 ps-1">Demande Accordés</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    < ======= Fin Récupérer le cumul du nombre de reunions executees ======= -->

                     <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                     <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Demande de Paiement<span>| Proposé</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $nbrdemandepaie; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $nbrdemandepaie ?></span> <span class="text-muted small pt-2 ps-1">Demande Proposés</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->

                    <!-- ======= Debut Récupérer le cumul du nombre de reunions executees ======= -->
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Demande de Paiement<span>| Approuvé</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $nbrdemandepaieAccor; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $nbrdemandepaieAccor ?></span> <span class="text-muted small pt-2 ps-1">Demande Accordés</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions executees ======= -->

                    <!-- ======= Debut Récupérer le cumul du nombre de reunions executees ======= -->
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Demande de Décompte<span>| Traité</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $nbrDecompte; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $nbrDecompte ?></span> <span class="text-muted small pt-2 ps-1">Demande Accordés</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions executees ======= -->

                    
                    <!-- ======= Fin Récupérer le cumul du nombre de recommandations executees ======= -->
                

                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Statistique de Demande de Paiement</span></h5>
                                <div id="pieChart2"></div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#pieChart2"), {
                                            series: [
                                                <?php echo $nbrdemandepaie; ?>,
                                                <?php echo $nbrdemandepaieAccor; ?>,
                                            ],
                                            chart: {
                                                height: 350,
                                                type: 'pie',
                                                toolbar: {
                                                    show: true
                                                }
                                            },
                                            labels: [
                                                'Proposé',
                                                'Accordé',
                                            ]
                                        }).render();
                                    });
                                </script>
                            </div>
                        </div>
                        </div>
                        
                    <!-- ======= DebutDescompte traiter  ======= -->
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Décompte Réalisé</h5>
                                <div id="donutChart1"></div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#donutChart1"), {
                                            series: [
                                                <?php echo $nbrdemandepaieAccor; ?>,
                                                <?php echo $nbrDecompte; ?>,
                                            ],
                                            chart: {
                                                height: 500,
                                                type: 'donut',
                                                toolbar: {
                                                    show: true
                                                }
                                            },
                                            labels: [
                                                'Demande de Paiement',
                                                'Décompte',
                                            ],
                                        }).render();
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Nombre de traiter ======= -->


                    
                    

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Projet <span>| Validé</span></h5>
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">N°</th>
                                            <th scope="col">Nom Projet</th>
                                            <th scope="col">Auteur</th>
                                            <th scope="col">Type d'auteur</th>
                                            <th scope="col">Objet</th>
                                            <th scope="col">Gestionnaire</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $increment = 0;
                                        while ($row = $listing->fetch(PDO::FETCH_ASSOC)) :
                                            $IntitulleProjet = htmlspecialchars($row['IntitulleProjet']);
                                            $Auteur = htmlspecialchars($row['Auteur']);
                                            $Typeauteur = htmlspecialchars($row['Typeauteur']);
                                            $Objet = htmlspecialchars($row['Objet']);
                                            $Gestionnaire = htmlspecialchars($row['Gestionnaire']);                                          
                                            
                                            
                                            
                                            
                                        ?>
                                            <tr>
                                                <th scope="row">#<?php echo $increment = $increment + 1; ?></th>
                                                <td><?php echo $IntitulleProjet; ?></td>
                                                <td><?php echo $Auteur; ?></td>
                                                <td><?php echo $Typeauteur; ?></td>
                                                <td><?php echo $Objet; ?></td>
                                                <td><?php echo $Gestionnaire; ?></td>
                                            </tr>
                                            </tr>
                                        <?php
                                        endwhile;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    

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
<?php
    session_start(); // ouverture de la session
    include("libraries/autoload.php");
    use GroceryCrud\Core\GroceryCrud;

    $namePage = 'Offre_dashboard';


error_reporting(E_ALL);
ini_set("display_errors", 1);

    $database = include('database.php');
    $config = include('config.php');
    $crud = new GroceryCrud($config, $database);
    include_once("db.php"); //pour les accès direct à la base de données
?>

<?php
    // gestion des droits sur l'affichage
    if (isset($_SESSION['idu'])&& ( $_SESSION['droit']== "admin" || $_SESSION['droit']== "UGAO")){ // si paramètres correct.
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

   

    $sql = "SELECT COUNT(IDAvis) as NBRES FROM AvisAppelOffre  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr1 = $pdo->query($sql);
    $nbrAvis = $nbr1->fetchColumn();


    $sql = "SELECT COUNT(IDOffre) as NBRES FROM Offre  WHERE (YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr2 = $pdo->query($sql);
    $nbrOffre = $nbr2->fetchColumn();

    $sql = "SELECT COUNT(IDOffre) as NBRES FROM Offre  WHERE (Note IS NOT NULL && YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr3 = $pdo->query($sql);
    $nbrOffreNote = $nbr3->fetchColumn();


    $sql = "SELECT COUNT(IDOffre) as NBRES FROM Offre  WHERE (objet IS NOT NULL && YEAR(date_creation) = $annee && is_delete = 1)";
    $nbr4 = $pdo->query($sql);
    $nbrOffreAttribue = $nbr4->fetchColumn();
    
    
    $sql = "SELECT * FROM Projet WHERE (Libelle_avis = 'Favorable' && YEAR(date_creation) = $annee && is_delete = 1)";
    $listing1 = $pdo->query($sql);

    $sql = "SELECT * FROM Projet WHERE (Libelle_avis = 'Favorable' && YEAR(date_creation) = $annee && IntitulleProjet IS NOT NULL && is_delete = 1)";
    $listing = $pdo->query($sql);
    
    
    if($listing === false){
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
        <title>Dashboard - UGAO| SIGAMP-94</title>

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
                <?php if ($_SESSION['droit'] != "admin" && $_SESSION['droit']!= "Ordonateur" && $_SESSION['droit']!= "courrier" && $_SESSION['droit']!= "UGAO" && $_SESSION['droit']!= "UGAC" && $_SESSION['droit']!= "UGAD") {
       echo' <link href="new_assets/assets_dashboard/css/style2.css" rel="stylesheet">';
        }else{
        echo' <link href="new_assets/assets_dashboard/css/style.css" rel="stylesheet">';}?>
  
</head>
<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="54">

    	 <?php include 'new_includes/header.php' ?>
    	  <?php if ($_SESSION['droit'] == "admin" || $_SESSION['droit'] == "Ordonateur" || $_SESSION['droit'] == "courrier" || $_SESSION['droit'] == "UGAO" || $_SESSION['droit'] == "UGAC" || $_SESSION['droit'] == "UGAD") {
      		 include 'slide.php';
        }
        ?>

        <main id="main" class="main">

            <div class="card recent-sales">
                <h1 class="card-title text-center fw-bold"> DASHBOARD UGAO: <?php echo($month . ' ' .$annee);?></h1>
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
                        <form action="Offre_dashboard.php" method="GET">
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
                                <h5 class="card-title">Avis <span>| des Offres</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $nbrAvis; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $nbrAvis ?></span> <span class="text-muted small pt-2 ps-1">Avis</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->

                    <!-- ======= Debut Récupérer le cumul du nombre de reunions executees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Offre  <span>| Total</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $nbrOffre; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $nbrOffre ?></span> <span class="text-muted small pt-2 ps-1">Offres</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions executees ======= -->

                     <!-- ======= Debut Récupérer le cumul du nombre de reunions programmees ======= -->
                     <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Offre <span>| Noté</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $nbrOffreNote; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $nbrOffreNote ?></span> <span class="text-muted small pt-2 ps-1">Offres</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions programmees ======= -->

                    <!-- ======= Debut Récupérer le cumul du nombre de reunions executees ======= -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Marchés    <span>| Attribué</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h6><?php echo $nbrOffreAttribue; ?></h6>
                                        <span class="text-success small pt-1 fw-bold"><?php echo $nbrOffreAttribue ?></span> <span class="text-muted small pt-2 ps-1">Marchés</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Fin Récupérer le cumul du nombre de reunions executees ======= -->

                    
                    <!-- ======= Fin Récupérer le cumul du nombre de recommandations executees ======= -->
                
                    <div class="col-lg-3 col-md-6 col-sm-6">
                            
                    	</div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Statistique des Offres</span></h5>
                                <div id="pieChart1"></div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#pieChart1"), {
                                            series: [
                                                <?php echo $nbrOffre; ?>,
                                                <?php echo $nbrOffreAttribue; ?>,
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
                                                'Attribué',
                                            ]
                                        }).render();
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                            
                    	</div>
                    
                    
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Note  <span>| Projets</span></h5>
                                
                                <?php
                                    while ($row = $listing->fetch(PDO::FETCH_ASSOC)) :
					$IDAvis2;
                                        $IntitulleProjet = htmlspecialchars($row['IntitulleProjet']);
                                        $IDProjet = htmlspecialchars($row['IDProjet']);
                                     ?>
                                       <h5><?php echo $IntitulleProjet; ?></h5>
                                    <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">N°</th>
                                            <th scope="col">Objet Offre</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Soumissionaire</th>
                                            <th scope="col">Note</th>
                                            <th scope="col">Remarque</th>
                                        </tr>
                                    </thead>
                                     <?php  

                                        $q = $pdo->prepare("SELECT IDAvis FROM AvisAppelOffre  WHERE (IDProjet = ?)");
					$q->execute([$IDProjet]);
					

                                        $increment = 0;
					 while ($data = $q->fetch(PDO::FETCH_ASSOC)) :
					$IDAvis2 = $data['IDAvis'];

                                        $sql = "SELECT * FROM Offre WHERE (Note IS NOT NULL && IDAvis = $IDAvis2)";
                                        $listingnote = $pdo->query($sql);
                               
					?>
                                    
                                    <tbody>
                                        <?php
                                        while ($row2 = $listingnote->fetch(PDO::FETCH_ASSOC)) :
                                            $objet_offre = htmlspecialchars($row2['objet_offre']);
                                            $Type = htmlspecialchars($row2['Type']);
                                            $IDSoumiss = htmlspecialchars($row2['IDSoumiss']);
                                            $Note = htmlspecialchars($row2['Note']);
                                            $Commentaire = htmlspecialchars($row2['Commentaire']);                                          
                                            
                                            $sql = "SELECT nom_entreprise FROM soumissionaire  WHERE (id_soumissionaire = $IDSoumiss)";
                                            $nom_entreprise = $pdo->query($sql);
                                            $nom_entreprise = $nom_entreprise->fetchColumn();

                                            
                                            
                                        ?>
                                            <tr>
                                                <th scope="row">#<?php echo $increment = $increment + 1; ?></th>
                                                <td><?php echo $objet_offre; ?></td>
                                                <td><?php echo $Type; ?></td>
                                                <td><?php echo $nom_entreprise; ?></td>
                                                <td><?php echo $Note; ?></td>
                                                <td><?php echo $Commentaire; ?></td>
                                            </tr>
                                            </tr>
                                        <?php
                                        endwhile;
                                        
                                    endwhile;
                                        ?>

                                    </tbody>
                                </table>
                                <?php
                                    endwhile;
                                ?>
                                
                            </div>
                        </div>
                    </div>

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
                                        while ($row = $listing1->fetch(PDO::FETCH_ASSOC)) :
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
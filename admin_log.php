<?php
    session_start(); // ouverture de la session
    include("libraries/autoload.php");
    use GroceryCrud\Core\GroceryCrud;

    $namePage = 'admin_dashboard';


error_reporting(E_ALL);
ini_set("display_errors", 1);

    $database = include('database.php');
    $config = include('config.php');
    $crud = new GroceryCrud($config, $database);
    include_once("db.php"); //pour les accès direct à la base de données
?>

<?php
    // gestion des droits sur l'affichage
    if (isset($_SESSION['idu'])&& ( $_SESSION['droit']== "admin")){ // si paramètres correct.
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

?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <!-- ======= Meta ======= -->
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <!-- ======= Title ======= -->
        <title>Logs| SIGAMP-94</title>

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

                <div class="text-center mb-2">
                    <button type="button" class="btn btn-info" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" data-bs-toggle="modal" data-bs-target="#basicModal">
                        Filtrer
                    </button>
            </div>

            <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Filtrer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="admin_log.php" method="GET">
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


                    <div class="col-lg-12">
                    <div class="card">
                                        <div class="card-body">
                                                <h5 class="card-title">Logs</h5>
                                                <table class="table nowrap table-hover datatable">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">N<sup>o</sup></th>
                                                            <th scope="col">Utilisateur</th>
                                                            <th scope="col">Action</th>
                                                            <th scope="col">Objet</th>
                                                            <th scope="col">Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql = "SELECT * FROM `logs` WHERE (YEAR(date_action) = $annee) ORDER BY id_logs DESC";
                                                        $general = $pdo->query($sql);
                                                        $compteur_realisations = 0;
                                                        while ($row = $general->fetch(PDO::FETCH_ASSOC)) :
                                                            $id_action = htmlspecialchars($row['id_action']);
                                                            $id_user = htmlspecialchars($row['id_user']);
                                                            $date_action = htmlspecialchars($row['date_action']);
                                                            $id_element = htmlspecialchars($row['id_element']);

                                                            $sql = "SELECT nom FROM rh_personnel WHERE (id_personnel = $id_user)";
                                                            $user = $pdo->query($sql); 
                                                            $user = $user ->fetchColumn();
                                                            
                                                            $sql = "SELECT * FROM action_log WHERE (id_action = $id_action)";
                                                            $action2 = $pdo->query($sql); 
                                                            $data = $action2->fetch(PDO::FETCH_ASSOC);
                                                            
                                                            $nom_action = $data['nom_action'];
    							    $tableConcerne = $data['tableConcerne'];
                                                            
                                                         if ($tableConcerne == "rh_personnel") {
                                                            
                                                            $sql = "SELECT nom FROM rh_personnel WHERE ( id_personnel = $id_element )";
                                                            $action = $pdo->query($sql); 
                                                            $action = $action ->fetchColumn();
                                                        
                                                    	   }elseif ($tableConcerne == "Projet")  {
                                                    	    
                                                    	      $sql = "SELECT Auteur FROM Projet WHERE (IDProjet = $id_element )";
                                                            $action = $pdo->query($sql); 
                                                            $action = $action ->fetchColumn();
                                                         }elseif ($tableConcerne == "archive")  {
                                                    	    
                                                            $sql = "SELECT IDProjet FROM archive WHERE ( id_archive = $id_element )";
                                                             $IDProjet = $pdo->query($sql); 
                                                             $IDProjet = $IDProjet ->fetchColumn();
                                                             $sql = "SELECT Auteur FROM Projet WHERE (IDProjet = $IDProjet )";
                                                            $action = $pdo->query($sql); 
                                                            $action = $action ->fetchColumn();
                                                         }elseif ($tableConcerne == "Avenant")  {
                                                    	    
                                                            $sql = "SELECT Motif FROM Avenant WHERE (IDAvenant = $id_element )";
                                                            $action = $pdo->query($sql); 
                                                            $action = $action ->fetchColumn();
                                                         }elseif ($tableConcerne == "AvisAppelOffre")  {
                                                    	    
                                                            $sql = "SELECT objet_avis FROM AvisAppelOffre WHERE (IDAvis = $id_element )";
                                                            $action = $pdo->query($sql); 
                                                            $action = $action ->fetchColumn();
                                                         }elseif ($tableConcerne == "Contrats")  {
                                                    	    
                                                            $sql = "SELECT Objet_contrat FROM Contrats WHERE (IDContrats = $id_element )";
                                                            $action = $pdo->query($sql); 
                                                            $action = $action ->fetchColumn();
                                                         }elseif ($tableConcerne == "DemandePaiement")  {
                                                    	    
                                                            $sql = "SELECT Objet FROM DemandePaiement WHERE (IDDmdePD = $id_element )";
                                                            $action = $pdo->query($sql); 
                                                            $action = $action ->fetchColumn();
                                                         }elseif ($tableConcerne == "descompte")  {
                                                    	    
                                                            $sql = "SELECT IDProjet FROM descompte WHERE (IDDecpte = $id_element )";
                                                            $IDProjet = $pdo->query($sql); 
                                                            $IDProjet = $IDProjet ->fetchColumn();
                                                            $sql = "SELECT Auteur FROM Projet WHERE (IDProjet = $IDProjet )";
                                                            $action = $pdo->query($sql); 
                                                            $action = $action ->fetchColumn();
                                                         }elseif ($tableConcerne == "des_doc_exige")  {
                                                    	    
                                                            $sql = "SELECT IDDecpte FROM des_doc_exige WHERE (IDDocExigible = $id_element )";
                                                            $IDDecpte = $pdo->query($sql); 
                                                            $IDDecpte = $IDDecpte ->fetchColumn();
                                                            $sql = "SELECT IDProjet FROM descompte WHERE (IDDecpte = $IDDecpte )";
                                                            $IDProjet = $pdo->query($sql); 
                                                            $IDProjet = $IDProjet ->fetchColumn();
                                                            $sql = "SELECT Auteur FROM Projet WHERE (IDProjet = $IDProjet )";
                                                            $action = $pdo->query($sql); 
                                                            $action = $action ->fetchColumn();
                                                         }elseif ($tableConcerne == "Offre")  {
                                                    	    
                                                            $sql = "SELECT objet_offre FROM Offre WHERE (IDOffre = $id_element )";
                                                            $action = $pdo->query($sql); 
                                                            $action = $action ->fetchColumn();
                                                         }elseif ($tableConcerne == "soumissionaire")  {
                                                    	    
                                                            $sql = "SELECT nom_entreprise FROM soumissionaire WHERE (id_soumissionaire = $id_element )";
                                                            $action = $pdo->query($sql); 
                                                            $action = $action ->fetchColumn();
                                                         }elseif ($tableConcerne == "attachement_decpt")  {
                                                    	    
                                                            $sql = "SELECT IDDecpte FROM attachement_decpt WHERE (IDattach = $id_element )";
                                                            $IDDecpte = $pdo->query($sql); 
                                                            $IDDecpte = $IDDecpte ->fetchColumn();
                                                            $sql = "SELECT IDProjet FROM descompte WHERE (IDDecpte = $IDDecpte )";
                                                            $IDProjet = $pdo->query($sql); 
                                                            $IDProjet = $IDProjet ->fetchColumn();
                                                            $sql = "SELECT Auteur FROM Projet WHERE (IDProjet = $IDProjet )";
                                                            $action = $pdo->query($sql); 
                                                            $action = $action ->fetchColumn();
                                                            
                                                    	    }

                                                                    
                                                            $compteur_realisations += 1;
                                                        ?>
                                                            <tr>
                                                                <th scope="row">#<?php echo $compteur_realisations; ?></th>
                                                                <td><?php echo $user; ?></td>
                                                                <td><?php echo $nom_action ; ?></td>
                                                                <td><?php echo $action ; ?></td>
                                                                <td><?php echo $date_action ; ?></td>
                                                             
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
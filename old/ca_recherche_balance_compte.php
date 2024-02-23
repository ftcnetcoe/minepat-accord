<?php
    session_start(); // ouverture de la session 
    include("libraries/autoload.php");
    use GroceryCrud\Core\GroceryCrud;

    $namePage = 'recherche_balance_comptes';

    $database = include('database.php');
    $config = include('config.php');
    $crud = new GroceryCrud($config, $database);
    include_once("db.php"); //pour les accès direct à la base de données

    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    $output = $crud->render();

    if ($output->isJSONResponse) {
        header('Content-Type: application/json; charset=utf-8');
        echo $output->output;
        exit;
    }

    $css_files = $output->css_files;
    $js_files = $output->js_files;
    $output = $output->output;
?>
<?php


if (isset($_SESSION['idu'])&& ( $_SESSION['droit']== "admin")){ // si paramètres correct. 
?>

<!DOCTYPE html>
<html>

    <head>
        <!-- ======= Meta ======= -->
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <!-- ======= Title ======= -->
        <title>Dashboard - RH | KIAMA 360</title>

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

        <!-- ======= Template Main CSS File ======= -->
        <link href="new_assets/assets_dashboard/css/style.css" rel="stylesheet">

       
    </head>

    <body>

        <!-- ======= Debut Header ======= -->
        <?php include 'new_includes/header.php'?>
        <!-- ======= Fin Header ======= -->

                        <!-- ======= Debut Header ======= -->
        		<?php include 'slide.php'?>
        		<!-- ======= Fin Header ======= -->
        		
        <main id="main" class="main">
        
             
         
                <div class="row">
          
                    <div class="col-12">
                        
                           <div class="card recent-sales">
		                <h1 class="card-title text-center fw-bold">BALLANCE DES COMPTES</h1>
		            </div>
		
		            <div class="container">
		                <div class="row mb-4">
		                    <div class="col-md-4 mx-auto">
		                        <h3 class="text-center mt-4 mb-4 h3">Période</h3>
		                        <form method="post" action ="ca_report_ope.php">
		                            <div class="mb-4">
		                                <label for="date_debut" class="form-label">Date debut :</label>
		                                <input name="date_debut" type="date" class="form-control" id="date_debut">
		                            </div>
		                            <div class="mb-4">
		                                <label for="date_fin" class="form-label">Date fin :</label>
		                                <input name="date_fin" type="date" class="form-control" id="date_fin">
		                            </div>
		                            <button class="w-100 btn btn-primary mb-2" type="submit">Soumettre</button>
		                        </form>
		                    </div>
		                </div>
		            </div>		
                            
                      
                    </div>
                </div>
         
       
        

            

            </main>


        <!-- ======= Debut Footer ======= -->
        <?php include_once 'new_includes/footer.php'?>
        <!-- ======= Fin Footer ======= -->

        <script src="new_assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
        <script src="new_assets/js/agency.js"></script>
        <script src="new_assets/js/DataTable---Fully-BSS-Editable.js"></script>
	
        <?php foreach($js_files as $file): ?>
            <script src="<?php /* affichage des resultat*/ echo $file; ?>"></script>
        <?php endforeach; ?>
    </body>
</html>
<?php	  
  }else{
	  header('Location: ../index.php' );  
  } 
?>
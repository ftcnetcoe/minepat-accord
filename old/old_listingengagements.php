<?php
session_start(); // ouverture de la session 
include("libraries/autoload.php");
use GroceryCrud\Core\GroceryCrud;

$database = include('database.php');
$config = include('config.php');
$crud = new GroceryCrud($config, $database);
include_once("db.php"); //pour les accès direct à la base de données
   $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

error_reporting(E_ALL);
ini_set("display_errors", 1);
  
$crud->setTable('ENGAGEMENT_FACTURE');
$crud->setSubject('Engagement_Facture', 'Gestion des Engagements_Factures');
$crud->setRelation('IDPROJ', 'PROJET', 'NOMPROJ');

if (!empty($_GET['idproj'])) $idproj = $_GET['idproj'];
else  header('Location: ../index.php' );

$crud->where(['IDPROJET = ?' => ''.$idproj.'']);  

//$crud->unsetSearchColumns(['IDPROJET', 'MTN', 'DESCRIP','JUSTIF', 'IDINTER']);

$crud->displayAs(array(
		 	'IDPROJET' => "Projet",
		 	'NUMERO' => "Numéro Facture",
                        'NUM_BC_CONTRAT' => "Numéro du Bon de Commande ou du Contrat",
		        'BC_CONTRAT' => 'Bon de Commande ou Contrat (PDF)',
		        'PJ_FACTURE' => 'Facture (PDF)',
			'MNT_TRANCH1' => 'Montant Tranche 1',
			'DATE_TRANCH1' => 'Date Tranche 1',
			'MNT_TRANCH2' => 'Montant Tranche 2',
			'DATE_TRANCH2' => 'Date Tranche 2',
			'MNT_TRANCH3' => 'Montant Tranche 3',
			'DATE_TRANCH3' => 'Date Tranche 3'
			
			
		)); 
		
		

	 $crud->unsetAdd(); 
	 $crud->unsetDelete();
	 $crud->unsetEdit();
 
 

 $uploadValidations = [
    'maxUploadSize' => '20M', // 20 Mega Bytes
    'minUploadSize' => '1K', // 1 Kilo Byte
    'allowedFileTypes' => [
        'pdf,PDF,doc,Docx'
    ]
];

$crud->setFieldUpload(
    'BC_CONTRAT', 
    'files/justif', 
    '/files/justif', 
    $uploadValidations
);

$crud->setFieldUpload(
    'PJ_FACTURE', 
    'files/justif', 
    '/files/justif', 
    $uploadValidations
);

$crud->defaultOrdering('DATE', 'ASC');
 
$crud->unsetDeleteMultiple();
   
 

 
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
 
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>KIAMA SA</title>
	<link rel="icon" type="image/png" href="logo/logo.png" />
	
	 
	
	
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan+Script">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
	
	<style>
 /* .btn-default {
	 background-color: #3c8dbc;
	 color: #f4f4f4;
 }
 
 .gc-filter-button{
	 display: none;
 }
 
 .dropdown-toggle{
	 display: none; 
 }
 
.content-wrapper {
   
   background: url("../logo/back.jpg");
   background-position: center;

}
*/
  </style>
     <style>
.container {
    padding-right: 15px;
    padding-left: 0px;
    margin-right: auto;
    margin-left: 0px;
}

</Style>
  <?php
    foreach($css_files as $file): ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
   <?php endforeach; ?>
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="54">
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-dark" id="mainNav">
        <div class="container"><a class="navbar-brand" href="#page-top" >GESTION&nbsp; KIAMA S.A</a><button data-bs-toggle="collapse" data-bs-target="#navbarResponsive" class="navbar-toggler navbar-toggler-right" type="button" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive" style="text-align: right;">
                <ul class="navbar-nav ms-auto text-uppercase">
                   <?php 
				  // include_once("menu.php");
				   ?>
                </ul>
            </div>
        </div>
    </nav>
    <header class="masthead" style="background-image:url('assets/img/header-bg.jpg');"></header>
    <section id="services" style="padding: 0px 0px;padding-top: 0px;padding-left: 0px;padding-bottom: 0px;">
        
			<!-- 
								Informatiions Menu secondaire ici 
								-->
			<?php						
	 /* echo "<center>";
	  include_once("solde.php");
	  echo "<a href='operation_debit.php'> ACTUALISER </a>";
	  echo "</center>"; */
	?>
		
		
        <section class="mt-4" style="padding: 3px 0px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        
                            <!-- <div class="card-header py-2">
                               
                            </div>-->
                            
                                
								  <div style="padding: 20px 10px;">
			                         <?php echo $output; ?>
                                   </div>
	   
								<!-- 
								Informatiions principales 
								-->
								
                            
                      
                    </div>
                </div>
            </div>
        </section>
    </section>
    
    
    <?php 
				   include_once("footer.php");
				   ?>
   
    
    
    
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
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
    <script src="assets/js/agency.js"></script>
    <script src="assets/js/DataTable---Fully-BSS-Editable.js"></script>
	
	<?php foreach($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>


</body>

</html>
<?php	  
  
?>
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
  
$crud->setTable('OPERATION_DEBIT');
$crud->setSubject('Operation de debit', 'Gestion des operations de débit');
$crud->setRelation('IDCOMPTEOP', 'COMPTE_OPERATION', 'NOMCOMPTE');
$crud->setRelation('IDPROJ', 'PROJET', 'NOMPROJ');
$crud->setRelation('IDENGAG_FAC', 'ENGAGEMENT_FACTURE', '{NUM_BC_CONTRAT}-{NOMPROJ}-{LIBELLE}'); //ajouter le Fournisseur
$crud->setRelation('IDCOMPTED', 'COMPTE_DEBIT', 'NOMCOMPTE');



if (!empty($_GET['idengagfac'])) $idengagfac= $_GET['idengagfac'];
else  header('Location: ../index.php' );

$crud->where(['	IDENGAG_FAC= ?' => ''.$idengagfac.'']);  

//$crud->unsetSearchColumns(['IDPROJET', 'MTN', 'DESCRIP','JUSTIF', 'IDINTER']);

$crud->displayAs(array(
            'IDOPERATION' => "ID",
            'IDCOMPTEOP' => "Compte d'operation",
		    'DATEOP' => 'Date',
		    'IDPROJ' => 'Projet',
			'IDENGAG_FAC' => 'Engagement_Facture',
			'IDCOMPTED' => 'Compte associé',
		)); 
		
$crud->columns(['IDOPERATION', 'IDCOMPTEOP', 'DATEOP','IDPROJ', 'IDENGAG_FAC', 'MONTANT','IDCOMPTED','BILLETEUR','MOTIF']);

		
		

	 $crud->unsetAdd(); 
	 $crud->unsetDelete();
	 $crud->unsetEdit();
 
 


//$crud->defaultOrdering('DATE', 'ASC');
 
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
  
  <?php
    foreach($css_files as $file): ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
   <?php endforeach; ?>
   
      <style>
.container {
    padding-right: 15px;
    padding-left: 0px;
    margin-right: auto;
    margin-left: 0px;
}

</Style>
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
<?php
session_start(); // ouverture de la session 
include("libraries/autoload.php");

use GroceryCrud\Core\GroceryCrud;

$namePage = "treso_jafb_bancaire";
$namePrincipal = 'jafb';
$namePrincipale = 'Jtresorerie';

$database = include('database.php');
$config = include('config.php');
$crud = new GroceryCrud($config, $database);
include_once("db.php"); //pour les accès direct à la base de données

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

error_reporting(E_ALL);
ini_set("display_errors", 1);
  $crud->setTable('ca_enregistrement');
$crud->setSubject('Frais Bancaire J AFB', 'Gestions des Frais Bancaire J AFB');

$crud->setRelation('IDPROJ', 'gl_projet', 'NOMPROJ', ['valide' => '0']);

$crud->where([
    'TYPEOPE = "Frais Bancaires"'
]);


//$crud->columns(['IDPROJ','date','montant','PJ','Commentaire','type','PJ','motif']);
$crud->unsetAddFields(['TYPEOPE']);
$crud->unsetEditFields(['TYPEOPE']);



  $crud->callbackColumn('montant', function ($value, $row) {
 
     if (!empty($value)) {
     
        return   "<div style='text-align : right'>". number_format($row->montant, 2, ',', ' ')."</div>"; 
        
    }else{
     return "<div style='text-align : right'>". $row->montant."</div>";
    }
      
    
});

 $crud->callbackColumn('PJ', function ($value, $row) {
            //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
            if (strlen($row->PJ) != 0) { return '<div class="myGallery">
   	    <a href="/files/fichevalid/'.$row->PJ.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
	      ​<span>'.$row->PJ.'</span>
	</div>';}
           
        });



$crud->callbackBeforeInsert(function ($stateParameters) {
    
    $stateParameters->data['TYPEOPE'] = "Frais Bancaires";
    
    return $stateParameters;
});


$crud->displayAs(array(

		 	'IDPROJ' => "Projet associé",
		        'date' => 'Date Opération',
		        'montant' => 'Montant',
			'PJ' => 'Piece Jointe',
			'Commentaire' => 'Commentaire',
			
			
		)); 
		
$crud->callbackColumn('Commentaire', function ($value, $row) {
    return "<div>" . wordwrap($row->Commentaire, 40, "<br>", false) . "</div>";
});

		
 if ($_SESSION['droit'] != "tresorerie" ){
 
	 $crud->unsetAdd(); 
	 $crud->unsetDelete();
	 $crud->unsetEdit();
	 
 }
 
 
 $uploadValidations = [
    'maxUploadSize' => '20M', // 20 Mega Bytes
    'minUploadSize' => '1K', // 1 Kilo Byte
    'allowedFileTypes' => [
        'pdf,PDF,doc,Docx'
    ]
];
$crud->setFieldUpload(
    'PJ', 
    'files/fichevalid', 
    '/files/fichevalid', 
    $uploadValidations
);

$crud->defaultOrdering('date', 'ASC');

$crud->unsetDelete();
$crud->unsetDeleteMultiple();
   
 /*
$crud->callbackBeforeInsert(function ($stateParameters) {
	 
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//recupère solde compte operation
	$sql = "SELECT BUDGETPROJ  FROM PROJET  where IDPROJ  = ? ";
	$q = $pdo->prepare($sql);
    $q->execute([$stateParameters->data['IDPROJET']]);
	$data2= $q->fetch(PDO::FETCH_ASSOC);
	$budgetprojet= $data2['BUDGETPROJ'];
	
	
	$sql = "SELECT  SUM(MTN) as total  FROM ENGAGEMENT where IDPROJET  = ? ";
	$q = $pdo->prepare($sql);
    $q->execute([$stateParameters->data['IDPROJET']]);
	$data = $q->fetch(PDO::FETCH_ASSOC);
	$total = $data['total'];
	

	
	 $t = $total +  $stateParameters->data['MTN'];
	
	 if ( $t > $budgetprojet){
		 
		  $errorMessage = new \GroceryCrud\Core\Error\ErrorMessage();
          return $errorMessage->setMessage("Vous ne pouvez enregistré cet engagement car  pour ce projet  les engagements  enregistrés  dépassent le budget du projet \n");
	}	
	
	
    return $stateParameters;
});






$crud->callbackBeforeUpdate(function ($stateParameters){

$pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//recupère solde compte operation
	$sql = "SELECT BUDGETPROJ  FROM PROJET  where IDPROJ  = ? ";
	$q = $pdo->prepare($sql);
    $q->execute([$stateParameters->data['IDPROJET']]);
	$data2= $q->fetch(PDO::FETCH_ASSOC);
	$budgetprojet= $data2['BUDGETPROJ'];
	
	
	$sql = "SELECT  SUM(MTN) as total  FROM ENGAGEMENT where IDPROJET  = ? ";
	$q = $pdo->prepare($sql);
    $q->execute([$stateParameters->data['IDPROJET']]);
	$data = $q->fetch(PDO::FETCH_ASSOC);
	$total = $data['total'];
	

	
	 $t = $total +  $stateParameters->data['MTN'];
	
	 if ( $t > $budgetprojet){
		 
		  $errorMessage = new \GroceryCrud\Core\Error\ErrorMessage();
          return $errorMessage->setMessage("Vous ne pouvez enregistré cet engagement car  pour ce projet  les engagements  enregistrés  dépassent le budget du projet \n");
	}		
	
return $stateParameters;	
});

*/


 
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


if (isset($_SESSION['idu'])&& ( $_SESSION['droit']== "admin" || $_SESSION['droit']== "budget" || $_SESSION['droit']== "daaf" || $_SESSION['droit']== "tresorerie" )){ // si paramètres correct. 
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    
    <title>KIAMA SA</title>
	 
    	<link rel="icon" type="image/png" href="logo/logo.png" />
        <link rel="apple-touch-icon" type="image/png" href="logo/logo.png" />

    
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    
        <link rel="stylesheet" href="new_assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="new_assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">

        
        <link href="new_assets/assets_dashboard/vendor/header/animsition/animsition.min.css" rel="stylesheet" media="all">
        <link href="new_assets/assets_dashboard/vendor/header/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">

        
        <link href="new_assets/assets_dashboard/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="new_assets/assets_dashboard/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="new_assets/assets_dashboard/vendor/remixicon/remixicon.css" rel="stylesheet">

        <?php
        foreach($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>

        <link href="new_assets/assets_dashboard/css/header/style.css" rel="stylesheet" media="all">

 
        <link href="new_assets/assets_dashboard/css/style.css" rel="stylesheet">  
  
</head>


<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="54">

    	 <?php include 'new_includes/header.php' ?>
        <?php include 'slide.php' ?>
        <main id="main" class="main">
        <div class="mt-3">
                <!-- CRUD-->
                <?php echo $output; ?>
            </div>
        </main>

	<!-- ======= Debut Footer ======= -->
        <?php include_once 'new_includes/footer.php'?>
        <!-- ======= Fin Footer ======= -->     
    
    
    
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

   <style>
.container {
    padding-right: 15px;
    padding-left: 0px;
    margin-right: auto;
    margin-left: 0px;
}

</Style>

</body>

</html>
<?php	  
  }else{
	  header('Location: ../index.php' );  
  }
?>
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
  
$crud->setTable('CREANCES');

$crud->setSubject('Créance', 'Gestion des Créances');

$crud->setRelation('IDPROJET', 'PROJET', 'NOMPROJ');

$crud->setRelation('IDC', 'CLIENTS', 'NOM');

 $crud->setRelationNtoN('ETAPE_CREANCE', 'LIAISON_CREAN_ETAP','ETAPE_CREANCE','IDCREA','IDETAP','LIBELLE');
 
 $crud->columns(['NUMERO_FACTURE','IDC','IDPROJET','MONTANT','DATE_FACTURATION','DATE_PREV','PJ_FACTURE','ETAPE_CREANCE','OBJECTIFSEM','STATUT']);
 
 

//$crud->setRelation('IDINTER', 'INTERVENANT', 'NOM');


/*if ($_SESSION['droit']== "gestionnaire" ){
	// afficher uniquement les engagements des projets  qui le concerne
	
	$sql = "SELECT IDPROJ  FROM PROJET where ID = ? ";
	$q = $pdo->prepare($sql);
    $q->execute([$_SESSION['idu']]);
	$results = $q->fetchAll(PDO::FETCH_ASSOC);
	
	if (count($results)>0){
	
		$cpt=1;
		
		$condition = "";
		foreach ($results as $row){
		
			 if ($cpt == count($results) ) $condition .= 'IDPROJET= '.$row['IDPROJ'];
			 else $condition .= 'IDPROJET= '.$row['IDPROJ']. ' OR ';
			 
			$cpt++;
		}
		
		$crud-> where($condition);
		
	} else $crud-> where("IDPROJET IS NULL"); // pas de projets associés au superviseur 
	
}else  if ($_SESSION['droit']== "superviseur"){ 
      // afficher uniquement les engagements des projets  qui le concerne
	
	$sql = "SELECT IDPROJ  FROM PROJET where IDSUP = ? ";
	$q = $pdo->prepare($sql);
    $q->execute([$_SESSION['idu']]);
	$results = $q->fetchAll(PDO::FETCH_ASSOC);
	
	if (count($results)>0){
	
		$cpt=1;
		
		$condition = "";
		foreach ($results as $row){
		
			 if ($cpt == count($results) ) $condition .= 'IDPROJET= '.$row['IDPROJ'];
			 else $condition .= 'IDPROJET= '.$row['IDPROJ']. ' OR ';
			 
			$cpt++;
		}
		
		$crud-> where($condition);
		
    }else $crud-> where("IDPROJET IS NULL"); // pas de projets associés au superviseur 
}
*/


$crud->displayAs(array(

		 	'IDPROJET' => "Projet",
		 	'IDC' => "CLIENT",
		 	'NUMERO_FACTURE' => "Numéro Facture",
            'DATE_EMISSION' => "Date d'émission",
            'DATE_PREV' => "Date Prévisionnel",
		    'DATE_FACTURATION' => 'Date de facturation',
		    'PJ_FACTURE' => 'Facture (PDF)',
			'DATE_PREVISIONNEL_PAIEMENT' => 'Date Prévisionnel de paiement',
			'ETAPE_CREANCE' => 'Etape de créance',
			'OBJECTIFSEM' => 'Objectif de la semaine',
            'certif_engagement' => "Certificat et bon D'engagement",
            'titre_creance' => "Titre de créance",
            'decharge_reception' => "Décharge Demande de Réception",
            'proces_verbal' => "Procès verbal de recette",
		    'decharge_paiement' => 'Décharge Dossier de Paiement',
		    'liquidation' => 'Liquidation',
			'ordonnancement' => 'Ordonnancement',
			'detail_validation' => 'Détail Validation',
			
			
			
		)); 
        $crud->columns(['NUMERO_FACTURE','IDC','IDPROJET','MONTANT','DATE_FACTURATION','DATE_PREV','PJ_FACTURE','ETAPE_CREANCE','certif_engagement','titre_creance','decharge_reception','proces_verbal','decharge_paiement','liquidation','ordonnancement','detail_validation','OBJECTIFSEM','STATUT']);
        

       /* $crud->unsetAddFields(['decharge_reception','proces_verbal', 'OBJECTIFSEM']);
        $crud->unsetColumns(['decharge_reception','proces_verbal', 'OBJECTIFSEM']);
        $crud->unsetEditFields(['decharge_reception','proces_verbal', 'OBJECTIFSEM']);*/
           

        $crud->callbackColumn('certif_engagement', function ($value, $row) {
            //return "<div style='text-align : left;'>". wordwrap($row->CNI, 50, "<br>", true)."</div>"; 
            if (strlen($row->certif_engagement) != 0) { return '<div class="myGallery">
   	    <a href="/files/justif/'.$row->certif_engagement.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
	      ​<span>'.$row->certif_engagement.'</span>
	</div>';}
           
        });
        $crud->callbackColumn('titre_creance', function ($value, $row) {
            //return "<div style='text-align : left;'>". wordwrap($row->CNI, 50, "<br>", true)."</div>"; 
            if (strlen($row->titre_creance) != 0) { return '<div class="myGallery">
   	    <a href="/files/justif/'.$row->titre_creance.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
	      ​<span>'.$row->titre_creance.'</span>
	</div>';}
           
        });
        
        $crud->callbackColumn('decharge_reception', function ($value, $row) {
            //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
            if (strlen($row->decharge_reception) != 0) { return '<div class="myGallery">
   	    <a href="/files/justif/'.$row->decharge_reception.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
	     ​<span>'.$row->decharge_reception.'</span>
	</div>';}
   
        });
        $crud->callbackColumn('proces_verbal', function ($value, $row) {
            //return "<div style='text-align : left;'>". wordwrap($row->CNI, 50, "<br>", true)."</div>"; 
            if (strlen($row->proces_verbal) != 0) { return '<div class="myGallery">
   	    <a href="/files/justif/'.$row->proces_verbal.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
	      ​<span>'.$row->proces_verbal.'</span>
	</div>';}
           
        });
        $crud->callbackColumn('decharge_paiement', function ($value, $row) {
            //return "<div style='text-align : left;'>". wordwrap($row->CNI, 50, "<br>", true)."</div>"; 
            if (strlen($row->decharge_paiement) != 0) { return '<div class="myGallery">
   	    <a href="/files/justif/'.$row->decharge_paiement.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
	      ​<span>'.$row->decharge_paiement.'</span>
	</div>';}
           
        });
        
        $crud->callbackColumn('liquidation', function ($value, $row) {
            //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
            if (strlen($row->liquidation) != 0) { return '<div class="myGallery">
   	    <a href="/files/justif/'.$row->liquidation.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
	     ​<span>'.$row->liquidation.'</span>
	</div>';}
   
        });
        $crud->callbackColumn('ordonnancement', function ($value, $row) {
            //return "<div style='text-align : left;'>". wordwrap($row->CNI, 50, "<br>", true)."</div>"; 
            if (strlen($row->ordonnancement) != 0) { return '<div class="myGallery">
   	    <a href="/files/justif/'.$row->ordonnancement.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
	      ​<span>'.$row->ordonnancement.'</span>
	</div>';}
           
        });
        $crud->callbackColumn('detail_validation', function ($value, $row) {
            //return "<div style='text-align : left;'>". wordwrap($row->CNI, 50, "<br>", true)."</div>"; 
            if (strlen($row->detail_validation) != 0) { return '<div class="myGallery">
   	    <a href="/files/justif/'.$row->detail_validation.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
	      ​<span>'.$row->detail_validation.'</span>
	</div>';}
           
        });
        
        $crud->callbackColumn('PJ_FACTURE', function ($value, $row) {
            //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
            if (strlen($row->PJ_FACTURE) != 0) { return '<div class="myGallery">
   	    <a href="/files/justif/'.$row->PJ_FACTURE.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
	     ​<span>'.$row->PJ_FACTURE.'</span>
	</div>';}
   
        });

		
 /*if ($_SESSION['droit'] != "budget" ){
 
	 
	 $crud->unsetDelete();
	 $crud->unsetEdit();
	 
 }*/
 
 
 $uploadValidations = [
    'maxUploadSize' => '20M', // 20 Mega Bytes
    'minUploadSize' => '1K', // 1 Kilo Byte
    'allowedFileTypes' => [
        'pdf,PDF,doc,Docx'
    ]
];



$crud->setFieldUpload(
    'PJ_FACTURE', 
    'files/justif', 
    '/files/justif', 
    $uploadValidations
);
$crud->setFieldUpload(
    'certif_engagement', 
    'files/justif', 
    '/files/justif', 
    $uploadValidations
);
$crud->setFieldUpload(
    'titre_creance', 
    'files/justif', 
    '/files/justif', 
    $uploadValidations
);
$crud->setFieldUpload(
    'decharge_reception', 
    'files/justif', 
    '/files/justif', 
    $uploadValidations
);
$crud->setFieldUpload(
    'proces_verbal', 
    'files/justif', 
    '/files/justif', 
    $uploadValidations
);
$crud->setFieldUpload(
    'decharge_paiement', 
    'files/justif', 
    '/files/justif', 
    $uploadValidations
);
$crud->setFieldUpload(
    'liquidation', 
    'files/justif', 
    '/files/justif', 
    $uploadValidations
);
$crud->setFieldUpload(
    'ordonnancement', 
    'files/justif', 
    '/files/justif', 
    $uploadValidations
);
$crud->setFieldUpload(
    'detail_validation', 
    'files/justif', 
    '/files/justif', 
    $uploadValidations
);

  $crud->callbackColumn('MONTANT', function ($value, $row) {
 
     if (!empty($value)) {
     
        return   "<div style='text-align : right; width:100px;'>". number_format($row->MONTANT, 0, '.', ' ')."</div>"; 
        
    }else{
    
         return "<div style='text-align : right; width:100px;'>". $row->MONTANT."</div>";
         
    }
      
    
});


//$crud->defaultOrdering('DATE_EMISSION', 'ASC');
 
$crud->unsetAdd(); 
$crud->unsetDelete();
$crud->unsetDeleteMultiple();
 $crud->unsetEdit();   

/*
$crud->callbackBeforeInsert(function ($stateParameters) {
      
     
       
   
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//recupère solde compte operation
	$sql = "SELECT * FROM ETAPE_CREANCE where IDETAP not in (Select IDETAP from `LIAISON_CREAN_ETAP` where IDCREA= ? ) ";
	$q = $pdo->prepare($sql);
        $q->execute([$stateParameters->insertId]); 
	$results = $q->fetchAll(PDO::FETCH_ASSOC);
	
	$objsem="";
	foreach ($results as $row){
	
		 $objsem = $objsem."  ".$row['LIBELLE'];	
		  	
	}
		
		
	$stateParameters->data['OBJECTIFSEM']= $objsem; 
	
	
    return $stateParameters;
});

*/



$crud->callbackBeforeUpdate(function ($stateParameters){

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//recupère solde compte operation
	$sql = "SELECT * FROM ETAPE_CREANCE where IDETAP not in (Select IDETAP from `LIAISON_CREAN_ETAP` where IDCREA= ? ) ";
	$q = $pdo->prepare($sql);
        $q->execute([$stateParameters->primaryKeyValue]); 
	$results = $q->fetchAll(PDO::FETCH_ASSOC);
	
	$objsem="";
	foreach ($results as $row){
	
		 $objsem = $objsem."  ".$row['LIBELLE'];	
		  	
	}
		
		
	$stateParameters->data['OBJECTIFSEM']= $objsem; 
	
	
return $stateParameters;
	
});




 
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


if (isset($_SESSION['idu'])&& ( $_SESSION['droit']== "admin" || $_SESSION['droit']== "budget" || $_SESSION['droit']== "gestionnaire" || $_SESSION['droit']== "superviseur" || $_SESSION['droit']== "tresorerie" )){ // si paramètres correct. 
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
				   include_once("menu.php");
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
	  echo "<center>";
	  include_once("echeancier.php"); 
	//  include_once("echeancier_mensuel.php");
	  echo "</center>";
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
  }else{
	  header('Location: ../index.php' );  
  }
?>
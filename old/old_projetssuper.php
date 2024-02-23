<?php
session_start(); // ouverture de la session 
include("libraries/autoload.php");
use GroceryCrud\Core\GroceryCrud;

$database = include('database.php');
$config = include('config.php');
$crud = new GroceryCrud($config, $database);
include_once("db.php"); //pour les accès direct à la base de données

/*
if (!empty($_GET['mois'])) $mois = $_GET['mois'];
else  $mois = date('m');
*/

error_reporting(E_ALL);
ini_set("display_errors", 1);
  
$crud->setTable('PROJET');
$crud->setSubject('gl_projet', 'Gestion des projets');

$crud->setRelation('IDPROG', 'PROGRAMME', 'NOMPROG');
$crud->setRelation('ID', 'PERSONNEL', '{NOM} {PRENOM}');
$crud->setRelation('IDSUP', 'PERSONNEL', '{NOM} {PRENOM}');

if ($_SESSION['droit']== "superviseur"){
	
	
	 $crud->where([
		    'IDSUP = ?' => ''.$_SESSION['idu'].''
         ]);  

	
}  
   

$crud->callbackColumn('CUMULDEP', function ($value, $row) {

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $q = $pdo->prepare("SELECT SUM(MONTANT) as MNT  FROM OPERATION_DEBIT where IDPROJ = ? ");
    $q->execute([$row->IDPROJ]);
    $data= $q->fetch(PDO::FETCH_ASSOC);
    $value= $data['MNT']; 
    
   // return "<a href='" . site_url('menu/' . $row->profile_url) . "'>$value</a>";
    return "<div style='text-align : right'>".number_format($value, 0, '.', ' ')."</div>";
});

$crud->callbackColumn('CUMULENGAG', function ($value, $row) {

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $q = $pdo->prepare("SELECT SUM(MONTANT) as MTN  FROM ENGAGEMENT_FACTURE where IDPROJET = ? ");
    $q->execute([$row->IDPROJ]);
    $data= $q->fetch(PDO::FETCH_ASSOC);
    $value= $data['MTN']; 
    
   // return "<a href='" . site_url('menu/' . $row->profile_url) . "'>$value</a>";
    return "<div style='text-align : right'>".number_format($value, 0, '.', ' ')."</div>";
});



$crud->callbackColumn('LISTINGDEP', function ($value, $row) {

  // return "<a class='btn btn-primary' href='/listingdepenses.php?idproj=". $row->IDPROJ."' target='blank' >LISTING DEPENSE</a>"; 
 //  <iframe class="embed-responsive-item" src=https://budget.kiama.cm/listingdepenses.php?idproj='.$row->IDPROJ.'" ></iframe>
 
  $modal='<div class="modal" id="exampleModal'.$row->IDPROJ.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen" style="width=100%" role="document">
    <div class="modal-content" style="min-height: 0px; max-height: 712px;">
      
      <div class="modal-body">
          <iframe src=https://budget.kiama.cm/listingdepenses.php?idproj='.$row->IDPROJ.'" frameborder="0" style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;height:100%;width:100%;position:absolute;top:0%;left:0px;right:0px;bottom:0px" height="100%" width="100%"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>'; 
 $modal= $modal. '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal'.$row->IDPROJ.'"> LISTING DEPENSE </button>';
    
  return $modal; 
 
});

$crud->callbackColumn('LISTINGENGAG', function ($value, $row) {

    // $row->profile_url is now available as invisible field
    
  
    
  return "<a class='btn btn-primary' href='/listingengagements.php?idproj=". $row->IDPROJ."' target='blank' >LISTING ENGAGEMENTS</a>";
    
});



/* else if ($_SESSION['droit']== "superviseur"){
    
     $crud->where([
		    'IDSUP = ?' => ''.$_SESSION['idu'].''
         ]); 
         
} */

$crud->displayAs(array(
			'IDPROG' => "Programme",
             'NOMPROJ' => "Nom du projet",
		    'NOMCLIENT' => 'Nom du client',
		    'IDPROJ' => 'Projet',
			 'MTNPROJ' => 'Montant du projet(Recette)',
			 'BUDGETPROJ' => 'Budget du projet (Dépense)',
			  'DTEDEBUT' => 'Date de début',
			  'DTEDEFIN' => 'Date de fin',
			  'DUREEPROJ' => 'Durée du projet',
			  'CUMULDEP' => "Cumul Dépense",
			  'CUMULENGAG' => "Cumul Engagement",
			  'LISTINGDEP' => "Listing Dépense",
			  'LISTINGENGAG' => "Listing engagement",
			  'COMPTEEXPLOI' => "Compte d'exploitation du projet",
			  'FICHEVALID' => "Fiche de validation du projet", 
			  'ID' => "Gestionnaire du projet",
			   'IDSUP' => "Superviseur",
		)); 
		
		
$crud->unsetAddFields(['DUREEPROJ','IDSUP','CUMULDEP','LISTINGDEP','LISTINGENGAG']);   //champ calculé automatiquement *********************
$crud->unsetEditFields(['DUREEPROJ','IDSUP','CUMULDEP','LISTINGDEP','LISTINGENGAG']);

$crud->requiredFields(['IDPROG','NOMPROJ','DTEDEBUT','DTEDEFIN','MTNPROJ','BUDGETPROJ','ID']);   //champ calculé automatiquement *********************

$crud->unsetSearchColumns(['IDPROG', 'FICHEVALID', 'IDSUP','ID', 'LISTINGENGAG', 'LISTINGDEP','CUMULDEP','DUREEPROJ','DTEDEFIN','DTEDEBUT','DTEDEFIN','STATUT','FICHECLOTURE','COMPTEEXPLOI','NOMCLIENT','BUDGETPROJ','MTNPROJ']);

/*

$crud->setActionButton('Expression Besoin', 'fa fa-file-pdf-o', function ($row) {

    return 'fiche_eb.php/?nomproj=' . $row->NOMPROJ;
    
}, false);

*/

$crud->callbackColumn('MTNPROJ', function ($value, $row) {
 
     if (!empty($value)) {
     
        return   "<div style='text-align : right'>".number_format($row->MTNPROJ, 0, '.', ' ')."</div>";
        
    }else{
     return "<div style='text-align : right'>".$row->MTNPROJ."</div>";
    }

});

$crud->callbackColumn('BUDGETPROJ', function ($value, $row) {
 
     if (!empty($value)) {
     
        return   "<div style='text-align : right'>".number_format($row->BUDGETPROJ, 0, '.', ' ')."</div>";
        
    }else{
     return "<div style='text-align : right'>".$row->BUDGETPROJ."</div>";
    }
      
    
});

		
 
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
    'COMPTEEXPLOI', 
    'files/docprojet', 
    '/files/docprojet', 
    $uploadValidations
);

$crud->setFieldUpload(
    'FICHEVALID', 
    'files/fichevalid', 
    '/files/fichevalid', 
    $uploadValidations
);


$crud->defaultOrdering('NOMPROJ', 'ASC');
 
$crud->unsetDelete();
$crud->unsetDeleteMultiple();
   
 /*
 
 $crud->callbackBeforeInsert(function ($stateParameters) {
 
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
 
        $stateParameters->data['MTNPROJ']=preg_replace('/[^0-9]/', '',$stateParameters->data['MTNPROJ']);
        $stateParameters->data['BUDGETPROJ']=preg_replace('/[^0-9]/', '',$stateParameters->data['BUDGETPROJ']);
	
	$dt_deb= $stateParameters->data['DTEDEBUT'];
	$dt_fin= $stateParameters->data['DTEDEFIN'];
	
	 if ( $dt_fin <= $dt_deb){
		     $errorMessage = new \GroceryCrud\Core\Error\ErrorMessage();
                return $errorMessage->setMessage("La date de fin du projet ne peut être identique ou inférieur à la date de début !\n");
	 }
	 
	 $date1 = strtotime($dt_deb);
	 $date2 = strtotime($dt_fin);
	 $nbJoursTimestamp = $date2 - $date1;
         $nbJours = $nbJoursTimestamp/86400;
         
         $stateParameters->data['DUREEPROJ'] = $nbJours.' jours';
         
 
     // Définition du superviseur******************************************************************************************
  $id_gest = $stateParameters->data['ID']; // ID du gestionnaire
  // recupère le département du gestionnaire
  

    $q = $pdo->prepare("SELECT IDDPT  FROM PERSONNEL where ID = ? ");
    $q->execute([$stateParameters->data['ID']]);
    $data= $q->fetch(PDO::FETCH_ASSOC);
    $IDGETS= $data['IDDPT'];
    
    // recupère l'ID du chef de département en question *********
    $q2 = $pdo->prepare("SELECT per.ID as ID FROM POSTE p inner join PERSONNEL per on p.IDPOSTE= per.IDPOSTE where per.IDDPT = ? and STATUT= 'chef' ");
    $q2->execute([$IDGETS]);
    $data2= $q2->fetch(PDO::FETCH_ASSOC);
    $IDSUP= $data2['ID'];
    
    $stateParameters->data['IDSUP']=  $IDSUP;
    
   
	
    return $stateParameters;
});





$crud->callbackBeforeUpdate(function ($stateParameters){

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $stateParameters->data['MTNPROJ']=preg_replace('/[^0-9]/', '',$stateParameters->data['MTNPROJ']);
        $stateParameters->data['BUDGETPROJ']=preg_replace('/[^0-9]/', '',$stateParameters->data['BUDGETPROJ']);
        

        $dt_deb= $stateParameters->data['DTEDEBUT'];
	$dt_fin= $stateParameters->data['DTEDEFIN'];
	
	 if ( $dt_fin <= $dt_deb){
		     $errorMessage = new \GroceryCrud\Core\Error\ErrorMessage();
                return $errorMessage->setMessage("La date de fin du projet ne peut être identique ou inférieur à la date de début !\n");
	 }
	 
	 $date1 = strtotime($dt_deb);
	 $date2 = strtotime($dt_fin);
	 $nbJoursTimestamp = $date2 - $date1;
         $nbJours = $nbJoursTimestamp/86400;
         
         $stateParameters->data['DUREEPROJ']= $nbJours.' jours';
         
         
  // Définition du superviseur******************************************************************************************
  $id_gest = $stateParameters->data['ID']; // ID du gestionnaire
  // recupère le département du gestionnaire
  

    $q = $pdo->prepare("SELECT IDDPT  FROM PERSONNEL where ID = ? ");
    $q->execute([$stateParameters->data['ID']]);
    $data= $q->fetch(PDO::FETCH_ASSOC);
    $IDGETS= $data['IDDPT'];
    
    // recupère l'ID du chef de département en question *********
    $q2 = $pdo->prepare("SELECT per.ID as ID FROM POSTE p inner join PERSONNEL per on p.IDPOSTE= per.IDPOSTE where per.IDDPT = ? and STATUT= 'chef' ");
    $q2->execute([$IDGETS]);
    $data2= $q2->fetch(PDO::FETCH_ASSOC);
    $IDSUP= $data2['ID'];
    
    $stateParameters->data['IDSUP']=  $IDSUP;
   

	
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


if (isset($_SESSION['idu'])&& ($_SESSION['droit']== "superviseur")){ // si paramètres correct. 
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
    
   
	 <?php
    foreach($css_files as $file): ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
   <?php endforeach; ?>
   <style>
     .modal-dialog {
     width : 100%;
     }
   </style>
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
	 /* echo "<center>";
	  include_once("solde_compte_operations.php");
	  echo "<a href='projet.php' class='btn btn-primary'> ACTUALISER </a>";
	  echo "</center>";*/
	?>
		
		
        <section class="mt-4" style="padding: 3px 0px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        
                            <!-- <div class="card-header py-2">
                               
                            </div>-->
                            
                                
				   <div style="padding: 30px 10px;">
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
   
    
    
    
    <!-- <script src="assets/bootstrap/js/bootstrap.min.js"></script>-->
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
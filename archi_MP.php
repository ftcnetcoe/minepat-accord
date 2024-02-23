<?php
session_start(); // ouverture de la session 
include("libraries/autoload.php");
use GroceryCrud\Core\GroceryCrud;

$database = include('database.php');
$config = include('config.php');
$crud = new GroceryCrud($config, $database);
include_once("db.php"); //pour les accès direct à la base de données

$namePage= "archi_MP";
$namePrincipalAd = 'archives';



//error_reporting(E_ALL);
//ini_set("display_errors", 1);


$crud->setTable('archive'); //definition de la table
$crud->setSubject('Archives', 'Gestion des Archives ');

$crud->setRelation('IDProjet', 'Projet', 'IntitulleProjet');


//definition de l'afichage des champs de la table
$crud->displayAs(array(
            'IDProjet' => "Projet",
	     	'PJ_Lancement' => "Lancement de la Consultation",   
		    'PJ_RegistreRetrait' => 'Registre des Retraits',
            'PJ_RegistrePlis' => 'Registre de Depot des Plis',
		    'PJ_PV_ComOuverture' => 'PV de la Commission',
            'PJ_TabBordAnalyOffres' => "Tableau d'analyse des Offres",
            'PJ_RapportPres' => "Rapport de Présentation",               	
		)); 

		
		
 $crud->columns(['IDProjet','PJ_Lancement','PJ_RegistreRetrait','PJ_RegistrePlis','PJ_PV_ComOuverture','PJ_TabBordAnalyOffres','PJ_RapportPres']);
 $crud->editFields(['IDProjet','PJ_Lancement','PJ_RegistreRetrait','PJ_RegistrePlis','PJ_PV_ComOuverture','PJ_TabBordAnalyOffres','PJ_RapportPres']);
 $crud->addFields(['IDProjet','PJ_Lancement','PJ_RegistreRetrait','PJ_RegistrePlis','PJ_PV_ComOuverture','PJ_TabBordAnalyOffres','PJ_RapportPres']);
$crud->where([
    'archive.is_delete = 1',
]);

$crud->callbackColumn('PJ_Lancement', function ($value, $row) {
    $Page = "archi_MP";
    
             $modal='<div class="modal fade" id="PJ_Lancement'.$row->id_archive.'" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content" style="min-height: 150px; max-height: 200px;">
                  <div class="modal-header">
                                <h4 class="modal-title">Archive</h4>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                      <form action="archive_traitement.php" method="post"  role="form" enctype="multipart/form-data">
                    <div class="modal-body">  
                    <label for="modele" class="form-label">Lancement de la Consultation</label>
                    <input type="file" name="PJ" id="PJ" class="form-control">
                                    <input id="ID" name="ID" type="hidden" value="'.$row->id_archive.'" />
                                    <input id="page" name="page" type="hidden" value="'.$Page.'" />
                                    <input id="champs" name="champs" type="hidden" value="PJ_Lancement" />
                    
                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                                </div>
                                </form>
    
                    
                  </div>
                </div>
              </div>'; 
              if (empty($row->PJ_Lancement)){
               $modal= $modal. '<center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_Lancement'.$row->id_archive.'">Ajout</button></center>'; 
              }else{
                $modal= $modal. '<a href="/files/docprojet/'.$row->PJ_Lancement.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;​<span>'.$row->PJ_Lancement.'</span></center>'; 
                $modal= $modal. '<br/><br/><center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_Lancement'.$row->id_archive.'">Modification</button></center>'; 
               }      
                return $modal; 
});
$crud->callbackColumn('PJ_RegistreRetrait', function ($value, $row) {
    $Page = "archi_MP";
    
             $modal='<div class="modal fade" id="PJ_RegistreRetrait'.$row->id_archive.'" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content" style="min-height: 150px; max-height: 200px;">
                  <div class="modal-header">
                                <h4 class="modal-title">Archive</h4>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                      <form action="archive_traitement.php" method="post"  role="form" enctype="multipart/form-data">
                    <div class="modal-body">  
                    <label for="modele" class="form-label">Registre des Retraits</label>
                    <input type="file" name="PJ" id="PJ" class="form-control">
                                    <input id="ID" name="ID" type="hidden" value="'.$row->id_archive.'" />
                                    <input id="page" name="page" type="hidden" value="'.$Page.'" />
                                    <input id="champs" name="champs" type="hidden" value="PJ_RegistreRetrait" />
                    
                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                                </div>
                                </form>
    
                    
                  </div>
                </div>
              </div>'; 
              if (empty($row->PJ_RegistreRetrait)){
               $modal= $modal. '<center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_RegistreRetrait'.$row->id_archive.'">Ajout</button></center>'; 
              }else{  
                $modal= $modal. '<a href="/files/docprojet/'.$row->PJ_RegistreRetrait.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;​<span>'.$row->PJ_RegistreRetrait.'</span>'; 
                $modal= $modal. '<br/><br/><center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_RegistreRetrait'.$row->id_archive.'">Modification</button></center>'; 
                
            }      
                return $modal; 
});
$crud->callbackColumn('PJ_RegistrePlis', function ($value, $row) {
    $Page = "archi_MP";
    
             $modal='<div class="modal fade" id="PJ_RegistrePlis'.$row->id_archive.'" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content" style="min-height: 150px; max-height: 200px;">
                  <div class="modal-header">
                                <h4 class="modal-title">Archive</h4>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                      <form action="archive_traitement.php" method="post"  role="form" enctype="multipart/form-data">
                    <div class="modal-body">  
                    <label for="modele" class="form-label">Registre des Dépots de Plis</label>
                    <input type="file" name="PJ" id="PJ" class="form-control">
                                    <input id="ID" name="ID" type="hidden" value="'.$row->id_archive.'" />
                                    <input id="page" name="page" type="hidden" value="'.$Page.'" />
                                    <input id="champs" name="champs" type="hidden" value="PJ_RegistrePlis" />
                    
                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                                </div>
                                </form>
    
                    
                  </div>
                </div>
              </div>'; 
              if (empty($row->PJ_RegistrePlis)){
               $modal= $modal. '<center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_RegistrePlis'.$row->id_archive.'">Ajout</button></center>'; 
              }else{
               $modal= $modal. '<a href="/files/docprojet/'.$row->PJ_RegistrePlis.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;​<span>'.$row->PJ_RegistrePlis.'</span>'; 
               $modal= $modal. '<br/><br/><center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_RegistrePlis'.$row->id_archive.'">Modification</button></center>'; 
               
            }      
                return $modal; 
});
$crud->callbackColumn('PJ_PV_ComOuverture', function ($value, $row) {
    $Page = "archi_MP";
    
             $modal='<div class="modal fade" id="PJ_PV_ComOuverture'.$row->id_archive.'" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content" style="min-height: 150px; max-height: 200px;">
                  <div class="modal-header">
                                <h4 class="modal-title">Archive</h4>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                      <form action="archive_traitement.php" method="post"  role="form" enctype="multipart/form-data">
                    <div class="modal-body">  
                    <label for="modele" class="form-label">PV de la Commission</label>
                    <input type="file" name="PJ" id="PJ" class="form-control">
                                    <input id="ID" name="ID" type="hidden" value="'.$row->id_archive.'" />
                                    <input id="page" name="page" type="hidden" value="'.$Page.'" />
                                    <input id="champs" name="champs" type="hidden" value="PJ_PV_ComOuverture" />
                    
                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                                </div>
                                </form>
    
                    
                  </div>
                </div>
              </div>'; 
              if (empty($row->PJ_PV_ComOuverture)){
               $modal= $modal. '<center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_PV_ComOuverture'.$row->id_archive.'">Ajout</button></center>'; 
              }else{
               $modal= $modal. '<a href="/files/docprojet/'.$row->PJ_PV_ComOuverture.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;​<span>'.$row->PJ_PV_ComOuverture.'</span>'; 
               $modal= $modal. '<br/><br/><center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_PV_ComOuverture'.$row->id_archive.'">Modification</button></center>'; 
               
            }      
                return $modal; 
});
$crud->callbackColumn('PJ_TabBordAnalyOffres', function ($value, $row) {
    $Page = "archi_MP";
    
             $modal='<div class="modal fade" id="PJ_TabBordAnalyOffres'.$row->id_archive.'" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content" style="min-height: 150px; max-height: 200px;">
                  <div class="modal-header">
                                <h4 class="modal-title">Archive</h4>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                      <form action="archive_traitement.php" method="post"  role="form" enctype="multipart/form-data">
                    <div class="modal-body">  
                    <label for="modele" class="form-label">Tableau d\'analyse</label>
                    <input type="file" name="PJ" id="PJ" class="form-control">
                                    <input id="ID" name="ID" type="hidden" value="'.$row->id_archive.'" />
                                    <input id="page" name="page" type="hidden" value="'.$Page.'" />
                                    <input id="champs" name="champs" type="hidden" value="PJ_TabBordAnalyOffres" />
                    
                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                                </div>
                                </form>
    
                    
                  </div>
                </div>
              </div>'; 
              if (empty($row->PJ_TabBordAnalyOffres)){
               $modal= $modal. '<center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_TabBordAnalyOffres'.$row->id_archive.'">Ajout</button></center>'; 
              }else{
               $modal= $modal. '<a href="/files/docprojet/'.$row->PJ_TabBordAnalyOffres.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;​<span>'.$row->PJ_TabBordAnalyOffres.'</span>'; 
               $modal= $modal. '<br/><br/><center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_TabBordAnalyOffres'.$row->id_archive.'">Modification</button></center>'; 
               
            }      
                return $modal; 
});
$crud->callbackColumn('PJ_RapportPres', function ($value, $row) {
    $Page = "archi_MP";
    
             $modal='<div class="modal fade" id="PJ_RapportPres'.$row->id_archive.'" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content" style="min-height: 150px; max-height: 200px;">
                  <div class="modal-header">
                                <h4 class="modal-title">Archive</h4>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                      <form action="archive_traitement.php" method="post"  role="form" enctype="multipart/form-data">
                    <div class="modal-body">  
                    <label for="modele" class="form-label">Rapport de Presentation</label>
                    <input type="file" name="PJ" id="PJ" class="form-control">
                                    <input id="ID" name="ID" type="hidden" value="'.$row->id_archive.'" />
                                    <input id="page" name="page" type="hidden" value="'.$Page.'" />
                                    <input id="champs" name="champs" type="hidden" value="PJ_RapportPres" />
                    
                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                                </div>
                                </form>
    
                    
                  </div>
                </div>
              </div>'; 
              if (empty($row->PJ_RapportPres)){
               $modal= $modal. '<center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_RapportPres'.$row->id_archive.'">Ajout</button></center>'; 
              }else{
               $modal= $modal. '<a href="/files/docprojet/'.$row->PJ_RapportPres.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;​<span>'.$row->PJ_RapportPres.'</span>'; 
               $modal= $modal. '<br/><br/><center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_RapportPres'.$row->id_archive.'">Modification</button></center>'; 
               
            }      
                return $modal; 
});
              

$crud->callbackDelete(function ($stateParameters) {

    $id = $stateParameters->primaryKeyValue;
    $modele = 50;
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $delete = $pdo->prepare('Update archive SET is_delete = 0 WHERE id_archive = ?');
    $delete->execute([$id]);
    
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $debit = $pdo->prepare('INSERT INTO logs (id_action, id_user, date_action, id_element) VALUES (?,?,?,?)');
    $debit->execute([$modele , $_SESSION['idu'] , $dateact, $id]);
    return $stateParameters;
});


$crud->callbackBeforeUpdate(function ($stateParameters){
    
    
    $dateact = date("Y-m-d H:i:s");
    
    $stateParameters->data['date_update']=  $dateact;
    $stateParameters->data['id_update']=  $_SESSION['idu'];
        
   
    return $stateParameters;
});
$crud->callbackAfterUpdate(function ($stateParameters){
    $dateact = date("Y-m-d H:i:s");
    $modele = 49;
    $id = $stateParameters->primaryKeyValue;
    
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $debit = $pdo->prepare('INSERT INTO logs (id_action, id_user, date_action, id_element) VALUES (?,?,?,?)');
    $debit->execute([$modele , $_SESSION['idu'] , $dateact, $id]);
    
    
    return $stateParameters;
});



$crud->defaultOrdering('IDProjet', 'ASC');

if ($_SESSION['droit']!= "admin" && $_SESSION['droit']!= "Archivage"){
   
    
    $crud->unsetDelete();
}
$crud->unsetEdit();
$crud->unsetAdd(); 
$crud->unsetDeleteMultiple();

$uploadValidations = [
    'maxUploadSize' => '20M', // 20 Mega Bytes
    'minUploadSize' => '1K', // 1 Kilo Byte
    'allowedFileTypes' => [
        'pdf,PDF,doc,Docx,ZIP,zip,ISO,iso'
    ]
];
  
 
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

// gestion des droits sur l'affichage
if (isset($_SESSION['idu'])&& ( $_SESSION['droit']== "admin" || $_SESSION['droit'] == "Archivage")){ // si paramètres correct. 
?>

<html>

<head>
	
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        
        
        <title> CONTRACTUALISATION - MINEPAT </title>

       
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

        
        <!-- ======= Template Main CSS File Dashboard ======= -->
                <?php if ($_SESSION['droit'] != "admin" && $_SESSION['droit']!= "Archivage") {
       echo' <link href="new_assets/assets_dashboard/css/style2.css" rel="stylesheet">';
        }else{
        echo' <link href="new_assets/assets_dashboard/css/style.css" rel="stylesheet">';}?>
  
</head>
<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="54">

    	 <?php include 'new_includes/header.php' ?>
    	  <?php if ($_SESSION['droit'] == "admin" || $_SESSION['droit']== "Archivage") {
      		 include 'slide.php';
        }
        ?>
    	 
        <main id="main" class="main">
            
        <div class="mt-3">
                <!-- CRUD-->
                <?php echo $output; ?>
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
	  header('Location: index.php' );  
  }
?>
<?php
session_start(); // ouverture de la session 
include("libraries/autoload.php");
use GroceryCrud\Core\GroceryCrud;

$database = include('database.php');
$config = include('config.php');
$crud = new GroceryCrud($config, $database);
include_once("db.php"); //pour les accès direct à la base de données

$namePage= "des_descompte";
$namePrincipalAd = 'descompte';



//error_reporting(E_ALL);
//ini_set("display_errors", 1);


$crud->setTable('descompte'); //definition de la table
$crud->setSubject('Décompte', 'Gestion des Décomptes Avance Démarrage');

$crud->setRelation('IDContrats', 'Contrats', 'Objet_contrat');
$crud->setRelation('IDProjet', 'Projet', 'IntitulleProjet', ['Libelle_avis' => 'Favorable']);
$crud->setRelation('IDSoumiss', 'soumissionaire', 'nom_entreprise');
$crud->setRelation('IDDmdePD', 'DemandePaiement', 'Objet', ['Avis' => 'Approuvé']);
$crud->setRelation('idAttribution', 'Offre', 'objet', ['is_recours' => 1]);


//definition de l'afichage des champs de la table
$crud->displayAs(array(
	     	'IDContrats' => "Contrat",
	     	'IDProjet' => "Projet",   
		'IDSoumiss' => 'Auteur',  
		'IDDmdePD' => 'Demande de Paiement', 
		'Type' => 'Type',
		'Montant' => 'Montant',
                'PJ_note_paiement' => "Note de Paiement",   
                'Pj_Accord_paiement' => "Accord de Paiement Signé",  
                'Doc_exigible' => "Document Exigible",       
                'date' => "Date",     
	     	'idAttribution' => "Décision d'attribution",      	
		)); 

		
		
$crud->columns(['Doc_exigible','IDContrats','idAttribution','IDProjet','IDSoumiss','IDDmdePD','date','Type','Montant','PJ_note_paiement','Pj_Accord_paiement']);
$crud->editFields(['IDContrats','IDProjet','idAttribution','IDSoumiss','IDDmdePD','Type','date','Montant','PJ_note_paiement','Pj_Accord_paiement']);
$crud->addFields(['IDContrats','IDProjet','idAttribution','IDSoumiss','IDDmdePD','Type','date','Montant','PJ_note_paiement','Pj_Accord_paiement']);
$crud->requiredFields(['IDContrats','idAttribution','IDProjet','IDDmdePD','date']);

$crud->where([
    'descompte.is_delete = 1',
]);

 $crud->callbackColumn('Doc_exigible', function ($value, $row) {

            $modal='<center><div class="modal" id="exampleModal'.$row->IDDecpte.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-fullscreen-xl-down" style="width: 1240px" role="document">
              <div class="modal-content" style="min-height: 600px; max-height: 900px;">
                
                <div class="modal-body">
                    <iframe src="http://minepat.kiama.cm/des_doc_exigible.php?IDDecpte='.$row->IDDecpte.'" frameborder="0" style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;height:100%;width:100%;position:absolute;top:0%;left:0px;right:0px;bottom:0px" height="100%" width="100%"></iframe>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 
                </div>
              </div>
            </div>
          </div></center>'; 
           $modal= $modal. '<button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModal'.$row->IDDecpte.'">Documents</button>';
              
            return $modal; 
           
 });

 $crud->callbackColumn('Montant', function ($value, $row) {
     if (!empty($value)) {    
        return   "<div style='text-align : right'>". number_format($row->Montant, 0, ',', ' ')."</div>";        
    }else{
     return "<div style='text-align : right'>". $row->Montant."</div>";
    }   
});

$crud->callbackColumn('PJ_note_paiement', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->PJ_note_paiement) != 0) { return '<div class="myGallery">
    <a href="/files/docprojet/'.$row->PJ_note_paiement.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
    ​<span>'.$row->PJ_note_paiement.'</span>
    </div>';}
           
});
$crud->callbackColumn('Pj_Accord_paiement', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->Pj_Accord_paiement) != 0) { return '<div class="myGallery">
    <a href="/files/docprojet/'.$row->Pj_Accord_paiement.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
    ​<span>'.$row->Pj_Accord_paiement.'</span>
    </div>';}
           
});

$crud->callbackDelete(function ($stateParameters) {

    $id = $stateParameters->primaryKeyValue;
    $modele = 14;
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $delete = $pdo->prepare('Update descompte SET is_delete = 0 WHERE IDDecpte = ?');
    $delete->execute([$id]);
    
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $debit = $pdo->prepare('INSERT INTO logs (id_action, id_user, date_action, id_element) VALUES (?,?,?,?)');
    $debit->execute([$modele , $_SESSION['idu'] , $dateact, $id]);
    return $stateParameters;
});

$crud->callbackBeforeInsert(function ($stateParameters){

    $dateact = date("Y-m-d H:i:s");
    
    
    $stateParameters->data['date_creation']=  $dateact;
    $stateParameters->data['date_creation']=  "Avance démarrage";
    $stateParameters->data['id_creation']=  $_SESSION['idu'];
    return $stateParameters;

});
//recuperation du poste superieur apres mise a jour

$crud->callbackBeforeUpdate(function ($stateParameters){
    
    
    $dateact = date("Y-m-d H:i:s");
    
    $stateParameters->data['date_update']=  $dateact;
    $stateParameters->data['id_update']=  $_SESSION['idu'];
        
   
    return $stateParameters;
});
$crud->callbackAfterInsert(function ($stateParameters) {
    $dateact = date("Y-m-d H:i:s");
    $modele = 35;
    $id = $stateParameters->insertId;
    
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $debit = $pdo->prepare('INSERT INTO logs (id_action, id_user, date_action, id_element) VALUES (?,?,?,?)');
    $debit->execute([$modele , $_SESSION['idu'] , $dateact, $id]);

    return $stateParameters;
});

$crud->callbackAfterUpdate(function ($stateParameters){
    $dateact = date("Y-m-d H:i:s");
    $modele = 36;
    $id = $stateParameters->primaryKeyValue;
    
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $debit = $pdo->prepare('INSERT INTO logs (id_action, id_user, date_action, id_element) VALUES (?,?,?,?)');
    $debit->execute([$modele , $_SESSION['idu'] , $dateact, $id]);
    
    
    return $stateParameters;
});



 $crud->unsetEdit();
 $crud->unsetAdd(); 
 $crud->unsetDelete();
 $crud->unsetDeleteMultiple();

$uploadValidations = [
    'maxUploadSize' => '20M', // 20 Mega Bytes
    'minUploadSize' => '1K', // 1 Kilo Byte
    'allowedFileTypes' => [
        'pdf,PDF,doc,Docx,ZIP,zip,ISO,iso'
    ]
];

$crud->setFieldUpload(
    'PJ_note_paiement', 
    'files/docprojet', 
    '/files/docprojet', 
    $uploadValidations
); 
$crud->setFieldUpload(
    'Pj_Accord_paiement', 
    'files/docprojet', 
    '/files/docprojet', 
    $uploadValidations
); 
   
 
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
if (isset($_SESSION['idu'])&& ( $_SESSION['droit']== "admin" || $_SESSION['droit'] == "UGAD")){ 
?>
<html>

<head>
	
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        
        
        <title> Décompte - MINEPAT </title>

       
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
                <?php if ($_SESSION['droit'] != "admin" && $_SESSION['droit']!= "UGAD") {
       echo' <link href="new_assets/assets_dashboard/css/style2.css" rel="stylesheet">';
        }else{
        echo' <link href="new_assets/assets_dashboard/css/style.css" rel="stylesheet">';}?>
  
</head>
<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="54">

    	 <?php include 'new_includes/header.php' ?>
    	  <?php if ($_SESSION['droit'] == "admin"  || $_SESSION['droit'] == "UGAD") {
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
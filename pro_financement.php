<?php
session_start(); // ouverture de la session 
include("libraries/autoload.php");
use GroceryCrud\Core\GroceryCrud;

$database = include('database.php');
$config = include('config.php');
$crud = new GroceryCrud($config, $database);
include_once("db.php"); //pour les accès direct à la base de données

$namePage= "pro_financement";
$namePrincipalAd = 'Projet';



//error_reporting(E_ALL);
//ini_set("display_errors", 1);


$crud->setTable('Projet'); //definition de la table
$crud->setSubject('Demande de Financement', 'Gestion des Demande de Financement');



//definition de l'afichage des champs de la table
$crud->displayAs(array(
	     	'Auteur' => "Auteur",   
		'Typeauteur' => 'Type',
		'Objet' => 'Objet de la Lettre',
                'Resume' => "Description",     
		'PJ_Lettre' => 'Lettre',
            	'PJ_Autres_demande' => 'Autres Pièces Jointes',
            	'Date_Depot_financement' => 'Date de Dépot', 
            	'InstructionTraitement' => 'Instruction de Traitement',
            	'NoteProjet' => 'Note',
            	'PJ_ProjetACC_REF' => 'Projet de Financement',           	
		)); 

		
if ($_SESSION['droit'] == "courrier"){
 $crud->columns(['Auteur','Typeauteur','Date_Depot_financement','Objet','Resume','PJ_Lettre','PJ_Autres_demande']);
 $crud->editFields(['Auteur','Typeauteur','Date_Depot_financement','Objet','Resume','PJ_Lettre','PJ_Autres_demande']);
 $crud->addFields(['Auteur','Typeauteur','Date_Depot_financement','Objet','Resume','PJ_Lettre','PJ_Autres_demande']);
$crud->requiredFields(['Auteur','Date_Depot_financement', 'Objet', 'PJ_Lettre']);
}elseif ($_SESSION['droit']== "Ordonateur"){
  $crud->columns(['Auteur','Typeauteur','Date_Depot_financement','Objet','Resume','InstructionTraitement','NoteProjet','PJ_ProjetACC_REF','PJ_Lettre','PJ_Autres_demande']);
 $crud->editFields(['Auteur', 'Objet','Resume','InstructionTraitement']);
 $crud->addFields(['Auteur', 'Objet','Resume','InstructionTraitement']);
$crud->readOnlyFields(['Auteur','Objet','Resume']);
 
}elseif ($_SESSION['droit']== "DPI"){
  $crud->columns(['Auteur','Typeauteur','Date_Depot_financement','Objet','Resume','InstructionTraitement','NoteProjet','PJ_ProjetACC_REF','PJ_Lettre','PJ_Autres_demande']);
 $crud->editFields(['Auteur','Objet','Resume','NoteProjet','PJ_ProjetACC_REF']);
 $crud->addFields(['Auteur','Objet','Resume','NoteProjet','PJ_ProjetACC_REF']);
 
$crud->readOnlyFields(['Auteur','Objet','Resume']);
}elseif ($_SESSION['droit']== "admin"){
  $crud->columns(['Auteur','Typeauteur','Date_Depot_financement','Objet','Resume','InstructionTraitement','NoteProjet','PJ_ProjetACC_REF','PJ_Lettre','PJ_Autres_demande']);
 $crud->editFields(['Auteur','Typeauteur','Date_Depot_financement','Objet','Resume','InstructionTraitement','NoteProjet','PJ_ProjetACC_REF','PJ_Lettre','PJ_Autres_demande']);
 $crud->addFields(['Auteur','Typeauteur','Date_Depot_financement','Objet','Resume','InstructionTraitement','NoteProjet','PJ_ProjetACC_REF','PJ_Lettre','PJ_Autres_demande']);
$crud->requiredFields(['Auteur','Date_Depot_financement', 'Objet', 'PJ_Lettre']);
}
$crud->where([
    'is_delete = 1'
]);

$crud->callbackColumn('Resume', function ($value, $row) {
    return "<div>" . wordwrap($row->Resume, 50, "<br>", false) . "</div>";
});

$crud->callbackColumn('PJ_Lettre', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->PJ_Lettre) != 0) { return '<div class="myGallery">
    <a href="/files/docprojet/'.$row->PJ_Lettre.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
    ​<span>'.$row->PJ_Lettre.'</span>
    </div>';}
           
});
$crud->callbackColumn('PJ_Autres_demande', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->PJ_Autres_demande) != 0) { return '<div class="myGallery">
    <a href="/files/docprojet/'.$row->PJ_Autres_demande.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
    ​<span>'.$row->PJ_Autres_demande.'</span>
    </div>';}
           
});
$crud->callbackColumn('PJ_ProjetACC_REF', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->PJ_ProjetACC_REF) != 0) { return '<div class="myGallery">
    <a href="/files/docprojet/'.$row->PJ_ProjetACC_REF.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
    ​<span>'.$row->PJ_ProjetACC_REF.'</span>
    </div>';}
           
});
$crud->callbackColumn('InstructionTraitement', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->InstructionTraitement) != 0) { return '<div class="myGallery">
    <a href="/files/docprojet/'.$row->InstructionTraitement.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
    ​<span>'.$row->InstructionTraitement.'</span>
    </div>';}
           
});


$crud->callbackDelete(function ($stateParameters) {

    $id = $stateParameters->primaryKeyValue;
    $modele = 10;
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $delete = $pdo->prepare('Update Projet SET is_delete = 0 WHERE IDProjet = ?');
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
    $modele = 3;
    $id = $stateParameters->insertId;
    
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $debit = $pdo->prepare('INSERT INTO logs (id_action, id_user, date_action, id_element) VALUES (?,?,?,?)');
    $debit->execute([$modele , $_SESSION['idu'] , $dateact, $id]);

    return $stateParameters;
});

$crud->callbackAfterUpdate(function ($stateParameters){
    $dateact = date("Y-m-d H:i:s");
    $modele = 4;
    $id = $stateParameters->primaryKeyValue;
    
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $debit = $pdo->prepare('INSERT INTO logs (id_action, id_user, date_action, id_element) VALUES (?,?,?,?)');
    $debit->execute([$modele , $_SESSION['idu'] , $dateact, $id]);
    
    
    return $stateParameters;
});



$crud->defaultOrdering('Auteur', 'ASC');


if ($_SESSION['droit']!= "admin" && $_SESSION['droit']!= "courrier" && $_SESSION['droit']!= "Ordonateur" && $_SESSION['droit']!= "DPI"){
    $crud->unsetEdit();
}
if ($_SESSION['droit']!= "admin" && $_SESSION['droit']!= "courrier"){
    $crud->unsetAdd(); 
    $crud->unsetDelete();
}

$crud->unsetDeleteMultiple();
$uploadValidations = [
    'maxUploadSize' => '20M', // 20 Mega Bytes
    'minUploadSize' => '1K', // 1 Kilo Byte
    'allowedFileTypes' => [
        'pdf,PDF,doc,Docx,ZIP,zip,ISO,iso'
    ]
];

$crud->setFieldUpload(
    'PJ_Lettre', 
    'files/docprojet', 
    '/files/docprojet', 
    $uploadValidations
); 
$crud->setFieldUpload(
    'PJ_Autres_demande', 
    'files/docprojet', 
    '/files/docprojet', 
    $uploadValidations
); 
$crud->setFieldUpload(
    'PJ_ProjetACC_REF', 
    'files/docprojet', 
    '/files/docprojet', 
    $uploadValidations
); 
$crud->setFieldUpload(
    'InstructionTraitement', 
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
if (isset($_SESSION['idu'])&& ( $_SESSION['droit']== "admin" || $_SESSION['droit'] == "courrier" || $_SESSION['droit'] == "Ordonateur" || $_SESSION['droit'] == "DPI" )){ // si paramètres correct. 
?>

<html>

<head>
	
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        
        
        <title>PROJET - MINEPAT </title>

       
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
                <?php if ($_SESSION['droit'] != "admin" && $_SESSION['droit']!= "courrier" && $_SESSION['droit']!= "Ordonateur" && $_SESSION['droit']!= "DPI") {
       echo' <link href="new_assets/assets_dashboard/css/style2.css" rel="stylesheet">';
        }else{
        echo' <link href="new_assets/assets_dashboard/css/style.css" rel="stylesheet">';}?>
  
</head>
<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="54">

    	 <?php include 'new_includes/header.php' ?>
    	  <?php if ($_SESSION['droit'] == "admin" || $_SESSION['droit']== "courrier" || $_SESSION['droit'] == "Ordonateur" || $_SESSION['droit'] == "DPI" ) {
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
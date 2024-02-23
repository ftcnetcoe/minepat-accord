<?php
session_start(); // ouverture de la session 
include("libraries/autoload.php");
use GroceryCrud\Core\GroceryCrud;

$database = include('database.php');
$config = include('config.php');
$crud = new GroceryCrud($config, $database);
include_once("db.php"); //pour les accès direct à la base de données

$namePage= "pro_projet_valide";
$namePrincipalAd = 'Projet';



//error_reporting(E_ALL);
//ini_set("display_errors", 1);


$crud->setTable('Projet'); //definition de la table
$crud->setSubject('Projet Validé', 'Gestion des Projets Validés');



//definition de l'afichage des champs de la table
$crud->displayAs(array(
	     	'IntitulleProjet' => "Intitullé du Projet",   
		'Montant' => 'Montant',
		'nature_depense' => 'Nature des Depense',
                'unite_physique' => "Unité Physique",     
		'Gestionnaire' => 'Gestionnaire',
            	'Poste_compt_assig' => 'Poste Comptable Assignataire', 
            	'mode_gestion' => 'Mode de Gestion',
            	'Date_projet_valide' => 'Date',
            	'Reference' => 'Réference',           	
		)); 

		
		
 $crud->columns(['Auteur','Objet','Resume','Reference','Date_projet_valide','IntitulleProjet','Montant','nature_depense']);
 $crud->editFields(['Auteur','Objet','Resume','Reference','Date_projet_valide','IntitulleProjet','Montant','nature_depense']);
 $crud->addFields(['Auteur','Objet','Resume','Reference','Date_projet_valide','IntitulleProjet','Montant','nature_depense']);
$crud->requiredFields(['IntitulleProjet','Reference','Date_projet_valide','Montant']);
$crud->readOnlyFields(['Auteur','Objet','Resume']);

$crud->where([
    'is_delete = 1',
    'Libelle_avis = "Favorable"',
]);

 $crud->callbackColumn('Montant', function ($value, $row) {
     if (!empty($value)) {    
        return   "<div style='text-align : right'>". number_format($row->Montant, 0, ',', ' ')."</div>";        
    }else{
     return "<div style='text-align : right'>". $row->Montant."</div>";
    }   
});

$crud->callbackBeforeInsert(function ($stateParameters){

    $dateact = date("Y-m-d H:i:s");
    
    
    $stateParameters->data['date_creation']=  $dateact;
    $stateParameters->data['id_creation']=  $_SESSION['idu'];
    return $stateParameters;

});
//recuperation du poste superieur apres mise a jour

$crud->callbackBeforeUpdate(function ($stateParameters){
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dateact = date("Y-m-d H:i:s");
    $ID= $stateParameters->primaryKeyValue;
    $verif = $pdo->prepare('SELECT * FROM archive where id_archive = ?');
    $verif->execute([$ID]);
    $dataverif = $verif->fetch(PDO::FETCH_ASSOC);
    $test = $dataverif['id_archive'];
        
        if (!isset($test) && empty($test)) {
        $verif = $pdo->prepare('INSERT INTO archive  (IDProjet,date_creation,id_creation ) VALUES (?,?,?)');
        $verif->execute([$ID, $dateact, $_SESSION['idu']]);
    	}
    
    
    $stateParameters->data['date_update']=  $dateact;
    $stateParameters->data['id_update']=  $_SESSION['idu'];
    
        
   
    return $stateParameters;
});
$crud->callbackAfterInsert(function ($stateParameters) {
    $dateact = date("Y-m-d H:i:s");
    $modele = 7;
    $id = $stateParameters->insertId;
    
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $debit = $pdo->prepare('INSERT INTO logs (id_action, id_user, date_action, id_element) VALUES (?,?,?,?)');
    $debit->execute([$modele , $_SESSION['idu'] , $dateact, $id]);

    return $stateParameters;
});

$crud->callbackAfterUpdate(function ($stateParameters){
    $dateact = date("Y-m-d H:i:s");
    $modele = 8;
    $id = $stateParameters->primaryKeyValue;
    
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $debit = $pdo->prepare('INSERT INTO logs (id_action, id_user, date_action, id_element) VALUES (?,?,?,?)');
    $debit->execute([$modele , $_SESSION['idu'] , $dateact, $id]);
    
    
    return $stateParameters;
});



$crud->defaultOrdering('Auteur', 'ASC');

if ($_SESSION['droit']!= "admin" && $_SESSION['droit']!= "Ordonateur"){
   
    $crud->unsetEdit();
}

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
if (isset($_SESSION['idu'])&& ( $_SESSION['droit']== "admin" || $_SESSION['droit'] == "Ordonateur" || $_SESSION['droit'] == "courrier" || $_SESSION['droit'] == "UGAO" || $_SESSION['droit'] == "UGAC" || $_SESSION['droit'] == "UGAD" || $_SESSION['droit'] == "CSM" || $_SESSION['droit'] == "Archivage" || $_SESSION['droit'] == "DPI" || $_SESSION['droit'] == "Controleur_Financier")){ // si paramètres correct. 
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
                <?php if ($_SESSION['droit'] != "admin" && $_SESSION['droit']!= "Ordonateur" && $_SESSION['droit']!= "courrier" && $_SESSION['droit']!= "UGAO" && $_SESSION['droit']!= "UGAC" && $_SESSION['droit']!= "UGAD" && $_SESSION['droit']!= "CSM" && $_SESSION['droit']!= "Archivage" && $_SESSION['droit'] != "DPI" && $_SESSION['droit'] != "Controleur_Financier") {
       echo' <link href="new_assets/assets_dashboard/css/style2.css" rel="stylesheet">';
        }else{
        echo' <link href="new_assets/assets_dashboard/css/style.css" rel="stylesheet">';}?>
  
</head>
<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="54">

    	 <?php include 'new_includes/header.php' ?>
    	  <?php if ($_SESSION['droit'] == "admin" || $_SESSION['droit'] == "Ordonateur" || $_SESSION['droit'] == "courrier" || $_SESSION['droit'] == "UGAO" || $_SESSION['droit'] == "UGAC" || $_SESSION['droit'] == "UGAD" || $_SESSION['droit'] == "CSM" || $_SESSION['droit'] == "Archivage" || $_SESSION['droit'] == "DPI" || $_SESSION['droit'] == "Controleur_Financier") {
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
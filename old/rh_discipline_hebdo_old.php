<?php
session_start(); // ouverture de la session 
include("libraries/autoload.php");
use GroceryCrud\Core\GroceryCrud;

$namePage = 'rh_discipline_hebdo';
 $namePrincipalAd = 'discipline';

$database = include('database.php');
$config = include('config.php');
$crud = new GroceryCrud($config, $database);
include_once("db.php"); //pour les accès direct à la base de données

/*
error_reporting(E_ALL);
ini_set("display_errors", 1);
*/
$crud->setTable('rh_discipline_hebdo'); //definition de la table
$crud->setSubject('Evaluation', 'Discipline et Evaluation Hebdomadaire');

//mise en relation des tables pour la selection du poste et des departements
$crud->setRelation('personel', 'rh_personnel', '{nom} {prenom}');
$crud->setRelation('unite', 'rh_poste', 'nom_poste');
//$crud->setDependentRelation('id_poste','id_unite','id_poste');

//definition de l'afichage des champs de la table
$crud->displayAs(array(
	     	'personel' => "Personnel",  
	     	'unite' => "Poste", 
	     	'date' => "Date de fin de semaine",    
		    'semaine' => 'Numero de Semaine',
            'note' => 'Apreciation',
			//'fiche_evaluation' => "Fiche de pointage et d'apreciation",
			'realisation_semaine' => 'Principales Réalisation de la semaines',
            'perspective' => 'Perpectives de réalisation S+1',
			'activite_critique_non' => 'Activités critique non résolues ou Besions Importants',
			'risque' => 'Risques et Moyens de Contournement',
            'absence' => "Nombres d'abscence (en minutes)",     
		    'absence_justifier' => "Nombres d'abscence Justifié",
            'heure_supp' => 'Heures Supplémentaires (en minutes)',
		)); 
		
$crud->requiredFields(['personel']);
$crud->unsetAddFields(['unite']);
$crud->unsetEditFields(['unite', 'personel']);
/*
$crud->callbackColumn('fiche_evaluation', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->fiche_evaluation) != 0) { return '<div class="myGallery">
   <a href="/files/docprojet/'.$row->fiche_evaluation.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
  ​<span>'.$row->fiche_evaluation.'</span>
</div>';}
   
});
*/
/*
  $crud->callbackBeforeInsert(function ($stateParameters){
	$date = date('d-m-y h:i:s');
        $stateParameters->data['date'] = $date;
        
        return $stateParameters;	
    });*/
   
   //remplissage du departement en fonction du personnel

$crud->callbackBeforeInsert(function ($stateParameters){
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q1 = $pdo->prepare("SELECT id_poste FROM rh_personnel where id_personnel = ? ");
    $q1->execute([$stateParameters->data['personel']]);
    $data1= $q1->fetch(PDO::FETCH_ASSOC);
    $value1= $data1['id_poste'];
    $stateParameters->data['unite']=  $value1;
    return $stateParameters;

});

$crud->defaultOrdering('personel', 'ASC');

if ( $_SESSION['droit']!= "RH" && $_SESSION['droit']!= "admin"){
    $crud->unsetAdd(); 
    $crud->unsetEdit();
}

$crud->unsetDelete();
$crud->unsetDeleteMultiple();
   

$uploadValidations = [
    'maxUploadSize' => '20M', // 20 Mega Bytes
    'minUploadSize' => '1K', // 1 Kilo Byte
    'allowedFileTypes' => [
        'pdf,PDF,doc,Docx'
    ]
];
/*
$crud->setFieldUpload(
    'fiche_evaluation', 
    'files/docprojet', 
    '/files/docprojet', 
    $uploadValidations
);*/

 
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
if (isset($_SESSION['idu'])&& ( $_SESSION['droit']== "admin" || $_SESSION['droit']== "RH" || $_SESSION['droit']== "soca")){ // si paramètres correct. 
?>

<!DOCTYPE html>
<html>

<head>
	<!-- ======= Meta ======= -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        
        <!-- ======= Title ======= -->
        <title>Evaluation Hebdomadaire | KIAMA 360</title>

        <!-- ======= Favicons ======= -->
    	<link rel="icon" type="image/png" href="logo/logo.png" />
        <link rel="apple-touch-icon" type="image/png" href="logo/logo.png" />

    	<!-- ======= Google Fonts ======= -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- ======= Vendor CSS Files ======= -->
        <link rel="stylesheet" href="new_assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="new_assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">

        <!-- ======= Vendor CSS Files Header ======= -->
        <link href="new_assets/assets_dashboard/vendor/header/animsition/animsition.min.css" rel="stylesheet" media="all">
        <link href="new_assets/assets_dashboard/vendor/header/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">

        <!-- ======= Vendor CSS Files Dashboard ======= -->
        <link href="new_assets/assets_dashboard/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="new_assets/assets_dashboard/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="new_assets/assets_dashboard/vendor/remixicon/remixicon.css" rel="stylesheet">

        <!-- ======= Template Main CSS File ======= -->
        <?php
        foreach($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>

        <!-- ======= Template Main CSS File Header ======= -->
        <link href="new_assets/assets_dashboard/css/header/style.css" rel="stylesheet" media="all">

        <!-- ======= Template Main CSS File Dashboard ======= -->
        <link href="new_assets/assets_dashboard/css/style.css" rel="stylesheet">
  
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="54">

    	<!-- ======= Debut Header ======= -->
        <?php include 'new_includes/header.php'?>
        <!-- ======= Fin Header ======= -->

    <section id="services" style="padding: 0px 0px;padding-top: 0px;padding-left: 0px;padding-bottom: 0px;">
        
	
        <section class="mt-4" style="padding: 3px 0px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                         <div style="padding: 20px 10px;">
			                <?php echo $output; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

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
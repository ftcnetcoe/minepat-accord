<?php
session_start(); // ouverture de la session 
include("libraries/autoload.php");
use GroceryCrud\Core\GroceryCrud;

$database = include('database.php');
$config = include('config.php');
$crud = new GroceryCrud($config, $database);
include_once("db.php"); //pour les accès direct à la base de données

$namePage= "partenaire";
$namePrincipalAd = 'tiers';
$namePrincipalA = 'tiers';
$namePrincipalRH = 'discipline';

/*
if (!empty($_GET['mois'])) $mois = $_GET['mois'];
else  $mois = date('m');


error_reporting(E_ALL);
ini_set("display_errors", 1);
  */
$crud->setTable('financier');
$crud->setSubject('Financier de l\'entreprise', 'Gestion des Financiers');

//$crud->setRelation('IDPROJ', 'projet', 'NOMPROJ');
//$crud->setRelation('ID', 'PERSONNEL', '{NOM} {PRENOM}');
//$crud->setRelation('IDSUP', 'PERSONNEL', '{NOM} {PRENOM}');
//$crud->setRelation('NOMCLIENT', 'CLIENTS', 'NOM');


/*if ($_SESSION['droit']== "gestionnaire" || $_SESSION['droit']== "utilisateur"){
	
	
	 $crud->where([
		    'ID = ?' => ''.$_SESSION['idu'].''
         ]);  
	
}else if ($_SESSION['droit']== "superviseur"){
    
     $crud->where([
		    'IDSUP = ?' => ''.$_SESSION['idu'].''
         ]); 
         
}
*/



/*$crud->callbackColumn('CUMULENGAG', function ($value, $row) {

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $q = $pdo->prepare("SELECT SUM(MONTANT) as MTN  FROM ENGAGEMENT_FACTURE where IDPROJET = ? ");
    $q->execute([$row->IDPROJ]);
    $data= $q->fetch(PDO::FETCH_ASSOC);
    $value= $data['MTN']; 
    
   // return "<a href='" . site_url('menu/' . $row->profile_url) . "'>$value</a>";
    return number_format($value, 0, '.', ' ') ;
});

$crud->callbackColumn('CUMULDEP', function ($value, $row) {

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $q = $pdo->prepare("SELECT SUM(MONTANT) as MNT  FROM OPERATION_DEBIT where IDPROJ = ? ");
    $q->execute([$row->IDPROJ]);
    $data= $q->fetch(PDO::FETCH_ASSOC);
    $value= $data['MNT']; 
    
   // return "<a href='" . site_url('menu/' . $row->profile_url) . "'>$value</a>";
    return number_format($value, 0, '.', ' ') ;
});


$crud->callbackColumn('LISTINGDEP', function ($value, $row) {

  return "<a class='btn btn-primary' href='/listingdepenses.php?idproj=". $row->IDPROJ."' target='blank' >LISTING DEPENSE</a>";  
    
});

$crud->callbackColumn('LISTINGENGAG', function ($value, $row) {

    
  return "<a class='btn btn-primary' href='/listingengagements.php?idproj=". $row->IDPROJ."' target='blank' >LISTING ENGAGEMENTS</a>";
    
});
*/
$crud->displayAs(array(
			'nom_financier' => "Nom du Financier",
             'telephone_financier' => "Téléphone du financier",
		    'type_financier' => "Type Financier",
            'RIB' => "RIB",

		)); 
		
$crud->callbackColumn('nom_financier', function ($value, $row) {
    return "<div>" . wordwrap($row->nom_financier, 50, "<br>", false) . "</div>";
});
//$crud->columns(['nom_entreprise', 'domaine_expertise', 'commentaire_soumissionnaire']);

/*
$crud->callbackColumn('RIB', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->RIB) != 0) { return '<div class="myGallery">
   <a href="/files/docprojet/'.$row->RIB.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
  ​<span>'.$row->RIB.'</span>
</div>';}
});	
*/


/*
$crud->callbackColumn('MTNPROJ', function ($value, $row) {
 
     if (!empty($value)) {
     
        return   "<div style='text-align : right'>".number_format($row->MTNPROJ, 0, '.', ' ')."</div>"; 
        
    }else{
    
     return "<div style='text-align : right'>".$row->MTNPROJ."</div>"; 
     
    }

});

$crud->callbackColumn('BUDGETPROJ', function ($value, $row) {
 
     if (!empty($value)) {
     
     
        return   "<div style='text-align : right'>". number_format($row->BUDGETPROJ, 0, '.', ' ')."</div>"; 
        
        
    }else{
     return "<div style='text-align : right'>". $row->BUDGETPROJ."</div>"; 
    }
      
    
});




$crud->callbackColumn('CUMULENGAG', function ($value, $row) {
 
     if (!empty($value)) {
     
     
        return   "<div style='text-align : right'>". number_format($row->CUMULENGAG, 0, '.', ' ')."</div>"; 
        
        
    }else{
     return  "<div style='text-align : right'>".$row->CUMULENGAG."</div>";
    }
      
    
});

$crud->callbackColumn('CUMULDEP', function ($value, $row) {
 
     if (!empty($value)) {
     
     
        return   "<div style='text-align : right'>". number_format($row->CUMULDEP, 0, '.', ' ')."</div>"; 
        
        
    }else{
     return "<div style='text-align : right'>".$row->CUMULDEP."</div>";
    }
      
    
}); */
		
 if ( $_SESSION['droit']!= "superviseur" && $_SESSION['droit']!= "admin" && $_SESSION['droit']!= "RH" ){
	 $crud->unsetAdd(); 
	
	 $crud->unsetEdit();
 }
 
 
 /*
 $uploadValidations = [
    'maxUploadSize' => '20M', // 20 Mega Bytes
    'minUploadSize' => '1K', // 1 Kilo Byte
    'allowedFileTypes' => [
        'pdf,PDF,doc,Docx'
    ]
];

$crud->setFieldUpload(
    'RIB', 
    'files/docprojet', 
    '/files/docprojet', 
    $uploadValidations
);
*/

/*
$crud->setFieldUpload(
    'FICHEVALID', 
    'files/fichevalid', 
    '/files/fichevalid', 
    $uploadValidations
);
*/

$crud->defaultOrdering('nom_financier', 'ASC');

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


 //if (isset($_SESSION['idu'])&& ( $_SESSION['droit']== "admin" || $_SESSION['droit']== "superviseur" || $_SESSION['droit']== "budget" || $_SESSION['droit']== "gestionnaire" || $_SESSION['droit']== "dcao" )){ // si paramètres correct. 
?>

<!DOCTYPE html>
<html>

<head>
   	
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        
        
        <title>KIAMA 360</title>

        
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
                <?php if ($_SESSION['droit'] != "budget" && $_SESSION['droit']!= "daaf") {
       echo' <link href="new_assets/assets_dashboard/css/style2.css" rel="stylesheet">';
        }else{
        echo' <link href="new_assets/assets_dashboard/css/style.css" rel="stylesheet">';}?>
  
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="54">

    	 <?php include 'new_includes/header.php' ?>
    	  <?php if ($_SESSION['droit'] == "budget" || $_SESSION['droit']== "daaf") {
      		 include 'slide.php';
        }
        ?>
    	 
        <main id="main" class="main">
            
        <div class="mt-3">
                <img class="img-fluid" src="new_assets/assets_dashboard/img/404.png" alt="logo-white" />
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


</body>

</html>
<?php	  
 /* }else{
	  header('Location: ../index.php' );  
  } */
?>
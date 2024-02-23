<?php
session_start(); // ouverture de la session 
include("libraries/autoload.php");
use GroceryCrud\Core\GroceryCrud;

$database = include('database.php');
$config = include('config.php');
$crud = new GroceryCrud($config, $database);
include_once("db.php"); //pour les accès direct à la base de données

$namePage= "crea_encours";
$namePrincipal= "creance";
$namePrincipale = 'Engagement';


$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

error_reporting(E_ALL);
ini_set("display_errors", 1);
  
$crud->setTable('ca_creance');

$crud->setSubject('Créance', 'Gestion des Créances');

$crud->setRelation('IDPROJ', 'gl_projet', 'NOMPROJ', ['valide' => '0']);
$crud->setRelationNtoN('ETAPE_CREANCE', 'LIAISON_CREAN_ETAP','ETAPE_CREANCE','IDCREA','IDETAP','LIBELLE');

// $crud->setRelation('IDC', 'CLIENTS', 'NOM');

// $crud->setRelationNtoN('ETAPE_CREANCE', 'LIAISON_CREAN_ETAP','ETAPE_CREANCE','IDCREA','IDETAP','LIBELLE');
 
// $crud->columns(['NUMERO_FACTURE','IDC','IDPROJET','MONTANT','DATE_FACTURATION','DATE_PREV','PJ_FACTURE','ETAPE_CREANCE','OBJECTIFSEM','STATUT']);
 
 

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
$annee= date("Y");


$crud->displayAs(array(

    'IDPROJ' => "Projet",
    //'IDC' => "CLIENT",
    'NUMERO_FACTURE' => "Numéro Facture",
    //'DATE_EMISSION' => "Date d'émission",
    'DATE_PREV' => "Date Prévisionnel",
    'DATE_FACTURATION' => 'Date de facturation',
    'DATE_PAIEMENT' => 'Date de Paiement',
    'PJ_FACTURE' => 'Facture (PDF)',
    'NATURECREA' => 'Nature de la créance',
    'ETAPE_CREANCE' => 'Etape de créance',
    'TYPEVENTE' => 'Type de vente',
    'MONTANTPENAL' => "Montant Pénalité",
    'MONTANTHT' => "Montant HT",
    'MONTANTIR' => "Montant IR",
    'MONTANTTVA' => "Montant TVA",
    'MONTANTNAP' => 'MONTANT NAP',
    'ETAPE_CREANCE' => 'Etape de créance',	
));

$crud->columns(['DATE_FACTURATION','LIBELLE','DATE_PAIEMENT','IDPROJ','MONTANTNAP','MONTANTTVA','MONTANTIR','MONTANTHT','MONTANTPENAL','NUMERO_FACTURE','ETAPE_CREANCE','NATURECREA','TYPEVENTE','DATE_PREV','PJ_FACTURE','STATUT']);

$crud->unsetAddFields(['certif_engagement','titre_creance','decharge_paiement','liquidation','ordonnancement','detail_validation','OBJECTIFSEM']);
 $crud->unsetEditFields(['certif_engagement','titre_creance','decharge_paiement','liquidation','ordonnancement','detail_validation','OBJECTIFSEM']);

$crud->requiredFields(['LIBELLE']);


$crud->callbackColumn('LIBELLE', function ($value, $row) {
    return "<div>" . wordwrap($row->LIBELLE, 50, "<br>", false) . "</div>";
});

$crud->callbackColumn('NUMERO_FACTURE', function ($value, $row) {
    return "<div>" . wordwrap($row->NUMERO_FACTURE, 50, "<br>", false) . "</div>";
});
       
$crud->callbackColumn('MONTANTPENAL', function ($value, $row) {
 
     if (!empty($value)) {
     
        return   "<div style='text-align : right; width:100px;'>". number_format($row->MONTANTPENAL, 0, '.', ' ')."</div>"; 
        
    }else{
    
         return "<div style='text-align : right; width:100px;'>". $row->MONTANTPENAL."</div>";
         
    }
      
    
});   

$crud->callbackColumn('MONTANTHT', function ($value, $row) {
 
     if (!empty($value)) {
     
        return   "<div style='text-align : right; width:100px;'>". number_format($row->MONTANTHT, 0, '.', ' ')."</div>"; 
        
    }else{
    
         return "<div style='text-align : right; width:100px;'>". $row->MONTANTHT."</div>";
         
    }
      
    
}); 

$crud->callbackColumn('MONTANTIR', function ($value, $row) {
 
     if (!empty($value)) {
     
        return   "<div style='text-align : right; width:100px;'>". number_format($row->MONTANTIR, 0, '.', ' ')."</div>"; 
        
    }else{
    
         return "<div style='text-align : right; width:100px;'>". $row->MONTANTIR."</div>";
         
    }
      
    
});   

$crud->callbackColumn('MONTANTTVA', function ($value, $row) {
 
     if (!empty($value)) {
     
        return   "<div style='text-align : right; width:100px;'>". number_format($row->MONTANTTVA, 0, '.', ' ')."</div>"; 
        
    }else{
    
         return "<div style='text-align : right; width:100px;'>". $row->MONTANTTVA."</div>";
         
    }
      
    
}); 

       /* $crud->unsetAddFields(['decharge_reception','proces_verbal', 'OBJECTIFSEM']);
        $crud->unsetColumns(['decharge_reception','proces_verbal', 'OBJECTIFSEM']);
        $crud->unsetEditFields(['decharge_reception','proces_verbal', 'OBJECTIFSEM']);*/
           

       
        
        $crud->callbackColumn('PJ_FACTURE', function ($value, $row) {
            //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
            if (strlen($row->PJ_FACTURE) != 0) { return '<div class="myGallery">
   	    <a href="/files/justif/'.$row->PJ_FACTURE.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
	     ​<span>'.$row->PJ_FACTURE.'</span>
	</div>';}
   
        });
        
        
        
        
        $crud->callbackColumn('MONTANTIR', function ($value, $row) {
 
     if (!empty($value)) {
     
        return   "<div style='text-align : right; width:100px;'>". number_format($row->MONTANTIR, 0, '.', ' ')."</div>"; 
        
    }else{
    
         return "<div style='text-align : right; width:100px;'>". $row->MONTANTIR."</div>";
         
    }
      
    
});   

$crud->callbackColumn('MONTANTTVA', function ($value, $row) {
 
     if (!empty($value)) {
     
        return   "<div style='text-align : right; width:100px;'>". number_format($row->MONTANTTVA, 0, '.', ' ')."</div>"; 
        
    }else{
    
         return "<div style='text-align : right; width:100px;'>". $row->MONTANTTVA."</div>";
         
    }
      
    
}); 

       
$crud->callbackColumn('MONTANTPENAL', function ($value, $row) {
 
     if (!empty($value)) {
     
        return   "<div style='text-align : right'>". number_format($row->MONTANTPENAL, 0, '.', ' ')."</div>"; 
        
    }else{
     return "<div style='text-align : right'>". $row->MONTANTPENAL."</div>";
    }
         
});
$crud->callbackColumn('MONTANTHT', function ($value, $row) {
 
     if (!empty($value)) {
     
        return   "<div style='text-align : right'>". number_format($row->MONTANTHT, 0, '.', ' ')."</div>"; 
        
    }else{
     return "<div style='text-align : right'>". $row->MONTANTHT."</div>";
    }
         
});
$crud->callbackColumn('MONTANTIR', function ($value, $row) {
 
     if (!empty($value)) {
     
        return   "<div style='text-align : right'>". number_format($row->MONTANTIR, 0, '.', ' ')."</div>"; 
        
    }else{
     return "<div style='text-align : right'>". $row->MONTANTIR."</div>";
    }
         
});
$crud->callbackColumn('MONTANTTVA', function ($value, $row) {
 
     if (!empty($value)) {
     
        return   "<div style='text-align : right'>". number_format($row->MONTANTTVA, 0, '.', ' ')."</div>"; 
        
    }else{
     return "<div style='text-align : right'>". $row->MONTANTTVA."</div>";
    }
         
});
$crud->callbackColumn('MONTANTNAP', function ($value, $row) {
 
     if (!empty($value)) {
     
        return   "<div style='text-align : right'>". number_format($row->MONTANTNAP, 0, '.', ' ')."</div>"; 
        
    }else{
     return "<div style='text-align : right'>". $row->MONTANTNAP."</div>";
    }
         
});
/*
 $crud->callbackBeforeInsert(function ($stateParameters){
  // $annee= date("Y");        
   $date= $stateParameters->data['DATE_FACTURATION'];
   $year = mktime(0, 0, 0, date("m"),   date("d"),   date("Y"));
  // $year = date("Y", $date);
   //echo $year;

            if ($date < $year )
            {
            	$errorMessage = new \GroceryCrud\Core\Error\ErrorMessage();
                return $errorMessage->setMessage("erreur\n");
            }

          
        return $stateParameters;
        
        });*/


		
 if ($_SESSION['droit'] != "budget" && $_SESSION['droit']!= "tresorerie"){
 
	 
	// $crud->unsetDelete();
	 $crud->unsetEdit();
	 $crud->unsetAdd(); 
	 
 }
 
 
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

  


$crud->defaultOrdering('DATE_FACTURATION', 'DESC');
 
//$crud->unsetAdd(); 
$crud->unsetDelete();
$crud->unsetDeleteMultiple();
// $crud->unsetEdit();   

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


/*
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


if (isset($_SESSION['idu'])&& ( $_SESSION['droit']== "admin" ||  $_SESSION['droit']== "daaf" || $_SESSION['droit']== "budget" || $_SESSION['droit'] == "tresorerie")){ // si paramètres correct. 
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
            
            <a class="btn btn-default" href='creance_report.php' target="_blank"><i class="bi bi-file-earmark-pdf-fill"></i> Rapport</a>
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


</body>

</html>
<?php	  
  }else{
	  header('Location: ../index.php' );  
  }
?>
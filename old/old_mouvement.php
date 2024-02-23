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

 if (!isset($_GET['mois'])) $mois = date('m');  
 else {
	 
	if (!empty($_GET['mois']) ) { $mois = $_GET['mois']; $crud-> where("month(DATEOP)=".$mois."");}
	else if (empty($_GET['mois'])) { $mois = date('m'); }
 }
 
error_reporting(E_ALL);
ini_set("display_errors", 1);
  
$crud->setTable('MOUVEMENT');
$crud->setSubject('Mouvement de compte', 'Gestion des mouvements de compte');

$crud->setRelation('IDCOMPTEOP1', 'COMPTE_OPERATION', 'NOMCOMPTE');
$crud->setRelation('IDCOMPTEOP2', 'COMPTE_OPERATION', 'NOMCOMPTE');

$crud->displayAs(array(
 		    'IDMOUV' => "ID",
                    'IDCOMPTEOP1' => "Compte  débité",
		    'IDCOMPTEOP2' => "Compte  crédité",
			'DATEOP' => "Date",
		)); 
		
$crud->columns(['IDMOUV', 'IDCOMPTEOP1', 'IDCOMPTEOP2','DATEOP', 'MONTANT', 'MOTIF']);
		
//$crud-> where("month(DATEOP)=".$mois."");
 		
 if ( $_SESSION['droit']!= "tresorerie"){
	 $crud->unsetAdd(); 
	 $crud->unsetDelete();
	 $crud->unsetEdit();
	
 }
 

 // recupère l'année fiscale en cours *********************************

$annee="2023"; // année fiscale ************
$sql = "SELECT anneefiscale FROM parametres";
$q = $pdo->prepare($sql);
$q->execute();
$data= $q->fetch(PDO::FETCH_ASSOC);
$annee = $data['anneefiscale'];
if ($annee != "all")  $crud-> where("year(DATEOP)=".$annee."");

//*********************************************************************

 
$crud->defaultOrdering('DATEOP', 'desc');
$crud->unsetDelete();
$crud->unsetDeleteMultiple();
   
    $crud->callbackColumn('MONTANT', function ($value, $row) {
 
     if (!empty($value)) {
     
        return   "<div style='text-align : right'>". number_format($row->MONTANT, 0, '.', ' ')."</div>"; 
        
    }else{
     return "<div style='text-align : right'>". $row->MONTANT."</div>";
    }
      
    
});


 $crud->callbackBeforeInsert(function ($stateParameters) {
  $stateParameters->data['MONTANT']=preg_replace('/[^0-9]/', '',$stateParameters->data['MONTANT']);
  
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	if ($stateParameters->data['IDCOMPTEOP1'] == $stateParameters->data['IDCOMPTEOP2']){
		
		 $errorMessage = new \GroceryCrud\Core\Error\ErrorMessage();
          return $errorMessage->setMessage("Les deux comptes ne peuvent être identique !!!\n");
		  
	}else {
	
	//recupère solde compte operation
	$sql = "SELECT SOLDE  FROM COMPTE_OPERATION where IDCOMPTEOP = ? ";
	$q = $pdo->prepare($sql);
    $q->execute([$stateParameters->data['IDCOMPTEOP1']]);
	$data= $q->fetch(PDO::FETCH_ASSOC);
	$solde= $data['SOLDE'];
	
	//soustrait au montant du formulaire
	$newsolde= $solde - $stateParameters->data['MONTANT'];
	
	// je met a jour  compte operation
	$sql = "update COMPTE_OPERATION set SOLDE = ?  where IDCOMPTEOP = ? ";
	$q = $pdo->prepare($sql);
    $q->execute([$newsolde,$stateParameters->data['IDCOMPTEOP1']]);
	
	// recupere solde associe
	$sql = "SELECT SOLDE  FROM COMPTE_OPERATION where IDCOMPTEOP = ? ";
	$q = $pdo->prepare($sql);
    $q->execute([$stateParameters->data['IDCOMPTEOP2']]);
	$data= $q->fetch(PDO::FETCH_ASSOC);
	$solde= $data['SOLDE'];
	
	//j'ajoute
	$newsolde_debit = $solde+$stateParameters->data['MONTANT'];
	
	//met a jours solde associé
    $sql = "update COMPTE_OPERATION set SOLDE = ?  where IDCOMPTEOP = ? ";
	$q = $pdo->prepare($sql);
    $q->execute([$newsolde_debit,$stateParameters->data['IDCOMPTEOP2']]);
	
	}

	
     /* $sql = "INSERT INTO SAUVEGARDE_SOLDE (IDCOMPTEOP, SOLDE, MOTIF) VALUES (?,?,?)";
      $stmt= $pdo->prepare($sql);
      $stmt->execute([$stateParameters->data['IDCOMPTEOP1'],$newsolde,'[INSERT_MOUV_DEBIT]'.$stateParameters->data['MOTIF']]);
      
      $sql = "INSERT INTO SAUVEGARDE_SOLDE (IDCOMPTEOP, SOLDE, MOTIF) VALUES (?,?,?)";
      $stmt= $pdo->prepare($sql);
      $stmt->execute([$stateParameters->data['IDCOMPTEOP2'],$newsolde_debit,'[INSERT_MOUV_CREDIT]'.$stateParameters->data['MOTIF']]);
	*/
    return $stateParameters;
});




//opération de mise à jour
$crud->callbackAfterUpdate(function ($stateParameters) {
   
return $stateParameters;
	
});




$crud->callbackBeforeUpdate(function ($stateParameters){

    $stateParameters->data['MONTANT']=preg_replace('/[^0-9]/', '',$stateParameters->data['MONTANT']); // gestion des espaces sur le montant 
 
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql = "SELECT MONTANT FROM MOUVEMENT where IDMOUV = ? ";
	$q = $pdo->prepare($sql);
        $q->execute([$stateParameters->primaryKeyValue]);
	$data= $q->fetch(PDO::FETCH_ASSOC);
	$montant_save =  $data['MONTANT'];
 
    
    $nouveau_montant = $stateParameters->data['MONTANT'] ;  
    
    $diff= $nouveau_montant-$montant_save;
    
    if ($diff>0) {
    
       
	//recupère solde compte operation
	$sql = "SELECT SOLDE  FROM COMPTE_OPERATION where IDCOMPTEOP = ? ";
	$q = $pdo->prepare($sql);
        $q->execute([$stateParameters->data['IDCOMPTEOP1']]);
	$data= $q->fetch(PDO::FETCH_ASSOC);
	$solde= $data['SOLDE'];
	
	//soustrait au montant du formulaire
	$newsolde= $solde - $diff;
	
	//met a jours solde associé
        $sql = "update COMPTE_OPERATION set SOLDE = ?  where IDCOMPTEOP = ? ";
	$q = $pdo->prepare($sql);
        $q->execute([$newsolde,$stateParameters->data['IDCOMPTEOP1']]);
        
        //On crédite le solde OPERATION2 **********************************************************************************
        //recupère solde compte operation
	$sql = "SELECT SOLDE  FROM COMPTE_OPERATION where IDCOMPTEOP = ? ";
	$q = $pdo->prepare($sql);
        $q->execute([$stateParameters->data['IDCOMPTEOP2']]);
	$data= $q->fetch(PDO::FETCH_ASSOC);
	$solde= $data['SOLDE'];
	$newsolde= $solde + $diff;
	$newsolde_save = $newsolde; 
	
	//met a jours solde associé
        $sql = "update COMPTE_OPERATION set SOLDE = ?  where IDCOMPTEOP = ? ";
	$q = $pdo->prepare($sql);
        $q->execute([$newsolde,$stateParameters->data['IDCOMPTEOP2']]);
    
    }
    
    if ($diff<0) {
    
      
	//recupère solde compte operation
	$sql = "SELECT SOLDE  FROM COMPTE_OPERATION where IDCOMPTEOP = ? ";
	$q = $pdo->prepare($sql);
        $q->execute([$stateParameters->data['IDCOMPTEOP1']]);
	$data= $q->fetch(PDO::FETCH_ASSOC);
	$solde= $data['SOLDE'];
	
	//soustrait au montant du formulaire
	$newsolde= $solde - $diff;
	
	//met a jours solde associé
        $sql = "update COMPTE_OPERATION set SOLDE = ?  where IDCOMPTEOP = ? ";
	$q = $pdo->prepare($sql);
        $q->execute([$newsolde,$stateParameters->data['IDCOMPTEOP1']]);
        
        // on débite le solde créditeur ****************************************************************
        $sql = "SELECT SOLDE  FROM COMPTE_OPERATION where IDCOMPTEOP = ? ";
	$q = $pdo->prepare($sql);
        $q->execute([$stateParameters->data['IDCOMPTEOP2']]);
	$data= $q->fetch(PDO::FETCH_ASSOC);
	$solde= $data['SOLDE'];
        
        //soustrait au montant du formulaire
	$newsolde= $solde + $diff;
	$newsolde_save = $newsolde; // utilisé pour la sauvagarde_solde ********************
	
	//met a jours solde associé
        $sql = "update COMPTE_OPERATION set SOLDE = ?  where IDCOMPTEOP = ? ";
	$q = $pdo->prepare($sql);
        $q->execute([$newsolde,$stateParameters->data['IDCOMPTEOP2']]);
	
	
    } 
    
    /*  $sql = "INSERT INTO SAUVEGARDE_SOLDE (IDCOMPTEOP, SOLDE, MOTIF) VALUES (?,?,?)";
      $stmt= $pdo->prepare($sql);
      $stmt->execute([$stateParameters->data['IDCOMPTEOP1'],$newsolde,'[UPDATE_MOUV_DEBIT]'.$stateParameters->data['MOTIF']]);
      
      $sql = "INSERT INTO SAUVEGARDE_SOLDE (IDCOMPTEOP, SOLDE, MOTIF) VALUES (?,?,?)";
      $stmt= $pdo->prepare($sql);
      $stmt->execute([$stateParameters->data['IDCOMPTEOP2'],$newsolde_save,'[UPDATE_MOUV_CREDIT]'.$stateParameters->data['MOTIF']]);
    */
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


if (isset($_SESSION['idu'])&& ( $_SESSION['droit']== "admin" || $_SESSION['droit']== "tresorerie" || $_SESSION['droit']== "superviseur" || $_SESSION['droit']== "budget")){ // si paramètres correct. 
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
	
	
  <script type="text/javascript">

	  function getUrlVars() {
		var vars = {};
		var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,    
		function(m,key,value) {
		  vars[key] = value;
		});
		return vars;
	  }

	
    function doReload(mois){ 
    
		document.location.href = "mouvement.php?mois="+mois;	
    }
  
	</script> 
	 <?php
    foreach($css_files as $file): ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
   <?php endforeach; ?>
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
        
			 
    
<div class="card-body">        
<div class="row">
	<div class="col-12 col-md-3 col-lg-3 col-xl-3" style="border-width: 2px;">
	
	</div>
	<div class="col-12 col-md-3 col-lg-3 col-xl-3" style="border-width: 2px;">
		<label class="control-label" for="id_ufg">MOIS:</label>
		  <select name="mois" id="mois" class="form-control"  onChange="doReload(this.value);" required>
			<option value=''> </option>
			<?php 
		  $mois_array = [1 => 'janvier', 2 => 'Fevrier' , 3 =>'Mars',4 => 'Avril', 5 => 'Mai', 6 => 'Juin',7 => 'Juillet', 8 => 'Août', 9 => 'Septembre',10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'];	  			
				
		  	  	if (empty($_GET['mois'])){
		  	  	
		  	  	      echo '<option value=""  selected> </option>';
		  	  	      for ($i=1;$i<=12;$i++) { 
		  	  	           echo '<option value='.$i.' >'.$mois_array[$i].'</option>';
		  	  	      }
		  	  	
		  	  	}else{
		  	  	        echo '<option value=""  selected> </option>';
					for ($i=1;$i<=12;$i++) { 
					
					if ($mois== $i) echo '<option value='.$i.' selected>'.$mois_array[$i].'</option>'; 
					else  echo '<option value='.$i.'>'.$mois_array[$i].'</option>';
					
					}
				}
				
			?>
		</select>	
	</div>
	
	<div class="col-12 col-md-3 col-lg-3 col-xl-3" style="border-width: 2px;">	
	</div>
	
	<div class="col-12 col-md-3 col-lg-3 col-xl-3" style="border-width: 2px;">	
	</div>
</div>
</div>	


		<?php						
	  echo "<center>";
	   include_once("solde_compte_operations.php");
	   echo "<a href='mouvement.php' class='btn btn-primary' > ACTUALISER </a>";
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
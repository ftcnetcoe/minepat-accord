<?php

session_start(); // ouverture de la session 
include_once("db.php"); //pour les accès direct à la base de données
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

error_reporting(E_ALL);
ini_set("display_errors", 1);


// recupère le fournisseur 
function get_fournisseur($pdo,$idf){

	$sql = "SELECT NOM FROM FOURNISSEUR_MP where IDF= ? ";
	$q = $pdo->prepare($sql);
        $q->execute([$idf]);
	$data= $q->fetch(PDO::FETCH_ASSOC);
	$fournisseur = $data['NOM'];
       return $fournisseur; 

}


function get_deja_paye($pdo,$idengagfac){

	//recupère somme des debits du mois
	$sql1 = "SELECT  sum(MONTANT) as TOTALPAYE FROM OPERATION_DEBIT  where IDENGAG_FAC = ? ";
	$q1 = $pdo->prepare($sql1);
	$q1->execute(array($idengagfac));
	$data1= $q1->fetch(PDO::FETCH_ASSOC);
	$total_paye = $data1['TOTALPAYE']; //total déja payé pour une facture...
	return $total_paye ;

}


/*
include("libraries/autoload.php");
use GroceryCrud\Core\GroceryCrud;

$database = include('database.php');
$config = include('config.php');
$crud = new GroceryCrud($config, $database);





if (!empty($_GET['idproj'])) $idproj = $_GET['idproj'];
else  header('Location: ../index.php' );

    

  
$crud->setTable('OPERATION_DEBIT');
$crud->setSubject('Opération de bebits', 'LISTING DES OPERATIONS DE DEBIT');

$crud->setRelation('IDCOMPTEOP', 'COMPTE_OPERATION', 'NOMCOMPTE');

//$crud->setRelation('IDPROJ', 'PROJET', 'NOMPROJ',['ACTIVE' => 'oui']);

$crud->setRelation('IDPROJ', 'PROJET', 'NOMPROJ');

// $crud->setRelation('IDENGAG', 'ENGAGEMENT', 'DESCRIP');
// $crud->setDependentRelation('IDENGAG','IDPROJ','IDPROJET'); 


$crud->unsetSearchColumns(['IDOPERATION', 'IDCOMPTEOP', 'DATEOP','IDPROJ', 'IDENGAG', 'MONTANT','IDCOMPTED','BILLETEUR','MOTIF']);

$crud->setRelation('IDCOMPTED', 'COMPTE_DEBIT', 'NOMCOMPTE');


 $crud->where(['IDPROJ = ?' => ''.$idproj.'']);  

$crud->displayAs(array(
            'IDOPERATION' => "ID",
            'IDCOMPTEOP' => "Compte d'operation",
		    'DATEOP' => 'Date',
		    'IDPROJ' => 'Projet',
			//'IDENGAG' => 'Engagement',
			'IDCOMPTED' => 'Compte associé',
		)); 
		
$crud->columns(['IDOPERATION', 'IDCOMPTEOP', 'DATEOP','IDPROJ', 'MONTANT','IDCOMPTED','BILLETEUR','MOTIF']);		

		

 
	 $crud->unsetAdd(); 
	 $crud->unsetDelete();
	 $crud->unsetEdit();
	 

 
 
 
  $crud->callbackColumn('MONTANT', function ($value, $row) {
 
     if (!empty($value)) {
     
        return   number_format($row->MONTANT, 0, '.', ' '); 
        
    }else{
     return $row->MONTANT;
    }
      
    
});

 
$crud->defaultOrdering('DATEOP', 'desc');
 
$crud->unsetDelete();
$crud->unsetDeleteMultiple();
   
 
$output = $crud->render();

if ($output->isJSONResponse) {
	
    header('Content-Type: application/json; charset=utf-8');
    echo $output->output;
    exit;
	
}

$css_files = $output->css_files;
$js_files = $output->js_files;
$output = $output->output;
*/

?>

<?php


if (isset($_SESSION['idu'])&& ( $_SESSION['droit']== "admin" || $_SESSION['droit']== "tresorerie" || $_SESSION['droit']== "projet" || $_SESSION['droit']== "gestionnaire" || $_SESSION['droit']== "budget" || $_SESSION['droit'] == "utilisateur")){ // si paramètres correct. 


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
    
		document.location.href = "operation_debit.php?mois="+mois;	
    }
  
</script> 

 <?php
    //foreach($css_files as $file): ?>
        <link type="text/css" rel="stylesheet" href="<?php //echo $file; ?>" />
   <?php //endforeach; ?>	
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
	<!-- <div class="col-12 col-md-3 col-lg-3 col-xl-3" style="border-width: 2px;">
		<label class="control-label" for="id_ufg">MOIS:</label>
		  <select name="mois" id="mois" class="form-control"  onChange="doReload(this.value);" required>
			<option value=''> </option>
			<?php 
		 /* $mois_array = [1 => 'janvier', 2 => 'Fevrier' , 3 =>'Mars',4 => 'Avril', 5 => 'Mai', 6 => 'Juin',7 => 'Juillet', 8 => 'Août', 9 => 'Septembre',10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'];	  			
				for ($i=1;$i<=12;$i++) { 
				if (!empty($mois) && $mois== $i) echo '<option value='.$i.' selected>'.$mois_array[$i].'</option>';
				else  echo '<option value='.$i.'>'.$mois_array[$i].'</option>';
				}
				*/
			?>
		</select>	
	</div> -->
	
	<div class="col-12 col-md-3 col-lg-3 col-xl-3" style="border-width: 2px;">	
	</div>
	
	<div class="col-12 col-md-3 col-lg-3 col-xl-3" style="border-width: 2px;">	
	</div>
</div>
</div>	
	
		
        <section class="mt-4" style="padding: 3px 0px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        
                            <!-- <div class="card-header py-2">
                               
                            </div>-->
                            
                                
				   <div style="padding: 50px 10px;">
				   
					<?php
								  
					$sql2 = "SELECT  *  FROM ENGAGEMENT_FACTURE";
					$q2 = $pdo->prepare($sql2);
				        $q2->execute();
					$results2= $q2->fetchAll(PDO::FETCH_ASSOC);
					
					$montant_deja_regle= 0; // montant facture déja réglé
					$montant_a_regle = 0; // montant à regler 
					
					$montant_tot = 0; // montant total
					$mont_tot_dej_regle = 0; //montant_totalçdeja 
					$tot_montant_a_regle = 0; //montant à regler
					$tot_montant_a_regle_mois = 0;
					$tot_montant_a_regle_mois1 = 0; 
					$tot_montant_a_regle_mois2= 0; 
				        setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
					
				     echo "<table class='table table-striped'>";
	        echo"  <thead class='thead-dark'><tr class='table-primary'> <td> NUM FACTURE </td> <td>FOURNISSEUR </td> <td> MONTANT </td> <td> DEJA REGLE </td>  <td>A REGLER </td> <td>  MOIS ".strtoupper(strftime('%B'))." </td> <td> MOIS ".strtoupper(strftime( '%B', strtotime( '+1 month') ))." </td> <td> SOLDE MOIS ".strtoupper(strftime( '%B', strtotime( '+2 month') ))."</td> </tr> </thead> <tbody>";
	                            $couleur= ""; // couleur ligne tableau 
	                           foreach($results2 as $row){  
	                               
	                               if ($row['IDENGAG_FAC'] != 22){ 
	                               
	                                /*
	                                // calcul du montant déja réglé *******************
	                                if ( $row['STATUT'] == "Paiement Effectif")  $montant_deja_regle = $row['MONTANT'];  
	                                else $montant_deja_regle = 0;  
	                                $mont_tot_dej_regle += $montant_deja_regle; 
	                                */
	                                
	                                 $montant_deja_regle = get_deja_paye($pdo,$row['IDENGAG_FAC']);
	                                $mont_tot_dej_regle += $montant_deja_regle; 
	                                
	                                // calcul du montant à régler ********************
	                                //$montant_a_regle = $row['MNT_TRANCH1']; + $row['MNT_TRANCH2'] + $row['MNT_TRANCH3'];
	                                $montant_a_regle = $row['MONTANT'] - $montant_deja_regle;
	                                
	                                if ($montant_a_regle>=0) $tot_montant_a_regle += $montant_a_regle; 
	                                
	                                //Montant à régler dans le Mois 
	                                $montant_a_regle_mois = 0; // montant à regler dans le mois.
	                                $dernierjour_mois = date("d-m-Y", mktime(0, 0, 0, date("m") +1, 0, date("y"))); // date("Y-m-t", strtotime(date("d/m/Y"))); //dernier jour du mois 
	                                
	                                // echo  $dernierjour_mois."<br/>";
	                                
	                                if ($row['DATE_TRANCH1'] <=  $dernierjour_mois) { // mois en cours 
	  
		                                
		                                
		                                if ($row['MNT_TRANCH1'] > $montant_deja_regle)   $montant_a_regle_mois =  $row['MNT_TRANCH1'] - $montant_deja_regle ; 
		                                else  $montant_a_regle_mois = 0; 
		                                
	                                
	                                 }
	                                
	                                 //Montant à régler dans le Mois 
	                                $montant_a_regle_mois1 = 0;  // montant à regler dans le mois.
	                                $dernierjour_mois1 = $dernierjour_mois = date("d-m-Y", mktime(0, 0, 0, date("m") +2, 0, date("y"))); // date("Y-m-t", strtotime('+1 month')); //dernier jour du mois 
	                                
	                                
	                                if ($row['DATE_TRANCH2'] <=  $dernierjour_mois1) {
	                                 
	                                        if ( $montant_a_regle_mois == 0) $montant_a_regle_mois1 = 0; 
	                                 	else $montant_a_regle_mois1 = $montant_a_regle_mois1 +  $row['MNT_TRANCH2'];
	                                       
	                                 
	                                 
	                                 }
	                                
	                                
	                                //Montant à régler dans le Mois 
	                                $montant_a_regle_mois2 = 0;  // montant à regler dans le mois.
	                                $dernierjour_mois2 =  $dernierjour_mois = date("d-m-Y", mktime(0, 0, 0, date("m") +3, 0, date("y"))); // date("Y-m-t", strtotime('+2 month')); //dernier jour du mois 
	                                
	                                 if ($row['DATE_TRANCH3'] <=  $dernierjour_mois2)  {
   
                                            if ( $montant_a_regle_mois1 == 0) $montant_a_regle_mois2 = 0; 
	                                    else $montant_a_regle_mois2 = $montant_a_regle_mois2 +  $row['MNT_TRANCH3'];
	                                    
	                                    
	                                 
	                                  }
	                                  
	                              //vérification des informations du tableau
	                               if (   ($montant_a_regle !=0 &&  ($montant_a_regle_mois +$montant_a_regle_mois1 + $montant_a_regle_mois2) ==0  ) && $montant_a_regle >0 ){
	                                   //$couleur= "table-danger";
	                                    // colorier la ligne en rouge   
	                                    /*$montant_a_regle_mois = $montant_a_regle *0.25;
	                                    $montant_a_regle_mois1 = $montant_a_regle *0.5;
	                                    $montant_a_regle_mois2 = $montant_a_regle *0.25;*/
	                                    
	                                   $montant_a_regle_mois =  $montant_a_regle; 
	                               } 
	                               
	                               if ($montant_a_regle <0)  $couleur= "table-danger"; // danger
	                               else  $couleur="";
	                               
	                               // on effectue les totaux ici*****************
	                                 $tot_montant_a_regle_mois += $montant_a_regle_mois;
	                                 $tot_montant_a_regle_mois1 += $montant_a_regle_mois1; 
	                                 $tot_montant_a_regle_mois2 += $montant_a_regle_mois2; 
	                                 
	                               
	                                echo "<tr class=".$couleur." > <td> ".$row['NUMERO']."</td> <td> ".get_fournisseur($pdo,$row['IDF']) ." </td> <td>".number_format($row['MONTANT'], 0, '.', ' ')." </td> <td> ".number_format($montant_deja_regle, 0, '.', ' ')."</td>  <td> ".number_format($montant_a_regle, 0, '.', ' ')." </td><td> ".number_format($montant_a_regle_mois, 0, '.', ' ')." </td><td>".number_format($montant_a_regle_mois1, 0, '.', ' ')."</td> <td>".number_format($montant_a_regle_mois2, 0, '.', ' ')."</td> </tr>";
	                                $montant_tot +=$row['MONTANT'];
	                                
	                                
	                                
	                             } // fin if 
	                                  
	                          }
	                               
	                        
	        echo"  <thead class='thead-dark'><tr class='table-primary'> <td> TOTAL </td> <td></td> <td> ".number_format($montant_tot, 0, '.', ' ')."</td> <td> ".number_format($mont_tot_dej_regle, 0, '.', ' ')."</td>  <td>".number_format( $tot_montant_a_regle, 0, '.', ' ')." </td> <td> ".number_format($tot_montant_a_regle_mois, 0, '.', ' ')." </td> <td>".number_format($tot_montant_a_regle_mois1, 0, '.', ' ')."</td> <td> ".number_format($tot_montant_a_regle_mois2, 0, '.', ' ')." </td> </tr> </thead> <tbody>";
	             	
	                               		  
		echo "</tbody></table>";                        
			       ?>                  
			                         
                                   </div>
	   
								
								
                            
                      
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
	
	<?php // foreach($js_files as $file): ?>
    <script src="<?php //echo $file; ?>"></script>
<?php //endforeach; ?>


</body>

</html>
<?php	  
 
  }else{ header('Location: ../index.php' );  }
  
?>
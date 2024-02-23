<?php
session_start(); // ouverture de la session 

error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once("db.php"); //pour les accès direct à la base de données
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function get_fournisseur($pdo,$idf){

       $sql = "SELECT * FROM FOURNISSEUR_MP where IDF= ? ";
       $q = $pdo->prepare($sql);
       $q->execute(array($idf));
       $data  = $q->fetch(PDO::FETCH_ASSOC);
       return $data["NOM"];
       
}

 
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
        
	
		
        <section class="mt-4" style="padding: 3px 0px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        
                            <!-- <div class="card-header py-2">
                               
                            </div>-->
                            
                           
                                
				   <div style="padding: 80px 5px;">
						
			               <?php
			               echo '<br/>';
			                include_once("echeancier.php");
			               echo '<br/>'; 
			               
			                // parcourir les les factures_engagements.
			                //caculer montant déja payé
			                // calculer reste à payer 
			                //calculer retard de paiement
			                
			                //recupère solde compte operation
					$sql = "SELECT *  FROM ENGAGEMENT_FACTURE";
					$q = $pdo->prepare($sql);
				        $q->execute();
					$results= $q->fetchAll(PDO::FETCH_ASSOC);
	
			                //echo "<center>DATE : ".date("Y-m-d")."<br></center>"; 
			                
			                echo "<table class='table table-striped'>";
	        echo "  <thead class='thead-dark'><tr class='table-primary'> <td> No FACTURE </td> <td>Nom Fournisseur</td> <td> Montant Facture </td> <td> Date de facture </td>  <td> Déja payé </td> <td> Reste à payer </td> <td> Dû à ce jour (En retard de paiement) </td> </thead> <tbody>";
	        
	                               foreach($results as $row){
	                               
		                                 //recupère somme des debits du mois
						 $sql1 = "SELECT  sum(MONTANT) as TOTALPAYE FROM OPERATION_DEBIT  where IDENGAG_FAC = ?   ";
					         $q1 = $pdo->prepare($sql1);
				       		 $q1->execute(array($row['IDENGAG_FAC']));
						 $data1= $q1->fetch(PDO::FETCH_ASSOC);
						 $total_paye = $data1['TOTALPAYE']; //total déja payé pour une facture...
		                               
		                                 // calule du montant restant à payer 
		                                 $total_rest = $row['MONTANT'] - $total_paye; 
		                                
		                                echo "<tr> <td> ".$row['NUMERO']." </td> <td>".get_fournisseur($pdo,$row['IDF'])." </td> <td>-".number_format($row['MONTANT'], 0, '.', ' ')." </td> <td>".$row['DATE']."</td>  <td>-".number_format($total_paye, 0, '.', ' ')."</td><td>".number_format( $total_rest, 0, '.', ' ')."</td> <td>".number_format($total_rest, 0, '.', ' ')." XAF</td>  </tr>";
		                               
	                            
	                               
	                               }
	        
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
	
	


</body>

</html>
<?php	  
 
?>
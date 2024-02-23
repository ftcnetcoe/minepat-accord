<?php
// insertion dans la BD
require_once 'db.php';
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
require_once 'PHPExcel.php';


error_reporting(E_ALL);
ini_set("display_errors", 1);


$inputFileName = 'Gestion des operations de débit_2023-02-03 RP Caisse.xlsx';

//  Read your Excel workbook
try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
} catch(Exception $e) {

    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
    
}


//  Get worksheet dimensions
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();



//print_r($results);

//retourne la période des opérations 
function getperiod ($Dateop){
	
	   $period = ""; 
       $mois= substr($Dateop,5,2);
       if 	($mois == "01") $period = "janvier";
	   else if ($mois == "02") $period = "Fevrier";
	    else if ($mois == "03") $period = "Mars";
		 else if ($mois == "04") $period = "Avril";
		  else if ($mois == "05") $period = "Mai";
		   else if ($mois == "06") $period = "Juin";
		    else if ($mois == "07") $period = "Juillet";
			 else if ($mois == "08") $period ="Aout";
			  else if ($mois == "09") $period ="Septembre";
			   else if ($mois == "10") $period = "Octobre";
			    else if ($mois == "11") $period = "Novembre";
				 else if ($mois == "12") $period = "Decembre";	
			return 	 $period; 
		   
}

$n = 4; // 5 caractères aléatoires  pour le lettrage de chaque opération complémentaire


function getRandomStr($n) { 
    // Stockez toutes les lettres possibles dans une chaîne.
    $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomStr = ''; 
    // Générez un index aléatoire de 0 à la longueur de la chaîne -1.
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($str) - 1); 
        $randomStr .= $str[$index]; 
    } 
    return $randomStr; 
} 

function getmaxi ($pdo){
	$q = $pdo->prepare("SELECT max(NUM) as nbre FROM ca_operation");
	$q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        return  $data["nbre"];      
}

function getmaxop ($pdo){
       $q = $pdo->prepare("SELECT max(op) as nbre FROM ca_operation");
	$q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        return  $data["nbre"];
}



$i=getmaxi ($pdo); // a modifier demain
$op=getmaxop ($pdo); //à modifier au suivant


//  Loop through each row of the worksheet in turn
for ($row = 2; $row <= $highestRow; $row++){ 

$op ++;
$i++;
	 
    //  Read a row of data into an array
    $ligne = $sheet->rangeToArray('A' . $row. ':' . $highestColumn . $row, NULL,TRUE,FALSE);
    
     $DateOP = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($ligne[0][2]));    
   // $DateOP = date('Y-m-d', $ligne[0][2]);
    $ID = $ligne[0][0];
    $IDPROJ = $ligne[0][3];
    $MONTANT = $ligne[0][5];
    $CLIENT_FOURNISS = $ligne[0][7];
    $MOTIF = $ligne[0][8];
       
    $LIBELLECOMPTE = $ligne[0][1]; // Compte d'opération 

    $LibelleOp = "Achat"; //
    

         echo "ID=".$ID." COMPTE=".$LIBELLECOMPTE." DAteOP= ".$DateOP." Montant= ".$MONTANT." Mofif= ".$MOTIF."<br/>"; 
 

	 $lettrage = getRandomStr($n);
	 

	/*
	 // Constatation 
	 $requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS,NUM,Period,lettrage,op,ancientypeop) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	 $requete->execute(array($DateOP,"ACHAT",$MOTIF ,"",$MONTANT,199,2,$IDPROJ,$CLIENT_FOURNISS,$i,getperiod($DateOP),$lettrage,$op,"ACHAT_DIVERS")); //1 représente journal de vente
	 
	 $requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS,NUM,Period,lettrage,op,ancientypeop) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	 $requete->execute(array($DateOP,"ACHAT",$MOTIF ,$MONTANT,"",228,2,$IDPROJ,$CLIENT_FOURNISS,$i,getperiod($DateOP),$lettrage,$op,"ACHAT_DIVERS")); //1 représente journal de vente
	 */
	
	 $i++;
	 // Paiement
	 $jnal = 5; $cpt= 40; // par défaut on initialise à la caisse 
	 if ( $LIBELLECOMPTE== "Caisse") { $jnal = 5; $cpt= 40;  }
	 else if  ( $LIBELLECOMPTE== "Banque BCPME") {  $jnal = 4; $cpt= 39; }
	 else if  ( $LIBELLECOMPTE== "Banque AFB") {  $jnal = 3; $cpt= 38; }
	 
	 
	  
	 $requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS,NUM,Period,lettrage,op,ancientypeop) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	 $requete->execute(array($DateOP,"ACHAT",$MOTIF ,"",$MONTANT,$cpt,$jnal,$IDPROJ,$CLIENT_FOURNISS,$i,getperiod($DateOP),$lettrage,$op,"RP_CAISSE")); //1 représente journal de vente
	 
	 $requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS,NUM,Period,lettrage,op,ancientypeop) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	 $requete->execute(array($DateOP,"ACHAT",$MOTIF ,$MONTANT,"",13,$jnal,$IDPROJ,$CLIENT_FOURNISS,$i,getperiod($DateOP),$lettrage,$op,"RP_CAISSE")); //1 représente journal de vente
	 

	
}


 
?>
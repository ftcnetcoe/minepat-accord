<?php
// insertion dans la BD
require_once '../db.php';
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
require_once 'PHPExcel.php';
error_reporting(E_ALL);
ini_set("display_errors", 1);



$inputFileName = 'credits_dons.xls';

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


$i=1307; // a modifier demain

$op=654; //à modifier au suivant

//  Loop through each row of the worksheet in turn
for ($row = 2; $row <= $highestRow; $row++){ 

    //  Read a row of data into an array
    $ligne = $sheet->rangeToArray('A' . $row. ':' . $highestColumn . $row, NULL,TRUE,FALSE);
    
    $ID = $ligne[0][0];
    $LIBELLECOMPTE = $ligne[0][1];
    
  //  $date = strtotime($ligne[0][3]);
  
   $DateOP = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($ligne[0][3]));
    
   //$DateOP = date("Y-m-d", strtotime($ligne[0][3]));
      
    $MONTANT = $ligne[0][6];
    $MOTIF = $ligne[0][7];
    $LibelleOp = $ligne[0][5];
    
    
    /*
    echo "<pre>";
    var_dump( $ID);
    echo "</pre>";
    */
    
    //  Insert row data array into your database of choice here
      
          echo "ID=".$ID." COMPTE=".$LIBELLECOMPTE." DAteOP= ".$DateOP." Montant= ".$MONTANT." Mofif= ".$MONTIF."<br/>"; 


	
	 $lettrage = getRandomStr($n);
	 //$i++;
	 
	// insertion insertion ligne
	 $requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS,NUM,Period,lettrage,op,ancientypeop) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	 $requete->execute(array($DateOP,"","RC" ,"",$MONTANT,2,5,"","",$i,getperiod ($DateOP),$lettrage,$op,"DON")); //1 représente journal de vente
	 
	 $requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS,NUM,Period,lettrage,op,ancientypeop) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	 $requete->execute(array($DateOP,"","RC" ,$MONTANT,"",40,5,"","",$i,getperiod ($DateOP),$lettrage,$op,"DON")); //1 représente journal de vente
	 
	 $op ++;
	 $i++;
	
	 /*
	 
	 $requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS,NUM,Period,lettrage) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
	 $requete->execute(array($row['DATEOP'],"",$row['MOTIF'],"",$row['mntcredit']+($row['mntcredit']*19.25)/100 ,29,1,$row['IDPROJ'],"",$i,getperiod ($row['DATEOP']),"")); //1 représente journal de vente
	
	
	 $i++;
	 
	 $requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS,NUM,Period,lettrage) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
	 $requete->execute(array($row['DATEOP'],"",$row['MOTIF'],"",$row['mntcredit']+($row['mntcredit']*19.25)/100,$row['IDCOMPTEC'],3,$row['IDPROJ'],"",$i,getperiod ($row['DATEOP']),$lettrage)); //1 représente journal de vente
	 
	 //TVA RS
	 $requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS,NUM,Period,lettrage) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
	 $requete->execute(array($row['DATEOP'],"",$row['MOTIF'],"","",25,3,$row['IDPROJ'],"",$i,getperiod ($row['DATEOP']),"")); //1 représente journal de vente
	
	// IR RS
	$requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS,NUM,Period,lettrage) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
	$requete->execute(array($row['DATEOP'],"",$row['MOTIF'],"","",26,3,$row['IDPROJ'],"",$i,getperiod ($row['DATEOP']),"")); //1 représente journal de vente
	
	// AFB NAP
	$requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS,NUM,Period,lettrage) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
	$requete->execute(array($row['DATEOP'],"",$row['MOTIF'],$row['mntcredit']+($row['mntcredit']*19.25)/100,"",38,3,$row['IDPROJ'],"",$i,getperiod ($row['DATEOP']),"")); //1 représente journal de vente
	
	// PENALITE 
	$requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS,NUM,Period,lettrage) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
	$requete->execute(array($row['DATEOP'],"",$row['MOTIF'],"","",32,3,$row['IDPROJ'],"",$i,getperiod ($row['DATEOP']),"")); //1 représente journal de vente
	
	 */
}


 
?>
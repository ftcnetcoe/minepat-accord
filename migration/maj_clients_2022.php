<?php
// insertion dans la BD
require_once '../db.php';
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
require_once 'PHPExcel.php';
error_reporting(E_ALL);
ini_set("display_errors", 1);



$inputFileName = 'credits_clients_2022.xls';

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


$i=1369; // a modifier demain

$op=716; //à modifier au suivant

//  Loop through each row of the worksheet in turn
for ($row = 2; $row <= $highestRow; $row++){ 

    //  Read a row of data into an array
    $ligne = $sheet->rangeToArray('A' . $row. ':' . $highestColumn . $row, NULL,TRUE,FALSE);
    
    $ID = $ligne[0][0];
    $LIBELLECOMPTE = $ligne[0][1];
    $datefact = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($ligne[0][3]));
    $datepaie = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($ligne[0][4]));  
    $projet = $ligne[0][5];
    $creance= $ligne[0][6];
    
    $MONTANTNAP = $ligne[0][7];
    $tauxIR = $ligne[0][8];
    $HT =  round($ligne[0][9],2); // arrondi à 2 chiffre après la virgule
    $IR =  round($ligne[0][10],2);
    $tauxTVA =  $ligne[0][11];
    $TVA =  round($ligne[0][12],2);
    $TTC =  round($ligne[0][13],2); 
    $Motif =  $ligne[0][14];
        
   
    /*
    echo "<pre>";
    var_dump( $ID);
    echo "</pre>";
    */
    
    $op ++;
    
         //  Insert row data array into your database of choice here
      
         // echo "ID=".$ID." COMPTE=".$LIBELLECOMPTE." Date= ".$date."DateF = ".$datefacturation." Proejt = ".$projet." Créance ".$creance." NAP= ".$MONTANTNAP." HT=".$HT." IR= ".$IR." TVA= ".$TVA." TTC=".$TTC." Mofif= ".$Motif ."<br/>"; 
 
        $i++; 
	
	 $lettrage = getRandomStr($n);
	 //$i++;
	 
	//TTC
	 $requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS,NUM,Period,lettrage,op,ancientypeop) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	 $requete->execute(array($datefact,$creance,$Motif ,$TTC,"",212,1,$projet,"",$i,getperiod ($datefact),$lettrage,$op,"SPI")); //1 représente journal de vente
	
	
	//TVA
	
	if ($TVA !=0){
	 $requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS,NUM,Period,lettrage,op,ancientypeop) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	 $requete->execute(array($datefact,$creance,$Motif ,"",$TVA,31,1,$projet,"",$i,getperiod ($datefact),"",$op,"SPI")); //1 représente journal de vente
	}
	
	//HT
	 $requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS,NUM,Period,lettrage,op,ancientypeop) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	 $requete->execute(array($datefact,$creance,$Motif ,"",$HT,28,1,$projet,"",$i,getperiod($datefact),"",$op,"SPI")); //1 représente journal de vente
	
	
	$i++;
	
	 $jnal=3; //fixe à AFB par défaut 
	 if ($jnal == "Caisse") $jnal =5; else $jnal =3; 
	 
	//TTC (Modifier journal = 1  en fonction CAISSE ou AFB
	 $requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS,NUM,Period,lettrage,op,ancientypeop) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	 $requete->execute(array($datepaie,$creance,$Motif ,"",$TTC,212,$jnal,$projet,"",$i,getperiod ($datepaie),$lettrage,$op,"SPI")); //1 représente journal de vente
	
	if ($TVA !=0){
	//TVA RS (Modifier journal = 1  en fonction CAISSE ou AFB
	 $requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS,NUM,Period,lettrage,op,ancientypeop) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	 $requete->execute(array($datepaie,$creance,$Motif ,$TVA,"",25,$jnal,$projet,"",$i,getperiod ($datepaie),"",$op,"SPI")); //1 représente journal de vente
	}
	
	 //IR RS (Modifier journal = 1  en fonction CAISSE ou AFB
	 $requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS,NUM,Period,lettrage,op,ancientypeop) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	 $requete->execute(array($datepaie,$creance,$Motif ,$IR,"",26,$jnal,$projet,"",$i,getperiod ($datepaie),"",$op,"SPI")); //1 représente journal de vente
	
	 $comptea=38; // fixe à AFB par défaut 
	 if ($LIBELLECOMPTE == "Caisse") $comptea=40; else $comptea=38; 
	 //IR RS (Modifier journal = 1  en fonction CAISSE ou AFB et 26 = 38 = AFB ou 40= CAISSE
	 $requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS,NUM,Period,lettrage,op,ancientypeop) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	 $requete->execute(array($datepaie,$creance,$Motif ,$MONTANTNAP,"",$comptea,$jnal,$projet,"",$i,getperiod ($datepaie),"",$op,"SPI")); //1 représente journal de vente
	
	
	 
	 
	 
	 
	
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
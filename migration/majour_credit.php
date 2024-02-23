<?php
// insertion dans la BD
require_once 'db.php';
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
error_reporting(E_ALL);
ini_set("display_errors", 1);

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


//$sql = "SELECT * from operation_debit";
$sql="SELECT *, opdebit.MONTANT as montandebit FROM `operation_debit` opdebit inner join engagement_facture engagfac on opdebit.IDENGAG_FAC = engagfac.IDENGAG_FAC where opdebit.IDENGAG_FAC <> -1 and opdebit.IDENGAG_FAC <> 0"; 

$q = $pdo->prepare($sql);
$q->execute();
$results= $q->fetchAll(PDO::FETCH_ASSOC);

$idjnal =6; //OPERATIONS DIVERS 
$n = 4; // 5 caractères aléatoires  pour le lettrage de chaque opération complémentaire

print_r($results);
$i=0; 

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


foreach ( $results as $row ){
	
	 $lettrage = getRandomStr($n);
	 
	 $i++;
	 //insertion insertion ligne
	 $requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS, NUM,Period,lettrage) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
	 $requete->execute(array($row['DATEOP'],$row['NUMERO'],$row['LIBELLE'],"",$row['montandebit'],$row['IDCOMPTED'],2,$row['IDPROJ'],$row['BILLETEUR'],$i,getperiod ($row['DATEOP']),$lettrage)); //1 représente journal de vente
	 
	 // $TVA= ($row['MONTANT']*19.25)/100;
	 //insertion insertion ligne
	 $requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS, NUM,Period,lettrage) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
	 $requete->execute(array($row['DATEOP'],$row['NUMERO'],$row['LIBELLE'],"","",34,2,$row['IDPROJ'],$row['BILLETEUR'],$i,getperiod ($row['DATEOP']),"")); //1 représente journal de vente
	 
	 $requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS, NUM,Period,lettrage) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
	 $requete->execute(array($row['DATEOP'],$row['NUMERO'],$row['LIBELLE'],$row['montandebit'],"",36,2,$row['IDPROJ'],$row['BILLETEUR'],$i,getperiod ($row['DATEOP']),"")); //1 représente journal de vente
	 
	 if ($row['IDCOMPTEOP']== 2) $idjnal= 3; // JAFB
	 else if ($row['IDCOMPTEOP']== 3)  $idjnal= 4; // JBCPME
	 else if ($row['IDCOMPTEOP']== 1)  $idjnal= 5; // JCAISSE
	 else $idjnal= 6; // JDIVERS
	 
	 $i++; 
	 
	 $requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS, NUM,Period,lettrage) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
	 $requete->execute(array($row['DATEOP'],$row['NUMERO'],$row['LIBELLE'],$row['montandebit'],"",$row['IDCOMPTED'],$idjnal,$row['IDPROJ'],$row['BILLETEUR'],$i,getperiod ($row['DATEOP']),$lettrage)); //1 représente journal de vente
	 
	$requete = $pdo->prepare("INSERT INTO ca_operation (DateOp,RefPj,LibelleOp,MontantOpDebit,MontantOpCredit,Numcpt,idJnal,IDPROJ,CLIENT_FOURNISS, NUM,Period,lettrage) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
	$requete->execute(array($row['DATEOP'],$row['NUMERO'],$row['LIBELLE'],"",$row['montandebit'],$row['IDCOMPTEOP'],$idjnal,$row['IDPROJ'],$row['BILLETEUR'],$i,getperiod ($row['DATEOP']),"")); //1 représente journal de vente
	 
}
//SELECT *, opdebit.MONTANT as montandebit FROM `operation_debit` opdebit inner join engagement_facture engagfac on opdebit.IDENGAG_FAC = engagfac.IDENGAG_FAC where opdebit.IDENGAG_FAC <> -1 and opdebit.IDENGAG_FAC <> 0;

 
?>

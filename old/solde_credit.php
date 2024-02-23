<?php
$pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//recupère solde compte operation
	$sql = "SELECT *  FROM COMPTE_OPERATION";
	$q = $pdo->prepare($sql);
        $q->execute();
	$results= $q->fetchAll(PDO::FETCH_ASSOC);
	
	echo "<table class='table table-striped'>";
	        echo "  <thead class='thead-dark'><tr class='table-primary'> <td> COMPTE OPERATION </td> <td>NOMBRE OPERATION</td> <td> TOTAL DES OPERATIONS CREDIT</td><td>NOMBRE OPERATION MOIS</td> <td> TOTAL DES OPERATIONS CREDIT MOIS</td> <td> SOLDE COMPTE</td> </tr> </thead> <tbody>";
	$cpt_nbre=0; $cpt_total1=0; $cpt_total2=0; $cpt_total3=0; $cpt_nbre_mois=0;	 
	foreach($results as $row){
	
		// echo " <b>".$row['NOMCOMPTE']."</b> : ".number_format($row['SOLDE'], 0, '.', ' ')." XAF &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;";
		
		
		 //recupère somme des debits du mois
		 /* $sql1 = "SELECT  sum(MONTANT) as TOTAL FROM OPERATION_DEBIT  where IDCOMPTEOP = ?  and MONTH(DATEOP)= ? ";
	         $q1 = $pdo->prepare($sql1);
       		 $q1->execute(array($row['IDCOMPTEOP'],$mois));
		 $data1= $q1->fetch(PDO::FETCH_ASSOC);
		 $sommedebit_mois= $data1['TOTAL']; */
		 
		//recupère somme des credits du mois 
		 $sql2 = "SELECT  count(*) as NBRE, sum(MONTANT) as TOTAL FROM OPERATION_CREDIT  where IDCOMPTEOP = ?  and MONTH(DATEOP)= ? ";
	         $q2 = $pdo->prepare($sql2);
       		 $q2->execute(array($row['IDCOMPTEOP'],$mois));
		 $data2= $q2->fetch(PDO::FETCH_ASSOC);
		 $sommecredit_mois= $data2['TOTAL'];
		 
		 //recupère somme mouvement debit du mois 
		 $sql3 = "SELECT  sum(MONTANT) as TOTAL FROM MOUVEMENT where IDCOMPTEOP2 = ? and MONTH(DATEOP)= ? ";
	         $q3 = $pdo->prepare($sql3);
       		 $q3->execute(array($row['IDCOMPTEOP'],$mois));
		 $data3= $q3->fetch(PDO::FETCH_ASSOC);
		 $sommecredit_mouv_mois = $data3['TOTAL'];
		 
		 $solde_mois =  $sommecredit_mois+ $sommecredit_mouv_mois;  // changer $row['SOLEINIT'] par le solde en debut de mois.
		 
		 
		 
		 $sql = "SELECT count(*) as NBRE, sum(MONTANT) as TOTAL FROM OPERATION_CREDIT  where IDCOMPTEOP = ? ";
	         $q = $pdo->prepare($sql);
       		 $q->execute(array($row['IDCOMPTEOP']));
		 $data= $q->fetch(PDO::FETCH_ASSOC);
		 
		  
		  echo "<tr> <td> ".$row['NOMCOMPTE']." </td> <td>".$data['NBRE']."</td> <td>".number_format($data['TOTAL'], 0, '.', ' ')." XAF </td> <td>".$data2['NBRE']."</td> <td>".number_format($solde_mois, 0, '.', ' ')." XAF </td> 
   <td>".number_format($row['SOLDE'], 0, '.', ' ')." XAF </td> </tr>";
   
	$cpt_nbre +=$data['NBRE']; $cpt_total1+=$data['TOTAL']; $cpt_total2 += $solde_mois; $cpt_total3 +=$row['SOLDE']; $cpt_nbre_mois+= $data2['NBRE'];
		 
	}
	
echo "<tr class='table-primary'> <td> TOTAL </td> <td>".$cpt_nbre."</td> <td>".number_format($cpt_total1, 0, '.', ' ')." XAF </td> <td>".$cpt_nbre_mois."</td> <td>".number_format($cpt_total2, 0, '.', ' ')." XAF </td> 
   <td>".number_format($cpt_total3, 0, '.', ' ')." XAF </td> </tr>";
   	
	echo "</tbody></table>";
	
?>
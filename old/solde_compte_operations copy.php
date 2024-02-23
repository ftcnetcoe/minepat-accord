<?php
$pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//recupère solde compte operation
	$sql = "SELECT *  FROM COMPTE_OPERATION";
	$q = $pdo->prepare($sql);
        $q->execute();
	$results= $q->fetchAll(PDO::FETCH_ASSOC);
	
	echo "<table class='table table-striped'>";
	        echo "  <thead class='thead-dark'><tr class='table-primary'> <td> COMPTE OPERATION </td> <td>TOTAL CREDIT MOIS </td> <td> TOTAL DES OPERATIONS DEBIT </td> <td>NOMBRE OPERATION MOIS</td>  <td> CUMUL MOUVEMENT DEBIT </td> <td> CUMUL MOUVEMENT CREDIT </td> <td> SOLDE MOIS EN COURS </td> <td> SOLDE COMPTE</td> </tr> </thead> <tbody>";
        $tcm =0; $cpt_total1=0; $cpt_total2=0; $cpt_total3=0; $cpt_nbre_mois=0; $t=0; $t2=0;
	foreach($results as $row){
	
		 
		 //recupère somme des debits du mois
		 $sql1 = "SELECT count(*) as NBRE, sum(MONTANT) as TOTAL FROM OPERATION_DEBIT  where IDCOMPTEOP = ?  and MONTH(DATEOP)= ? ";
	         $q1 = $pdo->prepare($sql1);
       		 $q1->execute(array($row['IDCOMPTEOP'],$mois));
		 $data1= $q1->fetch(PDO::FETCH_ASSOC);
		 $sommedebit_mois= $data1['TOTAL'];
		 
		//recupère somme des credits du mois 
		 $sql2 = "SELECT  sum(MONTANT) as TOTAL FROM OPERATION_CREDIT  where IDCOMPTEOP = ?  and MONTH(DATEOP)= ? ";
	         $q2 = $pdo->prepare($sql2);
       		 $q2->execute(array($row['IDCOMPTEOP'],$mois));
		 $data2= $q2->fetch(PDO::FETCH_ASSOC);
		 $sommecredit_mois= $data2['TOTAL'];
		 
		 //recupère somme mouvement debit du mois 
		 $sql3 = "SELECT  sum(MONTANT) as TOTAL FROM MOUVEMENT where IDCOMPTEOP1 = ? and MONTH(DATEOP)= ? ";
	         $q3 = $pdo->prepare($sql3);
       		 $q3->execute(array($row['IDCOMPTEOP'],$mois));
		 $data3= $q3->fetch(PDO::FETCH_ASSOC);
		 $sommedebit_mouv_mois = $data3['TOTAL'];
		 
		 //recupère somme mouvement debit du mois 
		 $sql4 = "SELECT  sum(MONTANT) as TOTAL FROM MOUVEMENT where IDCOMPTEOP2 = ? and MONTH(DATEOP)= ? ";
	         $q4 = $pdo->prepare($sql4);
       		 $q4->execute(array($row['IDCOMPTEOP'],$mois));
		 $data4= $q4->fetch(PDO::FETCH_ASSOC);
		 $sommecredit_mouv_mois = $data4['TOTAL'];
		 
		/*//recupère somme des credits du mois 
		 $sql2 = "SELECT   sum(MONTANT) as TOTAL FROM OPERATION_CREDIT  where IDCOMPTEOP = ?  and MONTH(DATEOP)= ? ";
	         $q2 = $pdo->prepare($sql2);
       		 $q2->execute(array($row['IDCOMPTEOP'],$mois));
		 $data2= $q2->fetch(PDO::FETCH_ASSOC);
		 $sommecredit_mois= $data2['TOTAL'];*/
		 
		 
		 $solde_mois = $sommecredit_mois+$row['SOLEINIT'] - $sommedebit_mouv_mois -$sommedebit_mois+ $sommecredit_mouv_mois ;  // changer $row['SOLEINIT'] par le solde en debut de mois.
		 
		 
		 $sql = "SELECT count(*) as NBRE, sum(MONTANT) as TOTAL FROM OPERATION_DEBIT  where IDCOMPTEOP = ?  and MONTH(DATEOP)= ?";
	         $q = $pdo->prepare($sql);
       		 $q->execute(array($row['IDCOMPTEOP'],$mois));
		 $data= $q->fetch(PDO::FETCH_ASSOC);
		 
		 //Recupère solde initial
		 $tcm +=$sommecredit_mois; $cpt_total1+=$data['TOTAL']; $cpt_total2 += $solde_mois; $cpt_total3 +=$row['SOLDE']; $cpt_nbre_mois +=$data1['NBRE']; $t+=$sommedebit_mouv_mois; $t2+=$sommecredit_mouv_mois ;
		 
		  echo "<tr> <td> ".$row['NOMCOMPTE']." </td> <td>".number_format($sommecredit_mois, 0, '.', ' ')." XAF </td> <td>-".number_format($data['TOTAL'], 0, '.', ' ')." XAF </td> <td>".$data1['NBRE']."</td>  <td>-".number_format($sommedebit_mouv_mois, 0, '.', ' ')."</td><td>".number_format($sommecredit_mouv_mois , 0, '.', ' ')."</td><td>".number_format($solde_mois, 0, '.', ' ')." XAF</td> <td>".number_format($row['SOLDE'], 0, '.', ' ')." XAF </td> </tr>";
	
		 
	}
	 echo "<tr class='table-primary'> <td> TOTAL </td> <td>".$tcm."</td> <td>-".number_format($cpt_total1, 0, '.', ' ')." XAF </td>  <td>".$cpt_nbre_mois."</td> <td>-".number_format($t, 0, '.', ' ') ."</td> <td>".number_format($t2, 0, '.', ' ') ."</td> <td>".number_format($cpt_total2, 0, '.', ' ')." XAF</td> <td>".number_format($cpt_total3, 0, '.', ' ')." XAF </td> </tr>";
	 
	echo "</tbody></table>";
	
?>
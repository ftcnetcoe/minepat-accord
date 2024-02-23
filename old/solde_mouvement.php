<?php
$pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//recupère solde compte operation
	$sql = "SELECT *  FROM COMPTE_OPERATION";
	$q = $pdo->prepare($sql);
        $q->execute();
	$results= $q->fetchAll(PDO::FETCH_ASSOC);
	
	echo "<table class='table table-striped'>";
	        echo "  <thead class='thead-dark'><tr class='table-primary'> <td> COMPTE OPERATION </td> <td>NOMBRE OPERATION</td>  <td> TOTAL DES OPERATIONS DEBITS </td> <td> TOTAL DES OPERATIONS CREDIT </td> <td> SOLDE COMPTE</td> </tr> </thead> <tbody>";
	
	$cpt_nbre=0; $cpt_total1=0; $cpt_total2=0; $cpt_total3=0; $cpt_nbre_mois=0;
		 
	foreach($results as $row){
	
		 $sql = "SELECT count(*) as NBRE, sum(MONTANT) as TOTAL FROM MOUVEMENT where IDCOMPTEOP1 = ? ";
	         $q = $pdo->prepare($sql);
       		 $q->execute(array($row['IDCOMPTEOP']));
		 $data= $q->fetch(PDO::FETCH_ASSOC);
		 
		 $sql2 = "SELECT count(*) as NBRE, sum(MONTANT) as TOTAL FROM MOUVEMENT where IDCOMPTEOP2 = ? ";
	         $q2 = $pdo->prepare($sql2);
       		 $q2->execute(array($row['IDCOMPTEOP']));
		 $data2= $q2->fetch(PDO::FETCH_ASSOC);
		 
		  echo "<tr> <td> ".$row['NOMCOMPTE']." </td> <td>".$data['NBRE']."</td> <td>".number_format($data['TOTAL'], 0, '.', ' ')." XAF </td> <td>".number_format($data2['TOTAL'], 0, '.', ' ')." XAF </td> <td>".number_format($row['SOLDE'], 0, '.', ' ')." XAF </td> </tr>";
		$cpt_nbre+=$data['NBRE']; $cpt_total1+=$data['TOTAL'];$cpt_total2+=$data2['TOTAL']; $cpt_total3+=$row['SOLDE'];
	}
	
	 echo "<tr class='table-primary'> <td> TOTAL</td> <td>".$cpt_nbre."</td> <td>".number_format($cpt_total1, 0, '.', ' ')." XAF </td> <td>".number_format($cpt_total2, 0, '.', ' ')." XAF </td> <td>".number_format($cpt_total3, 0, '.', ' ')." XAF </td> </tr>";
	
	echo "</tbody></table>";
	
?>
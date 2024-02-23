<?php
session_start(); // ouverture de la session

ini_set('memory_limit', '900000M');
ini_set("pcre.backtrack_limit", "5000000"); 
 
include("libraries/autoload.php");
use GroceryCrud\Core\GroceryCrud;
$database = include('database.php');
$config = include('config.php');
$crud = new GroceryCrud($config, $database);
include_once("db.php"); 
error_reporting(E_ALL);
ini_set("display_errors", 1);
//if (isset($_POST['date_debut']) && isset($_POST['date_fin'])){	

	$date_debut = "01/01/2022";
	$date_fin = "31/12/2022";

$date = '27/09/2013';
$dt = DateTime::createFromFormat('d/m/Y', $date);


$html = '';
$html .= '



<img src="entete.jpeg" width="1024" height="60"> <caption> 
<H1 style="color:#3358FF;">GRAND-LIVRE DES COMPTES</H1></caption>


<table border="0" width="1024" cellspacing="0">	
		<tr>
			<td> Date de tirage ' . date("Y/m/d") .'</td>
			<td align = "right"> à '. $dt->format('H:i:s').'</td>
			<td align = "right"> Periode du : '.$date_debut.' au '.$date_fin.'</td>
	    </tr>
		
</table>

&nbsp;


<table border="1" width="1024" cellspacing="0">	
<thead BGCOLOR="red">

     <tr style="background-color:#A6ACAF;">
        <th>Date</th>
        <th>Code Compte</th>
        <th>N<sup>o</sup> pièce</th>
        <th>Libellé écriture</th>
        <th>Let</th>
        <th>Mouvement Débit</th>
        <th>Mouvement Crédit</th>
        <th>Solde Progressif</th>
     </tr>
     
</thead>';

   $pdo = Database::connect();
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   

   
    
    
	$q4 = $pdo->prepare('SELECT * FROM `ca_journal`');
	$q4->execute();
	
	
       

	$sommedebmouv1 = 0;
	$sommecremouv1 = 0;
	$sommesol1 = 0;
	$solde = 0;


	
	
	
while($data4= $q4->fetch(PDO::FETCH_ASSOC)){
	
	
	
	$html .= '

	<tr cellspadding="0">

	<th colspan="8" align = "left"> Total JOURNAL '.$data4['CodeJnal'].'- '.$data4['Libelle'].' </th>
	
	
	</tr>';
	
	
	//recupère les valeurs initiales des debits et crédit des comptes 
	$sommedebmouv = 0;
	$sommecremouv = 0;
        $sommesol = $sommedebmouv -  $sommecremouv; // calcule le solde initial
        
	
	// $sommesol = $data4['Solde']; //solde initial du compte
	
		
	$q3 = $pdo->prepare('SELECT * FROM `ca_operation` op  inner join ca_comptes cpt on cpt.NumCpt= op.NumCpt  where  idJnal= ? order BY DateOp ASC');
	$q3->execute(array($data4['idJnal']));

        while($data3= $q3->fetch(PDO::FETCH_ASSOC)){


	    $solde = $data3['MontantOpDebit'] - $data3['MontantOpCredit'];
	    
	
		$html .= '
    <tbody>
        <tr>
		<td>'.$data3['DateOp'].'</td>
		<td>'.$data3['CodeCpt'].'</td>
		<td>'.$data3['CodeOp'].'</td>
	        <td colspan="2">'.$data3['LibelleOp'].'</td>
	        <td align = "right">'.number_format($data3['MontantOpDebit'], 0, '.', ' ').'</td>
		<td align = "right">'.number_format($data3['MontantOpCredit'], 0, '.', ' ').'</td>
	        <td align = "right">'.number_format($solde, 0, '.', ' ').'</td>
        </tr>';
		
	$sommedebmouv += $data3['MontantOpDebit'];
	$sommecremouv += $data3['MontantOpCredit'];
	$sommesol += $solde;
	

	
	

	}
	
	
	$html .= '

	<tr cellspadding="0">

	<th colspan="3"> Total JOURNAL '.$data4['CodeJnal'].'</th>
	<th> du '.$date_debut.'</th>
	<th> au '.$date_fin.'</th>
	<th align = "right">'.number_format($sommedebmouv, 0, '.', ' ').'</th>
	<th align = "right">'.number_format($sommecremouv, 0, '.', ' ').'</th>
	<th align = "right">'.number_format($sommesol, 0, '.', ' ').'</th>
	
	</tr>';
	
		$sommedebmouv1 += $sommedebmouv;
		$sommecremouv1 += $sommecremouv;
		$sommesol1 += $sommesol;
	
	
	
}
   	$html .= '
	   <tr style="background-color:#D7DBDD;">
	   <td colspan="5" align = "right">A rapporter</td>
	   <td align = "right">'.number_format($sommedebmouv1, 0, '.', ' ').'</td>
	   <td align = "right">'.number_format($sommecremouv1, 0, '.', ' ').'</td>
	   <td align = "right">'.number_format($sommesol1, 0, '.', ' ').'</td>
	   </tr>
	</tbody></table>';

	require_once __DIR__ . '/vendor/autoload.php';
	$mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/tmp','mode' => 'utf-8','format' => 'A4-L' ]);
	
	$mpdf->AliasNbPages('{PAGETOTAL}');
	$mpdf->setFooter('{PAGENO}/{PAGETOTAL}');
	$mpdf->WriteHTML( $html );
	$mpdf->WriteHTML('');
	$mpdf->Output();
	exit;

/*} else {
	header('Location: /index.php' );  
}
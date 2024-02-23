<?php

require 'db.php';
session_start();

// accès à la BD pour verification des information
// redirection en fonction des informations fournies

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



if (isset ($_POST['password']) && isset($_POST['login'])){	

 $pass = $_POST['password'];
 $pass = md5($pass); // cryptage MD5
 $login = $_POST['login'];
 


   $sql = "SELECT id_personnel,DROIT,active,nom,id_unite FROM rh_personnel WHERE  LOGIN= ? and PASS= ?   ";
   $q = $pdo->prepare($sql);
   $q->execute(array($login,$pass));
   $data= $q->fetch(PDO::FETCH_ASSOC);


  // $droit= $data['droit']; //recupère le droit. 
   $idu= $data['id_personnel']; //recupère le droit. 
    $droit= $data['DROIT']; //recupère le droit. 
    $active= $data['active']; //recupère le droit. 
    $nom= $data['nom']; //recupère le nom. 
     $id_unite= $data['id_unite']; //recupère l'unite.
   
   if (!empty($idu) &&  $active==1 ){
	   
	   $_SESSION['pass'] = $pass;
	   $_SESSION['login'] = $login;
	   $_SESSION['idu'] = $idu;
	   $_SESSION['droit'] = $droit;
	      $_SESSION['nom'] = $nom;
	         $_SESSION['id_unite'] = $id_unite;
	   
	   if ($_SESSION['droit'] == "RH")  header('Location: rh_dashboard.php'); 
	   else if ($_SESSION['droit'] == "tresorerie")  header('Location: rh_dashboard_reunion_daaf.php'); 
	   else if ($_SESSION['droit'] == "admin")  header('Location: admin_dashboard.php');  //header('Location: rh_dashboard.php'); //provisoire (crée le dashboard de l'admin)
	   else if ($_SESSION['droit'] == "budget")  header('Location: gac_contrats.php'); 
	   else if ($_SESSION['droit'] == "utilisateur")  header('Location: projet.php');
	   else if ($_SESSION['droit'] == "superviseur")  header('Location: prod_dashboard.php');
	   else if ($_SESSION['droit'] == "gestionnaire")  header('Location: mesprojets.php');
	   else if ($_SESSION['droit'] == "suivi_evaluation")  header('Location: suivi_projet.php');
	   else if ($_SESSION['droit'] == "saisie")  header('Location: devisfournisseurs.php');
	   else if ($_SESSION['droit'] == "sdcao")  header('Location: rh_dashboard_reunion_dcao.php'); // a remplacer par le dashboard
	   else if ($_SESSION['droit'] == "dcao")  header('Location: dao_dashboard.php');
	   else if ($_SESSION['droit'] == "sdao")  header('Location: dao_montage.php'); //montage.php
	   else if ($_SESSION['droit'] == "planification")  header('Location: prod_planification.php');
	   else if ($_SESSION['droit'] == "execution")  header('Location: gestionnaire.php');
	   else if ($_SESSION['droit'] == "soca")  header('Location: ges_courriers_dashboard.php ');	//  ges_courriers_dashboard.php
	   else if ($_SESSION['droit'] == "adrde")  header('Location: rh_dashboard_reunion_drde.php');   // a remplacer par le dashboard 
	   else if ($_SESSION['droit'] == "daaf")  header('Location: ca_dashboard.php');   // a remplacer par le dashboard 
	   else if ($_SESSION['droit'] == "uee")  header('Location: ekio_dashboard.php');   // a remplacer par le dashboard http://kiama360.kiama.cm/ca_etat_comptable.php
	   
       // Mot de passe incorrect
	   
		
   }else if (!empty($idu) && $active==0){ // pas definit : login ou mot de passe incorrect
   
     $_SESSION['msg3'] = "activation";
     header('Location:index.php');  // Mot de passe incorrect
	   
   }else { // utilisateur n'existe pas 
      
	   $sql = "SELECT count(*) as nbre FROM rh_personnel WHERE  LOGIN = ? ";
	   $q = $pdo->prepare($sql);
           $q->execute(array($login));
          $data= $q->fetch(PDO::FETCH_ASSOC);
	   if ( $data['nbre'] >=1){ // login bon password à verifier
	    
	         $_SESSION['msg3'] = "mdp";
	        header('Location: index.php');  // Mot de passe incorrect
	   }else{ // login incorrect 
	         $_SESSION['msg3'] = "login";
	        header('Location: index.php' ); // Msg= Login incorrect 
	   }
		   
   }


} else {
	header('Location: index.php' );  
} 

?>
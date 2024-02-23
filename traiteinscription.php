<?php

require 'db.php';
session_start();

// accès à la BD pour verification des information
// redirection en fonction des informations fournies

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



if (isset($_POST['password']) && isset($_POST['login'])){	

 $pass = $_POST['password'];
 $pass = md5($pass); //cryptage MD5
 $login = $_POST['login'];
 


   $sql = "SELECT id_personnel,DROIT,active FROM rh_personnel WHERE  LOGIN = ? and PASS= ? ";
   $q = $pdo->prepare($sql);
   $q->execute(array($login,$pass));
   $data= $q->fetch(PDO::FETCH_ASSOC); 
   
   $idu= $data['ID']; //recupère le droit. 
   $droit= $data['DROIT']; //recupère le droit. 
   $active= $data['ACTIVE']; //recupère le droit. 
  
   if (!empty($idu)){ // le compte existe déja 
	   
	   $_SESSION['msg'] = "exist"; // le compte existe déja. veuillez vous connecter plutot
	   if ($active ==0) $_SESSION['msg2'] = "activation";
	   header('Location: index.php');  // Mot de passe incorrect
		
   }else { // pas definit // on crée le compte maintenant
	   
	   $sql = "INSERT INTO rh_personnel (LOGIN, PASS, DROIT, active) VALUES (?,?,?,?)";
	   $stmt= $pdo->prepare($sql);
           $stmt->execute([$login, $pass, "user","0"]);
	   
	   $_SESSION['msg3'] = "activation";
	   header('Location: index.php');  // Mot de passe incorrect
	   
   }


} else {
	header('Location: /statistiqueb2c' );  
} 

?>
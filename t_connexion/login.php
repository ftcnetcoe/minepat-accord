<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require '../db.php';
session_start();

// accès à la BD pour verification des information
// redirection en fonction des informations fournies

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if (isset ($_POST['pass']) && isset($_POST['login'])){	

 $pass = $_POST['pass'];
 $pass = md5($pass); // cryptage MD5
 $login = $_POST['login'];
 
   $sql = "SELECT idu,droit FROM users WHERE  login = ? and pass= ?   ";
   $q = $pdo->prepare($sql);
   $q->execute(array($login,$pass));
   $data= $q->fetch(PDO::FETCH_ASSOC); 
   $idu= $data['idu']; //recupère le droit. 
   $droit= $data['droit']; //recupère le droit. 
  
   if (!empty($idu)){
	   
	   $_SESSION['pass'] = $pass;
	   $_SESSION['login'] = $login;
	   $_SESSION['idu'] = $idu;
	   $_SESSION['droit'] = $droit;
       
	   header('Location: ../gesconsultants/main.php');  // Mot de passe incorrect
		
   }else if (!empty($idu) ){ // pas definit : login ou mot de passe incorrect
	 
	   header('Location: ../index.php');  // Mot de passe incorrect
	   
   }else { // utilisateur n'existe pas 
      
	   $sql = "SELECT count(*) as nbre FROM users WHERE  login = ? ";
	   $q = $pdo->prepare($sql);
           $q->execute(array($login));
           $data= $q->fetch(PDO::FETCH_ASSOC);
	   if ( $data['nbre'] >=1){ // login bon password à verifier	    
	         $_SESSION['msg3'] = "mdp";
	        header('Location: ../index.php');  // Mot de passe incorrect
	   }else{ // login incorrect 
	        $_SESSION['msg3'] = "login";
	        header('Location: ../index.php' ); // Msg= Login incorrect 
	   }
		   
   }

} else {
	header('Location: /statistiqueb2c' );  
} 


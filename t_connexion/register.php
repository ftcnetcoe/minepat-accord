<?php

require '../db.php';
session_start();

// accès à la BD pour verification des information
// redirection en fonction des informations fournies

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



if (isset($_POST['pass']) && isset($_POST['login']) && isset($_POST['email'])){	

 $pass = $_POST['pass'];
 $pass = md5($pass); //cryptage MD5
 $login = $_POST['login'];
 $mail = $_POST['email'];


   $sql = "SELECT idu,droit,active FROM users WHERE  login = ? and pass= ? ";
   $q = $pdo->prepare($sql);
   $q->execute(array($login,$pass));
   $data= $q->fetch(PDO::FETCH_ASSOC); 
   
   $idu= $data['idu']; //recupère le droit. 
   $droit= $data['droit']; //recupère le droit. 
   $active= $data['active']; //recupère le droit. 
  
   if (!empty($idu)){ // le compte existe déja 
	   
	   $_SESSION['msg'] = "exist"; // le compte existe déja. veuillez vous connecter plutot
	   if ($active ==0) $_SESSION['msg2'] = "activation";
	   header('Location: ../index.php');  // Mot de passe incorrect
		
   }else { // pas definit // on crée le compte maintenant
	   
	   $sql = "INSERT INTO users (login, pass, droit,mail, active) VALUES (?,?,?,?,?)";
	   $stmt= $pdo->prepare($sql);
           $stmt->execute([$login, $pass, "user",$mail,"0"]);

	   // envoie un mail d'activation...
	   // contenant un lien d'activation.............
	   
	   $_SESSION['msg3'] = "activation";
	   header('Location: ../index.php');  // Mot de passe incorrect
	   
	   //retourne 
		   
   }


} else {
	header('Location: /statistiqueb2c' );  
} 

?>
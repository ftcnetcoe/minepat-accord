<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();

require 'db.php';


// accès à la BD pour verification des information
// redirection en fonction des informations fournies

$pdo = Database2::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



if (isset($_POST['password'])){	

 $pass = $_POST['password'];
 $pass = md5($pass); //cryptage MD5
 $idu= $_SESSION['idu'];

 

   $sql = "update user set pass= ?  WHERE  idu= ?";
   $q = $pdo->prepare($sql);
   $q->execute(array($pass,$idu));
   
  // $_SESSION['msg3'] = "mdpc";
   header('Location: index.php');  // Mot de passe incorrect
     		   
   }

?>
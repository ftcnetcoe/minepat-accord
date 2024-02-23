<?php
session_start(); //to ensure you are using same session
	session_unset();
session_destroy();
unset($_SESSION['pass']);
unset($_SESSION['login']);
 header('Location: index.php');  // Mot de passe incorrect

?>
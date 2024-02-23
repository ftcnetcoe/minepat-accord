<?php

require 'db.php';
session_start();

// accès à la BD pour verification des information
// redirection en fonction des informations fournies

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$i = 0; 

if (isset($_POST['password']) && isset($_POST['login'])) {

	$pass = $_POST['password'];
	$pass = md5($pass); // cryptage MD5
	$login = $_POST['login'];

	// $sql = "SELECT id_personnel,DROIT,active,nom,prenom,id_unite FROM rh_personnel WHERE  LOGIN= ? and PASS= ?   ";
	$sql = "SELECT * FROM rh_personnel WHERE  LOGIN= ? and PASS= ?   ";
	$q = $pdo->prepare($sql);
	$q->execute(array($login, $pass));
	$data = $q->fetch(PDO::FETCH_ASSOC);

	// $droit= $data['droit']; //recupère le droit. 
	$idu = $data['id_personnel']; //recupère le droit. 
	$droit = $data['DROIT']; //recupère le droit. 
	$active = $data['active']; //recupère le droit. 
	$nom = $data['nom']; //recupère le nom. 
	$prenom = $data['prenom']; //recupère le prenom. 
	$mail = $data['mail']; //recupère l'email.
	$tel_personnel = $data['tel_personnel']; //recupère le tel_personnel.

	if (!empty($idu) &&  $active != 0) {
		$_SESSION['pass'] = $pass;
		$_SESSION['login'] = $login;
		$_SESSION['idu'] = $idu;
		$_SESSION['droit'] = $droit;
		$_SESSION['droit_pere'] = $droit;
		$_SESSION['nom'] = $nom;
		$_SESSION['prenom'] = $prenom;
		$_SESSION['mail'] = $mail;
		$_SESSION['tel_personnel'] = $tel_personnel;

		$roles = explode("#", $_SESSION['droit_pere']);
		$nbrRoles = count($roles);

		if ($nbrRoles > 1) {
			header('Location: connexion_choix.php');
		} else {
			if ($_SESSION['droit'] == "admin")  header('Location: admin_dashboard.php'); 
			else if ($_SESSION['droit'] == "courrier")  header('Location: courrier_dashboard.php');
			else if ($_SESSION['droit'] == "Ordonateur")  header('Location: ordonateur_dashboard.php');
			else if ($_SESSION['droit'] == "UGAO")  header('Location: Offre_dashboard.php');
			else if ($_SESSION['droit'] == "UGAC")  header('Location: contrat_dashboard.php');
			else if ($_SESSION['droit'] == "UGAD")  header('Location: Decompte_dashboard.php');
			else if ($_SESSION['droit'] == "CSM")  header('Location: CSM_dashboard.php');
			else if ($_SESSION['droit'] == "Archivage")  header('Location: archive_dashboard.php');
			else if ($_SESSION['droit'] == "DPI")  header('Location: ordonateur_dashboard.php');
			else if ($_SESSION['droit'] == "Controleur_Financier")  header('Location: contrat_dashboard.php');
		}

		// Mot de passe incorrect

	} else if (!empty($idu) && $active == 0) { // pas definit : login ou mot de passe incorrect
	sleep(2) ;

		$_SESSION['msg3'] = "activation";
		header('Location:index.php');  // Mot de passe incorrect

	} else { // utilisateur n'existe pas 

		$sql = "SELECT count(*) as nbre FROM rh_personnel WHERE  LOGIN = ? "; 
		$q = $pdo->prepare($sql);
		$q->execute(array($login));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		if ($data['nbre'] >= 1) { // login bon password à verifier
		sleep(2) ;
			$_SESSION['msg3'] = "mdp";
			header('Location: index.php');  // Mot de passe incorrect
		} else { // login incorrect 
			
			//$i++;
			//if ($i == 3) {
			//$q3 = $pdo->prepare('UPDATE rh_personnel SET active = 0 WHERE LOGIN = "?"');
			//$q3->execute([$login]);

			//$data2['active'] = 0;
			//header('Location: index.php');
			//}
			sleep(2) ;
			$_SESSION['msg3'] = "login";
			header('Location: index.php'); // Msg= Login incorrect 
			
			
		}
	}
} else {
sleep(2) ;
	header('Location: index.php');
}
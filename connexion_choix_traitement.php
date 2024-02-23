<?php

session_start(); // ouverture de la session

if ($_POST['roles'] != "" && $_SESSION['droit_pere']) {
    $_SESSION['droit'] = $_POST['roles'];
} else {
    header('Location: index.php');
}

			
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
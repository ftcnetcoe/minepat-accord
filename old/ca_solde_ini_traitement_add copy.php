<?php

session_start(); // ouverture de la session 
include("libraries/autoload.php");

use GroceryCrud\Core\GroceryCrud;

$database = include('database.php');
$config = include('config.php');
$crud = new GroceryCrud($config, $database);
include_once("db.php");
error_reporting(E_ALL);
ini_set("display_errors", 1);

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM ca_comptes ORDER BY CodeCpt ASC";
$comptes = $pdo->query($sql);
if ($comptes === false) {
    die("Erreur");
}

while ($row = $comptes->fetch(PDO::FETCH_ASSOC)) :

    $NumCpt = $row['NumCpt'];
    $CodeCpt = $row['CodeCpt'];
    $initial_debit = 'initial_debit_' . $CodeCpt;
    $initial_credit = 'initial_credit_' . $CodeCpt;

    if (
        isset($_POST[$initial_debit]) &&
        isset($_POST[$initial_credit]) &&
        isset($_POST['annee'])
    ) {
        $initial_debit = $_POST[$initial_debit];
        $initial_credit = $_POST[$initial_credit];
        $annee = $_POST['annee'];

        if (
            $initial_debit != "" &&
            $initial_credit != "" &&
            $annee != ""
        ) {
            $sql = "SELECT COUNT(*) FROM ca_solde_ini WHERE ((NumCpt = '$NumCpt' && CodeCpt = '$CodeCpt' && annee = $annee))";
            $nbrSoldeIni = $pdo->query($sql);
            $nbrSoldeIni = $nbrSoldeIni->fetchColumn();

            if ($nbrSoldeIni == 0) {
                $q1 = $pdo->prepare("INSERT INTO  ca_solde_ini (NumCpt,CodeCpt,initial_debit,initial_credit,annee) VALUES (?, ?, ?, ?, ?)");
                $q1->execute([$row['NumCpt'], $row['CodeCpt'], $initial_debit, $initial_credit, $annee]);
            }
        }
    }
endwhile;

header('Location: ca_solde_ini.php');
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

$yearNow = date('Y');

// Récupérer l'IDPROJ projet'
$sql = "SELECT * FROM gl_projet WHERE (NOMPROJ = 'PROJET FONCTIONNEMENT DIVERS' && YEAR(DTEDEBUT) = $yearNow)";
$IDPROJ = $pdo->query($sql);
$IDPROJ = $IDPROJ->fetchColumn();
if ($IDPROJ === false) {
    die("Erreur : Récupérer l'IDPROJ projet");
}

for ($i = 0; $i < 5; $i++) {
    if (
        isset($_POST['action_' . $i])
    ) {
        if (
            // isset($_POST['LIBELLE_' . $i]) &&
            // isset($_POST['PJ_FACTURE_' . $i]) &&
            // isset($_POST['IDF_' . $i]) &&
            isset($_POST['MNTHT_' . $i]) &&
            // isset($_POST['tva_' . $i]) &&
            isset($_POST['MNTTTC_' . $i]) &&
            isset($_POST['date_achat_' . $i]) &&
            // isset($_POST['date_paiement_' . $i]) &&
            isset($_POST['statut_' . $i])
        ) {
            $NUMERO = $_POST['NUMERO_' . $i];

            $fournisseurs = [
                '0' => 'Camtel',
                '1' => 'CDE',
                '2' => 'Eneo',
                '3' => 'Loyer',
                '4' => 'SIPAU'
            ];
            // Récupérer les fournisseurs
            $sql = "SELECT * FROM FOURNISSEUR_MP WHERE (NOM = '$fournisseurs[$i]')";
            $fournisseur = $pdo->query($sql);
            $row_fournisseur = $fournisseur->fetch(PDO::FETCH_ASSOC);
            if ($row_fournisseur === false) {
                die("Erreur : Récupérer les fournisseurs");
            }
            $LIBELLE = $row_fournisseur['Commentaire'];
            $IDF = $row_fournisseur['IDF'];

            $PJ_FACTURE = '';
            if ($_FILES['PJ_FACTURE_' . $i]['error'] == 0) {
                $extension = pathinfo($_FILES['PJ_FACTURE_' . $i]['name'])['extension'];
                $extensionAutorise = array('php', 'html', 'xml');
                if (!in_array(strtolower($extension), $extensionAutorise)) {
                    if ($_FILES['PJ_FACTURE_' . $i]['size'] <= 10000000) {
                        $nameFile = pathinfo($_FILES['PJ_FACTURE_' . $i]['name'], PATHINFO_FILENAME);
                        $file = 'files/docprojet/' . $nameFile . '.' . $extension;
                        move_uploaded_file($_FILES['PJ_FACTURE_' . $i]['tmp_name'], $file);
                        $PJ_FACTURE = $_FILES['PJ_FACTURE_' . $i]['name'];
                    }
                }
            }

            $MNTHT = $_POST['MNTHT_' . $i];
            $MNTHT = floatval($MNTHT);
            $MNTTVA = 0;
            if (isset($_POST['tva_' . $i])) {
                $MNTTVA = ($MNTHT * 19.25) / 100;
                $MNTTVA = floatval($MNTTVA);
            }
            // $MNTTTC = $MNTHT + $MNTTVA;
            $MNTTTC = $_POST['MNTTTC_' . $i];
            $MNTTTC = floatval($MNTTTC);

            // die($MNTHT . ' - ' . $MNTTVA . ' - ' . $MNTTTC);

            $DATEACHAT = $_POST['date_achat_' . $i];
            $DATE_PAIEMENT = $_POST['date_paiement_' . $i];
            $STATUT = $_POST['statut_' . $i];

            $TYPEOPE = 'fonctionnement';

            $q1 = $pdo->prepare("INSERT INTO  ca_engagement_facture (NUMERO,LIBELLE,MNTTVA,MNTHT,MNTTTC,IDF,DATEACHAT,DATE_PAIEMENT,PJ_FACTURE,STATUT,IDPROJ,TYPEOPE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $q1->execute([$NUMERO, $LIBELLE, $MNTTVA, $MNTHT, $MNTTTC, $IDF, $DATEACHAT, $DATE_PAIEMENT, $PJ_FACTURE, $STATUT, $IDPROJ, $TYPEOPE]);
        }
    }
}

header('Location: gac_achat_fonctionnement.php');
<?php
session_start(); // ouverture de la session 
include("libraries/autoload.php");

use GroceryCrud\Core\GroceryCrud;

$namePage = "gac_facture_courente";
$namePrincipal = 'achat';

$database = include('database.php');
$config = include('config.php');
$crud = new GroceryCrud($config, $database);
include_once("db.php"); //pour les accès direct à la base de données

error_reporting(E_ALL);
ini_set("display_errors", 1);

//var_dump($stateParameters);
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SESSION['droit'] != "RH" && $_SESSION['droit'] != "admin" && $_SESSION['droit'] != "daaf" && $_SESSION['droit'] != "RH") {
    $crud->unsetAdd();
    $crud->unsetDelete();
    $crud->unsetEdit();
}

?>

<?php
// gestion des droits sur l'affichage
if (isset($_SESSION['idu']) && ($_SESSION['droit'] == "admin" || $_SESSION['droit'] == "budget" || $_SESSION['droit'] == "daaf" || $_SESSION['droit'] == "RH")) { // si paramètres correct.  
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>KIAMA SA</title>
        <link rel="icon" type="image/png" href="logo/logo.png" />
        <link rel="apple-touch-icon" type="image/png" href="logo/logo.png" />
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link rel="stylesheet" href="new_assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="new_assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
        <link href="new_assets/assets_dashboard/vendor/header/animsition/animsition.min.css" rel="stylesheet" media="all">
        <link href="new_assets/assets_dashboard/vendor/header/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
        <link href="new_assets/assets_dashboard/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="new_assets/assets_dashboard/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="new_assets/assets_dashboard/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="new_assets/assets_dashboard/css/header/style.css" rel="stylesheet" media="all">
        <link href="new_assets/assets_dashboard/css/style2.css" rel="stylesheet">
    </head>

    <body>
        <?php include 'new_includes/header.php' ?>
        <main id="main" class="main">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action='gac_achat_fonctionnement_traitement_add.php' method='POST' role='form' enctype='multipart/form-data'>
                                <div class="row mt-3 mb-3">
                                    <div class="col-md-8">
                                        <h5 class="card-title">Ajouter des achats de fonctionnement</h5>
                                    </div>
                                </div>
                                <table class="table table-striped nowrap table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="font-size: 13px;">Action</th>
                                            <th scope="col" style="font-size: 13px;">Libelle</th>
                                            <th scope="col" style="font-size: 13px;">NUMERO FAC</th>
                                            <th scope="col" style="font-size: 13px;">Facture (pdf)</th>
                                            <th scope="col" style="font-size: 13px;">Fournisseur</th>
                                            <th scope="col" style="font-size: 13px;">Montant HT</th>
                                            <th scope="col" style="font-size: 13px;">TVA</th>
                                            <th scope="col" style="font-size: 13px;">Montan TTC</th>
                                            <th scope="col" style="font-size: 13px;">Date achat</th>
                                            <th scope="col" style="font-size: 13px;">Date paiement</th>
                                            <th scope="col" style="font-size: 13px;">Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $labelles = [
                                            '0' => 'Fraix postaux et Télécommunication',
                                            '1' => 'Eau',
                                            '2' => 'Energie',
                                            '3' => 'Location Bail',
                                            '4' => 'Materiel de Bureau'
                                        ];
                                        $fournisseurs = [
                                            '0' => 'Camtel',
                                            '1' => 'CDE',
                                            '2' => 'Eneo',
                                            '3' => 'Loyer',
                                            '4' => 'SIPAU'
                                        ];
                                        for ($i = 0; $i < 5; $i++) {
                                        ?>
                                            <tr class="align-middle">
                                                <td class="text-center"><input type="checkbox" name="action_<?php echo $i ?>" id="action_<?php echo $i ?>" class="form-check-input" onclick="change(<?php echo $i ?>)"></td>
                                                <td width="100"><?php echo $labelles[$i] ?></td>
                                                <td width="150"><input type="text" name="NUMERO_<?php echo $i ?>" id="NUMERO_<?php echo $i ?>" value="" class="form-control form-control-sm" disabled="disabled"></td>
                                                <td width="200"><input type="file" name="PJ_FACTURE_<?php echo $i ?>" id="PJ_FACTURE_<?php echo $i ?>" class="form-control form-control-sm" disabled="disabled"></td>
                                                <td><?php echo $fournisseurs[$i] ?></td>
                                                <td width="150"><input type="text" name="MNTHT_<?php echo $i ?>" id="MNTHT_<?php echo $i ?>" step="0.00" value="" class="form-control form-control-sm" disabled="disabled" onkeyup="getMNTHT(<?php echo $i ?>)" onkeypress="verifierCaracteres(event); return false;" required></td>
                                                <td class="text-center"><input type="checkbox" name="tva_<?php echo $i ?>" id="tva_<?php echo $i ?>" class="form-check-input" disabled="disabled" onclick="change_tva(<?php echo $i ?>)"></td>
                                                <td width="150"><input type="text" name="MNTTTC_<?php echo $i ?>" id="MNTTTC_<?php echo $i ?>" step="0.00" value="" class="form-control form-control-sm" disabled="disabled" onkeyup="getMNTTTC(<?php echo $i ?>)" onkeypress="verifierCaracteres(event); return false;" required></td>
                                                <td width="100"><input type="date" name="date_achat_<?php echo $i ?>" id="date_achat_<?php echo $i ?>" value="" class="form-control form-control-sm" disabled="disabled" required></td>
                                                <td width="100"><input type="date" name="date_paiement_<?php echo $i ?>" id="date_paiement_<?php echo $i ?>" value="" class="form-control form-control-sm" disabled="disabled"></td>
                                                <td width="100">
                                                    <select name="statut_<?php echo $i ?>" id="statut_<?php echo $i ?>" class="form-select form-select-sm" disabled="disabled" required>
                                                        <option value="" disabled selected hidden>Select</option>
                                                        <option value="En cours">En cours</option>
                                                        <option value="Paiement Effectif">Paiement Effectif</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="text-end mt-3">
                                    <a href="gac_achat_fonctionnement.php" class="btn btn-secondary">Fermer</a>
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <script>
            var tva = 19.25 / 100;
            for (let i = 0; i < 5; i++) {
                function change(i) {
                    if (document.getElementById('action_' + i).checked === true) {
                        //Active un élément
                        document.getElementById('NUMERO_' + i).disabled = false;
                        document.getElementById('PJ_FACTURE_' + i).disabled = false;
                        document.getElementById('MNTHT_' + i).disabled = false;
                        document.getElementById('tva_' + i).disabled = false;
                        document.getElementById('MNTTTC_' + i).disabled = false;
                        document.getElementById('date_achat_' + i).disabled = false;
                        document.getElementById('date_paiement_' + i).disabled = false;
                        document.getElementById('statut_' + i).disabled = false;
                    } else {
                        // decocher
                        document.getElementById('NUMERO_' + i).disabled = true;
                        document.getElementById('PJ_FACTURE_' + i).disabled = true;
                        document.getElementById('MNTHT_' + i).disabled = true;
                        document.getElementById('tva_' + i).disabled = true;
                        document.getElementById('MNTTTC_' + i).disabled = true;
                        document.getElementById('date_achat_' + i).disabled = true;
                        document.getElementById('date_paiement_' + i).disabled = true;
                        document.getElementById('statut_' + i).disabled = true;
                    }
                }

                function verifierCaracteres(event) {
                    var keyCode = event.which ? event.which : event.keyCode;
                    var touche = String.fromCharCode(keyCode);
                    var champ = document.getElementById('mon_input');
                    var caracteres = '.0123456789';
                    if (caracteres.indexOf(touche) >= 0) {
                        champ.value += touche;
                    }
                }

                // function verif(evt) {
                //     var keyCode = evt.which ? evt.which : evt.keyCode;
                //     var accept = '.0123456789';
                //     if (accept.indexOf(String.fromCharCode(keyCode)) >= 0) {
                //         return true;
                //     } else {
                //         return false;
                //     }
                // }

                function change_tva(i) {
                    if (document.getElementById('tva_' + i).checked === true) {
                        // considerer  la tva
                        var MNTHT = document.getElementById('MNTHT_' + i).value;
                        if (MNTHT != '') {
                            MNTHT = parseFloat(MNTHT);
                            var MNTTVA = MNTHT * (19.25 / 100);
                            var MNTTTC = MNTHT + MNTTVA;
                            MNTTTC = Math.round(MNTTTC * 100) / 100;
                        } else {
                            MNTTTC = '';
                        }
                        document.getElementById('MNTTTC_' + i).value = MNTTTC;
                    } else {
                        // ne pas considerer la tva
                        var MNTHT = document.getElementById('MNTHT_' + i).value;
                        if (MNTHT != '') {
                            MNTHT = parseFloat(MNTHT);
                            var MNTTTC = MNTHT;
                            MNTTTC = Math.round(MNTTTC * 100) / 100;
                        } else {
                            MNTTTC = '';
                        }
                        document.getElementById('MNTTTC_' + i).value = MNTTTC;
                    }
                }

                //GET INPUTS, MULTIPLY AND GET THE ITEM PRICE
                function getMNTHT(i) {
                    // verifier si la tva est appliquer
                    var id_row = 'tva_' + i;
                    if (document.getElementById(id_row).checked === true) {
                        // considerer  la tva
                        var MNTHT = document.getElementById('MNTHT_' + i).value;
                        if (MNTHT != '') {
                            MNTHT = parseFloat(MNTHT);
                            var MNTTVA = MNTHT * (19.25 / 100);
                            var MNTTTC = MNTHT + MNTTVA;
                            MNTTTC = Math.round(MNTTTC * 100) / 100;
                        } else {
                            MNTTTC = '';
                        }
                        document.getElementById('MNTTTC_' + i).value = MNTTTC;
                    } else {
                        // ne pas considerer la tva
                        var MNTHT = document.getElementById('MNTHT_' + i).value;
                        if (MNTHT != '') {
                            MNTHT = parseFloat(MNTHT);
                            var MNTTTC = MNTHT;
                            MNTTTC = Math.round(MNTTTC * 100) / 100;
                        } else {
                            MNTTTC = '';
                        }
                        document.getElementById('MNTTTC_' + i).value = MNTTTC;
                    }
                };

                //-- ceci c'est le montant hors taxe
                function getMNTTTC(i) {
                    // verifier si la tva est appliquer
                    var id_row = 'tva_' + i;
                    if (document.getElementById(id_row).checked === true) {
                        // considerer  la tva
                        var MNTTTC = document.getElementById('MNTTTC_' + i).value;
                        if (MNTTTC != '') {
                            MNTTTC = parseFloat(MNTTTC);
                            var MNTHT = MNTTTC / (1 + (19.25 / 100));
                            MNTHT = Math.round(MNTHT * 100) / 100;
                        } else {
                            MNTHT = '';
                        }
                        document.getElementById('MNTHT_' + i).value = MNTHT;
                    } else {
                        // ne pas considerer la tva
                        var MNTTTC = document.getElementById('MNTTTC_' + i).value;
                        if (MNTTTC != '') {
                            MNTTTC = parseFloat(MNTTTC);
                            var MNTHT = MNTTTC;
                            MNTHT = Math.round(MNTHT * 100) / 100;
                        } else {
                            MNTHT = '';
                        }
                        document.getElementById('MNTHT_' + i).value = MNTHT;
                    }
                };
            }
        </script>

        <?php include_once 'new_includes/footer.php' ?>

        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
        <script src="assets/js/agency.js"></script>
        <script src="assets/js/DataTable---Fully-BSS-Editable.js"></script>
    </body>

    </html>

<?php
} else {
    header('Location: ../index.php');
}
?>
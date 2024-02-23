<?php
session_start(); // ouverture de la session
include("libraries/autoload.php");

use GroceryCrud\Core\GroceryCrud;

// error_reporting(E_ALL);
// ini_set("display_errors", 1);

$namePage = 'personnel_dashboard';

$database = include('database.php');
$config = include('config.php');
$crud = new GroceryCrud($config, $database);
include_once("db.php"); //pour les accès direct à la base de données
?>

<?php
// gestion des droits sur l'affichage
//if (isset($_SESSION['idu']) && ($_SESSION['droit'] == "admin" || $_SESSION['droit'] == "RH"  || $_SESSION['droit'] != "soca")) { // si paramètres correct.
?>

    <?php
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Variables
    $yearNow = date('Y');
    $monthNow = date('m');

    if (isset($_GET['annee']) && !empty($_GET['annee'])) {
        $annee = $_GET['annee'];
    } else {
        $annee =  $yearNow;
    }

    if (isset($_GET['moi']) && !empty($_GET['moi'])) {
        $moi = $_GET['moi'];
    } else {
        $moi =  $monthNow;
    }

    //Mois de l'année
    switch ($moi) {
        case 1:
            $month = 'Janvier';
            break;
        case 2:
            $month = 'Février';
            break;
        case 3:
            $month = 'Mars';
            break;
        case 4:
            $month = 'Avril';
            break;
        case 5:
            $month = 'Mai';
            break;
        case 6:
            $month = 'Juin';
            break;
        case 7:
            $month = 'Juillet';
            break;
        case 8:
            $month = 'Août';
            break;
        case 9:
            $month = 'Septembre';
            break;
        case 10:
            $month = 'Octobre';
            break;
        case 11:
            $month = 'Novembre';
            break;
        case 12:
            $month = 'Décembre';
            break;
    }

    $id = $_SESSION['idu'];
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];
    $mail = $_SESSION['mail'];
    $telephone = $_SESSION['tel_personnel'];
    $date_naiss = $_SESSION['date_naiss'];
    $sexe = $_SESSION['sexe'];
    $type_contrat = $_SESSION['type_contrat'];
    $date_debut = $_SESSION['date_debut'];
    $date_fin = $_SESSION['date_fin'];
    $id_poste = $_SESSION['id_poste'];
    $sql = "SELECT nom_poste,statut FROM `rh_poste` WHERE id_poste = $id_poste";
    $poste = $pdo->query($sql);
    $poste = $poste->fetchColumn();
    $unite = $_SESSION['unite'];

    //Récupérer le cumul de retards matinal et retard pause
    $sql = "SELECT SUM(retard) FROM `rh_discipline_journaliere` WHERE (MONTH(date_eva) = $moi && YEAR(date_eva) = $annee  && personnel = $id)";
    $nbrCumulRetardsMinutes = $pdo->query($sql);
    $nbrCumulRetardsMinutes = $nbrCumulRetardsMinutes->fetchColumn();
    if (!$nbrCumulRetardsMinutes) {
        $nbrCumulRetardsMinutes = 0;
    }
    $nbrCumulRetardsHeures = round(($nbrCumulRetardsMinutes / 60), 2); //Convertire en heures

    //Récupérer le cumul jours d'absences
    $sql = "SELECT SUM(absence) FROM `rh_discipline_hebdo` WHERE (MONTH(date) = $moi && YEAR(date) = $annee && personel = $id)";
    $nbrCumulAbsences = $pdo->query($sql);
    $nbrCumulAbsences = $nbrCumulAbsences->fetchColumn();
    if (!$nbrCumulAbsences) {
        $nbrCumulAbsences = 0;
    }

    //Récupérer le cumul jours d'absences justifiées
    $sql = "SELECT SUM(absence_justifier) FROM `rh_discipline_hebdo` WHERE (MONTH(date) = $moi && YEAR(date) = $annee && personel = $id)";
    $nbrCumulAbsenceJustifier = $pdo->query($sql);
    $nbrCumulAbsenceJustifier = $nbrCumulAbsenceJustifier->fetchColumn();
    if (!$nbrCumulAbsenceJustifier) {
        $nbrCumulAbsenceJustifier = 0;
    }

    //Récupérer le cumul des Avertissements
    $sql = "SELECT COUNT(id_sanction) as NBRES FROM rh_sanction WHERE (MONTH(date_sanction) = $moi && YEAR(date_sanction) = $annee && type_sanction = 'Avertissement' && destinataire = $id)";
    $nbrCumulAvertissements = $pdo->query($sql);
    $nbrCumulAvertissements = $nbrCumulAvertissements->fetchColumn();
    if (!$nbrCumulAvertissements) {
        $nbrCumulAvertissements = 0;
    }

    //Récupérer le cumul des Blâmes
    $sql = "SELECT COUNT(id_sanction) as NBRES FROM rh_sanction WHERE (MONTH(date_sanction) = $moi && YEAR(date_sanction) = $annee && type_sanction = 'Blâme' && destinataire = $id)";
    $nbrCumulBlames = $pdo->query($sql);
    $nbrCumulBlames = $nbrCumulBlames->fetchColumn();
    if (!$nbrCumulBlames) {
        $nbrCumulBlames = 0;
    }

    //Récupérer le cumul des Demandes d'explications
    $sql = "SELECT COUNT(id_sanction) as NBRES FROM rh_sanction WHERE (MONTH(date_sanction) = $moi && YEAR(date_sanction) = $annee && type_sanction = 'Demande d\'explication' && destinataire = $id)";
    $nbrCumulDemandesExplications = $pdo->query($sql);
    $nbrCumulDemandesExplications = $nbrCumulDemandesExplications->fetchColumn();
    if (!$nbrCumulDemandesExplications) {
        $nbrCumulDemandesExplications = 0;
    }

    //Récupérer le cumul des Mises à pied
    $sql = "SELECT COUNT(id_sanction) as NBRES FROM rh_sanction WHERE (MONTH(date_sanction) = $moi && YEAR(date_sanction) = $annee && type_sanction = 'Mise à pied' && destinataire = $id)";
    $nbrCumulMisesAPied = $pdo->query($sql);
    $nbrCumulMisesAPied = $nbrCumulMisesAPied->fetchColumn();
    if (!$nbrCumulMisesAPied) {
        $nbrCumulMisesAPied = 0;
    }

    //Récupérer le cumul des Lettres
    $sql = "SELECT COUNT(id_sanction) as NBRES FROM rh_sanction WHERE (MONTH(date_sanction) = $moi && YEAR(date_sanction) = $annee && type_sanction = 'Lettre' && destinataire = $id)";
    $nbrCumulLettres = $pdo->query($sql);
    $nbrCumulLettres = $nbrCumulLettres->fetchColumn();
    if (!$nbrCumulLettres) {
        $nbrCumulLettres = 0;
    }

    //Récupérer le cumul des heures supp
    $sql = "SELECT SUM(heure_sup) FROM `rh_discipline_hebdo` WHERE (MONTH(date) = $moi && YEAR(date) = $annee && personel = $id)";
    $nbrCumulHeuresSupp = $pdo->query($sql);
    $nbrCumulHeuresSupp = $nbrCumulHeuresSupp->fetchColumn();
    if (!$nbrCumulHeuresSupp) {
        $nbrCumulHeuresSupp = 0;
    }
    $nbrCumulHeuresSuppHeures = round(($nbrCumulHeuresSupp / 60), 2); //Convertire en heures

    // Récupérer le cumul des perfomance evaluation hebdomadaire mensuelle (S+)
    $sql = "SELECT COUNT(discipline_hebdo) as NBRES FROM rh_discipline_hebdo WHERE (MONTH(date) = $moi && YEAR(date) = $annee && note = 'S+' && personel = $id)";
    $nbrCumulNombreS = $pdo->query($sql);
    $nbrCumulNombreS = $nbrCumulNombreS->fetchColumn();
    if (!$nbrCumulNombreS) {
        $nbrCumulNombreS = 0;
    }

    // Récupérer le cumul des perfomance evaluation hebdomadaire mensuelle (E+)
    $sql = "SELECT COUNT(discipline_hebdo) as NBRES FROM rh_discipline_hebdo WHERE (MONTH(date) = $moi && YEAR(date) = $annee && note = 'E+' && personel = $id)";
    $nbrCumulNombreE = $pdo->query($sql);
    $nbrCumulNombreE = $nbrCumulNombreE->fetchColumn();
    if (!$nbrCumulNombreE) {
        $nbrCumulNombreE = 0;
    }

    // Récupérer le cumul des perfomance evaluation hebdomadaire mensuelle (F+)
    $sql = "SELECT COUNT(discipline_hebdo) as NBRES FROM rh_discipline_hebdo WHERE (MONTH(date) = $moi && YEAR(date) = $annee && note = 'B+' && personel = $id)";
    $nbrCumulNombreB = $pdo->query($sql);
    $nbrCumulNombreB = $nbrCumulNombreB->fetchColumn();
    if (!$nbrCumulNombreB) {
        $nbrCumulNombreB = 0;
    }

    // Récupérer les reunions
    $sql = "SELECT * FROM rh_programmer_reunion WHERE (MONTH(date_reunion) = $moi && YEAR(date_reunion) = $annee)";
    $reunions = $pdo->query($sql);
    if ($reunions === false) {
        die("Erreur : Récupérer les reunions");
    }

    // Récupérer les Recommandations
    $sql = "SELECT * FROM rh_suivi_realisation WHERE (MONTH(date_limite) = $moi && YEAR(date_limite) = $annee && responsable = $id)";
    $realisations = $pdo->query($sql);
    if ($realisations === false) {
        die("Erreur : Récupérer les Recommandations");
    }

    ?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <!-- ======= Meta ======= -->
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <!-- ======= Title ======= -->
        <title>Dashboard - Dicipline | KIAMA 360</title>

        <!-- ======= Favicons ======= -->
        <link href="new_assets/assets_dashboard/img/favicon.png" rel="icon">
        <link href="new_assets/assets_dashboard/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- ======= Google Fonts ======= -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- ======= Vendor CSS Files Header ======= -->
        <link href="new_assets/assets_dashboard/vendor/header/animsition/animsition.min.css" rel="stylesheet" media="all">
        <link href="new_assets/assets_dashboard/vendor/header/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">

        <!-- ======= Vendor CSS Files ======= -->
        <link href="new_assets/assets_dashboard/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="new_assets/assets_dashboard/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="new_assets/assets_dashboard/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="new_assets/assets_dashboard/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="new_assets/assets_dashboard/vendor/simple-datatables/style.css" rel="stylesheet">

        <!-- ======= Template Main CSS File Header ======= -->
        <link href="new_assets/assets_dashboard/css/header/style.css" rel="stylesheet" media="all">

        <!-- ======= Template Main CSS File ======= -->
        <link href="new_assets/assets_dashboard/css/style2.css" rel="stylesheet">
    </head>

    <body>
        <?php include 'new_includes/header.php' ?>

        <main id="main" class="main">

            <div class="card recent-sales">
                <h1 class="card-title text-center fw-bold">PERSONNEL DE KIAMA S.A : <?php echo ($month . ' ' . $annee); ?></h1>
                <div class="text-center mb-2">
                    <button type="button" class="btn btn-info" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" data-bs-toggle="modal" data-bs-target="#basicModal">
                        Filtrer
                    </button>
                </div>
            </div>

            <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Filtrer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="personnel_dashboard.php" method="GET">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="moi" class="form-label">moi</label>
                                        <select class="form-select" aria-label="Default select example" name="moi">
                                            <option value="01" selected>Janvier</option>
                                            <option value="02">Février</option>
                                            <option value="03">Mars</option>
                                            <option value="04">Avril</option>
                                            <option value="05">Mai</option>
                                            <option value="06">Juin</option>
                                            <option value="07">Juillet</option>
                                            <option value="08">Août</option>
                                            <option value="09">Septembre</option>
                                            <option value="10">Octobre</option>
                                            <option value="11">Novembre</option>
                                            <option value="12">Décembre</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="annee" class="form-label">Année</label>
                                        <select class="form-select" aria-label="Default select example" name="annee">
                                            <option value="<?php echo $yearNow; ?>" selected><?php echo $yearNow; ?></option>
                                            <?php for ($l = 1; $l < 5; $l++) {
                                                $an = $yearNow - $l; ?>
                                                <?php echo $an; ?>
                                                <option value="<?php echo $an; ?>"><?php echo $an; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary">Filtrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <section class="section profile">
                <div class="row">
                    <div class="col-xl-3">

                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                                <img src="new_assets/assets_dashboard/img/avatar.png" alt="Profile" class="rounded-circle">
                                <h2>
                                    <?php echo $nom . ' ' . $prenom; ?>
                                </h2>
                                <h3>
                                    <?php echo $poste; ?>
                                </h3>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-9">
                        <div class="card">
                            <div class="card-body pt-3">

                                <ul class="nav nav-tabs nav-tabs-bordered">
                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-profil">Profil</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-discipline">Discipline</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-performance">Performance</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-reunion">Réunion</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-recommandation">Recommandation</button>
                                    </li>
                                </ul>

                                <div class="tab-content pt-2">

                                    <div class="tab-pane fade show active profile-overview" id="profile-profil">
                                        <h5 class="card-title">Détails du profil</h5>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Nom et prénom</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $nom . ' ' . $prenom; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">E-mail</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $mail; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Téléphone</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $telephone; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Date de naissance</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $date_naiss; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Sexe</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $sexe; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Type de contrat</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $type_contrat; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Date de début</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $date_debut; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Date de fin</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $date_fin; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Poste</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $poste; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Département</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $unite; ?></div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade show profile-overview" id="profile-discipline">
                                        <h5 class="card-title">Détails de la discipline</h5>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Rétards</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $nbrCumulRetardsHeures; ?> hrs (<?php echo $nbrCumulRetardsMinutes; ?> mins)</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Absences</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $nbrCumulAbsences; ?> jrs</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Absences justifiées</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $nbrCumulAbsenceJustifier; ?> jrs</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Avertissements</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $nbrCumulAvertissements; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Blame</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $nbrCumulBlames; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Demande d'explication</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $nbrCumulDemandesExplications; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Mise a pied</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $nbrCumulMisesAPied; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Lettre</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $nbrCumulLettres; ?></div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade show profile-overview" id="profile-performance">
                                        <h5 class="card-title">Détails de la performance</h5>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Heures sup</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $nbrCumulHeuresSuppHeures; ?> hrs (<?php echo $nbrCumulHeuresSupp; ?> mins)</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Performance S+</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $nbrCumulNombreS; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Performance E+</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $nbrCumulNombreE; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Performance B+</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $nbrCumulNombreB; ?></div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade show profile-overview" id="profile-reunion">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Détails des réunions</h5>
                                                <table class="table table-striped nowrap table-hover datatable">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">N<sup>o</sup></th>
                                                            <th scope="col">Nom seance</th>
                                                            <th scope="col">Executé ?</th>
                                                            <th scope="col">Presence</th>
                                                            <th scope="col">Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $compteur_reunion = 0;
                                                        while ($row = $reunions->fetch(PDO::FETCH_ASSOC)) :
                                                            $id_reunion = htmlspecialchars($row['id_reunion']);
                                                            // Verifier s'il est convoquer et reuperer la reunion
                                                            $sql = "SELECT COUNT(*) FROM rh_liaison_convoquer WHERE (id_personnel = $id && id_reunion = $id_reunion)";
                                                            $isConvoquer = $pdo->query($sql);
                                                            $isConvoquer = $isConvoquer->fetchColumn();
                                                            if ($isConvoquer != 0) {
                                                                $nom_seance = htmlspecialchars($row['nom_seance']);
                                                                $date_reunion = htmlspecialchars($row['date_reunion']);
                                                                // Verifier si la reunion a ete executer
                                                                $sql = "SELECT * FROM rh_execution_reunion WHERE (id_reunion = $id_reunion)";
                                                                $reunion_executer = $pdo->query($sql);
                                                                $row_executer = $reunion_executer->fetch(PDO::FETCH_ASSOC);
                                                                if ($row_executer === false) {
                                                                    $isExecuter = 'NON';
                                                                } else {
                                                                    $isExecuter = 'OUI';
                                                                    $id_exe_reu = $row_executer['id_exe_reu'];
                                                                    // Verifier s'il est present
                                                                    $sql = "SELECT COUNT(*) FROM rh_liaison_absente WHERE (idpersonnel = $id && id_exe_reu = $id_exe_reu)";
                                                                    $present = $pdo->query($sql);
                                                                    $present = $present->fetchColumn();
                                                                    if ($present != 0) {
                                                                        $isPresent = 'NON';
                                                                    } else {
                                                                        $isPresent = 'OUI';
                                                                    }
                                                                }
                                                                $compteur_reunion += 1;
                                                        ?>
                                                                <tr>
                                                                    <th scope="row">#<?php echo $compteur_reunion; ?></th>
                                                                    <td><?php echo $nom_seance; ?></td>
                                                                    <td><?php echo $isExecuter; ?></td>
                                                                    <td>
                                                                        <?php
                                                                        if ($isExecuter == 'OUI') {
                                                                            echo $isPresent;
                                                                        } else {
                                                                            echo '...';
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td><?php echo $date_reunion; ?></td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        endwhile;
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade show profile-overview" id="profile-recommandation">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Détails des recommandations</h5>
                                                <table class="table nowrap table-hover datatable">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">N<sup>o</sup></th>
                                                            <th scope="col">Libelele realisation</th>
                                                            <!-- <th scope="col">Executé ?</th> -->
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Date limite</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $compteur_realisations = 0;
                                                        while ($row = $realisations->fetch(PDO::FETCH_ASSOC)) :
                                                            $libelele_realisation = htmlspecialchars($row['libelele_realisation']);
                                                            $date_limite = htmlspecialchars($row['date_limite']);
                                                            $status = htmlspecialchars($row['realise']);
                                                            $id_reunion2 = htmlspecialchars($row['nom_reunion']);
                                                            $compteur_realisations += 1;
                                                        ?>
                                                            <tr class="<?php if ($status == 'En Cours') {
                                                                            echo 'table-warning';
                                                                        } elseif ($status == 'NON') {
                                                                            echo 'table-danger';
                                                                        } elseif ($status == 'OUI') {
                                                                            echo 'table-success';
                                                                        }
                                                                        ?>">
                                                                <th scope="row">#<?php echo $compteur_realisations; ?></th>
                                                                <td><?php echo $libelele_realisation; ?></td>
                                                                <!-- <td><?php //echo $id_reunion2; 
                                                                            ?></td> -->
                                                                <td><?php echo $status; ?></td>
                                                                <td><?php echo $date_limite; ?></td>
                                                            </tr>
                                                        <?php
                                                        endwhile;
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php include 'new_includes/footer.php' ?>

    </body>

    </html>

<?php/*
} else {
    header('Location: index.php');
}*/
?>
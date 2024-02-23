<?php
session_start(); // ouverture de la session 
include("libraries/autoload.php");

use GroceryCrud\Core\GroceryCrud;

$namePage = 'rh_discipline_mensuelle';
$namePrincipalAd = 'discipline';

$database = include('database.php');
$config = include('config.php');
$crud = new GroceryCrud($config, $database);
include_once("db.php"); //pour les accès direct à la base de données


error_reporting(E_ALL);
ini_set("display_errors", 1);

$crud->setTable('rh_discipline_mensuelle'); //definition de la table
$crud->setSubject('Evaluation', 'Discipline et Evaluation Mensuel');

//mise en relation des tables pour la selection du poste et des departements
$crud->setRelation('personnel', 'rh_personnel', '{nom} {prenom}');
//$crud->setDependentRelation('id_poste','id_unite','id_poste');

//definition de l'afichage des champs de la table
$crud->displayAs(array(
    'personnel' => "Personnel ",
    'mois' => 'Mois a Evalué',
    'annee' => 'Année a Evalué',
    'discipline_transmission' => 'Discipline sur la transmission',
    'solution' => "Solution des Commentaires",
    'commentaire_evaluateur' => "Commentaire de l'Evaluateur",
    'fiche_realisation' => "Fiche de synthese Mensuelle",
    'besion_formation' => 'Besion En Formation',
));

//$crud->requiredFields(['personnel']);
$crud->unsetColumns(['poste', 'unite']);

$crud->callbackColumn('fiche_realisation', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->fiche_realisation) != 0) {
        return '<div class="myGallery">
   <a href="/files/docprojet/' . $row->fiche_realisation . '" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
  ​<span>' . $row->fiche_realisation . '</span>
</div>';
    }
});

$crud->defaultOrdering('personnel', 'ASC');

if ($_SESSION['droit'] != "RH" && $_SESSION['droit'] != "admin") {
    
    $crud->unsetEdit();
}
$crud->unsetAdd();
$crud->unsetDelete();
$crud->unsetDeleteMultiple();


$uploadValidations = [
    'maxUploadSize' => '20M', // 20 Mega Bytes
    'minUploadSize' => '1K', // 1 Kilo Byte
    'allowedFileTypes' => [
        'pdf,PDF,doc,Docx'
    ]
];

$crud->setFieldUpload(
    'fiche_realisation',
    'files/docprojet',
    '/files/docprojet',
    $uploadValidations
);


$output = $crud->render();

if ($output->isJSONResponse) {

    header('Content-Type: application/json; charset=utf-8');
    echo $output->output;
    exit;
}

$css_files = $output->css_files;
$js_files = $output->js_files;
$output = $output->output;


?>

<?php

// gestion des droits sur l'affichage
if (isset($_SESSION['idu']) && ($_SESSION['droit'] == "admin" || $_SESSION['droit'] == "RH" || $_SESSION['droit'] == "soca")) { // si paramètres correct. 
?>

    <!DOCTYPE html>
    <html>

    <head>
        <!-- ======= Meta ======= -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <!-- ======= Title ======= -->
        <title>Evaluation Mensuelle | KIAMA 360</title>

        <!-- ======= Favicons ======= -->
        <link rel="icon" type="image/png" href="logo/logo.png" />
        <link rel="apple-touch-icon" type="image/png" href="logo/logo.png" />

        <!-- ======= Google Fonts ======= -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- ======= Vendor CSS Files ======= -->
        <link rel="stylesheet" href="new_assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="new_assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">

        <!-- ======= Vendor CSS Files Header ======= -->
        <link href="new_assets/assets_dashboard/vendor/header/animsition/animsition.min.css" rel="stylesheet" media="all">
        <link href="new_assets/assets_dashboard/vendor/header/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">

        <!-- ======= Vendor CSS Files Dashboard ======= -->
        <link href="new_assets/assets_dashboard/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="new_assets/assets_dashboard/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="new_assets/assets_dashboard/vendor/remixicon/remixicon.css" rel="stylesheet">

        <!-- ======= Template Main CSS File ======= -->
        <?php
        foreach ($css_files as $file) : ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>

        <!-- ======= Template Main CSS File Header ======= -->
        <link href="new_assets/assets_dashboard/css/header/style.css" rel="stylesheet" media="all">

        <!-- ======= Template Main CSS File Dashboard ======= -->
        <link href="new_assets/assets_dashboard/css/style2.css" rel="stylesheet">

    </head>

    <body>
        <?php include 'new_includes/header.php' ?>
        <main id="main" class="main">
            <!-- Button Add -->
            <a href="rh_discipline_mensuelle_add.php" class="btn btn-default"><i class="bi bi-plus fw-bold h5"></i> Ajouter Evaluation</a>
            <div class="mt-3">
                <!-- CRUD-->
                <?php echo $output; ?>
            </div>
        </main>

        <?php include_once 'new_includes/footer.php' ?>

        <script src="new_assets/bootstrap/js/bootstrap.min.js"></script>
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
        <script src="new_assets/js/agency.js"></script>
        <script src="new_assets/js/DataTable---Fully-BSS-Editable.js"></script>

        <?php foreach ($js_files as $file) : ?>
            <script src="<?php /* affichage des resultat*/ echo $file; ?>"></script>
        <?php endforeach; ?>

    </body>

    </html>
<?php
} else {
    header('Location: index.php');
}
?>
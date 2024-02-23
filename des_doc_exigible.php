<?php
session_start(); // ouverture de la session 
include("libraries/autoload.php");
use GroceryCrud\Core\GroceryCrud;

$database = include('database.php');
$config = include('config.php');
$crud = new GroceryCrud($config, $database);
include_once("db.php"); //pour les accès direct à la base de données

$namePage= "off_eval";
$namePrincipalAd = 'Offre';



$nom_module = '';
$IDDmdePD;
$idplani = '';

if (!empty($_GET['IDDecpte'])){
    $IDDecpte= $_GET['IDDecpte'];
    
} 
else  header('Location: ../index.php' );



$crud->setTable('des_doc_exige'); //definition de la table
$crud->setSubject('Document', 'Gestion des Documents Exigible');



//definition de l'afichage des champs de la table
$crud->displayAs(array( 
		'PJ_contratSigne' => 'Contrat Signé',
		'PJ_QuittancePD' => "Original de la Quitance d'enregistrement",
                'PJ_BE_BC' => "Bon d'engaement/ Bon de Commande",     
                'PJ_CertificatEngag' => "Certificat d'engagement",  
                'PJ_Avis_Impos' => 'Avis Imposition',
		'PJ_DcpteProv' => 'Décompte Provisoire Timbré',
                'PJ_PV' => "Procés-Verbal de Constat",     
                'PJ_Attach' => "Attachements Signés",
                'PJ_TittreCreance' => 'Titre de Créance',
		'PJ_Attestation_Imat' => "Attestation d'immatriculation",
                'PJ_AttestaDomBq' => "Attestation de Domiciliation",     
                'PJ_AttestNRF' => "Attestation de Non Redevance",
                'PJ_OrdonnancePaie' => "Ordonance de Paiement",     
                'PJ_Cert_Garantie' => "Certificat de Garantie",          	
		)); 

		
		
$crud->columns (['PJ_contratSigne','PJ_QuittancePD', 'PJ_BE_BC','PJ_CertificatEngag','PJ_Avis_Impos','PJ_DcpteProv', 'PJ_PV','PJ_Attach','PJ_TittreCreance','PJ_Attestation_Imat','PJ_AttestaDomBq','PJ_AttestNRF','PJ_OrdonnancePaie','PJ_Cert_Garantie']);
$crud->editFields (['PJ_contratSigne','PJ_QuittancePD', 'PJ_BE_BC','PJ_CertificatEngag','PJ_Avis_Impos','PJ_DcpteProv','PJ_PV','PJ_Attach','PJ_TittreCreance', 'PJ_Attestation_Imat','PJ_AttestaDomBq','PJ_AttestNRF','PJ_OrdonnancePaie','PJ_Cert_Garantie']);
$crud->addFields (['PJ_contratSigne','PJ_QuittancePD', 'PJ_BE_BC','PJ_CertificatEngag','PJ_Avis_Impos','PJ_DcpteProv','PJ_PV','PJ_Attach','PJ_TittreCreance', 'PJ_Attestation_Imat','PJ_AttestaDomBq','PJ_AttestNRF','PJ_OrdonnancePaie','PJ_Cert_Garantie']);

$crud->where([
        '(IDDecpte = '.$IDDecpte.' AND des_doc_exige.is_delete = 1)'
]);
$crud->callbackColumn('PJ_contratSigne', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->PJ_contratSigne) != 0) { return '<div class="myGallery">
    <a href="/files/docprojet/'.$row->PJ_contratSigne.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
    ​<span>'.$row->PJ_contratSigne.'</span>
    </div>';}
           
});
$crud->callbackColumn('PJ_QuittancePD', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->PJ_QuittancePD) != 0) { return '<div class="myGallery">
    <a href="/files/docprojet/'.$row->PJ_QuittancePD.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
    ​<span>'.$row->PJ_QuittancePD.'</span>
    </div>';}
           
});
$crud->callbackColumn('PJ_BE_BC', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->PJ_BE_BC) != 0) { return '<div class="myGallery">
    <a href="/files/docprojet/'.$row->PJ_BE_BC.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
    ​<span>'.$row->PJ_BE_BC.'</span>
    </div>';}
           
});
$crud->callbackColumn('PJ_CertificatEngag', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->PJ_CertificatEngag) != 0) { return '<div class="myGallery">
    <a href="/files/docprojet/'.$row->PJ_CertificatEngag.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
    ​<span>'.$row->PJ_CertificatEngag.'</span>
    </div>';}
           
});
$crud->callbackColumn('PJ_Avis_Impos', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->PJ_Avis_Impos) != 0) { return '<div class="myGallery">
    <a href="/files/docprojet/'.$row->PJ_Avis_Impos.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
    ​<span>'.$row->PJ_Avis_Impos.'</span>
    </div>';}
           
});
$crud->callbackColumn('PJ_DcpteProv', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->PJ_DcpteProv) != 0) { return '<div class="myGallery">
    <a href="/files/docprojet/'.$row->PJ_DcpteProv.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
    ​<span>'.$row->PJ_DcpteProv.'</span>
    </div>';}
           
});
$crud->callbackColumn('PJ_note_paiement', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->PJ_note_paiement) != 0) { return '<div class="myGallery">
    <a href="/files/docprojet/'.$row->PJ_note_paiement.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
    ​<span>'.$row->PJ_note_paiement.'</span>
    </div>';}
           
});
$crud->callbackColumn('PJ_PV', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->PJ_PV) != 0) { return '<div class="myGallery">
    <a href="/files/docprojet/'.$row->PJ_PV.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
    ​<span>'.$row->PJ_PV.'</span>
    </div>';}
           
});
$crud->callbackColumn('PJ_Attach', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->PJ_Attach) != 0) { return '<div class="myGallery">
    <a href="/files/docprojet/'.$row->PJ_Attach.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
    ​<span>'.$row->PJ_Attach.'</span>
    </div>';}
           
});
$crud->callbackColumn('PJ_TittreCreance', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->PJ_TittreCreance) != 0) { return '<div class="myGallery">
    <a href="/files/docprojet/'.$row->PJ_TittreCreance.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
    ​<span>'.$row->PJ_TittreCreance.'</span>
    </div>';}
           
});
$crud->callbackColumn('PJ_Attestation_Imat', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->PJ_Attestation_Imat) != 0) { return '<div class="myGallery">
    <a href="/files/docprojet/'.$row->PJ_Attestation_Imat.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
    ​<span>'.$row->PJ_Attestation_Imat.'</span>
    </div>';}
           
});
$crud->callbackColumn('PJ_AttestaDomBq', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->PJ_AttestaDomBq) != 0) { return '<div class="myGallery">
    <a href="/files/docprojet/'.$row->PJ_AttestaDomBq.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
    ​<span>'.$row->PJ_AttestaDomBq.'</span>
    </div>';}
           
});
$crud->callbackColumn('PJ_AttestNRF', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->PJ_AttestNRF) != 0) { return '<div class="myGallery">
    <a href="/files/docprojet/'.$row->PJ_AttestNRF.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
    ​<span>'.$row->PJ_AttestNRF.'</span>
    </div>';}
           
});
$crud->callbackColumn('PJ_OrdonnancePaie', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->PJ_OrdonnancePaie) != 0) { return '<div class="myGallery">
    <a href="/files/docprojet/'.$row->PJ_OrdonnancePaie.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
    ​<span>'.$row->PJ_OrdonnancePaie.'</span>
    </div>';}
           
});
$crud->callbackColumn('PJ_Cert_Garantie', function ($value, $row) {
    //return "<div style='text-align : left;'>". wordwrap($row->besoin_marche, 50, "<br>", true)."</div>"; 
    if (strlen($row->PJ_Cert_Garantie) != 0) { return '<div class="myGallery">
    <a href="/files/docprojet/'.$row->PJ_Cert_Garantie.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;
    ​<span>'.$row->PJ_Cert_Garantie.'</span>
    </div>';}
           
});

$crud->callbackDelete(function ($stateParameters) {

    $id = $stateParameters->primaryKeyValue;
    $modele = 46;
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $delete = $pdo->prepare('Update des_doc_exige SET is_delete = 0 WHERE IDDocExigible = ?');
    $delete->execute([$id]);
    
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $debit = $pdo->prepare('INSERT INTO logs (id_action, id_user, date_action, id_element) VALUES (?,?,?,?)');
    $debit->execute([$modele , $_SESSION['idu'] , $dateact, $id]);
    return $stateParameters;
});

$crud->callbackBeforeInsert(function ($stateParameters){
    $IDDecpte= $_GET['IDDecpte'];
    $dateact = date("Y-m-d H:i:s");
    
    $stateParameters->data['IDDecpte']=  $IDDecpte;
    $stateParameters->data['date_creation']=  $dateact;
    $stateParameters->data['id_creation']=  $_SESSION['idu'];
    return $stateParameters;

});
//recuperation du poste superieur apres mise a jour

$crud->callbackBeforeUpdate(function ($stateParameters){
    
    
    $dateact = date("Y-m-d H:i:s");
    
    $stateParameters->data['date_update']=  $dateact;
    $stateParameters->data['id_update']=  $_SESSION['idu'];
        
   
    return $stateParameters;
});
$crud->callbackAfterInsert(function ($stateParameters) {
    $dateact = date("Y-m-d H:i:s");
    $modele = 47;
    $id = $stateParameters->insertId;
    
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $debit = $pdo->prepare('INSERT INTO logs (id_action, id_user, date_action, id_element) VALUES (?,?,?,?)');
    $debit->execute([$modele , $_SESSION['idu'] , $dateact, $id]);

    return $stateParameters;
});

$crud->callbackAfterUpdate(function ($stateParameters){
    $dateact = date("Y-m-d H:i:s");
    $modele = 48;
    $id = $stateParameters->primaryKeyValue;
    
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $debit = $pdo->prepare('INSERT INTO logs (id_action, id_user, date_action, id_element) VALUES (?,?,?,?)');
    $debit->execute([$modele , $_SESSION['idu'] , $dateact, $id]);
    
    
    return $stateParameters;
});




$crud->defaultOrdering('IDDecpte', 'ASC');

if ($_SESSION['droit']!= "admin" && $_SESSION['droit']!= "UGAD"){
   
    $crud->unsetEdit();
    $crud->unsetAdd(); 
    $crud->unsetDelete();
    
}
    
    $crud->unsetDeleteMultiple();

$uploadValidations = [
    'maxUploadSize' => '20M', // 20 Mega Bytes
    'minUploadSize' => '1K', // 1 Kilo Byte
    'allowedFileTypes' => [
        'pdf,PDF,doc,Docx,ZIP,zip,ISO,iso'
    ]
];  
$crud->setFieldUpload(
    'PJ_contratSigne', 
    'files/docprojet', 
    '/files/docprojet', 
    $uploadValidations
); 
$crud->setFieldUpload(
    'PJ_QuittancePD', 
    'files/docprojet', 
    '/files/docprojet', 
    $uploadValidations
); 
$crud->setFieldUpload(
    'PJ_BE_BC', 
    'files/docprojet', 
    '/files/docprojet', 
    $uploadValidations
); 
$crud->setFieldUpload(
    'PJ_CertificatEngag', 
    'files/docprojet', 
    '/files/docprojet', 
    $uploadValidations
); 
$crud->setFieldUpload(
    'PJ_Avis_Impos', 
    'files/docprojet', 
    '/files/docprojet', 
    $uploadValidations
); 
$crud->setFieldUpload(
    'PJ_DcpteProv', 
    'files/docprojet', 
    '/files/docprojet', 
    $uploadValidations
); 
$crud->setFieldUpload(
    'PJ_PV', 
    'files/docprojet', 
    '/files/docprojet', 
    $uploadValidations
); 
$crud->setFieldUpload(
    'PJ_Attach', 
    'files/docprojet', 
    '/files/docprojet', 
    $uploadValidations
); 
$crud->setFieldUpload(
    'PJ_TittreCreance', 
    'files/docprojet', 
    '/files/docprojet', 
    $uploadValidations
); 
$crud->setFieldUpload(
    'PJ_Attestation_Imat', 
    'files/docprojet', 
    '/files/docprojet', 
    $uploadValidations
); 
$crud->setFieldUpload(
    'PJ_AttestaDomBq', 
    'files/docprojet', 
    '/files/docprojet', 
    $uploadValidations
); 
$crud->setFieldUpload(
    'PJ_AttestNRF', 
    'files/docprojet', 
    '/files/docprojet', 
    $uploadValidations
); 
$crud->setFieldUpload(
    'PJ_OrdonnancePaie', 
    'files/docprojet', 
    '/files/docprojet', 
    $uploadValidations
); 
$crud->setFieldUpload(
    'PJ_Cert_Garantie', 
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
if (isset($_SESSION['idu'])&& ( $_SESSION['droit']== "admin" || $_SESSION['droit'] == "UGAD")){ // si paramètres correct. 
?>

<html>

<head>
	
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        
        
        <title> Offres- MINEPAT </title>

       
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

       
        <?php
        foreach($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>

        
        <link href="new_assets/assets_dashboard/css/header/style.css" rel="stylesheet" media="all">

        
        <!-- ======= Template Main CSS File Dashboard ======= -->
                
       <link href="new_assets/assets_dashboard/css/style2.css" rel="stylesheet">
      
</head>
<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="54">

    
    	 
        <main id="main" class="main">
            
        <div class="mt-3">
                <!-- CRUD-->
                <?php echo $output; ?>
            </div>
        </main>

	<!-- ======= Debut Footer ======= -->
        <?php include_once 'new_includes/footer.php'?>
        <!-- ======= Fin Footer ======= -->
          
    
    
    
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
	
	<?php foreach($js_files as $file): ?>
    <script src="<?php /* affichage des resultat*/ echo $file; ?>"></script>
<?php endforeach; ?>


</body>

</html>
<?php	  
  }else{
	  header('Location: index.php' );  
  }
?>
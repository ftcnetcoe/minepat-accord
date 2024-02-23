<?php
session_start(); // ouverture de la session 
include("libraries/autoload.php");
use GroceryCrud\Core\GroceryCrud;

$database = include('database.php');
$config = include('config.php');
$crud = new GroceryCrud($config, $database);
include_once("db.php"); //pour les accès direct à la base de données

$namePage= "archi_contrat";
$namePrincipalAd = 'archives';



//error_reporting(E_ALL);
//ini_set("display_errors", 1);


$crud->setTable('archive'); //definition de la table
$crud->setSubject('Archives', 'Gestion des Archives ');

$crud->setRelation('IDProjet', 'Projet', 'IntitulleProjet');


//definition de l'afichage des champs de la table
$crud->displayAs(array(
            'IDProjet' => "Projet",
	     	'PJ_ConvocatComisAttrib' => "Convocation a la Comission d\'attribution",   
		    'PJ_PVComisAttrib' => 'PV de la commission d\'attribution ',
            'PJ_VisaBudgetaire' => 'Visa Budgetaire et de Conformité',
		    'PJ_NotifAttrib' => 'Notification d\'attribution',
            'PJ_DecisNfruc' => "Notification de la decision d\'infructuosité",
            'PJ_DecisSansSuite' => "Notification de la decision de sans Suite",
            'PJ_AvisAttrib' => 'Avis d\'attribution',
            'PJ_JnalSignatureElec' => "Journal des signature Electroniques",
            'Contrat_Acte' => "Contrat/Acte d'engagement",
            'PJ_NotifRejet' => 'Notification de Rejet',                 	
)); 

		
		
 $crud->columns(['IDProjet','PJ_ConvocatComisAttrib','PJ_PVComisAttrib','PJ_VisaBudgetaire','PJ_NotifRejet','PJ_NotifAttrib','PJ_DecisNfruc','PJ_DecisSansSuite','PJ_AvisAttrib','PJ_JnalSignatureElec','Contrat_Acte']);
 $crud->editFields(['IDProjet','PJ_ConvocatComisAttrib','PJ_PVComisAttrib','PJ_VisaBudgetaire','PJ_NotifRejet','PJ_NotifAttrib','PJ_DecisNfruc','PJ_DecisSansSuite','PJ_AvisAttrib','PJ_JnalSignatureElec','Contrat_Acte']);
 $crud->addFields(['IDProjet','PJ_ConvocatComisAttrib','PJ_PVComisAttrib','PJ_VisaBudgetaire','PJ_NotifRejet','PJ_NotifAttrib','PJ_DecisNfruc','PJ_DecisSansSuite','PJ_AvisAttrib','PJ_JnalSignatureElec','Contrat_Acte']);
$crud->where([
    'archive.is_delete = 1',
]);

$crud->callbackColumn('PJ_ConvocatComisAttrib', function ($value, $row) {
    $Page = "archi_contrat";
    
             $modal='<div class="modal fade" id="PJ_ConvocatComisAttrib'.$row->id_archive.'" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content" style="min-height: 150px; max-height: 200px;">
                  <div class="modal-header">
                                <h4 class="modal-title">Archive</h4>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                      <form action="archive_traitement.php" method="post"  role="form" enctype="multipart/form-data">
                    <div class="modal-body">  
                    <label for="modele" class="form-label">Lancement de la Consultation</label>
                    <input type="file" name="PJ" id="PJ" class="form-control">
                                    <input id="ID" name="ID" type="hidden" value="'.$row->id_archive.'" />
                                    <input id="page" name="page" type="hidden" value="'.$Page.'" />
                                    <input id="champs" name="champs" type="hidden" value="PJ_ConvocatComisAttrib" />
                    
                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                                </div>
                                </form>
    
                    
                  </div>
                </div>
              </div>'; 
              if (empty($row->PJ_ConvocatComisAttrib)){
               $modal= $modal. '<center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_ConvocatComisAttrib'.$row->id_archive.'">Ajout</button></center>'; 
              }else{
                $modal= $modal. '<a href="/files/docprojet/'.$row->PJ_ConvocatComisAttrib.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;​<span>'.$row->PJ_ConvocatComisAttrib.'</span></center>'; 
                $modal= $modal. '<br/><br/><center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_ConvocatComisAttrib'.$row->id_archive.'">Modification</button></center>'; 
               }      
                return $modal; 
});
$crud->callbackColumn('PJ_PVComisAttrib', function ($value, $row) {
    $Page = "archi_contrat";
    
             $modal='<div class="modal fade" id="PJ_PVComisAttrib'.$row->id_archive.'" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content" style="min-height: 150px; max-height: 200px;">
                  <div class="modal-header">
                                <h4 class="modal-title">Archive</h4>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                      <form action="archive_traitement.php" method="post"  role="form" enctype="multipart/form-data">
                    <div class="modal-body">  
                    <label for="modele" class="form-label">Registre des Retraits</label>
                    <input type="file" name="PJ" id="PJ" class="form-control">
                                    <input id="ID" name="ID" type="hidden" value="'.$row->id_archive.'" />
                                    <input id="page" name="page" type="hidden" value="'.$Page.'" />
                                    <input id="champs" name="champs" type="hidden" value="PJ_PVComisAttrib" />
                    
                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                                </div>
                                </form>
    
                    
                  </div>
                </div>
              </div>'; 
              if (empty($row->PJ_PVComisAttrib)){
               $modal= $modal. '<center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_PVComisAttrib'.$row->id_archive.'">Ajout</button></center>'; 
              }else{  
                $modal= $modal. '<a href="/files/docprojet/'.$row->PJ_PVComisAttrib.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;​<span>'.$row->PJ_PVComisAttrib.'</span>'; 
                $modal= $modal. '<br/><br/><center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_PVComisAttrib'.$row->id_archive.'">Modification</button></center>'; 
                
            }      
                return $modal; 
});
$crud->callbackColumn('PJ_VisaBudgetaire', function ($value, $row) {
    $Page = "archi_contrat";
    
             $modal='<div class="modal fade" id="PJ_VisaBudgetaire'.$row->id_archive.'" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content" style="min-height: 150px; max-height: 200px;">
                  <div class="modal-header">
                                <h4 class="modal-title">Archive</h4>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                      <form action="archive_traitement.php" method="post"  role="form" enctype="multipart/form-data">
                    <div class="modal-body">  
                    <label for="modele" class="form-label">Registre des Dépots de Plis</label>
                    <input type="file" name="PJ" id="PJ" class="form-control">
                                    <input id="ID" name="ID" type="hidden" value="'.$row->id_archive.'" />
                                    <input id="page" name="page" type="hidden" value="'.$Page.'" />
                                    <input id="champs" name="champs" type="hidden" value="PJ_VisaBudgetaire" />
                    
                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                                </div>
                                </form>
    
                    
                  </div>
                </div>
              </div>'; 
              if (empty($row->PJ_VisaBudgetaire)){
               $modal= $modal. '<center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_VisaBudgetaire'.$row->id_archive.'">Ajout</button></center>'; 
              }else{
               $modal= $modal. '<a href="/files/docprojet/'.$row->PJ_VisaBudgetaire.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;​<span>'.$row->PJ_VisaBudgetaire.'</span>'; 
               $modal= $modal. '<br/><br/><center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_VisaBudgetaire'.$row->id_archive.'">Modification</button></center>'; 
               
            }      
                return $modal; 
});
$crud->callbackColumn('PJ_NotifAttrib', function ($value, $row) {
    $Page = "archi_contrat";
    
             $modal='<div class="modal fade" id="PJ_NotifAttrib'.$row->id_archive.'" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content" style="min-height: 150px; max-height: 200px;">
                  <div class="modal-header">
                                <h4 class="modal-title">Archive</h4>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                      <form action="archive_traitement.php" method="post"  role="form" enctype="multipart/form-data">
                    <div class="modal-body">  
                    <label for="modele" class="form-label">PV de la Commission</label>
                    <input type="file" name="PJ" id="PJ" class="form-control">
                                    <input id="ID" name="ID" type="hidden" value="'.$row->id_archive.'" />
                                    <input id="page" name="page" type="hidden" value="'.$Page.'" />
                                    <input id="champs" name="champs" type="hidden" value="PJ_NotifAttrib" />
                    
                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                                </div>
                                </form>
    
                    
                  </div>
                </div>
              </div>'; 
              if (empty($row->PJ_NotifAttrib)){
               $modal= $modal. '<center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_NotifAttrib'.$row->id_archive.'">Ajout</button></center>'; 
              }else{
               $modal= $modal. '<a href="/files/docprojet/'.$row->PJ_NotifAttrib.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;​<span>'.$row->PJ_NotifAttrib.'</span>'; 
               $modal= $modal. '<br/><br/><center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_NotifAttrib'.$row->id_archive.'">Modification</button></center>'; 
               
            }      
                return $modal; 
});
$crud->callbackColumn('PJ_DecisNfruc', function ($value, $row) {
    $Page = "archi_contrat";
    
             $modal='<div class="modal fade" id="PJ_DecisNfruc'.$row->id_archive.'" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content" style="min-height: 150px; max-height: 200px;">
                  <div class="modal-header">
                                <h4 class="modal-title">Archive</h4>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                      <form action="archive_traitement.php" method="post"  role="form" enctype="multipart/form-data">
                    <div class="modal-body">  
                    <label for="modele" class="form-label">Tableau d\'analyse</label>
                    <input type="file" name="PJ" id="PJ" class="form-control">
                                    <input id="ID" name="ID" type="hidden" value="'.$row->id_archive.'" />
                                    <input id="page" name="page" type="hidden" value="'.$Page.'" />
                                    <input id="champs" name="champs" type="hidden" value="PJ_DecisNfruc" />
                    
                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                                </div>
                                </form>
    
                    
                  </div>
                </div>
              </div>'; 
              if (empty($row->PJ_DecisNfruc)){
               $modal= $modal. '<center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_DecisNfruc'.$row->id_archive.'">Ajout</button></center>'; 
              }else{
               $modal= $modal. '<a href="/files/docprojet/'.$row->PJ_DecisNfruc.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;​<span>'.$row->PJ_DecisNfruc.'</span>'; 
               $modal= $modal. '<br/><br/><center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_DecisNfruc'.$row->id_archive.'">Modification</button></center>'; 
               
            }      
                return $modal; 
});
$crud->callbackColumn('PJ_DecisSansSuite', function ($value, $row) {
    $Page = "archi_contrat";
    
             $modal='<div class="modal fade" id="PJ_DecisSansSuite'.$row->id_archive.'" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content" style="min-height: 150px; max-height: 200px;">
                  <div class="modal-header">
                                <h4 class="modal-title">Archive</h4>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                      <form action="archive_traitement.php" method="post"  role="form" enctype="multipart/form-data">
                    <div class="modal-body">  
                    <label for="modele" class="form-label">Rapport de Presentation</label>
                    <input type="file" name="PJ" id="PJ" class="form-control">
                                    <input id="ID" name="ID" type="hidden" value="'.$row->id_archive.'" />
                                    <input id="page" name="page" type="hidden" value="'.$Page.'" />
                                    <input id="champs" name="champs" type="hidden" value="PJ_DecisSansSuite" />
                    
                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                                </div>
                                </form>
    
                    
                  </div>
                </div>
              </div>'; 
              if (empty($row->PJ_DecisSansSuite)){
               $modal= $modal. '<center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_DecisSansSuite'.$row->id_archive.'">Ajout</button></center>'; 
              }else{
               $modal= $modal. '<a href="/files/docprojet/'.$row->PJ_DecisSansSuite.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;​<span>'.$row->PJ_DecisSansSuite.'</span>'; 
               $modal= $modal. '<br/><br/><center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_DecisSansSuite'.$row->id_archive.'">Modification</button></center>'; 
               
            }      
                return $modal; 
});
$crud->callbackColumn('PJ_NotifRejet', function ($value, $row) {
    $Page = "archi_contrat";
    
             $modal='<div class="modal fade" id="PJ_NotifRejet'.$row->id_archive.'" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content" style="min-height: 150px; max-height: 200px;">
                  <div class="modal-header">
                                <h4 class="modal-title">Archive</h4>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                      <form action="archive_traitement.php" method="post"  role="form" enctype="multipart/form-data">
                    <div class="modal-body">  
                    <label for="modele" class="form-label">Rapport de Presentation</label>
                    <input type="file" name="PJ" id="PJ" class="form-control">
                                    <input id="ID" name="ID" type="hidden" value="'.$row->id_archive.'" />
                                    <input id="page" name="page" type="hidden" value="'.$Page.'" />
                                    <input id="champs" name="champs" type="hidden" value="PJ_NotifRejet" />
                    
                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                                </div>
                                </form>
    
                    
                  </div>
                </div>
              </div>'; 
              if (empty($row->PJ_NotifRejet)){
               $modal= $modal. '<center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_NotifRejet'.$row->id_archive.'">Ajout</button></center>'; 
              }else{
               $modal= $modal. '<a href="/files/docprojet/'.$row->PJ_NotifRejet.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;​<span>'.$row->PJ_NotifRejet.'</span>'; 
               $modal= $modal. '<br/><br/><center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_NotifRejet'.$row->id_archive.'">Modification</button></center>'; 
               
            }      
                return $modal; 
});
$crud->callbackColumn('PJ_AvisAttrib', function ($value, $row) {
    $Page = "archi_contrat";
    
             $modal='<div class="modal fade" id="PJ_AvisAttrib'.$row->id_archive.'" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content" style="min-height: 150px; max-height: 200px;">
                  <div class="modal-header">
                                <h4 class="modal-title">Archive</h4>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                      <form action="archive_traitement.php" method="post"  role="form" enctype="multipart/form-data">
                    <div class="modal-body">  
                    <label for="modele" class="form-label">Rapport de Presentation</label>
                    <input type="file" name="PJ" id="PJ" class="form-control">
                                    <input id="ID" name="ID" type="hidden" value="'.$row->id_archive.'" />
                                    <input id="page" name="page" type="hidden" value="'.$Page.'" />
                                    <input id="champs" name="champs" type="hidden" value="PJ_AvisAttrib" />
                    
                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                                </div>
                                </form>
    
                    
                  </div>
                </div>
              </div>'; 
              if (empty($row->PJ_AvisAttrib)){
               $modal= $modal. '<center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_AvisAttrib'.$row->id_archive.'">Ajout</button></center>'; 
              }else{
               $modal= $modal. '<a href="/files/docprojet/'.$row->PJ_AvisAttrib.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;​<span>'.$row->PJ_AvisAttrib.'</span>'; 
               $modal= $modal. '<br/><br/><center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_AvisAttrib'.$row->id_archive.'">Modification</button></center>'; 
               
            }      
                return $modal; 
});
$crud->callbackColumn('PJ_JnalSignatureElec', function ($value, $row) {
    $Page = "archi_contrat";
    
             $modal='<div class="modal fade" id="PJ_JnalSignatureElec'.$row->id_archive.'" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content" style="min-height: 150px; max-height: 200px;">
                  <div class="modal-header">
                                <h4 class="modal-title">Archive</h4>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                      <form action="archive_traitement.php" method="post"  role="form" enctype="multipart/form-data">
                    <div class="modal-body">  
                    <label for="modele" class="form-label">Rapport de Presentation</label>
                    <input type="file" name="PJ" id="PJ" class="form-control">
                                    <input id="ID" name="ID" type="hidden" value="'.$row->id_archive.'" />
                                    <input id="page" name="page" type="hidden" value="'.$Page.'" />
                                    <input id="champs" name="champs" type="hidden" value="PJ_JnalSignatureElec" />
                    
                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                                </div>
                                </form>
    
                    
                  </div>
                </div>
              </div>'; 
              if (empty($row->PJ_JnalSignatureElec)){
               $modal= $modal. '<center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_JnalSignatureElec'.$row->id_archive.'">Ajout</button></center>'; 
              }else{
               $modal= $modal. '<a href="/files/docprojet/'.$row->PJ_JnalSignatureElec.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;​<span>'.$row->PJ_JnalSignatureElec.'</span>'; 
               $modal= $modal. '<br/><br/><center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#PJ_JnalSignatureElec'.$row->id_archive.'">Modification</button></center>'; 
               
            }      
                return $modal; 
});
$crud->callbackColumn('Contrat_Acte', function ($value, $row) {
    $Page = "archi_contrat";
    
             $modal='<div class="modal fade" id="Contrat_Acte'.$row->id_archive.'" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content" style="min-height: 150px; max-height: 200px;">
                  <div class="modal-header">
                                <h4 class="modal-title">Archive</h4>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                      <form action="archive_traitement.php" method="post"  role="form" enctype="multipart/form-data">
                    <div class="modal-body">  
                    <label for="modele" class="form-label">Rapport de Presentation</label>
                    <input type="file" name="PJ" id="PJ" class="form-control">
                                    <input id="ID" name="ID" type="hidden" value="'.$row->id_archive.'" />
                                    <input id="page" name="page" type="hidden" value="'.$Page.'" />
                                    <input id="champs" name="champs" type="hidden" value="Contrat_Acte" />
                    
                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                                </div>
                                </form>
    
                    
                  </div>
                </div>
              </div>'; 
              if (empty($row->Contrat_Acte)){
               $modal= $modal. '<center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#Contrat_Acte'.$row->id_archive.'">Ajout</button></center>'; 
              }else{
               $modal= $modal. '<a href="/files/docprojet/'.$row->Contrat_Acte.'" download> <img src="/files/docprojet/telecharger.png" width="32" height="32"> </a>&nbsp;&nbsp;&nbsp;​<span>'.$row->Contrat_Acte.'</span>'; 
               $modal= $modal. '<br/><br/><center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#Contrat_Acte'.$row->id_archive.'">Modification</button></center>'; 
               
            }      
                return $modal; 
});
              

$crud->callbackDelete(function ($stateParameters) {

    $id = $stateParameters->primaryKeyValue;
    $modele = 50;
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $delete = $pdo->prepare('Update archive SET is_delete = 0 WHERE id_archive = ?');
    $delete->execute([$id]);
    
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $debit = $pdo->prepare('INSERT INTO logs (id_action, id_user, date_action, id_element) VALUES (?,?,?,?)');
    $debit->execute([$modele , $_SESSION['idu'] , $dateact, $id]);
    return $stateParameters;
});


$crud->callbackBeforeUpdate(function ($stateParameters){
    
    
    $dateact = date("Y-m-d H:i:s");
    
    $stateParameters->data['date_update']=  $dateact;
    $stateParameters->data['id_update']=  $_SESSION['idu'];
        
   
    return $stateParameters;
});
$crud->callbackAfterUpdate(function ($stateParameters){
    $dateact = date("Y-m-d H:i:s");
    $modele = 49;
    $id = $stateParameters->primaryKeyValue;
    
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $debit = $pdo->prepare('INSERT INTO logs (id_action, id_user, date_action, id_element) VALUES (?,?,?,?)');
    $debit->execute([$modele , $_SESSION['idu'] , $dateact, $id]);
    
    
    return $stateParameters;
});



$crud->defaultOrdering('IDProjet', 'ASC');

if ($_SESSION['droit']!= "admin" && $_SESSION['droit']!= "Archivage"){
   
    
    $crud->unsetDelete();
}
$crud->unsetEdit();
$crud->unsetAdd(); 
$crud->unsetDeleteMultiple();

$uploadValidations = [
    'maxUploadSize' => '20M', // 20 Mega Bytes
    'minUploadSize' => '1K', // 1 Kilo Byte
    'allowedFileTypes' => [
        'pdf,PDF,doc,Docx,ZIP,zip,ISO,iso'
    ]
];
  
 
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
if (isset($_SESSION['idu'])&& ( $_SESSION['droit']== "admin" || $_SESSION['droit'] == "Archivage")){ // si paramètres correct. 
?>

<html>

<head>
	
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        
        
        <title> CONTRACTUALISATION - MINEPAT </title>

       
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
                <?php if ($_SESSION['droit'] != "admin" && $_SESSION['droit']!= "Archivage") {
       echo' <link href="new_assets/assets_dashboard/css/style2.css" rel="stylesheet">';
        }else{
        echo' <link href="new_assets/assets_dashboard/css/style.css" rel="stylesheet">';}?>
  
</head>
<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="54">

    	 <?php include 'new_includes/header.php' ?>
    	  <?php if ($_SESSION['droit'] == "admin" || $_SESSION['droit']== "Archivage") {
      		 include 'slide.php';
        }
        ?>
    	 
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
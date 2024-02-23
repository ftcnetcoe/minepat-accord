<?php
session_start(); // ouverture de la session 
include("libraries/autoload.php");
use GroceryCrud\Core\GroceryCrud;

$database = include('database.php');
$config = include('config.php');
$crud = new GroceryCrud($config, $database);
include_once("db.php"); //pour les accès direct à la base de données

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
error_reporting(E_ALL);
ini_set("display_errors", 1);

$id = '';


if (!empty($_POST['ID'])){
    $page= $_POST['page'];
    $ID= $_POST['ID'];
    $champs = $_POST['champs'];
    var_dump($champs);
    
   


      $file_Lancement = '';
            $extension = pathinfo($_FILES['PJ']['name'])['extension'];
            $extensionAutorise = array('php', 'html', 'xml');
            if (!in_array(strtolower($extension), $extensionAutorise)) {
                if ($_FILES['PJ']['size'] <= 10000000) {
                    $nameFile = pathinfo($_FILES['PJ']['name'], PATHINFO_FILENAME);
                    $file = 'files/docprojet/' . $nameFile . '.' . $extension;
                    move_uploaded_file($_FILES['PJ']['tmp_name'], $file);
                    $file_Lancement = $_FILES['PJ']['name'];
                    
                }
            }
            
   if ( $champs == "PJ_Lancement"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_Lancement = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    }
   elseif ( $champs == "PJ_RegistreRetrait"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_RegistreRetrait = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    } 
    elseif ( $champs == "PJ_RegistrePlis"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_RegistrePlis = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    } 
    elseif ( $champs == "PJ_PV_ComOuverture"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_PV_ComOuverture = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    } 
    elseif ( $champs == "PJ_TabBordAnalyOffres"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_TabBordAnalyOffres = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    } 
    elseif ( $champs == "PJ_RapportPres"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_RapportPres = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    }  

    elseif ( $champs == "PJ_ConvocatComisAttrib"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_ConvocatComisAttrib = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    }
   elseif ( $champs == "PJ_PVComisAttrib"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_PVComisAttrib = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    } 
    elseif ( $champs == "PJ_VisaBudgetaire"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_VisaBudgetaire = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    } 
    elseif ( $champs == "PJ_NotifRejet"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_NotifRejet = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    } 
    elseif ( $champs == "PJ_NotifAttrib"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_NotifAttrib = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    } 
    elseif ( $champs == "PJ_DecisNfruc"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_DecisNfruc = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    }
    elseif ( $champs == "PJ_DecisSansSuite"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_DecisSansSuite = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    }
   elseif ( $champs == "PJ_AvisAttrib"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_AvisAttrib = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    } 
    elseif ( $champs == "PJ_JnalSignatureElec"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_JnalSignatureElec = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    } 
    elseif ( $champs == "Contrat_Acte"){

      $Enregistre= $pdo->prepare('UPDATE archive SET Contrat_Acte = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    } 
    elseif ( $champs == "PJ_OSDEMARAGE"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_OSDEMARAGE = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    } 
    elseif ( $champs == "PJ_Avenant_MarchesAddi"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_Avenant_MarchesAddi = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    }



    elseif ( $champs == "PJ_CCAP_CCAG"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_CCAP_CCAG = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    } 
    elseif ( $champs == "PJ_CCTP_CCTG"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_CCTP_CCTG = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    } 
    elseif ( $champs == "PJ_Offre"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_Offre = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    } 
    elseif ( $champs == "PJ_DecisSans"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_DecisSans = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    } 
    elseif ( $champs == "PJ_AvisAttribExe"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_AvisAttribExe = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    }
    elseif ( $champs == "PJ_JnalSignatureElecExe"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_JnalSignatureElecExe = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    }
   elseif ( $champs == "PJ_Contrat_Acte"){

      $Enregistre= $pdo->prepare('UPDATE archive SET PJ_Contrat_Acte = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    } 
    elseif ( $champs == "OS_Demarage"){

      $Enregistre= $pdo->prepare('UPDATE archive SET OS_Demarage = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    } 
    elseif ( $champs == "Rapport_Avancement"){

      $Enregistre= $pdo->prepare('UPDATE archive SET Rapport_Avancement = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    } 
    elseif ( $champs == "Liquidation_Dcpte"){

      $Enregistre= $pdo->prepare('UPDATE archive SET Liquidation_Dcpte = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    } 
    elseif ( $champs == "Dcptes_Prestation"){

      $Enregistre= $pdo->prepare('UPDATE archive SET Dcptes_Prestation = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    }
    elseif ( $champs == "Ordres_Paiement"){

      $Enregistre= $pdo->prepare('UPDATE archive SET Ordres_Paiement = ? WHERE (id_archive = ?)');
      $Enregistre->execute([$file_Lancement, $ID]);
    }



    $dateact = date("Y-m-d H:i:s");
    $modele = 49;
    
    $debit = $pdo->prepare('INSERT INTO logs (id_action, id_user, date_action, id_element) VALUES (?,?,?,?)');
    $debit->execute([$modele , $_SESSION['idu'] , $dateact, $ID]);
}
header("Location:".$_SERVER[HTTP_REFERER]);